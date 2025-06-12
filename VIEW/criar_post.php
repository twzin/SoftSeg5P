<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar Post</title>
    <script src="../MODEL/criar_post.js" defer></script>
</head>
<body>
    <h2>Criar novo post</h2>
    <form id="formPost" enctype="multipart/form-data">
        <label for="titulo">Descrição:</label>
        <input type="text" name="titulo" id="titulo" required><br><br>

        <label for="imagem">Imagem:</label>
        <input type="file" name="imagem" id="imagem" accept="image/*" required><br><br>

        <button type="submit">Publicar</button>
    </form>
    <button onclick="window.location.href='feed.php'" style="margin-bottom: 20px;">Voltar para o feed</button>


    <div id="mensagem"></div>
</body>
</html>

