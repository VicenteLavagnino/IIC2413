<!DOCTYPE html>
<html style="background-color: #131e21">
<head>
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <div class="title-image">
        <img src="../styles/imagen.png" alt="Epic Prime">
    </div>

    <div class="container">
        <h1 class="title">Iniciar sesión</h1>
        <form action="login_process.php" method="POST">
            <div class="field">
                <label class="label" style="color: #FF9900">Usuario</label>
                <div class="control">
                    <input class="input" type="text" name="username" placeholder="Ingrese su usuario">
                </div>
            </div>
            <div class="field">
                <label class="label" style="color: #FF9900">Contraseña</label>
                <div class="control">
                    <input class="input" type="password" name="password" placeholder="Ingrese su contraseña">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <button class="button is-primary" style="background-color: #FF9900" type="submit">Iniciar Sesión</button>
                </div>
                <div class="control">
                    <a href="register.php" class="button is-primary" style="background-color: red">¿No tienes cuenta?</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>

