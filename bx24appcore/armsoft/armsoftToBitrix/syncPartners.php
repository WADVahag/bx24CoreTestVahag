<?php

require "../bx24appcore/run.php";

$aHTTP['http']['header'] = "User-Agent: PHP-SOAP/5.5.11\r\n";
$context = stream_context_create($aHTTP);
$client = new SoapClient($armsoft->soapUrl, array('trace' => 1, "stream_context" => $context));
$Partners = $armsoft->getPartners($client);
$PartnersAll = json_decode(json_encode($Partners), true);
$i = 0;

// file_put_contents('allPartners.json', json_encode($PartnersAll, JSON_UNESCAPED_UNICODE));
// echo 'Start';
// echo '<pre>';
// print_r($PartnersAll);
foreach ($PartnersAll as $keychunk => $PartnersChunk) {
    // if (!empty($PartnersChunk)) {
        foreach ($PartnersChunk as $keyPartner => $Partner) {
            $resPartner = $crm->getCompanieList(
                array(
                    'order' => ["SORT" => "ASC"],
                    'filter' => ["UF_CRM_1575536383883" => $Partner['PartnerID']], //["CATALOG_ID" => $catalogId],
                    'select' => ["*", "UF_*"]
                )
            );

            $resPartner = json_decode($resPartner,true);

            $PartnerUpdateId = $resPartner['result'][0]['ID'];
            $PartnerUpdateXMLId = $resPartner['result'][0]['UF_CRM_1575536383883'];
            $i++;

            if ($i >  $PartnersAll['totalPartners']) {
                echo "we have CHanged ".($i-1);
                echo ' Partners';
                die;
            }

            if ($PartnerUpdateXMLId != $Partner['PartnerID']) {

                sleep(1);
                $resPartnerAdd = $crm->CompanieAdd(array(
                    'fields' => [       
                        "TITLE" => $Partner['Name'], //
                        "COMPANY_TYPE" => "CUSTOMER",
                        "UF_CRM_1575536321627" => $Partner['Address'],
                        "UF_CRM_1575536341107" => $Partner['BusinessAddress'],
                        "UF_CRM_1575536354003" => $Partner['ManagerName'],
                        "UF_CRM_1575536383883" => $Partner['PartnerID']
                    ],
                ));

                // echo 'number of change ===='.$i;
            
                echo '<pre>';
                print_r($resPartnerAdd);
                echo 'Avelacvel e nor Ynkerutyun' . 'productXMLID === ' . $PartnerUpdateXMLId . 'productUpdateId === ' . $PartnerUpdateId . "ParnerID === " . $Partner['PartnerID'];
            } else {
                sleep(1);
                $resPartnerUpdate = $crm->CompanieUpdate(
                    $PartnerUpdateId, //id of updated Partner
                    array(
                        "TITLE" => $Partner['Name'], //
                        "COMPANY_TYPE" => "CUSTOMER",
                        "UF_CRM_1575536321627" => $Partner['Address'],
                        "UF_CRM_1575536341107" => $Partner['BusinessAddress'],
                        "UF_CRM_1575536354003" => $Partner['ManagerName'],
                    )
                );

                echo '<pre>';
                print_r($resPartnerUpdate);
                echo 'Haytnabervela Hmanknum katarvel a Tarmacum' . $PartnerUpdateXMLId . 'productUpdateId === ' . $PartnerUpdateId . "ParnerID === " . $Partner['PartnerID'];
            }
        }
    // }else{
    //     echo 'PartnersChunk is empty';
    // break;
    // }
    
}

?>