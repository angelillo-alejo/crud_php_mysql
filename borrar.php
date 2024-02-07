<?php
include 'conexion.php';
//Obtener el id enviado del index
$idRegistro = $_GET['id'];

//Selecionar datos
$query = "SELECT * FROM usuarios where id='".$idRegistro."'";
$usuario = mysqli_query($con, $query) or die (mysqli_error());

//Volcamos los datos de ese registro en una fila
$fila = mysqli_fetch_assoc($usuario);


if (isset($_POST['borrarRegistro'])){

    $query = "DELETE FROM usuarios where id='$idRegistro'";

        if (!mysqli_query($con, $query)){
            die('Error' .mysqli_error($con));
            $error = 'No se pudo borrar el registro';
        }else{
            $mensaje = 'Registro borrado correctamente';
            header('Location: index.php');
            exit();
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

        <h3>Borrar un Registro Existente</h3>

    </div>
        <div class="row caja">
            <div class="col-sm-6 offset-3">
            <form method="POST" action ='<?php $_SERVER['PHP_SELF']; ?>'>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Ingresa el nombre" value="<?php echo $fila['nombre'];?>" readonly>                    
                </div>
                
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input type="text" class="form-control" name="apellidos" placeholder="Ingresa los apellidos" value=" <?php echo $fila['apellidos'];?>" readonly>                    
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Telefono:</label>
                    <input type="number" class="form-control" name="telefono" placeholder="Ingresa el teléfono" value=" <?php echo $fila['telefono'];?>" readonly>                    
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" placeholder="Ingresa el email" value=" <?php echo $fila['email'];?>" readonly>                    
                </div>
              
                <button type="submit" class="btn btn-primary w-100" name="borrarRegistro">Borrar Registro</button>

                </form>
            </div>
        </div>
    </div>
  </body>
</html>