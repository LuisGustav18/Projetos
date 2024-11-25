<?php 

require "./config.php";


if (!empty($_POST["nomePes"]) && isset($_POST["nomePes"]) &&
    !empty($_POST["senhaPes"]) && isset($_POST["senhaPes"])){

       $nomePes = $_POST["nomePes"];
       $senhaPes = $_POST["senhaPes"];
       $mensagem = "";

       if (ProcurarContas($nomePes, $senhaPes)) {
        header("Location: ./pag.php");
        exit;
    } else {
        $mensagem = "Erro nome de usuário ou senha incorretos.";
    }
}

if (!empty($_POST["nome"]) && isset($_POST["nome"]) &&
    !empty($_POST["senha"]) && isset($_POST["senha"])){

       $nome = $_POST["nome"];
       $senha = $_POST["senha"];
       $mensagemErro = "";
       
        if (CompararNome($nome)){
            $mensagemErro = "Este nome de usuário já existe!";
        } else {
            AdicionarContas($nome, $senha);
            header("Location: ./index.php");
            exit;
        }
}

if (!empty($_POST["titulo"]) && isset($_POST["titulo"]) &&
    !empty($_POST["descricao"]) && isset($_POST["descricao"])){

        $titulo = $_POST["titulo"];
        $descricao = $_POST["descricao"];

        AdicionarTexto($titulo, $descricao);
        header("Location: ./pag.php");
        exit;
}

if(!empty($_GET["excluir"]) && isset($_GET["excluir"])){
    $id = $_GET["excluir"];

    ExcluirTexto($id);
    header("Location: ./pag.php");
    exit;
}

if(!empty($_GET["excluir2"]) && isset($_GET["excluir2"])){
    $id = $_GET["excluir2"];

    ExcluirTexto($id);
    header("Location: ./perfil.php");
    exit;
}

function AdicionarTexto($titulo,$descricao){
    session_start();
    require "./config.php";

    $sql = "INSERT INTO texto (titulo, descricao, id_digito) VALUES (:titulo, :descricao, :id_digito)";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(":titulo", $titulo);
    $sql->bindValue(":descricao", $descricao);
    $sql->bindValue(":id_digito", $_SESSION["usuario"][0]["id"]);
    $sql->execute();
}

function ProcurarContas($nomePes, $senhaPes){
    require "config.php";
    session_start();

    $sql = "SELECT * FROM usuario WHERE nome = :nome AND senha = :senha";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(":nome", $nomePes);
    $sql->bindValue(":senha", $senhaPes);
    $sql->execute();

    if($sql->rowCount() > 0 ){
        $usuario = $sql->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION["usuario"] = $usuario;
        return true;
    }
    return false;
}

function CompararNome($nome){
    require "./config.php";

    $sql = "SELECT nome FROM usuario WHERE nome = :nome";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(":nome", $nome);
    $sql->execute();

    return $sql->fetch() !== false;
}

function AdicionarContas($nome, $senha){
    require "./config.php";

    $sql = "INSERT INTO usuario (nome, senha) VALUES (:nome, :senha)";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(":nome", $nome);
    $sql->bindValue(":senha", $senha); 
    $sql->execute();

};
function AparecerTexto(){
    require "./config.php";

    $sql = "SELECT usuario.nome, texto.titulo, texto.descricao, texto.id, texto.id_digito FROM texto,usuario WHERE usuario.id = texto.id_digito ORDER BY texto.data_criacao DESC";
    $sql = $pdo->prepare($sql);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}
function AparecerTextoId(){
    require "./config.php";

    $sql = "SELECT texto.titulo, texto.descricao, texto.id, texto.id_digito FROM texto,usuario WHERE usuario.id = texto.id_digito AND usuario.id = :id ORDER BY texto.data_criacao DESC";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(":id", $_SESSION["usuario"][0]["id"]);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

function ExcluirTexto($id){
    session_start();
    require "./config.php";

    $sql = "DELETE FROM texto WHERE id = :id AND id_digito = :usu";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->bindValue(":usu", $_SESSION["usuario"][0]["id"]);
    $sql->execute();
}

function AparecerExcluir(){
    require "./config.php";

    $sql = "SELECT * FROM usuario, texto WHERE usuario.id = :id AND texto.id_digito = usuario.id";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(":id", $_SESSION["usuario"][0]["id"]);
    $sql->execute();

    if($sql->rowCount() > 0 ){
        return true;
    }
    return false;
}