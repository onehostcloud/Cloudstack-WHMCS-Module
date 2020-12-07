<?php

use WHMCS\Database\Capsule;
//ini_set('display_errors',true);
//error_reporting(E_ALL);
function cloudstack_ConfigOptions() {
    $id = (int) $_REQUEST["id"];
    $query = Capsule::table("tblcustomfields")->where('relid', $id)->where('fieldname', 'domainid')->where('type', 'product')->get();
    if (!$query) {
        Capsule::table("tblcustomfields")->insert(
                [
                    "type" => "product",
                    "relid" => $id,
                    "fieldname" => "domainid",
                    "fieldtype" => "text",
                    "adminonly" => "on"
                ]
        );
    }
    $query = Capsule::table("tblcustomfields")->where('relid', $id)->where('fieldname', 'cloudstackvmid')->where('type', 'product')->get();
    if (!$query) {
        Capsule::table("tblcustomfields")->insert(
                [
                    "type" => "product",
                    "relid" => $id,
                    "fieldname" => "cloudstackvmid",
                    "fieldtype" => "text",
                    "adminonly" => "on"
                ]
        );
    }
    $query = Capsule::table("tblcustomfields")->where('relid', $id)->where('fieldname', 'cloudstackaccountid')->where('type', 'product')->get();
    if (!$query) {
        Capsule::table("tblcustomfields")->insert(
                [
                    "type" => "product",
                    "relid" => $id,
                    "fieldname" => "cloudstackaccountid",
                    "fieldtype" => "text",
                    "adminonly" => "on"
                ]
        );
    }
    $query = Capsule::table("tblcustomfields")->where('relid', $id)->where('fieldname', 'networkid')->where('type', 'product')->get();
    if (!$query) {
        Capsule::table("tblcustomfields")->insert(
                [
                    "type" => "product",
                    "relid" => $id,
                    "fieldname" => "networkid",
                    "fieldtype" => "text",
                    "adminonly" => "on"
                ]
        );
    }
    $query = Capsule::table("tblcustomfields")->where('relid', $id)->where('fieldname', 'LIKE', '%ipstart%')->where('type', 'product')->get();
    if (!$query) {
        Capsule::table("tblcustomfields")->insert(
                [
                    "type" => "product",
                    "relid" => $id,
                    "fieldname" => "ipstart|IP Start",
                    "fieldtype" => "text",
                    "required" => "on",
                    "showorder" => "on"
                ]
        );
    }
    $query = Capsule::table("tblcustomfields")->where('relid', $id)->where('fieldname', 'LIKE', '%ipend%')->where('type', 'product')->get();
    if (!$query) {
        Capsule::table("tblcustomfields")->insert(
                [
                    "type" => "product",
                    "relid" => $id,
                    "fieldname" => "ipend|IP End",
                    "fieldtype" => "text",
                    "required" => "on",
                    "showorder" => "on"
                ]
        );
    }
    $query = Capsule::table("tblcustomfields")->where('relid', $id)->where('fieldname', 'LIKE', '%netmask%')->where('type', 'product')->get();
    if (!$query) {
        Capsule::table("tblcustomfields")->insert(
                [
                    "type" => "product",
                    "relid" => $id,
                    "fieldname" => "netmask|NetMask",
                    "fieldtype" => "text",
                    "required" => "on",
                    "showorder" => "on"
                ]
        );
    }
    $query = Capsule::table("tblcustomfields")->where('relid', $id)->where('fieldname', 'LIKE', '%networktype%')->where('type', 'product')->get();
    if (!$query) {
        Capsule::table("tblcustomfields")->insert(
                [
                    "type" => "product",
                    "relid" => $id,
                    "fieldname" => "networktype|Choose Network Type",
                    "fieldtype" => "dropdown",
                    "required" => "on",
                    "showorder" => "on",
                    "fieldoptions" => "Shared,Guest,Isolated"
                ]
        );
    }
    $query = Capsule::table("tblcustomfields")->where('relid', $id)->where('fieldname', 'LIKE', '%domain%')->where('type', 'product')->get();
    if (!$query) {
        Capsule::table("tblcustomfields")->insert(
                [
                    "type" => "product",
                    "relid" => $id,
                    "fieldname" => "domain|Domain Name",
                    "fieldtype" => "text",
                    "required" => "on",
                    "showorder" => "on",
                ]
        );
    }
    $query = Capsule::table("tblcustomfields")->where('relid', $id)->where('fieldname', 'LIKE', '%gateway%')->where('type', 'product')->get();
    if (!$query) {
        Capsule::table("tblcustomfields")->insert(
                [
                    "type" => "product",
                    "relid" => $id,
                    "fieldname" => "gateway|Gateway",
                    "fieldtype" => "text",
                    "required" => "on",
                    "showorder" => "on",
                ]
        );
    }

    # Should return an array of the module options for each product - maximum of 24
    return [
        "API Key" => [
            "FriendlyName" => "API Key",
            "Type" => "text", # Text Box
            "Size" => "25", # Defines the Field Width
            "Description" => "",
        ],
        "Secret Key" => [
            "FriendlyName" => "Secret Key",
            "Type" => "text", # Text Box
            "Size" => "25", # Defines the Field Width
            "Description" => "",
        ],
        "End Point" => [
            "FriendlyName" => "End Point",
            "Type" => "text", # Text Box
            "Size" => "25", # Defines the Field Width
            "Description" => "API url",
        ],
        "License" => [
            "FriendlyName" => "License",
            "Type" => "text", # Text Box
            "Size" => "25", # Defines the Field Width
            "Description" => "",
        ],
        "Memory" => [
            "FriendlyName" => "Memory",
            "Type" => "text", # Text Box
            "Size" => "25", # Defines the Field Width
            "Description" => "In GB",
        ],
        "create_opt" => array(
            "FriendlyName" => "",
            "Description" => "<a href='#' id='createoption'>Create Config Option</a><script>
			$(document).ready(function(){
			 
				$( '#createoption' ).click(function() {
				
						$.ajax({
						   url: 'index.php',
						   method: 'POST',
						   data: 'ajaxpage=createconfig&productid=" . $id . "',
						   success: function(data){
                                                    console.log(data);
                                                  	window.location.href='configproducts.php?action=edit&id=" . $id . "&tab=3#tab=3';
                                                   }
						});
				});
				  
			
			});
	
		</script>"
        ),
    ];
}

