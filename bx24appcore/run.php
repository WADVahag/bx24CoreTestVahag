<?php

require __DIR__ . "/vendor/autoload.php";



use Bitrix24\Crm;

$webhook = 'https://flashmotors.bitrix24.ru/rest/1/449h9yryp2eypcbt/';
$crm = new Crm($webhook);
