<?php
    session_start(); // Da acesso a sessão do navegador

    $login = $_POST['login'];
    $senha = md5($_POST['senha']);

    include_once 'conexao.php';

    $stmt = $con->prepare("SELECT * FROM usuario WHERE nome = ? AND senha = ? ");
    $stmt->bindParam(1, $login);
    $stmt->bindParam(2, $senha);

    $stmt->execute();

    if ($stmt->rowCount() === 1) {

        $row = $stmt->fetch();

        $_SESSION["nome"] = $row["nome"]; // Criando uma variável de sessão
        $_SESSION["perfil"] = $row["perfil"];
        $_SESSION["tempo"] = time(); // Registrando o tempo exato do login Ex: 1675279671
        header("location: painel.php");
    } else {
        header("location: index.php?msg=Login/Senha inválido(s)");
    }