function cloudstack_CreateAccount($params) {
    if (empty($params["domain"])) {
        $params["domain"] = $params['customfields']['domain'];
        Capsule::table('tblhosting')->where('id', $params["serviceid"])->update([
            'domain' => $params['customfields']['domain']
        ]);
        $domainname = explode('.', $params['customfields']['domain']);
        if (is_array($domainname)) {
            $dname = $domainname['0'];
        } else {
            $dname = $domain;
        }
        Capsule::table('tblhosting')->where('id', $params["serviceid"])->update([
            'username' => $dname
        ]);
    } else {
        $domainname = explode('.', $params['domain']);
        if (is_array($domainname)) {
            $dname = $domainname['0'];
        } else {
            $dname = $domain;
        }
    }
    $error = false;
    $serviceid = $params["serviceid"]; # Unique ID of the product/service in the WHMCS Database
    $pid = $params["pid"]; # Product/Service ID
    $domain = $params["domain"];
    $username = $params["username"];
    $password = $params["password"];
    #client details
    $firstname = $params['clientsdetails']['firstname'];
    $lastname = $params['clientsdetails']['lastname'];
    $email = $params['clientsdetails']['email'];
    $cloudusername = $params['clientsdetails']['firstname'] . $params['clientsdetails']['userid'];

    $cloudstack = request($params);
//    $networkoffering = $cloudstack->listNetworkOfferings();
//    print_r($networkoffering);
//    exit();
    if (empty($params['customfields']['domainid'])) {
        $domain = $cloudstack->createDomain($domain);
        // print_r($domain); exit();
        $domainid = $domain->createdomainresponse->domain->id;
        $queryacct = Capsule::select("SELECT * FROM  `tblcustomfields` WHERE fieldname='domainid' AND relid='" . $params['pid'] . "' AND type='product'");
        Capsule::table('tblcustomfieldsvalues')->where('fieldid', $queryacct[0]->id)->where('relid', $params["serviceid"])->update([
            'value' => $domain->createdomainresponse->domain->id
        ]);
    } else {
        $domainid = $params['customfields']['domainid'];
    }

    if (isset($domainid)) { //$domain->createdomainresponse->domain->id 'ad415254-80ba-4765-a37f-0715bd21bec0'
        if (empty($params['customfields']['cloudstackaccountid'])) {
            $account = $cloudstack->createAccount(2, $email, $firstname, $lastname, $password, $username, $account, $domainid);
            $accountid = $account->createaccountresponse->account->id;
            $queryacc = Capsule::select("SELECT * FROM  `tblcustomfields` WHERE fieldname='cloudstackaccountid' AND relid='" . $params['pid'] . "' AND type='product'");

            Capsule::table('tblcustomfieldsvalues')->where('fieldid', $queryacc[0]->id)->where('relid', $params["serviceid"])->update([
                'value' => $account->createaccountresponse->account->id
            ]);
        } else {
            $accountid = $params['customfields']['cloudstackaccountid'];
        }
        if ($accountid) {
            $zoneid = $params['configoptions']['Zones'];
            $serviceofferid = $params['configoptions']['ServiceOffer'];
            $diskOfferingId = $params['configoptions']['DiskOffer'];
            $networktype = 'Account';
            if (empty($params['customfields']['networkid'])) {
                $networkoffering = $cloudstack->listNetworkOfferings();
                $networks = $cloudstack->createNetwork($dname, $dname, $networkoffering->listnetworkofferingsresponse->networkoffering[2]->id, $zoneid, $params['username'], $networktype, $domainid, $params['customfields']['ipend'], $params['customfields']['gateway'], $isDefault = "", true, $params['customfields']['netmask'], $params['domain'], $params['customfields']['ipstart']);
                $networkid = $networks->createnetworkresponse->network->id;
                if (isset($networks->createnetworkresponse->errortext)) {
                    return $networks->createnetworkresponse->errortext;
                }
                $querynet = Capsule::select("SELECT * FROM  `tblcustomfields` WHERE fieldname='networkid' AND relid='" . $params['pid'] . "' AND type='product'");
                Capsule::table('tblcustomfieldsvalues')->where('fieldid', $querynet[0]->id)->where('relid', $params["serviceid"])->update([
                    'value' => $networkid
                ]);
            } else {
                $networkid = $params['customfields']['networkid'];
            }
            $templateid = $params['configoptions']['Template'];
            if (isset($params['password'])) {
                $password = $params['password'];
                $passwordenabled = true;
            }

            $job = $cloudstack->deployVirtualMachine($serviceofferid, $templateid, $zoneid, $params['username'], $diskOfferingId, $dname, $domainid, $group = "", $hostId = "", 'XenServer', $keyPair = "", $dname, $networkid, $memory, $password, $passwordenabled);
            if (isset($job->deployvirtualmachineresponse->errortext)) {
                $error = true;
                $errormsg = $job->deployvirtualmachineresponse->errortext;
            } else {
                $row = Capsule::select("SELECT * FROM  `tblcustomfields` WHERE fieldname='cloudstackvmid' AND relid='" . $params['pid'] . "' AND type='product'");
                Capsule::table('tblcustomfieldsvalues')->where('fieldid', $row[0]->id)->where('relid', $params["serviceid"])->update([
                    'value' => $job->deployvirtualmachineresponse->id
                ]);
            }
            //exit();
        } else {
            $error = true;
            $errormsg = $account->createaccountresponse->errortext;
        }
    } else {
        $error = true;
        // print_r($domain);  exit();
        $errormsg = $domain->createdomainresponse->errortext;
    }
    if ($error == false) {
        $result = "success";
    } else {
        $result = $errormsg;
    }
    return $result;
}

