<?php

require __DIR__ . "/vendor/autoload.php";



use Bitrix24\Crm;

$webhook = 'your bitrix214 webhook dont forget to put the slash (/) at the end ';
$crm = new Crm($webhook);

// Using Armsoft With WSDL \\
/*
    For using our extension make sure to have your accountant service with its wsdl file and get your databaseName including UserName and Password
*/

// If you need to enable the extension Uncomment the Code Below by deleting the /*  and */ signs at the begining and the end of the code

/*
use Armsoft\Armsoft;

$soapUrl = 'http://yourLink/YourAccountantService.svc?wsdl';
$username = ' UserName';
$password = ' Password';
$dbname = ' databaseName';

$armsoft = new Armsoft($soapUrl, $username, $password, $dbname);
*/