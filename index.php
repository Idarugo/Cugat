<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/styles/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="fondo-login">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto py-4 form-login">
                <h1 class="text-center titulo">Inicio de Sesion</h1>
                <form>
                    <div class="form-floating py-1">
                        <i class="fas fa-user"></i>
                        <input class="form-control" style="border-radius: 20px;" placeholder="Ingrese su usuario" type="text" name="txt_usuario" id="usuario">
                        <label for="usuario">Ingrese su usuario</label>
                    </div>

                    <div class="form-floating py-1">
                        <i class="fas fa-lock"></i>
                        <input class="form-control" style="border-radius: 20px;" placeholder="Ingrese su clave" type="password" name="txt_clave" id="clave">
                        <label for="clave">Ingrese su clave</label>
                    </div>
                    <button type="submit" class="btn btn-success col-md-12 my-1" style="border-radius: 20px; height: 50px;font-size: large;">Ingresar</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>