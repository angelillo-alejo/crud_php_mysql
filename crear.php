<?php
include 'conexion.php';
// Verifica si se ha enviado el formulario
if (isset($_POST['crearRegistro'])){
    $nombre = mysqli_real_escape_string ($con, $_POST['nombre']);
    $apellidos = mysqli_real_escape_string ($con, $_POST['apellidos']);
    $telefono = mysqli_real_escape_string ($con, $_POST['telefono']);
    $email = mysqli_real_escape_string ($con, $_POST['email']);

    //Configura tiempo y zona horaria
    date_default_timezone_set('Europe/Madrid');
    $time = date('h:i:s a', time());

    //Validar si los campos estan vacios (en el lado del servidor)
    if (
    !isset($nombre) || $nombre == '' ||
    !isset($apellidos) || $apellidos == '' ||
    !isset($telefono) || $telefono == '' ||
    !isset($email) || $email == '' ){
        $error = 'Algunos campos estan vacios';
    }else{
        $query = "INSERT INTO usuarios(nombre, apellidos, telefono, email)
        VALUES('$nombre', '$apellidos', '$telefono', '$email')";
        if (!mysqli_query($con, $query)){
            die('Error' .mysqli_error($con));
            $error = 'No se pudo crear el registro';
        }else{
            header('Location: index.php');
            $mensaje = 'Registro creado correctamente';
            exit();
        }
    }

}
?>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link href="css/estilos.css" rel="stylesheet">

    <title>CRUD PHP Y MYSQL</title>
  </head>
  <body>
    <h1 class="text-center">CRUD PHP Y MYSQL</h1>
    <p class="text-center"></p>

    <div class="container">

    <div class="row">
        <h4>Crear un Nuevo Registro</h4>
    </div>   

        <div class="row caja">

            <div class="col-sm-6 offset-3">
            <form method="POST" action = '<?php $_SERVER['PHP_SELF']; ?>'>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Ingresa el nombre">                    
                </div>
                
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input type="text" class="form-control" name="apellidos" placeholder="Ingresa los apellidos">                    
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Telefono:</label>
                    <input type="number" class="form-control" name="telefono" placeholder="Ingresa el teléfono">                    
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" placeholder="Ingresa el email">                    
                </div>
              
                <button type="submit" class="btn btn-primary w-100" name="crearRegistro">Crear Registro</button>

                </form>
            </div>
        </div>
    </div>
  </body>
</html>