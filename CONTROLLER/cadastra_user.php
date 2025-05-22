<?php
    $email = $_POST["email"];
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    include "../DAO/conexao.php";

    $stmt = $con->prepare("INSERT INTO usuario (email, user, senha) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die("Erro ao preparar statement: " . $con->error);
    }

    $stmt->bind_param("sss", $email, $usuario, $senha);
    $stmt->execute();
?>
