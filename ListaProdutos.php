<style>
    *{
        text-align: center;
        font-family: 'Arial Narrow';
    }
    div>table{
        width: 60%;
        font-size: 20px;

    }
    table>tbody>tr>th>button{
        font-size: 20px;
    }
    table>thead>tr>th{
        font-size: 25px;
    }
    div>form{
        width: 97%;
        margin-left: auto;
        margin-right: auto;
    
    }
    div>form>fieldset{
        border-radius: 10px;
    }
    fieldset>label,legend{
        font-size: 25px;
    }
    fieldset>input,select{
        border-radius: 5px;
        margin-top: 5%;
        padding: 10px;
        width: 22%;
        font-size: 25px;
        border: 2px solid  rgb(85, 84, 84);
    }
    h1{
        margin-top: 1%;
        font-size: 40px;
    }
    section{
        width: 60%;
        margin-left: auto;
        margin-right: auto;
    }
</style>

<?php
include('menu.html');
include('ConexaoDB.php');

//seleciona as categorias
$sSelectCategorias = "select * from mercado.tbcategoria";
$oSelectCategorias = pg_query($oConexao,$sSelectCategorias);
//
$sSelectFornecedor = "select * from mercado.tbfornecedor";
$oSelectFornecedor = pg_query($oConexao,$sSelectFornecedor);
//seleciona os produto
$sSelectProduto = "SELECT    proCODIGO,
                             proNOME,
                             prodescricao,
                             provalor,
                             proestoque,
                             tbproduto.catcodigo,
                             catdescricao,
                             tbproduto.forcodigo,
                             fornome	
                        FROM mercado.tbproduto
                       INNER JOIN mercado.tbcategoria
                          ON tbproduto.catcodigo = tbcategoria.catcodigo
                       INNER JOIN mercado.tbfornecedor
                          ON tbproduto.forcodigo = tbfornecedor.forcodigo	
                       order by procodigo asc;";

$oSelectProduto = pg_query($oConexao,$sSelectProduto);

?>
<script>
    async function deletaProduto(proCodigo) {
        //manda pela url o valor clicodigo par deletar
        const dados = await fetch('deleteproduto.php?proCodigo='+proCodigo);
        //atualiza a pagina
        window.location.reload();
    }    

</script>

<h1>Produto:</h1>

<div>

    <form action="insereProduto.php" method="post">
        <fieldset>
            <legend>Cadastro de Produto:</legend>
            <label for="sProdutoNome">Nome:</label>
            <input type="text" name="sProdutoNome" id="sProdutoNome">
            <label for="sProdutoDescricao">Descrição:</label>
            <input type="text" name="sProdutoDescricao" id="sProdutoDescricao">
            <label for="sProdutoValor">Valor:</label>
            <input type="text" name="sProdutoValor" id="sProdutoValor"><br>
            <label for="sProdutoEstoque">Estoque:</label>
            <input type="text" name="sProdutoEstoque" id="sProdutoEstoque">
            <label for="sProdutoCategoria">Categoria:</label>
            <select name="sProdutoCategoria" id="sProdutoCategoria">
                <?php
                    while($linhaCategorias = pg_fetch_assoc($oSelectCategorias)){
                        echo('<option value="'.$linhaCategorias['catcodigo'].'">'.$linhaCategorias['catdescricao'].'</option>');
                    }
                ?>
                
            </select>
            <label for="sProdutoFornecedor">Fornecedor:</label>
            <select name="sProdutoFornecedor" id="sProdutoFornecedor">
                <?php
                    while($linhaFornecedor = pg_fetch_assoc($oSelectFornecedor)){
                        echo('<option value="'.$linhaFornecedor['forcodigo'].'">'.$linhaFornecedor['fornome'].'</option>');
                    }
                ?>
                
            </select>
            <br>
            <input type="submit" value="Inserir Produto" onclick="window.location.reload();">
        </fieldset>
    </form>



    <section>

        <table border="2px ">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Estoque</th>
                    <th>Codigo<br> categoria</th>
                    <th>Categoria</th>
                    <th>Codigo <br> fornecedor</th>
                    <th>Nome <br> fornecedor</th>
                    <th>Deletar</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                while($linhaProduto = pg_fetch_assoc($oSelectProduto)){
                    ?>
                    <tr>
                        <th><?= $linhaProduto['procodigo']?></th>
                        <th><?= $linhaProduto['pronome']?></th>
                        <th><?= $linhaProduto['prodescricao']?></th>
                        <th><?= $linhaProduto['provalor']?></th>
                        <th><?= $linhaProduto['proestoque']?></th>
                        <th><?= $linhaProduto['catcodigo']?></th>
                        <th><?= $linhaProduto['catdescricao']?></th>
                        <th><?= $linhaProduto['forcodigo']?></th>
                        <th><?= $linhaProduto['fornome']?></th>
                        <th><button id="<?= $linhaProduto['procodigo'] ?>" onclick="deletaProduto(<?= $linhaProduto['procodigo'] ?>)">DELETE</button></th>

                    </tr>
                    
                    <?php
                }

                ?>

            </tbody>
        </table>
    </section>
<br>


</div>
