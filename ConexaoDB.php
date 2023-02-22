<?php

$sHost = '127.0.0.1';
$sPort = '5432';
$sDbName = 'treina';
$sUser = 'postgres';
$sPassword = 'postgres';

$sConexao = "host = $sHost 
             port = $sPort 
             dbname = $sDbName 
             user = $sUser 
             password = $sPassword";

$oConexao = pg_connect($sConexao);
// var_dump($oConexao);

?>