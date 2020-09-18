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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/fonte.css">
    <title>Cadastrar</title>
</head>

<body style="background-color: #f6f9fc;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="lista.php">#</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="lista.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="lista.php">Lista de Equipamento</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Cadastro de Equipamento</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <form class="my-2 my-lg-5">
            <div class="form-group">
                <label for="exampleInput1">Tipo do equipamento</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInput2">Marca do equipamento</label>
                <input type="text" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <label for="exampleInput2">Tombo</label>
                <input type=text class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Status</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Local</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>