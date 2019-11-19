<?php

// $iblockId = intval($_GET['iblockId']);
// $elCode = $_POST['elCode'];
// $id = intval($_GET['id']);
require "../run.php";

$resListElements = $crm->getListElementById(33);

// $resListElementAdd = $crm->ListElementAdd(array(
//     'IBLOCK_TYPE_ID' => 'lists',
//     'IBLOCK_ID' => '33', //$iblockId,
//     'ELEMENT_CODE' => 'element1',
//     'FIELDS' => array(
//         'NAME' => 'Test element 1',
//         'PROPERTY_121' => array('n0' => "n1582")
//     )
// ));

// $resListELemenetUpdate = $crm->ListElementUpdate(
//     33, //$iblockId,
//     'element1', //$elCode
//     array(
//         'NAME' => 'Test element 2',
//         'PROPERTY_121' => array('n0' => "n1582")
//     )
// );

// $resListElementDelete = $crm->ListsElementDelete(33, 'element1');
echo '<pre>';
print_r($resListElements);