function cloudstack_TerminateAccount($params) {
    $cloudstack = request($params);
    $id = $params['customfields']['cloudstackaccountid'];
    $domain = $cloudstack->deleteAccount($id);

    if ($domain->responsedeleteaccount->jobid) {
        $result = "success";
    } else {
        $result = $domain->responsedeleteaccount->errortext;
    }
    return $result;
}

function cloudstack_SuspendAccount($params) {
    // print_r($params);
    # Code to perform action goes here...

    $cloudstack = request($params);

    $id = $params['customfields']['cloudstackaccountid'];
    $domain = $cloudstack->disableAccount(TRUE, $params['username'], '', $id);

    if ($domain->disableaccountresponse->jobid) {
        $result = "success";
    } else {
        $result = $domain->responsedisableaccount->errortext;
    }
    return $result;
}

function cloudstack_UnsuspendAccount($params) {

    # Code to perform action goes here...
//

    $cloudstack = request($params);
    $id = $params['customfields']['cloudstackaccountid'];
    $domain = $cloudstack->enableAccount($params['username'], '', $id);

    if (!empty($domain->enableaccountresponse->account->id)) {
        $result = "success";
    } else {
        $result = $domain->responseenableaccount->errortext;
    }
    return $result;
}

function cloudstack_ChangePassword($params) {

    $cloudstack = request($params);
    $id = $params['customfields']['cloudstackvmid'];
    $reset = $cloudstack->resetPasswordForVirtualMachine($id);
    if ($reset->passwordforvirtualmachineresponse->jobid) {
        $result = "success";
    } else {
        $result = $reset->passwordforvirtualmachineresponse->errortext;
    }
    return $result;
}

