<?php
include 'conexion.php';
//Obtener el id enviado del index
$idRegistro = $_GET['id'];
//  var_dump($_GET['id']);

//Selecionar datos
$query = "SELECT * FROM usuarios where id='".$idRegistro."'";
$usuario = mysqli_query($con, $query) or die (mysqli_error( ));

//Volcamos los datos de ese registro en una fila
$fila = mysqli_fetch_assoc($usuario);

// Verifica si se ha enviado el formulario
if (isset($_POST['editarRegistro'])){
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
        $query = "UPDATE usuarios set nombre= '$nombre', apellidos= '$apellidos', telefono='$telefono', email='$email' where id='$idRegistro'";

        if (!mysqli_query($con, $query)){
            die('Error' .mysqli_error($con));
            $error = 'No se pudo crear el registro';
        }else{
            $mensaje = 'Registro creado correctamente';
            header('Location: index.php');
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
    <p class="text-center">************************************</p>

    <div class="container">

    <div class="row">

        <h3>Editar un Registro Existente</h3>

    </div>
        <div class="row caja">
            <div class="col-sm-6 offset-3">
            <form method="POST" action ='<?php $_SERVER['PHP_SELF']; ?>'>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Ingresa el nombre" value="<?php echo $fila['nombre'];?>">                    
                </div>
                
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input type="text" class="form-control" name="apellidos" placeholder="Ingresa los apellidos" value=" <?php echo $fila['apellidos'];?>">                    
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Telefono:</label>
                    <input type="number" class="form-control" name="telefono" placeholder="Ingresa el teléfono" value=" <?php echo $fila['telefono'];?>">                    
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" placeholder="Ingresa el email" value=" <?php echo $fila['email'];?>">                    
                </div>
              
                <button type="submit" class="btn btn-primary w-100" name="editarRegistro">Editar Registro</button>

                </form>
            </div>
        </div>
    </div>
  </body>
</html>