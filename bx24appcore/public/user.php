<?php
require "../run.php";

//getting current user in bitrix
$user = $crm->getUser(array("DOMAIN" => $_REQUEST['DOMAIN'], "auth" => $_REQUEST['AUTH_ID']));

// displaying department of the user to get other info pleace find the UF ids needed from user
$userDepartment = $user['result']['UF_DEPARTMENT'][0];

echo $userDepartment;
?>