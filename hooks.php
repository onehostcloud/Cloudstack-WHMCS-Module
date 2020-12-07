<?php

use WHMCS\Database\Capsule;

add_hook('AdminAreaPage', 1, function($vars) {
    if ($_POST['ajaxpage'] == 'createconfig') {
        require_once 'cloudstack.php';
        $data = Capsule::table('tblproducts')
                        ->where('id', '=', $_POST['productid'])
                        ->where('servertype', '=', 'cloudstack')->first();
        $params['configoption3'] = $data->configoption3;
        $params['configoption1'] = $data->configoption1;
        $params['configoption2'] = $data->configoption2;
        $params['data'] = $data->configoption2;
        $cloudstack = request($params);
        $zones = $cloudstack->listZones(); // zones lists
        $zone = [];
        foreach ($zones->listzonesresponse->zone as $zonename) {
            $zone[$zonename->id] = $zonename->name;
        }
        $serviceoffers = $cloudstack->listServiceOfferings(); //disk offered
        $soffer = [];
        foreach ($serviceoffers->listserviceofferingsresponse->serviceoffering as $serviceoffer) {
            $soffer[$serviceoffer->id] = $serviceoffer->name;
        }
        $disk = [];
        $diskoffers = $cloudstack->listDiskOfferings(); //disk offered
        foreach ($diskoffers->listdiskofferingsresponse->diskoffering as $diskoffer) {
            $disk[$diskoffer->id] = $diskoffer->name;
        }
        $temp = [];
        $templates = $cloudstack->listTemplates('all');
        //print_r($templates); exit();
        foreach ($templates->listtemplatesresponse->template as $template) {
            $temp[$template->id] = $template->name;
        }
        cloustack_generateconfigoption('Zones', $_POST['productid'], $zone);
        cloustack_generateconfigoption('ServiceOffer', $_POST['productid'], $soffer);
        cloustack_generateconfigoption('DiskOffer', $_POST['productid'], $disk);
        cloustack_generateconfigoption('Template', $_POST['productid'], $temp);
        echo "success";
        exit();
    }
});
?>