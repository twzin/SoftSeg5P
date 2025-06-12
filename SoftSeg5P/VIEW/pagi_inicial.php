<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit;
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/index.css">
    <script src="js/index.js"></script>
    <title>TRICK SPORT</title>
</head>
<body>
    <div class="header">
        <div class="titulo">
            <p>TRICK SPORT</p>
        </div>
        <div class="menu">
            <form action="../CONTROLLER/logout_user.php" method="post" style="display:inline;">
                <button type="submit" class="btnMenu">Sair</button>
            </form>
        </div>
    </div>
    <div class="background">
        <div class="form-geral">
            <div>
                <h1>Página Inicial</h1>
                <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['user']); ?>!</p>
            </div>
        </div>
    </div>
</body>
</html>
