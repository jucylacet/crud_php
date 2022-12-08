<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ficha Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body style="background-color:powderblue">
    <?php

    $pdo = new PDO("mysql:host=localhost;dbname=trabalhophp", "root", "senhaSQL2022*");
    $pdo-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_GET['excluir'])){
        $cod_ficha = (int) $_GET['excluir'];
        $pdo-> exec("DELETE FROM tab_ficha WHERE cod_ficha = $cod_ficha");
        echo"<h3>Usuário com id $cod_ficha foi excluída com sucesso!</h3>";
    }

    if(isset($_POST['nome'])){
        $sql = $pdo->prepare("INSERT INTO `tab_ficha` VALUES (null, ?, ?, ?)");
        $sql -> execute(array($_POST['nome'], $_POST['cpf'], $_POST['email']));
        echo "<h3>Ficha cadastrada com sucesso!</h3>";
    }
    ?>

    <div class="header bg-info p-1">
        <header>
            <h2 class="text-light fw-normal justify-content-center">Ficha de Cadastro de Usuários</h2>
        </header>
    </div>
    </br>
    <div class="container">
        <form method="POST">
        <legend>
            <h2 class="row justify-content-center">Preencha os dados abaixo</h2>
        </legend>
        <fieldset>
            <div class="form-floating">
            <input type="text" class="form-control" placeholder="Nome" name="nome" id="inputNome" required>
            <label for="inputNome">Nome</label>
            </div>
            </br>
            <div class="form-floating">
            <input type="text" class="form-control" placeholder="CPF" name="cpf" id="inputCpf" required>
            <label for="inputCpf">CPF</label>
            </div>
            </br>
            <div class="form-floating">
            <input type="email" class="form-control" placeholder="E-mail" name="email" id="inputEmail" required>
            <label for="inputEmail">E-mail</label>
            </div>
            </br>
            <div class="button mt-3">
                <input class="btn btn-primary" type="submit" value="Enviar">
                <input class="btn btn-primary" type="reset" value="Limpar Dados">
            </div>
            </form>
        </fieldset>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
 
    <?php
        $sql = $pdo->prepare("SELECT * FROM `tab_ficha`");
        $sql->execute(); 
        $fichas = $sql->fetchAll();

        echo "<table class= 'table table-striped table-hover'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th scope='col' colspan='2' class='text-center'>Ações</th>";
        echo "<th scope='col'>Nome</th>";
        echo "<th scope='col'>Cpf</th>";
        echo "<th scope='col'>E-mail</th>";
        echo "</tr></thead><tbody>";

        foreach($fichas as $ficha){
            echo"<tr>";
            echo'<td align=center>
            <a href="?excluir='. $ficha['cod_ficha'] . '">( X )</a>
            </td>';
            echo'<td align=center>
            <a href="alterar.php?cod_ficha='. $ficha['cod_ficha'] . '">( Alterar )</a>
            </td>';
            echo"<td>" . $ficha['nome'] . "</td>";
            echo"<td>" . $ficha['cpf'] . "</td>";
            echo"<td>" . $ficha['email'] . "</td>";
            echo"</tr>";
        }
    ?>
</body>
</html>