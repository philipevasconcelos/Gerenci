<?php require_once("conecta.php"); ?>
<?php

if (isset($_POST["manutencao"])) {
    $statusequipamento = $_POST["statusequipamento"];
    $datamanutencao = $_POST["datamanutencao"];
    $manutencao = $_POST["manutencao"];
    $equipaid = $_POST["idequipamento"];

    //objeto de alteração 
    $alterar = "UPDATE equipamento ";
    $alterar .= "SET ";
    $alterar .= "id_equipamentostatus = {$statusequipamento}, ";
    $alterar .= "datamanutencao = '{$datamanutencao}', ";
    $alterar .= "manutencao = '{$manutencao}' ";
    $alterar .= "WHERE idequipamento = {$equipaid} ";
    $operacao_alterar = mysqli_query($conecta, $alterar);
    if (!$operacao_alterar) {
        die("Erro na alteracao");
    } else {
        header("location:detalhamento.php?codigo=" . $equipaid . "");
    }
}

//Consulta a tabela de equipamento
$tr = "SELECT * FROM equipamento ";
if (isset($_GET["codigo"])) {
    $id = $_GET["codigo"];
    $tr .= "WHERE idequipamento = {$id} ";
} else {
    $tr .= "WHERE idequipamento = 4";
}

$con_equipamento = mysqli_query($conecta, $tr);

$info_equipamento = mysqli_fetch_assoc($con_equipamento);

// Consultar status

$status = "SELECT * FROM statusequipamento";
$listar_status = mysqli_query($conecta, $status);
if (!$listar_status) {
    die("Erro no banco");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap4.5/css/bootstrap.min.css">
    <link href="css/alterar.css" rel="stylesheet">
    <title>Alterar Manutenção</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class=" navbar-brand" href="listagem.php">Início</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="listagem.php">Lista <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-normal" href="inserir_equipamento.php">Cadastrar</a>
                </li>
            </ul>
        </div>
    </nav>

    <main>
        <div id="janela_formulario">
            <h2>Alterar Descricrição do Problema</h2>
            <ul>
                <li><b>Tipo do equipamento: </b><?php echo $info_equipamento["tipoequipamento"] ?></li>
                <li><b>Marca do equipamento: </b><?php echo $info_equipamento["marcaequipamento"] ?></li>
                <li><b>Tombo: </b><?php echo $info_equipamento["tombo"] ?></li>
            </ul>
            <form action="alterar_detalhe.php" method="POST">
                <label for="statusequipamento">Status</label>
                <select name="statusequipamento" id="statusequipamento">
                    <?php
                    //Pegar tipo do status direto do banco
                    $meustatus = $info_equipamento["id_equipamentostatus"];
                    while ($linha_status = mysqli_fetch_assoc($listar_status)) {
                        $status_principal = $linha_status["idstatus"];
                        if ($meustatus == $status_principal) {
                    ?>
                            <option value="<?php echo $linha_status["idstatus"]  ?>" selected>
                                <?php echo $linha_status["tipostatus"] ?>
                            </option>

                        <?php
                        } else {
                        ?>
                            <option value="<?php echo $linha_status["idstatus"]  ?>">
                                <?php echo $linha_status["tipostatus"] ?>
                            </option>

                    <?php
                        }
                    }
                    ?>
                </select>

                <label for="datamanutencao">Data</label><br>
                <input type="date" value="<?php echo $info_equipamento["datamanutencao"] ?>" name="datamanutencao" id="datamanutencao"><br>

                <label for="manutencao">Descrição do Problema</label>
                <textarea rows="5" cols="60" type="textarea" value="<?php echo $info_equipamento["manutencao"] ?>" name="manutencao" id="manutencao" autocomplete="off" autofocus></textarea>

                <input type="hidden" name="idequipamento" value="<?php echo $info_equipamento["idequipamento"] ?>">

                <input type="submit" value="Confirmar Alteração">
            </form>
        </div>
    </main>
</body>

</html>