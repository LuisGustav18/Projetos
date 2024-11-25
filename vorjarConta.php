<?php

require "./funcion.php";

if (empty($mensagemErro) && !isset($mensagemErro)){
    $mensagemErro = "";
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
    <a href="./index.php"><</a> 
</footer>
<div class="geral">
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" placeholder="Digite seu nome...">

        <label for="senha">Senha:</label>
        <input type="password" name="senha" placeholder="Digite sua senha...">

        <button type="submit">Criar</button>
    </form> 

    <?php if($mensagemErro): ?>
        <p><?=$mensagemErro?></p>
    <?php endif ?>
</div>
</body>
</html>