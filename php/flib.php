<?php

function echoPre($close = false)
{
    $s = (!!$close) ? "</pre>" : "<pre>";
    echo $s;
}
function echoBr($n = 1)
{
    for ($i = 0; $i < $n; $i++) {
        echo "<br>";
    }
}

function identity($a)
{
    return $a;
}

function toNumber($s)
{
    return $s + 0;
}
function toBoolBit($b)
{
    return (!!$b) ? 'b\'0\'' : 'b\'1\'';
}
function fromBoolBit($b)
{
    return !!$b;
}

function isInstanceOf($className, $obj)
{
    if (!is_object($obj)) {
        return false;
    }

    return $className == get_class($obj);
}

if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle)
    {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}

function UnixMs()
{
    return intval(
        round(
            microtime(true) * 1000
        )
    );
}

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function castArray($x)
{
    if (is_array($x)) {
        return $x;
    }

    return [$x];
}

function array_at($arr, $key_s, $preserveKeys = false)
{
    $rArr = [];
    $keys = castArray($key_s);
    foreach ($keys as $key) {
        $val = $arr[$key];

        if ($preserveKeys) {
            $rArr[$key] = $val;
        } else {
            $rArr[] = $val;
        }
    }
    unset($key, $val);

    return $rArr;
}

function array_defaults()
{
    $args = func_get_args();

    $dest = array_shift($args);
    $source_s = $args;

    foreach ($source_s as $src) {
        foreach ($src as $k => $v) {
            // $destVal = $dest[$k];
            if (!isset($dest[$k])) {
                $dest[$k] = $v;
            }

        }
        unset($k, $v);
    }
    unset($src);

    return $dest;
}

function wrap_implode($array, $before = '', $after = '', $separator = '')
{
    if (!$array) {
        return '';
    }

    return $before . implode($separator, $array) . $after;
}

function mrap_implode($array, $before = '', $after = '', $separator = '')
{
    if (!$array) {
        return '';
    }

    return $before . implode("{$after}{$separator}{$before}", $array) . $after;
}

/**
 * Flatten an array so that resulting array is of depth 1.
 * If any value is an array itself, it is merged by parent array, and so on.
 *
 * @param array $array
 * @param bool $preserver_keys OPTIONAL When true, keys are preserved when mergin nested arrays (=> values with same key get overwritten)
 * @return array
 */
function array_flatten($array, $preserve_keys = false)
{
    if (!$preserve_keys) {
        // ensure keys are numeric values to avoid overwritting when array_merge gets called
        $array = array_values($array);
    }

    $flattened_array = array();
    foreach ($array as $k => $v) {
        if (is_array($v)) {
            $flattened_array = array_merge($flattened_array, call_user_func(__FUNCTION__, $v, $preserve_keys));
        } elseif ($preserve_keys) {
            $flattened_array[$k] = $v;
        } else {
            $flattened_array[] = $v;
        }
    }
    return $flattened_array;
}

/**
 * Get the top element and rotate the array afterwards
 */
function array_rotate(&$arr)
{
    $elm = array_shift($arr);
    array_push($arr, $elm);
    return $elm;
}

function array_kshift(&$arr)
{
    list($k) = array_keys($arr);
    $r = array($k => $arr[$k]);
    unset($arr[$k]);
    return $r;
}

function array_krotate(&$arr)
{
    $kv = array_kshift($arr);
    [$k, $v] = [array_keys($kv)[0], array_values($kv)[0]];

    $arr[$k] = $v;

    return $kv;
}

function format_fullname($title, $forenames, $surname)
{
    $firstnames = explode(" ", $forenames);

    $firstname = array_shift($firstnames);

    if (count($firstnames)) {
        $firstname .= ' ';

        foreach ($firstnames as $c) {
            $firstname .= $c[0];
        }
    }

    $o = $title . " " . $surname . ", " . $firstname;

    return $o;
}

function sql_get_placeholders($text, $count = 0, $separator = ",")
{
    $result = array();
    if ($count > 0) {
        for ($x = 0; $x < $count; $x++) {
            $result[] = $text;
        }
    }

    return implode($separator, $result);
}

function sql_get_stmt($table_name, $data_fields, $data, $ignore = true)
{
    $insert_values = array();

    foreach ($data as $d) {
        $question_marks[] = '(' . sql_get_placeholders('?', sizeof($d)) . ')';
        $insert_values = array_merge($insert_values, array_values($d));
    }

    $ignoreSQL = $ignore ? "IGNORE" : "";

    $sql = "INSERT $ignoreSQL INTO $table_name (" . implode(",", $data_fields) . ") VALUES " .
    implode(',', $question_marks);

    return [$sql, $insert_values];
}

function sql_get_stmt_kOrd($table_name, $data_fields, $data, $ignore = true)
{
    $insert_values = array();

    foreach ($data as $d) {
        $question_marks[] = '(' . sql_get_placeholders('?', sizeof($d)) . ')';

        $temp_vals = [];
        foreach ($data_fields as $df) {
            $temp_vals[] = $d[$df];
        }

        // $insert_values = array_merge($insert_values, array_values($d));
        $insert_values = array_merge($insert_values, array_values($temp_vals));
    }

    $ignoreSQL = $ignore ? "IGNORE" : "";

    $sql = "INSERT $ignoreSQL INTO $table_name (" . implode(",", $data_fields) . ") VALUES " .
    implode(',', $question_marks);

    return [$sql, $insert_values];
}

function allTrue($arr)
{
    if (is_array($arr)) {
        return (bool) array_product($arr);
    } else {
        return (bool) $arr;
    }

}

function anyTrue($arr)
{
    return (bool) array_sum($arr);
}

function formatDTtoMySQL($dts)
{
    $timestamp = strtotime($dts);

    return date('Y-m-d H:i:s', $timestamp);
}

function getPostVar($conn, $var)
{
    return $conn->real_escape_string($_POST[$var]);
}

function issetPostA($arr)
{
    $func = function ($var) {
        return isset($_POST[$var]);
    };

    if (is_array($arr)) {
        return allTrue(
            array_map($func, $arr)
        );
    } else {
        return allTrue($arr);
    }

}

function echoTableStyle()
{
	echo '<style type="text/css">html {
		font-family: sans-serif;
	  }

	  table {
		border-collapse: collapse;
		border: 2px solid rgb(200,200,200);
		letter-spacing: 1px;
		font-size: 0.8rem;
	  }

	  td, th {
		border: 1px solid rgb(190,190,190);
		padding: 6px 12px;
	  }

	  th {
		background-color: rgb(235,235,235);
	  }

	  td {
		text-align: center;
	  }

	  tr:nth-child(even) td {
		background-color: rgb(250,250,250);
	  }

	  tr:nth-child(odd) td {
		background-color: rgb(245,245,245);
	  }

	  caption {
		padding: 10px;
	  }
	  </style>';
}