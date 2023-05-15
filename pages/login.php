<!DOCTYPE html>
<html lang="es">

<head>
    <?php include '../components/head.php' ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/main.css">
    <link rel="stylesheet" href="../assets/styles/pages/login.css">
    <title>Login</title>
</head>

<body>
    <?php include '../components/header.php' ?>
    <div class="login-container">
        <form action="../routes/usuario.routes.php" class="form-login" method="POST">
            <ul class="login-nav">
                <li class="login-nav__item active">
                    <a href="#">Iniciar Sesion</a>
                </li>
            </ul>
            <label for="login-input-user" class="login__label">
                Usuario
            </label>
            <input id="login-input-user" class="login__input" type="text" name="txtUsuario" />
            <label for="login-input-password" class="login__label">
                Contraseña
            </label>
            <input id="login-input-password" class="login__input" type="password" name="txtPassword" />
            <button class="login__submit" name="btnUsuarioLogin">Iniciar Sesion</button>
            <?php if (isset($_GET['AuthError'])) : ?>
                <div id="error-message" class="error-message"><?php echo htmlspecialchars($_GET['AuthError']) ?></div>
            <?php endif; ?>
        </form>
    </div>
    <?php include '../components/footer.php' ?>
</body>

</html>