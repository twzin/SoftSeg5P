<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="header">
        <div class="titulo"><p>Trick Sport</p></div>

        <div class="menu">
            <a href="pagi_inicial.php"><button class="btnMenu">Home</button></a>
            <form action="../CONTROLLER/logout_user.php" method="post" style="display:inline;">
                <button type="submit" class="btnMenu">Sair</button>
            </form>
        </div>
    </div>

    <div class="background">
        <div class="form-geral">
            <div class="form-cadastro" style="padding-bottom:2rem;">
                <h1>PERFIL</h1>

                <label>Usuário</label>
                <p style="margin-bottom:1.25rem;">
                    <?= htmlspecialchars($_SESSION['user']) ?>
                </p>

                <label>E-mail</label>
                <p style="margin-bottom:1.25rem;">
                    <?= htmlspecialchars($_SESSION['email']) ?>
                </p>

                <label>Biografia</label>
                <p style="white-space:pre-wrap;">
                    <?= nl2br(htmlspecialchars($_SESSION['biografia'])) ?>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
