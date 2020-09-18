<?php require_once("conecta.php"); ?>
<?php
if (isset($_POST["tipoequipamento"])) {
    $tid = $_POST["idequipamento"];

    $exclusao = "DELETE FROM equipamento WHERE idequipamento = {$tid}";
    $con_exlusao = mysqli_query($conecta, $exclusao);
    if (!$con_exlusao) {
        die("Registro não excluido");
    } else {
        header("location:listagem.php");
    }
}

$tr = "SELECT * FROM equipamento ";
if (isset($_GET["codigo"])) {
    $id = $_GET["codigo"];
    $tr .= "WHERE idequipamento = {$id} ";
}

$con_equipamento = mysqli_query($conecta, $tr);
if (!$con_equipamento) {
    die("Erro na consulta");
}

$info_equipamento = mysqli_fetch_assoc($con_equipamento);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap4.5/css/bootstrap.min.css">
    <link href="css/alterar.css" rel="stylesheet">
    <title>Excluir Equipamento</title>
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
            <form action="exclusao.php" method="POST">
                <h2>Excluir Equipamento</h2>

                <label for="tipoequipamento">Tipo do Equipamento</label>
                <input type="text" value="<?php echo $info_equipamento["tipoequipamento"] ?>" name="tipoequipamento" id="tipoequipamento">

                <label for="marcaequipamento">Marca do Equipamento</label>
                <input type="text" value="<?php echo $info_equipamento["marcaequipamento"] ?>" name="marcaequipamento" id="marcaequipamento">

                <label for="tombo">Tombo</label>
                <input type="text" value="<?php echo $info_equipamento["tombo"] ?>" name="tombo" id="tombo">

                <input type="hidden" name="idequipamento" value="<?php echo $info_equipamento["idequipamento"] ?>">

                <input type="submit" value="Confirmar exclusão">



            </form>

        </div>
    </main>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>