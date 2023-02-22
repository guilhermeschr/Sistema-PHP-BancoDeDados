<?php
session_start();
include('ConexaoDB.php');
//recebe o valor                                 verifica se é inteiro
$proCodigo = filter_input(INPUT_GET,"proCodigo", FILTER_SANITIZE_NUMBER_INT);
$sDeleteProduto = "DELETE FROM MERCADO.TBproduto WHERE proCODIGO = $proCodigo";

pg_query($oConexao, $sDeleteProduto);


?>
