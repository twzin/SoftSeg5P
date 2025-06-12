<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
require_once __DIR__ . '/../DAO/conexao.php';

/* coleta */
$usuario   = trim($_POST['usuario']   ?? '');
$email     = trim($_POST['email']     ?? '');
$senhaRaw  = $_POST['senha']         ?? '';
$biografia = trim($_POST['biografia'] ?? '');

if ($usuario === '' || $email === '' || $senhaRaw === '') {
    echo json_encode(['ok' => false, 'msg' => 'Campos obrigatórios faltando']);
    exit;
}

/* gera SHA-256 (hex) */
$senhaHash = hash('sha256', $senhaRaw);

/* grava */
$stmt = $con->prepare(
    "INSERT INTO usuario (user, senha, email, biografia)
     VALUES (?, ?, ?, ?)"
);
if (!$stmt) {
    echo json_encode(['ok' => false, 'msg' => 'Prepare falhou: ' . $con->error]);
    exit;
}
$stmt->bind_param("ssss", $usuario, $senhaHash, $email, $biografia);

if ($stmt->execute()) {
    echo json_encode(['ok' => true, 'msg' => 'Usuário cadastrado com sucesso!']);
} else {
    echo json_encode(['ok' => false, 'msg' => 'Erro ao cadastrar: ' . $stmt->error]);
}
