<?php

error_reporting(-1);
ini_set("html_errors", 1);
ini_set("display_startup_errors", 1);
ini_set("log_errors", 1);
ini_set("display_errors", 1);
ini_set("track_errors",1);
ini_set("report_memleaks",1);

require_once('safemysql.class.php');

function ssql_getDB()
{
        $_opts = array(
        'host' => 'ct.crgsa.co.za',
        'user' => 'server',
        'pass' => 'Crg2021@)@!',
        // 'db' => 'supercare2Dev',
        'db' => 'sc_costingModel',
        'charset' => 'utf8mb4'
    );

    $db = new SafeMySQL($_opts);

    return $db;
}

function getPDO($login)
{
	$hn = $login['hn'];
	$db = $login['db'];

	$un = $login['user'];
	$pw = $login['pass'];

	$chrs = 'utf8mb4';
	$attr = "mysql:host=$hn;dbname=$db;charset=$chrs";
	$opts =
	[
	PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES   => false,
	];

	try
	{
		$pdo = new PDO($attr, $un, $pw, $opts);
	}
	catch (\PDOException $e)
	{
		throw new \PDOException($e->getMessage(), (int)$e->getCode());
	}

	return $pdo;
}