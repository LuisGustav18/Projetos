<?php 
session_start();
require "./funcion.php";
$textoUsuarios = AparecerTextoId();

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
    <link rel="stylesheet" href="./Styles/stylePerfil.css">
    <title>Document</title>
</head>
<body>
    <footer>
        <a href="./pag.php"><</a>
    </footer>
    <div class="container">
        <div class="sidebar">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDlDuX8nJcgDUBDXK1s2zp9dUyCvPIYI4S_Q&s" alt="Imagem do seu perfil">
            <h1><?=$_SESSION["usuario"][0]["nome"]?></h1>
        </div>

        <div class="main-content"> 
            <?php foreach($textoUsuarios as $texto): ?>
                <div class="serp">
                <h2><?=$texto["titulo"]?></h2>
                <p><?=$texto["descricao"]?></p>
                <a href="./perfil.php?excluir2=<?=$texto["id"]?>" class="pagar">Excluir</a>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</body>
</html>