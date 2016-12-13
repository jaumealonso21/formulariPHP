<?php

require_once 'conexion.php';  //llamada al archivo de conexión
if(isset($_REQUEST['actualizar'])){
	$id=$_REQUEST['id'];
        $nombre = $_REQUEST['nombre'];
        $email = $_REQUEST['email'];
        $user = $_REQUEST['user'];
        $pass = $_REQUEST['pass'];


$conec =  mysqli_connect($hostname, $username, $password, $database);

echo "el id es ".$id;	
// Check connection
if (!$conec) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "UPDATE usuarios set nombre='".$nombre."', email='".$email."', user='".$user."',password='".$pass."'  WHERE id='".$id."'";
echo $sql;
if (mysqli_query($conec, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updated record: " . mysqli_error($conec);
}

mysqli_close($conec);
  header('Location:listado.php');
}

?>