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
// include('../at2.php');
$sSelectCliente = "SELECT CLICODIGO,
                             CLINOME,
                             CLICPF,
                             tbcliente.CIDCODIGO,
                             CIDNOME 
                        FROM mercado.tbcliente 
                       INNER JOIN mercado.tbcidade
                          ON tbcliente.cidcodigo = tbcidade.cidcodigo
                          order by clicodigo asc
                       ";
    //
    $oSelectCliente = pg_query($oConexao,$sSelectCliente);
//seleciona as cidades
$sSelectCidade = "select * from mercado.tbcidade";
$oSelectCidade = pg_query($oConexao,$sSelectCidade);
//seleciona os clientes
$oSelectCliente = pg_query($oConexao,$sSelectCliente);

?>
<script>
    async function deletacliente(cliCodigo) {
        //manda pela url o valor clicodigo para deletar
        const dados = await fetch('deletacliente.php?cliCodigo='+cliCodigo);
        //atualiza a pagina
        window.location.reload();
    }    

</script>

<h1>Cliente:</h1>

<div>

    <form action="inserecliente.php" method="post">
        <fieldset>
            <legend>Cadastro de clientes:</legend>
            <label for="sClienteNome">Nome:</label>
            <input type="text" name="sClienteNome" id="sClienteNome">
            <label for="sClienteCpf">CPF:</label>
            <input type="text" name="sClienteCpf" id="sClienteCpf">
            <label for="sCidadeCliente">Cidade:</label>
            <select name="sCidadeCliente" id="sCidadeCliente">
                <?php
                    while($linhaCidade = pg_fetch_assoc($oSelectCidade)){
                        echo('<option value="'.$linhaCidade['cidcodigo'].'">'.$linhaCidade['cidnome'].'</option>');
                    }
                ?>
                
            </select>
            <br>
            <input type="submit" value="Inserir Cliente" onclick="window.location.reload();">
        </fieldset>
    </form>


    <section>
        <table border="2px ">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Codigo <br> da cidade</th>
                    <th>Nome cidade</th>
                    <th>Deletar</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                while($linhaCliente = pg_fetch_assoc($oSelectCliente) ){
                    ?>
                    <tr>
                        <th><?= $linhaCliente['clicodigo']?></th>
                        <th><?= $linhaCliente['clinome']?></th>
                        <th><?= $linhaCliente['clicpf']?></th>
                        <th><?= $linhaCliente['cidcodigo']?></th>
                        <th><?= $linhaCliente['cidnome']?></th>
                        <th><button id="<?= $linhaCliente['clicodigo'] ?>" onclick="deletacliente(<?= $linhaCliente['clicodigo'] ?>)">DELETE</button></th>

                    </tr>
                    
                <?php
                }

                ?>
            </tbody>
        </table>
    </section>

</div>
