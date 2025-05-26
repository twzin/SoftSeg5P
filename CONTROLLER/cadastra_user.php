<?php
    $input = json_decode(file_get_contents("php://input"), true);
    $usuario = $input["user"];
    $senha = $input["senha"];
    $email = $input["email"];

    include "../DAO/conexao.php";

    $stmt = $con->prepare("INSERT INTO usuario (email, user, senha) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die("Erro ao preparar statement: " . $con->error);
    }

    $stmt->bind_param("sss", $email, $usuario, $senha);
    $stmt->execute();
     
    $resultado = $con->affected_rows;

    if ($resultado) {
        echo json_encode(["CadastroFeito" => $resultado]);

    }
    

?>

