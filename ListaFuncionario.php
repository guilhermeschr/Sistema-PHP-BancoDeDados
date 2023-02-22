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
//seleciona as departamentos
$sSelectDepartamento = "select * from MERCADO.TBDEPARTAMENTO";
$oSelectDepartamento = pg_query($oConexao,$sSelectDepartamento);
//seleciona os funcionarios
$sSelectFuncionario= "SELECT fcncodigo,
                             fcnnome,
                             tbfuncionario.dptCODIGO,
                             dptdescricao 
                        FROM  mercado.tbfuncionario
                       INNER JOIN mercado.tbdepartamento
                          ON tbfuncionario.dptcodigo = tbdepartamento.dptcodigo
                       order by fcncodigo asc;";

$oSelectFuncionario = pg_query($oConexao,$sSelectFuncionario);

?>
<script>
    async function deletafuncionario(fcnCodigo) {
        //manda pela url o valor clicodigo par deletar
        const dados = await fetch('deletefuncionario.php?fcnCodigo='+fcnCodigo);
        //atualiza a pagina
        window.location.reload();
    }    

</script>

<h1>Funcionario:</h1>

<div>

<form action="insereFuncionario.php" method="post">
    <fieldset>
        <legend>Cadastro de Funcionario:</legend>
        <label for="sFuncionarioNome">Nome:</label>
        <input type="text" name="sFuncionarioNome" id="sFuncionarioNome">
        <label for="sDepartamentofuncionario">Departamento:</label>
        <select name="sDepartamentofuncionario" id="sDepartamentofuncionario">
            <?php
                while($linhaDepartamento = pg_fetch_assoc($oSelectDepartamento)){
                    echo('<option value="'.$linhaDepartamento['dptcodigo'].'">'.$linhaDepartamento['dptdescricao'].'</option>');
                }
            ?>
            
        </select>
        <br>
        <input type="submit" value="Inserir Funcionario" onclick="window.location.reload();">
    </fieldset>
</form>

    <section>
        <table border="2px ">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nome</th>
                    <th>Codigo <br> do departamento</th>
                    <th>Departamento</th>
                    <th>Deletar</th>
                </tr>
            </thead>
            
            <tbody>
            <?php
                while($linhaFuncionario = pg_fetch_assoc($oSelectFuncionario)){
                    ?>
                    <tr>
                        <th><?= $linhaFuncionario['fcncodigo']?></th>
                        <th><?= $linhaFuncionario['fcnnome']?></th>
                        <th><?= $linhaFuncionario['dptcodigo']?></th>
                        <th><?= $linhaFuncionario['dptdescricao']?></th>
                        <th><button id="<?= $linhaFuncionario['fcncodigo'] ?>" onclick="deletafuncionario(<?= $linhaFuncionario['fcncodigo'] ?>)">DELETE</button></th>

                    </tr>
                    
                    <?php
                }

                ?>

            </tbody>
        </table>
    </section>
<br>


</div>
