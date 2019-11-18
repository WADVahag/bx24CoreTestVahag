<?php

require "../run.php";

$resRequisites = $crm->getRequisites();

echo '<pre>';
print_r($resRequisites);
