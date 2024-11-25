<?php 

session_start();
require "./funcion.php";
require "./trocar.php";
$textos = AparecerTexto();
$aparecerExcluir = AparecerExcluir();

if(!isset($_SESSION["usuario"]) && empty($_SESSION["usuario"])){
    header("Location: ./index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./Styles/stylePag.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDlDuX8nJcgDUBDXK1s2zp9dUyCvPIYI4S_Q&s">
                    <h2><?=$_SESSION["usuario"][0]["nome"]?></h2>
            <div class="borda">
                <a href="./perfil.php">Sobre</a>
            </div>
            <div class="borda">
                <a href="./alterar.php">Trocar Dados</a>
            </div>
        </div>
        <div class="main-content">
           <?php foreach($textos as $texto):?>
            <div class="serp">
                <p><?=$texto["nome"]?></p> 
                <h2><?=$texto["titulo"]?></h2>
                <p><?=$texto["descricao"]?></p>
                <?php if($aparecerExcluir && $texto["id_digito"] == $_SESSION["usuario"][0]["id"]): ?>
                <a href="./pag.php?excluir=<?= $texto["id"]?>" class="apagar">Excluir</a> 
                <?php endif ?>
            </div>
        <?php endforeach ?>
        </div>
        <div class="extra-content">
            <h3>Criar Textos</h3>
            <form method="POST">
                <label for="titulo">Titulo:</label>
                <input type="text" name="titulo" placeholder="Digite o titulo...">
                <label for="descricao">Descrição:</label>
                <input type="text" name="descricao" placeholder="Digite a descrição...">
                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>
</body>
</html>