<?php
session_start();
include('ConexaoDB.php');
//recebe o valor                                 verifica se é inteiro
$fcnCodigo = filter_input(INPUT_GET,"fcnCodigo", FILTER_SANITIZE_NUMBER_INT);
$sDeleteFuncionario = "DELETE FROM MERCADO.TBfuncionario WHERE FcnCODIGO = $fcnCodigo";

pg_query($oConexao, $sDeleteFuncionario);


?>
