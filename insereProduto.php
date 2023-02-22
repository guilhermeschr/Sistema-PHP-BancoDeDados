<html>
   <head>
    <style>
        html, body {
            height: 100%;
        }

        body {
            align-items: center;
            background-color: #1D1F20;
            display: flex;
            justify-content: center;
        }

        .loader  {
            animation: rotate 1s infinite;  
            height: 50px;
            width: 50px;
        }

        .loader:before,
        .loader:after {   
            border-radius: 50%;
            content: '';
            display: block;
            height: 20px;  
            width: 20px;
        }
        .loader:before {
            animation: ball1 1s infinite;  
            background-color: #cb2025;
            box-shadow: 30px 0 0 #f8b334;
            margin-bottom: 10px;
        }
        .loader:after {
            animation: ball2 1s infinite; 
            background-color: #00a096;
            box-shadow: 30px 0 0 #97bf0d;
        }

        @keyframes rotate {
        0% { 
            -webkit-transform: rotate(0deg) scale(0.8); 
            -moz-transform: rotate(0deg) scale(0.8);
        }
        50% { 
            -webkit-transform: rotate(360deg) scale(1.2); 
            -moz-transform: rotate(360deg) scale(1.2);
        }
        100% { 
            -webkit-transform: rotate(720deg) scale(0.8); 
            -moz-transform: rotate(720deg) scale(0.8);
        }
        }

        @keyframes ball1 {
        0% {
            box-shadow: 30px 0 0 #f8b334;
        }
        50% {
            box-shadow: 0 0 0 #f8b334;
            margin-bottom: 0;
            -webkit-transform: translate(15px,15px);
            -moz-transform: translate(15px, 15px);
        }
        100% {
            box-shadow: 30px 0 0 #f8b334;
            margin-bottom: 10px;
        }
        }

        @keyframes ball2 {
        0% {
            box-shadow: 30px 0 0 #97bf0d;
        }
        50% {
            box-shadow: 0 0 0 #97bf0d;
            margin-top: -20px;
            -webkit-transform: translate(15px,15px);
            -moz-transform: translate(15px, 15px);
        }
        100% {
            box-shadow: 30px 0 0 #97bf0d;
            margin-top: 0;
        }
        }
    </style>
   </head> 
   <body>
    <meta http-equiv="refresh" name="Refresh" content="1.8; URL=ListaProdutos.php">

    <h1 style="text-align: center;">Processando</h1><br>


    <div class="loader"></div>

   </body>


</html>

<?php
include('ConexaoDB.php');

$sProdutoNome = $_POST['sProdutoNome'];
$sProdutoDescricao = $_POST['sProdutoDescricao'];
$sProdutoValor = $_POST['sProdutoValor'];
$sProdutoEstoque = $_POST['sProdutoEstoque'];
$sProdutoCategoria = $_POST['sProdutoCategoria'];
$sProdutoFornecedor = $_POST['sProdutoFornecedor'];

//insercao de clientes
$sInsertProduto = "INSERT INTO mercado.tbproduto (proNOME,
                                                      prodescricao,
                                                      provalor,
                                                      proestoque,
                                                      catcodigo,
                                                      forcodigo) 
VALUES ('$sProdutoNome','$sProdutoDescricao','$sProdutoValor','$sProdutoEstoque','$sProdutoCategoria','$sProdutoFornecedor')";
//
$oSelectProduto = pg_query($oConexao,$sInsertProduto);
?>