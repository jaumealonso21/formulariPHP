<?php


require_once 'conexion.php';  //llamada al archivo de conexión
if(isset($_REQUEST['submit'])){
	
	$nombre=$_REQUEST['nombre'];


$email = $_REQUEST['email'];
$user = $_REQUEST['user'];
$pass = $_REQUEST['password'];


$conec =  mysqli_connect($hostname, $username, $password, $database);

// Check connection
if (!$conec) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "INSERT INTO usuarios (nombre, email,user,password)
VALUES ('$nombre','$email','$user','$pass')";

 
$query = mysqli_query($conec,'SELECT * FROM usuarios WHERE user="'.mysqli_escape_string($conec,$user).'"');
if($existe = mysqli_fetch_row($query))
{
	echo 'El usuario '.$user.' ya existe.';	
}
else{
	$inser = mysqli_query($conec,$sql);
	if($inser)
	{
		echo 'Usuario registrado con exito';
	}else{
		echo 'Hubo un error en el registro.';	
	}
	}
}





mysqli_close($conec);
?>
<p><a href="formulario.php">añadir mas usuarios</a> .</p>
<p><a href="listado.php">listado usuarios</a> .</p>