//function cloudstack_ChangePackage($params) {
//
//    # Code to perform action goes here...
//
//    if ($successful) {
//        $result = "success";
//    } else {
//        $result = "Error Message Goes Here...";
//    }
//    return $result;
//}

function cloudstack_ClientArea($params) {
    $id = $params['customfields']['cloudstackvmid'];
    $cloudstack = request($params);
    //    cloudstack_CreateAccount($params)
    if ($_GET['page'] == 'rebuild') {
        $zones = $cloudstack->listZones(); // zones lists
        $zoneid = $zones->listzonesresponse->zone;


        $zonesoption = '';
        foreach ($zoneid as $zoneop) {
            // print_r($zoneop);
            $zonesoption .= '<option value=' . $zoneop->id . '>' . $zoneop->name . '</option>';
        }
        // echo $zonesoption;
        $serviceoffer = $cloudstack->listServiceOfferings(); //disk offered
        $serviceofferid = $serviceoffer->listserviceofferingsresponse->serviceoffering;
        $serviceoffersoption = '';
        foreach ($serviceofferid as $serviceop) {
            //   print_r($serviceop);
            $serviceoffersoption .= '<option value=' . $serviceop->id . '>' . $serviceop->name . '</option>';
        }


        $diskoffer = $cloudstack->listDiskOfferings(); //disk offered
        $diskOfferingId = $diskoffer->listdiskofferingsresponse->diskoffering;

        $diskoffers = '';
        // print_r($diskOfferingId);
        foreach ($diskOfferingId as $distopffop) {
            $diskoffers .= '<option value=' . $distopffop->id . '>' . $distopffop->displaytext . '</option>';
        }
        $template = $cloudstack->listTemplates('all');
        $templateid = $template->listtemplatesresponse->template;
        $templateopt = '';
        foreach ($templateid as $templateo) {
            $templateopt .= '<option value=' . $templateo->id . '>' . $templateo->name . '</option>';
        }
    }
    if (!isset($_GET['page'])) {
        $virtualmachine = $cloudstack->listVirtualMachines($account = "", $domainId = "", $forVirtualNetwork = "", $groupId = "", $hostId = "", $hypervisor = "", $id);
    }
    return array(
        'templatefile' => 'clientarea',
        'vars' => array(
            'zone' => $zonesoption,
            'serviceoffer' => $serviceoffersoption,
            'diskoffer' => $diskoffers,
            'template' => $templateopt,
            'response' => $response,
            'virtualmachine' => isset($virtualmachine->listvirtualmachinesresponse->virtualmachine[0]) ? $virtualmachine->listvirtualmachinesresponse->virtualmachine[0] : '',
            'logs' => $cloudstack->listAsyncJobs()->listasyncjobsresponse->asyncjobs
        ),
    );
}

function cloudstack_reboot($params) {

    $cloudstack = request($params);
    $id = $params['customfields']['cloudstackvmid'];
    $reboot = $cloudstack->rebootVirtualMachine($id);
    // print_r($reboot); exit();
    if ($reboot->rebootvirtualmachineresponse->jobid) {
        $result = "success";
    } else {
        $result = $reboot->rebootvirtualmachineresponse->errortext;
    }
    return $result;
}

function cloudstack_shutdown($params) {
    $cloudstack = request($params);
    $id = $params['customfields']['cloudstackvmid'];
    $stop = $cloudstack->stopVirtualMachine($id);
    if ($stop->stopvirtualmachineresponse->jobid) {
        $result = "success";
    } else {
        $result = $stop->stopvirtualmachineresponse->errortext;
    }
    return $result;
}

