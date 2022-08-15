<?php
require_once 'login.php';
$db = ssql_getDB();

$data = [];

$q = implode("\n", [
    "SELECT",
    "`id`,",
    "`Name`,",
    "`Description` AS `description`,",
    "`Value` AS `value`,",
    "`Region` AS `region`,",
    "`SalesDistrict` AS `salesDistrict`",
    "FROM `attributes`",
    "WHERE `ValidTill` > CURDATE()",
    "ORDER BY `id` ASC"
]);
$data['attributes'] = $db->getAll($q);

// echo json_encode($r);
echo "<pre>";
print_r($data);
