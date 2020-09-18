<?php require_once("conecta.php"); ?>
<?php
if (isset($_POST["tipoequipamento"])) {
    $tipoequipamento = $_POST["tipoequipamento"];
    $marcaequipamento = $_POST["marcaequipamento"];
    $tomboequipamento = $_POST["tombo"];
    $statusequipamento = $_POST["statusequipamento"];
    $setorequipamento = $_POST["setor"];
    $equipaid = $_POST["idequipamento"];

    //objeto de alteração 
    $alterar = "UPDATE equipamento ";
    $alterar .= "SET ";
    $alterar .= "tipoequipamento = '{$tipoequipamento}', ";
    $alterar .= "marcaequipamento = '{$marcaequipamento}', ";
    $alterar .= "tombo = '{$tomboequipamento}', ";
    $alterar .= "id_equipamentostatus = {$statusequipamento}, ";
    $alterar .= "id_setor = {$setorequipamento} ";
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

//Consultar os setores

$setores = "SELECT * FROM setor";
$listar_setor = mysqli_query($conecta, $setores);
if (!$listar_setor) {
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
    <title>Alterar Infomacão do Equipamento</title>
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
            <h2>Alterar Informações do Equipamento</h2>
            <form action="alteracao.php" method="POST">
                <label for="tipoequipamento">Tipo do Equipamento</label>
                <input type="text" value="<?php echo $info_equipamento["tipoequipamento"] ?>" name="tipoequipamento" id="tipoequipamento">

                <label for="marcaequipamento">Marca do Equipamento</label>
                <input type="text" value="<?php echo $info_equipamento["marcaequipamento"] ?>" name="marcaequipamento" id="marcaequipamento">

                <label for="tombo">Tombo</label>
                <input type="text" value="<?php echo $info_equipamento["tombo"] ?>" name="tombo" id="tombo">

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

                <label for="setor">Setor</label>
                <select name="setor" id="setor">
                    <?php
                    //Pegar nome dos setores direto do banco
                    $meusetor = $info_equipamento["id_setor"];
                    while ($linha = mysqli_fetch_assoc($listar_setor)) {
                        $setor_principal = $linha["idsetor"];
                        if ($meusetor == $setor_principal) {
                    ?>
                            <option value="<?php echo $linha["idsetor"]  ?>" selected>
                                <?php echo $linha["nomesetor"] ?>
                            </option>

                        <?php
                        } else {
                        ?>
                            <option value="<?php echo $linha["idsetor"]  ?>">
                                <?php echo $linha["nomesetor"] ?>
                            </option>

                    <?php
                        }
                    }
                    ?>
                </select>

                <input type="hidden" name="idequipamento" value="<?php echo $info_equipamento["idequipamento"] ?>">

                <input type="submit" value="Confirmar Alteração">

            </form>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>