<?php require_once("conecta.php"); ?>
<?php

//Consulta a tabela de equipamento , setor e status
$tr = "SELECT * FROM setor INNER JOIN equipamento ON setor.idsetor = equipamento.id_setor INNER JOIN statusequipamento ON statusequipamento.idstatus = equipamento.id_equipamentostatus ";
if (isset($_GET["codigo"])) {
    $id = $_GET["codigo"];
    $tr .= "WHERE idequipamento = {$id} ";
} else {
    $tr .= "WHERE idequipamento = 4";
}

//Alterar manutenção

$con_equipamento = mysqli_query($conecta, $tr);

$info_equipamento = mysqli_fetch_assoc($con_equipamento);


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap4.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/detalhe.css">
    <title>Detalhes do Equipamento</title>
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
            <h2>Detalhes do Equipamento</h2>
            <div class="row aling items-stretch" id="detalhe">
                <div class="col-4">
                    <ul>
                        <li><b>Tipo do equipamento: </b><?php echo $info_equipamento["tipoequipamento"] ?></li>
                        <li><b>Marca do equipamento: </b><?php echo $info_equipamento["marcaequipamento"] ?></li>
                        <li><b>Tombo: </b><?php echo $info_equipamento["tombo"] ?></li>
                        <li><b>Status: </b><?php echo $info_equipamento["tipostatus"] ?></li>
                        <li><b>Local: </b><?php echo $info_equipamento["nomesetor"] ?></li><br>
                        <a id="alterar2" href="alteracao.php?codigo=<?php echo $info_equipamento["idequipamento"] ?>">Alterar Informações do Equipamento</a><br>
                        <a id="excluir" href="exclusao.php?codigo=<?php echo $info_equipamento["idequipamento"] ?>">Excluir Equipamento</a>
                    </ul>
                </div>
                <div class="col-4">
                    <li><b>Data: </b><?php echo $info_equipamento["datamanutencao"] ?></li>
                    <li><b>Descrição do Problema: </b><?php echo $info_equipamento["manutencao"] ?></li><br>
                    <a id="alterar1" href="alterar_detalhe.php?codigo=<?php echo $info_equipamento["idequipamento"] ?>">Alterar Descrição do Problema</a><br>
                    </ul>
                </div>
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