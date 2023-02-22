<style>
    *{
        text-align: center;
        font-family: 'Arial Narrow';
    }
    div>table{
        width: 45%;
        font-size: 20px;

    }
    table>tbody>tr>th>button{
        font-size: 20px;
    }
    table>thead>tr>th{
        font-size: 25px;
    }
    div>form{
        width: 63%;
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
        width: 25%;
        font-size: 25px;
        border: 2px solid  rgb(85, 84, 84);
    }
    h1{
        margin-top: 1%;
        font-size: 40px;
    }
    section{
        width: 45%;
        margin-left: auto;
        margin-right: auto;
    }
</style>

<?php
include('menu.html');
include('ConexaoDB.php');
include('../at2.php');
//seleciona as cidades
$sSelectCidade = "select * from mercado.tbcidade";
$oSelectCidade = pg_query($oConexao,$sSelectCidade);
//seleciona os fornecedores
$sSelectFornecedor = "SELECT FORcodigo,
                                 FORnome,
                                 FORCnpj,
                                 tbfornecedor.CIDCODIGO,
                                 CIDNOME 
                            FROM  mercado.tbfornecedor 
                           INNER JOIN mercado.tbcidade
                              ON tbfornecedor.cidcodigo = tbcidade.cidcodigo
                           order by forcodigo asc";

$oSelectFornecedor = pg_query($oConexao,$sSelectFornecedor);

?>
<script>
    async function deletafornecedor(forCodigo) {
        //manda pela url o valor clicodigo par deletar
        const dados = await fetch('deletefornecedor.php?forCodigo='+forCodigo);
        //atualiza a pagina
        window.location.reload();
    }    

</script>

<h1>Fornecedor:</h1>

<div>

    <form action="inserefornecedor.php" method="post">
        <fieldset>
            <legend>Cadastro de fornecedor:</legend>
            <label for="sFornecedorNome">Nome:</label>
            <input type="text" name="sFornecedorNome" id="sFornecedorNome">
            <label for="sFornecedorCnpj">CNPJ:</label>
            <input type="text" name="sFornecedorCnpj" id="sFornecedorCnpj">
            <label for="sCidadeFornecedor">Cidade:</label>
            <select name="sCidadeFornecedor" id="sCidadeFornecedor">
                <?php
                    while($linhaCidade = pg_fetch_assoc($oSelectCidade)){
                        echo('<option value="'.$linhaCidade['cidcodigo'].'">'.$linhaCidade['cidnome'].'</option>');
                    }
                ?>
                
            </select>
            <br>
            <input type="submit" value="Inserir Fornecedor" onclick="window.location.reload();">
        </fieldset>
    </form>


    <section>
        <table border="2px ">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nome</th>
                    <th>CNPJ</th>
                    <th>Codigo <br> da cidade</th>
                    <th>Nome cidade</th>
                    <th>Deletar</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                while($linhaFornecedor = pg_fetch_assoc($oSelectFornecedor)){
                    ?>
                    <tr>
                        <th><?= $linhaFornecedor['forcodigo']?></th>
                        <th><?= $linhaFornecedor['fornome']?></th>
                        <th><?= $linhaFornecedor['forcnpj']?></th>
                        <th><?= $linhaFornecedor['cidcodigo']?></th>
                        <th><?= $linhaFornecedor['cidnome']?></th>
                        <th><button id="<?= $linhaFornecedor['forcodigo'] ?>" onclick="deletafornecedor(<?= $linhaFornecedor['forcodigo'] ?>)">DELETE</button></th>

                    </tr>
                    
                    <?php
                }

                ?>

            </tbody>
        </table>
    </section>



</div>
