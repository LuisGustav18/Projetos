<?php 

require "./funcion.php";

if (empty($mensagem) && !isset($mensagem)){
    $mensagem = "";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./Styles/style.css">
    <title>Login</title>
</head>
<body>
    <div class="geral">
    <form method="POST">
        <label for="nomePes">Nome:</label>
        <input type="text" name="nomePes" placeholder="Digite seu nome...">

        <label for="senhaPes">Senha:</label>
        <input type="password" name="senhaPes" placeholder="Digite sua senha...">

        <button type="submit">Logar</button>
        <a href="./vorjarConta.php">Criar</a>
    </form> 
    <?php if (!empty($mensagem) && isset($mensagem)): ?>
    <p><?=$mensagem?></p>
    <?php endif ?>
</div>
</body>
</html>