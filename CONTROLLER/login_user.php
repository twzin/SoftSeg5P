<?php
    session_start();
    $input = json_decode(file_get_contents("php://input"), true);
    $usuario = $input["user"];
    $senha = $input["senha"];

    include "../DAO/conexao.php";


    $stmt = $con->prepare("SELECT * FROM usuario WHERE user = ? AND senha = ?");
    if ($stmt === false) {
        die("Erro ao preparar statement: " . $con->error);
    }

    $stmt->bind_param("ss", $usuario, $senha);
    $stmt->execute();
    $resultado = mysqli_stmt_get_result($stmt);


    $loginExiste = $resultado->num_rows > 0;   
        
    if ($loginExiste) {
        $_SESSION['user'] = $usuario;
    }
    
    echo json_encode(["loginExiste" => $loginExiste]);

?>
