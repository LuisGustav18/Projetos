<?php 

session_start();
require "./trocar.php";
require "./funcion.php";
if(!isset($_SESSION["usuario"]) && empty($_SESSION["usuario"])){
    header("Location: ./index.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/styleAlt.css">
    <title>Document</title>
</head>
<body>
    <footer>
        <a href="./pag.php"><</a> 
    </footer>
<div class="geral">
    <form method="POST" action="./trocar.php">
       <select name="trocar">
            <option value=" "></option>
            <option value="nome">Nome</option>
            <option value="senha">Senha</option>
            <option Value="ambos">Ambos</option>
       </select>
       <button type="submit">Enviar</button>
    </form>

    <?php if (empty($_SESSION["trocar"])): ?>

    <?php elseif ($_SESSION["trocar"] == "ambos"): ?>
        <hr>
        <form method="POST"> 
            <label for="nomeAlt">Nome:</label>
            <input type="text" name="nomeAlt" placeholder="Digite seu nome..." required>

            <label for="senhaAlt">Senha:</label>
            <input type="password" name="senhaAlt" placeholder="Digite sua senha..." required>

            <button type="submit">Alterar</button>
        </form>
    <?php elseif ($_SESSION["trocar"] == "nome"): ?>
        <hr>
        <form method="POST"> 
            <label for="nomeAlt">Nome:</label>
            <input type="text" name="nomeAlt" placeholder="Digite seu nome...">

            <button type="submit">Alterar</button>
        </form>
    <?php elseif ($_SESSION["trocar"] == "senha"): ?>
        <hr>
        <form method="POST">
            <label for="senhaAlt">Senha:</label>
            <input type="password" name="senhaAlt" placeholder="Digite sua senha...">

            <button type="submit">Alterar</button>
        </form>
    <?php endif ?>

    <?php if (!empty($mensagemErro2) && isset($mensagemErro2)): ?>
    <p><?=$mensagemErro2?></p>
    <?php endif ?>
</body>
</div>
</html>