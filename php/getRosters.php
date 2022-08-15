<?php
header("Access-Control-Allow-Origin: *");
require_once 'login.php';
require_once 'flib.php';
$db = ssql_getDB();

$q = implode("\n", [
    "SELECT",
    "`id`, `startDate`, `service` AS `service_id`, `tabledata`",
    "FROM rosters",
    "ORDER BY `id` DESC",
    "LIMIT 500",
]);
$r = $db->getAll($q);

foreach ($r as &$row) {

    $td = json_decode($row['tabledata'], true);
    $row['tabledata'] = $td;
}

// $rows = array_filter(
//     $r,
//     fn($row) => array_sum($row['tabledata'][0]['hours']) > 0
// );
$rows = array_filter(
    $r,
    function($row) {
        $hours = $row['tabledata'][0]['hours'];
        if (in_array(null, $hours, true)) return false;

        $sum = array_sum($hours);
        if ($sum < 1) return false;

        $count = count($hours);
        if ($count < 4 || $count > 14) return false;
        $avg = $sum / $count;
        if ($avg < 2)
        {
            return false;
        } else
        {
            return true;
        }
    }
);
$rows = array_values($rows);

// echoPre();
// print_r($rows);
// echo json_encode($r);
echo json_encode($rows);