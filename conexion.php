<?php

// Conectar a mysql, lo haremos con mysqli
$con = mysqli_connect('localhost', 'root', 'root', 'crud_php_mysql');

//Probar la conexion
if(mysqli_connect_errno()){
    echo 'Error de conexion:'.mysqli_connect_error();
 }//else{
//     echo 'Conectado correctamente';
// }


?>