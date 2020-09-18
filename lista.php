<?php require_once("conecta.php"); ?>
<?php

$tr = "SELECT * FROM setor INNER JOIN equipamento ON setor.idsetor = equipamento.id_setor INNER JOIN statusequipamento ON statusequipamento.idstatus = equipamento.id_equipamentostatus ";
if (isset($_GET["equipamento"])) {
    $nome_equipamento = $_GET["equipamento"];
    $tr .= "WHERE tipoequipamento LIKE '%{$nome_equipamento}%' OR tombo LIKE '%{$nome_equipamento}%' OR marcaequipamento LIKE '%{$nome_equipamento}%' OR tipostatus = '{$nome_equipamento}' OR nomesetor LIKE '%{$nome_equipamento}%' ";
}

$consulta_tr = mysqli_query($conecta, $tr);
if (!$consulta_tr) {
    die("erro no banco");
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
    <title>Lista</title>
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
                        <a class="dropdown-item" href="lista.php">Lista de equipamento</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Cadastro de equipamento</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <form class="my-2 my-lg-5" action="lista.php" method="GET">
            <div class="input-group">
                <input class="form-control form-control-lg mr-sm-2" type="search" name="equipamento" placeholder="Digite sua pesquisa" aria-label="Search" autocomplete="off">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Pesquisar</button>
            </div>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Local</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Tombo</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($linha = mysqli_fetch_assoc($consulta_tr)) {
                ?>
                    <tr>
                        <th scope="row"></th>
                        <td><?php echo $linha["nomesetor"] ?></td>
                        <td><?php echo $linha["tipoequipamento"] ?></td>
                        <td><?php echo $linha["marcaequipamento"] ?></td>
                        <td><?php echo $linha["tombo"] ?></td>
                        <td><?php echo $linha["tipostatus"] ?></td>
                        <td><a class="btn btn-primary" href="detalhamento.php?codigo=<?php echo $linha["idequipamento"] ?>" role="button">Detalhes</a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>