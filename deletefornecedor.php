<?php
session_start();
include('ConexaoDB.php');

//recebe o valor                                 verifica se é inteiro
$forCodigo = filter_input(INPUT_GET,"forCodigo", FILTER_SANITIZE_NUMBER_INT);


$sDeleteProduto = "DELETE FROM MERCADO.TBproduto WHERE forCodigo = $forCodigo";

pg_query($oConexao, $sDeleteProduto);

$sDeleteFornecedor = "DELETE FROM MERCADO.TBfornecedor WHERE FORCODIGO = $forCodigo";
//deleta fronecedor
pg_query($oConexao, $sDeleteFornecedor);


?>
