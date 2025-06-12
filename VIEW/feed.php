<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit;
}

require_once '../DAO/conexao.php';

$resultado = $con->query("SELECT * FROM posts ORDER BY id_user DESC");

$posts = [];
if ($resultado && $resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $posts[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Feed</title>
  <link rel="stylesheet" href="css/feed_style.css">
</head>
<body>
  <div class="top-bar">
    <h1>Trick Sport 🥊</h1>
    <div class="top-buttons">
      <a href="criar_post.php" class="top-button">Criar Novo Post</a>
      <a href="../CONTROLLER/logout_user.php" class="top-button">Sair</a>
    </div>
  </div>

  <div class="feed" id="feed">
    <?php foreach ($posts as $post): ?>
      <div class="post">
        <img src="../uploads/<?= htmlspecialchars($post['imagem']) ?>" alt="Post de <?= htmlspecialchars($post['nome']) ?>">
        <div class="info">
          <div class="usuario">@<?= htmlspecialchars($post['nome']) ?></div>
          <div class="legenda"><?= htmlspecialchars($post['titulo']) ?></div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</body>
</html>
