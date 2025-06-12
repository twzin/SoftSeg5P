<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
require_once __DIR__ . '/../DAO/conexao.php';

/* JSON recebido do fetch */
$input = json_decode(file_get_contents("php://input"), true);
$usuario = $input['user']  ?? '';
$senhaRaw = $input['senha'] ?? '';

/* hash SHA-256 para comparar */
$senhaHash = hash('sha256', $senhaRaw);

$stmt = $con->prepare(
    "SELECT id_usuario, user, email, biografia
     FROM usuario
     WHERE user = ? AND senha = ?"
);
$stmt->bind_param("ss", $usuario, $senhaHash);
$stmt->execute();
$res = $stmt->get_result();

$loginOk = $res->num_rows > 0;

if ($loginOk) {
    $row = $res->fetch_assoc();
    $_SESSION['id_usuario'] = $row['id_usuario'];
    $_SESSION['user']       = $row['user'];
    $_SESSION['email']      = $row['email'];
    $_SESSION['biografia']  = $row['biografia'] ?? '';
}

echo json_encode(['loginExiste' => $loginOk]);
