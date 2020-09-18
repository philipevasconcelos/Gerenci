<?php require_once("conecta.php");
//insercao no banco 
if (isset($_POST["tipoequipamento"])) {
    $tipoequipamento = $_POST["tipoequipamento"];
    $marcaequipamento = $_POST["marcaequipamento"];
    $tomboequipamento = $_POST["tombo"];
    $statusequipamento = $_POST["statusequipamento"];
    $setorequipamento = $_POST["setor"];

    $inserir = "INSERT INTO `equipamento`(`tipoequipamento`, `marcaequipamento`, `tombo`,`id_equipamentostatus`,`id_setor`) VALUES ('$tipoequipamento','$marcaequipamento', '$tomboequipamento', $statusequipamento, $setorequipamento)";

    $operacao = mysqli_query($conecta, $inserir);
    if (!$operacao) {
        die("Erro no banco");
    } else {
        print("Cadastrado com sucesso!");
    }
}

//selecao de  setor 
$select = "SELECT `idsetor`,`nomesetor` FROM `setor`";
$listar = mysqli_query($conecta, $select);
if (!$listar) {
    die("Erro no banco");
}


//selecao de status
$selectstatus = "SELECT `idstatus`, `tipostatus` FROM `statusequipamento`";
$listarstatus = mysqli_query($conecta, $selectstatus);
if (!$listarstatus) {
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
    <link rel="stylesheet" type="text/css" href="css/alterar.css">
    <title>Cadastrar Equipamento</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class=" navbar-brand" href="listagem.php">Início</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="listagem.php">Lista <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link font-weight-normal" href="inserir_equipamento.php">Cadastrar</a>
                </li>
            </ul>
        </div>
    </nav>
    <main>
        <div id="janela_formulario">
            <form action="inserir_equipamento.php" method="POST">
                <h2>Cadastrar Equipamento</h2>
                <label for="tipoequipamento">Tipo do Equipamento</label>
                <input type="text" name="tipoequipamento" autocomplete="off" autofocus>

                <label for="marcaequipamento">Marca do Equipamento</label>
                <input type="text" name="marcaequipamento" autocomplete="off">

                <label for="tombo">Tombo</label>
                <input type="text" name="tombo" autocomplete="off">
                <!-- preenchimento dinamico do setor e status -->

                <label for="statusequipamento">Status</label>
                <select name="statusequipamento">
                    <?php
                    while ($statuslinha = mysqli_fetch_assoc($listarstatus)) {
                    ?>
                        <option value="<?php echo $statuslinha["idstatus"]; ?>">
                            <?php echo $statuslinha["tipostatus"]; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
                <label for="setor">Local</label>
                <select name="setor">
                    <?php
                    while ($linha = mysqli_fetch_assoc($listar)) {
                    ?>
                        <option value="<?php echo $linha["idsetor"]; ?>">
                            <?php echo $linha["nomesetor"]; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
                <input type="submit" value="Inserir Equipamento">
            </form>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>

</html>