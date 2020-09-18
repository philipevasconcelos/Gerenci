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
    <link rel="stylesheet" href="css/listagem.css">
    <link rel="stylesheet" href="css/topo_lista.css">
    <title>Lista de Equipamentos</title>
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
        <div class="container">
            <div class="d-flex justify-content-between">
                <div>
                    <h2>Lista de Equipamento</h2>
                </div>
                <div>
                    <h3>Flex</h3>
                </div>

            </div>
            <form class="my-2 my-lg-5" action="lista.php" method="GET">
                <div class="input-group">
                    <input class="form-control form-control-lg mr-sm-2" type="search" name="equipamento" placeholder="Digite sua pesquisa" aria-label="Search" autocomplete="off">
                    <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Pesquisar</button>
                </div>
            </form>
            <div id="topo">
                <ul>
                    <li class="h6"><strong>Local</strong></li>
                    <li class="h6"><strong>Tipo</strong></li>
                    <li class="h6"><strong>Marca</strong></li>
                    <li class="h6"><strong>Tombo</strong></li>
                    <li class="h6"><strong>Status</strong></li>
                    <li></li>
                </ul>
            </div>
            <div id="customers">
                <?php
                while ($linha = mysqli_fetch_assoc($consulta_tr)) {
                ?>
                    <ul>
                        <li><?php echo $linha["nomesetor"] ?></li>
                        <li><?php echo $linha["tipoequipamento"] ?></li>
                        <li><?php echo $linha["marcaequipamento"] ?></li>
                        <li><?php echo $linha["tombo"] ?></li>
                        <li><?php echo $linha["tipostatus"] ?></li>
                        <li><a class="text-prymary" id="detalhe" href="detalhamento.php?codigo=<?php echo $linha["idequipamento"] ?>"><strong>Destalhes</strong></a></li>
                    </ul>
                <?php
                }
                ?>
            </div>
        </div>
    </main>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>