function cloudstack_start($params) {
    $cloudstack = request($params);
    $id = $params['customfields']['cloudstackvmid'];
    $start = $cloudstack->startVirtualMachine($id);
    if ($start->startvirtualmachineresponse->jobid) {
        $result = "success";
    } else {
        $result = $start->startvirtualmachineresponse->errortext;
    }
    return $result;
}

function cloudstack_ClientAreaCustomButtonArray() {
    $buttonarray = array(
        "Reboot Server" => "reboot",
        "Shutdown Server" => "shutdown",
        "Start Server" => "start",
    );
    return $buttonarray;
}

function cloudstack_AdminCustomButtonArray() {
    $buttonarray = array(
        "Reboot Server" => "reboot",
        "Shutdown Server" => "shutdown",
        "Start Server" => "start",
    );
    return $buttonarray;
}

function cloudstack_UsageUpdate($params) {

    $serverid = $params['serverid'];
    $serverhostname = $params['serverhostname'];
    $serverip = $params['serverip'];
    $serverusername = $params['serverusername'];
    $serverpassword = $params['serverpassword'];
    $serveraccesshash = $params['serveraccesshash'];
    $serversecure = $params['serversecure'];

    # Run connection to retrieve usage for all domains/accounts on $serverid
    # Now loop through results and update DB

    foreach ($results AS $domain => $values) {
        update_query("tblhosting", array(
            "diskused" => $values['diskusage'],
            "dislimit" => $values['disklimit'],
            "bwused" => $values['bwusage'],
            "bwlimit" => $values['bwlimit'],
            "lastupdate" => "now()",
                ), array("server" => $serverid, "domain" => $values['domain']));
    }
}

function request($params) {
    require_once __DIR__ . '/class/CloudStackClient.php';
    $cloudstack = new CloudStackClient($params['configoption3'], $params['configoption1'], $params['configoption2']);
    return $cloudstack;
}

function cloudstack_rebuild($params) {
    
}

function cloustack_generateconfigoption($name, $id, $data) {
    // echo $id;
    # Configurable Option
    $addconfigrablegroupname = "Cloudstak-" . $name . " " . $id . ":";
    $addconfigurabledescription = $name;
    $addconfigurableoptionname = $name;
    $configurableoptionresult = Capsule::table('tblproductconfiglinks')->where('pid', $id)->get();
    $configurableoptionlinkresult = Capsule::table('tblproductconfiggroups')->where('name', $addconfigrablegroupname)->get();
    // print_r($configurableoptionlinkresult);
    if (empty($configurableoptionlinkresult)) {
        try {
            $configurablegroupid = Capsule::table('tblproductconfiggroups')
                    ->insertGetId(
                    [
                        "name" => $addconfigrablegroupname,
                        "description" => $addconfigurabledescription
                    ]
            );

            Capsule::table('tblproductconfiglinks')
                    ->insertGetId(
                            [
                                "gid" => $configurablegroupid,
                                "pid" => $id
                            ]
            );
            $configid = Capsule::table('tblproductconfigoptions')
                    ->insertGetId(
                    [
                        "gid" => $configurablegroupid,
                        "optionname" => $addconfigurableoptionname,
                        "optiontype" => "1",
                        "qtyminimum" => '',
                        "qtymaximum" => '',
                        "order" => "",
                        "hidden" => ""
                    ]
            );
            foreach ($data as $key => $n) {
                $tblpricing_rel_id[] = Capsule::table('tblproductconfigoptionssub')
                        ->insertGetId(
                        [
                            "configid" => $configid,
                            "optionname" => $key . "|" . $n,
                            "sortorder" => "",
                            "hidden" => ""
                        ]
                );
            }
            $datas = Capsule::table('tblcurrencies')->orderBy('code', 'DESC')->get();
            foreach ($datas as $data) {
                $curr_id = $data->id;
                $curr_code = $data->code;
                $currenciesarray[$curr_id] = $curr_code;
            }
            foreach ($tblpricing_rel_id as $tdval) {
                foreach ($currenciesarray as $curr_id => $currency) {
                    Capsule::table('tblpricing')->insert(
                            [
                                'type' => 'configoptions',
                                'currency' => $curr_id,
                                'relid' => $tdval,
                                'msetupfee' => '',
                                'qsetupfee' => '',
                                'annually' => '',
                                'biennially' => '',
                                'triennially' => ''
                            ]
                    );
                }
            }
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
}

?>