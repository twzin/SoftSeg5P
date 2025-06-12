<?php
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['user'])) {
    http_response_code(401);           // não autorizado → login
    echo json_encode(['error' => 'não logado']);
    exit;
}

echo json_encode([
    'user'      => $_SESSION['user'],
    'email'     => $_SESSION['email'],
    'biografia' => $_SESSION['biografia'] ?? ''
]);
