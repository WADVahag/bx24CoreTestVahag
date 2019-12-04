<?php

require "../bx24appcore/run.php";

$aHTTP['http']['header'] = "User-Agent: PHP-SOAP/5.5.11\r\n";
$context = stream_context_create($aHTTP);
$client = new SoapClient($armsoft->soapUrl, array('trace' => 1, "stream_context" => $context));
$Partners = $armsoft->getPartners($client);
$PartnersAll = json_decode(json_encode($Partners), true);

file_put_contents('allPartners.json', json_encode($PartnersAll, JSON_UNESCAPED_UNICODE));

$i = 0;

/*
$resPartner = $crm->getCompanieList(
    array(
        'order' => ["SORT" => "ASC"],
        'filter' => ["UF_CRM_1575373969620" =>115], //["CATALOG_ID" => $catalogId],
        'select' => ["*","UF_*"]
    )
);
echo  $PartnerUpdateXMLId = intval( $resPartner['result'][0]['UF_CRM_1575373969620']);
echo '<pre>';
//rint_r($resPartner);
// echo ""$PartnerUpdateXMLId


if ($PartnerUpdateXMLId !== 115) {
    echo '<br> addddddddddddddddddddddddddddddddddddddd <br>';

    // $resPartnerAdd = $crm->CompanieAdd(array(
    //     'fields' => [
    //         "TITLE" => 'testAnun', //
    //         "COMPANY_TYPE" => "CUSTOMER",
    //         "UF_CRM_1575372680585" => 'test hasce himnakan',
    //         "UF_CRM_1575372725687" => 'test hasce Gorcnakan',
    //         "UF_CRM_1575373341906" => 'test Tnoren',
    //         "UF_CRM_1575373969620" => 118
    //     ],
    // ));
    // echo '<pre>';
    // print_r($resPartnerAdd);

}else{
    echo 'update';
}
*/
//hcic stacvac tvyalneri mej cikl enq frum

foreach ($PartnersAll as $keychunk => $PartnersChunk) {
    if ($PartnersChunk != []) {
        foreach ($PartnersChunk as $keyPartner => $Partner) {
            # code...


            $resPartner = $crm->getCompanieList(
                array(
                    'order' => ["SORT" => "ASC"],
                    'filter' => ["UF_CRM_1575373969620" => $Partner['PartnerID']], //["CATALOG_ID" => $catalogId],
                    'select' => ["*", "UF_*"]
                )
            );
            $PartnerUpdateId = $resPartner['result'][0]['ID'];
            $PartnerUpdateXMLId = $resPartner['result'][0]['UF_CRM_1575373969620'];

            $i++;

            if ($i == 5) {
                die;
            }
            if ($PartnerUpdateXMLId !== $Partner['PartnerID']) {

                sleep(1);
                $resPartnerAdd = $crm->CompanieAdd(array(
                    'fields' => [
                        "TITLE" => $Partner['Name'], //
                        "COMPANY_TYPE" => "CUSTOMER",
                        "UF_CRM_1575372680585" => $Partner['Address'],
                        "UF_CRM_1575372725687" => $Partner['BusinessAddress'],
                        "UF_CRM_1575373341906" => $Partner['ManagerName'],
                        "UF_CRM_1575373969620" => $Partner['PartnerID']
                    ],
                ));
                echo '<pre>';
                print_r($resPartnerAdd);
                echo '<br> Avelacvel e nor Ynkerutyun' . 'productXMLID === ' . $PartnerUpdateXMLId . 'productUpdateId === ' . $PartnerUpdateId . "ParnerID === " . $Partner['PartnerID'];
            } else {
                sleep(1);
                $resPartnerUpdate = $crm->CompanieUpdate(
                    $PartnerUpdateId, //id of updated Partner
                    array(
                        "TITLE" => $Partner['Name'], //
                        "COMPANY_TYPE" => "CUSTOMER",
                        "UF_CRM_1575372680585" => $Partner['Address'],
                        "UF_CRM_1575372725687" => $Partner['BusinessAddress'],
                        "UF_CRM_1575373341906" => $Partner['ManagerName']

                    )
                );

                echo '<pre>';
                print_r($resPartnerUpdate);
                echo '<br> Haytnabervela Hmanknum katarvel a Tarmacum' . $PartnerUpdateXMLId . 'productUpdateId === ' . $PartnerUpdateId . "ParnerID === " . $Partner['PartnerID'];
            }
        }
    }
}
