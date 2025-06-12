<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado.']);
    exit;
}

require_once '../DAO/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método inválido.']);
    exit;
}

if (!isset($_POST['titulo']) || !isset($_FILES['imagem'])) {
    echo json_encode(['success' => false, 'message' => 'Dados incompletos.']);
    exit;
}

$titulo = trim($_POST['titulo']);
$imagem = $_FILES['imagem'];
$nome = $_SESSION['user'];
$id_user = null; 

if ($imagem['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['success' => false, 'message' => 'Erro no upload da imagem.']);
    exit;
}

if ($imagem['size'] > 5 * 1024 * 1024) {
    echo json_encode(['success' => false, 'message' => 'Imagem muito grande.']);
    exit;
}

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mimeType = finfo_file($finfo, $imagem['tmp_name']);
finfo_close($finfo);

$tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
if (!in_array($mimeType, $tiposPermitidos)) {
    echo json_encode(['success' => false, 'message' => 'Tipo de arquivo inválido.']);
    exit;
}

$extensao = strtolower(pathinfo($imagem['name'], PATHINFO_EXTENSION));
$extensoesProibidas = ['php', 'phtml', 'exe', 'js', 'sh'];
if (in_array($extensao, $extensoesProibidas)) {
    echo json_encode(['success' => false, 'message' => 'Extensão não permitida.']);
    exit;
}

$uploadDir = '../uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$nomeImagem = uniqid('img_', true) . '.' . $extensao;
$caminhoImagem = $uploadDir . $nomeImagem;

if (!move_uploaded_file($imagem['tmp_name'], $caminhoImagem)) {
    echo json_encode(['success' => false, 'message' => 'Erro ao salvar a imagem.']);
    exit;
}

$stmt = $con->prepare("INSERT INTO posts (id_user, nome, imagem, titulo) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $id_user, $nome, $nomeImagem, $titulo);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao salvar no banco: ' . $stmt->error]);
}

$stmt->close();
$con->close();
