<?php
session_start();
include('ConexaoDB.php');
//recebe o valor                                 verifica se é inteiro
$cliCodigo = filter_input(INPUT_GET,"cliCodigo", FILTER_SANITIZE_NUMBER_INT);
$sDeleteCliente = "DELETE FROM MERCADO.TBCLIENTE WHERE CLICODIGO = $cliCodigo";

pg_query($oConexao, $sDeleteCliente);

?>
