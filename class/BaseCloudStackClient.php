<?php

/*
 * This file is part of the CloudStack PHP Client.
 *
 * (c) Quentin Pleplé <quentin.pleple@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once dirname(__FILE__) . "/CloudStackClientException.php";

class BaseCloudStackClient {

    public $apiKey;
    public $secretKey;
    public $endpoint; // Does not ends with a "/"

    public function __construct($endpoint, $apiKey, $secretKey) {
        // API endpoint
        if (empty($endpoint)) {
            throw new CloudStackClientException(ENDPOINT_EMPTY_MSG, ENDPOINT_EMPTY);
        }

        if (!preg_match("|^http://.*$|", $endpoint)) {
            throw new CloudStackClientException(sprintf(ENDPOINT_NOT_URL_MSG, $endpoint), ENDPOINT_NOT_URL);
        }

        // $endpoint does not ends with a "/"
        $this->endpoint = substr($endpoint, -1) == "/" ? substr($endpoint, 0, -1) : $endpoint;

        // API key
        if (empty($apiKey)) {
            throw new CloudStackClientException(APIKEY_EMPTY_MSG, APIKEY_EMPTY);
        }
        $this->apiKey = $apiKey;

        // API secret
        if (empty($secretKey)) {
            throw new CloudStackClientException(SECRETKEY_EMPTY_MSG, SECRETKEY_EMPTY);
        }
        $this->secretKey = $secretKey;
    }

    public function getSignature($queryString) {
        if (empty($queryString)) {
            throw new CloudStackClientException(STRTOSIGN_EMPTY_MSG, STRTOSIGN_EMPTY);
        }

        $hash = @hash_hmac("SHA1", $queryString, $this->secretKey, true);
        $base64encoded = base64_encode($hash);
        return urlencode($base64encoded);
    }

    public function request($command, $args = array()) {
        if (empty($command)) {
            throw new CloudStackClientException(NO_COMMAND_MSG, NO_COMMAND);
        }

        if (!is_array($args)) {
            throw new CloudStackClientException(sprintf(WRONG_REQUEST_ARGS_MSG, $args), WRONG_REQUEST_ARGS);
        }

        foreach ($args as $key => $value) {
            if ($value == "") {
                unset($args[$key]);
            }
        }

        // Building the query
        $args['apikey'] = $this->apiKey;
        $args['command'] = $command;
        $args['response'] = "json";
        ksort($args);
        $query = http_build_query($args);
        $query = str_replace("+", "%20", $query);
        $query .= "&signature=" . $this->getSignature(strtolower($query));
        $url = $this->endpoint . "?" . $query;
        //$json = file_get_contents($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, '3');
        $json = curl_exec($ch);
        if (curl_errno($ch)) {
            $json = json_encode(array('createdomainresponse' => array('errortext' => curl_error($ch))));
        }
        curl_close($ch);
        $response = json_decode($json);
        return $response;
    }

}
