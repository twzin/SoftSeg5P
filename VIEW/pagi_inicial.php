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
    <title>TRICK SPORT</title>
    <link rel="icon" type="image/png" href="imagens/favicon.png">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="header">
        <div class="titulo">
            <p>TRICK SPORT</p>
        </div>
        <div class="logout-button">
            <form action="../CONTROLLER/logout_user.php" method="post">
                <button type="submit" class="btnMenu">Sair</button>
            </form>
        </div>
    </div>

    <!-- Corpo da página -->
    <div class="background">
        <div class="form-geral">
            <div class="form-login">
                <h1 style="margin-bottom: 2rem;">
                    Bem-vindo(a)! <strong><?php echo htmlspecialchars ($_SESSION['user']); ?></strong>.
                </h1>
                <a href="feed.php">
                    <button class="btnMenu" style="width: 100%; margin-bottom: 1rem;">Ver Publicações</button>
                </a>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
