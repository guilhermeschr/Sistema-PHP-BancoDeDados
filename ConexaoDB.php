<?php

$sHost = '000.0.0.0';
$sPort = '0000';
$sDbName = 'Name';
$sUser = 'User';
$sPassword = 'Password';

$sConexao = "host = $sHost 
             port = $sPort 
             dbname = $sDbName 
             user = $sUser 
             password = $sPassword";

$oConexao = pg_connect($sConexao);


?>
