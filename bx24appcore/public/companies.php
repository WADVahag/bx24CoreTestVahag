<?php
// $id = intval($_GET['id']);
require "../run.php";

// $newCompanyName = $_POST['newCompanyName'];
// $newCompanyPhone = $_POST['newCompanyPhone'];


$resCompanies = $crm->getCompanieList(array(
    'order' => ["ID" => "DESC"],
    // 'filter' => [">PROBABILITY"=> 50 ], //["CATALOG_ID" => $catalogId],
    'select' => ["*", "UF_*"]
));
// $resCompanieById = $crm->getCompanyById(3);

// $resCompanyAdd = $crm->CompanieAdd(
//     array(
//         'fields' => [
//             "TITLE" => 'ADIDAS', //$newCustomerName,
//             "COMPANY_TYPE" => "CUSTOMER",
//             "PHONE" => array(["VALUE" => 132456, "VALUE_TYPE" => "WORK"]) //array(["VALUE" => $newCustomerPhone, "VALUE_TYPE" => "WORK"])
//         ],
//         'params' => ['REGISTER_SONET_EVENT' => 'Y']
//     )
// );

// $resCompanyUpdate = $crm->CompanieUpdate(
//     3, //$id,
//     array(
//             "TITLE" => 'valodiComp', //$newCustomerName,
//             "COMPANY_TYPE" => "CUSTOMER",
//             "PHONE" => array(["VALUE" => 132456, "VALUE_TYPE" => "WORK"]) //array(["VALUE" => $newCustomerPhone, "VALUE_TYPE" => "WORK"])
//     )
// );

// $resCompanyDelete = $crm->CompanieDelete(3);
echo '<pre>';
print_r($resCompanies);
