<?php
require_once 'login.php';
$db = ssql_getDB();

$data = [];

$q = implode("\n", [
    "SELECT",
    "`id`, `RoleName` AS `name`",
    "FROM `role`",
    "ORDER BY `id` ASC"
]);
$data['role'] = $db->getAll($q);

$q = implode("\n", [
    "SELECT",
    "`id`, `name`, `rate`,",
    "`role` AS `role_id`,",
    "`Region` AS `region_id`,",
    "`SalesDistrict` AS `salesDistrict_id`",
    "FROM `role_rate`",
    "WHERE `valid_till` >= now()",
    "AND",
    "`valid_from` <= now()",
    "ORDER BY `id` ASC"
]);
$data['role_rate'] = $db->getAll($q);

$q = implode("\n", [
    "SELECT",
    "`id`, `name`",
    "FROM `service_type`",
    "ORDER BY `name` ASC"
]);
$data['service_types'] = $db->getAll($q);

$q = implode("\n", [
    "SELECT",
    "`id`, `name`, `holiday_date` as `date`",
    "FROM `holidays`",
    "ORDER BY `date` ASC"
]);
$data['holidays'] = $db->getAll($q);

$q = implode("\n", [
    "SELECT",
    "`id`,",
    "`Name` AS `name`,",
    "`Description` AS `description`,",
    "`Value` AS `value`,",
    "`Region` AS `region`,",
    "`SalesDistrict` AS `salesDistrict_id`",
    "FROM `attributes`",
    "WHERE `ValidTill` > CURDATE()",
    "ORDER BY `id` ASC"
]);
$data['attributes'] = $db->getAll($q);

echo json_encode($data);
