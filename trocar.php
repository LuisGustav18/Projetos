<?php

if (!empty($_POST["trocar"]) && isset($_POST["trocar"])){
    session_start();
    $_SESSION["trocar"] = $_POST["trocar"];

    header("Location: ./alterar.php");
    exit;
}

if ((!empty($_POST["nomeAlt"]) && isset($_POST["nomeAlt"])) ||
    (!empty($_POST["senhaAlt"]) && isset($_POST["senhaAlt"]))){
        
    $nomeAlt = $_POST["nomeAlt"];
    $senhaAlt = "";

    if(!empty($_POST["senhaAlt"]) && isset($_POST["senhaAlt"])){
         $senhaAlt = $_POST["senhaAlt"];
    }
   
    $mensagemErro2 = "";

    if (CompararNome2($nomeAlt)){
        $mensagemErro2 = "Já existe esse usuario!";
    } else {
        AlterarElementos($nomeAlt, $senhaAlt);
        header("Location: ./pag.php");
        exit;
    }
}

function CompararNome2($nomeAlt){
    require "./config.php";

    $sql = "SELECT nome FROM usuario WHERE nome = :nome";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(":nome", $nomeAlt);
    $sql->execute();

    return $sql->fetch() !== false;
}

function AlterarElementos($nomeAlt,$senhaAlt){
    session_start();
    require "./config.php";

    if (!empty($nomeAlt) && !empty($senhaAlt)){
        $sql = "UPDATE usuario SET nome = :nome, senha = :senha WHERE id = :id";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":id",  $_SESSION["usuario"][0]["id"]);
        $sql->bindValue(":nome", $nomeAlt);
        $sql->bindValue(":senha", $senhaAlt);
        $sql->execute();

        $_SESSION["usuario"][0]["nome"] = $nomeAlt;
    } elseif (!empty($nomeAlt) && empty($senhaAlt)){
        $sql = "UPDATE usuario SET nome = :nome WHERE id = :id";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":id",  $_SESSION["usuario"][0]["id"]);
        $sql->bindValue(":nome", $nomeAlt);
        $sql->execute();

        $_SESSION["usuario"][0]["nome"] = $nomeAlt;
    } elseif (empty($nomeAlt) && !empty($senhaAlt)){
        $sql = "UPDATE usuario SET senha = :senha WHERE id = :id";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":id", $_SESSION["usuario"][0]["id"]);
        $sql->bindValue(":senha", $senhaAlt);
        $sql->execute();
    }
}

