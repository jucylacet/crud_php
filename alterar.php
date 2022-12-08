<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<?php
$pdo = new PDO("mysql:host=localhost;dbname=trabalhophp", "root", "senhaSQL2022*");

if (isset($_GET['cod_ficha'])) {
    $cod_ficha = (int)$_GET['cod_ficha'];
    $sql = $pdo->prepare("SELECT * FROM tab_ficha WHERE cod_ficha = $cod_ficha");
    $sql->execute();
    $fichas = $sql->fetchAll();

    foreach ($fichas as $ficha) {
        echo "<form method='POST'>";
        echo "<legend>Insira os dados abaixo</legend>";
        echo "<fieldset>";
        echo "<div>";
        echo "Nome: <input type='text' class='form-control' name='nome' value='" . $ficha['nome'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "CPF: <input type='text' class='form-control' name='cpf' value='" . $ficha['cpf'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "E-mail: <input type='email' class='form-control' name='email' value='" . $ficha['email'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "<input type='submit' class='btn btn-primary' value='Enviar'>";
        echo "<input type='reset' class='btn btn-primary' value='Limpar Dados'>";
        echo "</div>";
        echo "<br>";
        echo "</fieldset>";
        echo "</form>";
    }
}

if (isset($_POST['nome'])) {
    $sql = $pdo->prepare("UPDATE tab_ficha SET nome = ?, cpf = ?, email = ? WHERE cod_ficha = $cod_ficha");
    $sql->execute(array($_POST['nome'], $_POST['cpf'], $_POST['email']));
    echo "<h1>Usuário com id = $cod_ficha alterado com sucesso!</h1>";
    echo "<a href='index.php'>Voltar</a>";

}