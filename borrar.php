<HTML LANG="es">

<HEAD>
   <TITLE>Editar registro</TITLE>
   <LINK REL="stylesheet" TYPE="text/css" HREF="bootstrap.css">
</HEAD>

<BODY>

<?php

require_once 'conexion.php';  //llamada al archivo de conexión
if(isset($_REQUEST['borrar'])){
	$id=$_REQUEST['id'];



$conec =  mysqli_connect($hostname, $username,$password, $database);

echo "el id es ".$id;	
// Check connection
if (!$conec) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "DELETE FROM usuarios WHERE id=".$id."";
echo $sql;
if (mysqli_query($conec, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conec);
}

mysqli_close($conec);
  header('Location:listado.php');
}

else {
?>

<?php


if(isset($_REQUEST['editar'])){
	$id=$_REQUEST['id'];

$conec =  mysqli_connect($hostname, $username,$password, $database);


// Check connection
if (!$conec) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "select * FROM usuarios WHERE id=".$id."";
   
$result = mysqli_query($conec, $sql);
if (mysqli_num_rows($result) > 0) {
	
	
		$row = mysqli_fetch_assoc($result);
		echo "
<table class='table table-hover'>
<FORM ACTION='editar.php' METHOD='post'ENCTYPE='multipart/form-data'>";
                echo "<tr>";
                echo "<input type='hidden' value='".$row['id']."' name='id'>";
		echo "<td>nombre:</td>";
		echo "  <td><input type='text' name='nombre' value='".$row['nombre']."' /></td></tr>";
		echo "<tr><td>apellido:</td>";
		echo "  <td><input type='text' name='email' value='".$row['email']."' /></td></tr>";
		echo "<tr><td>username:</td>";
		echo "  <td><input type='text' name='user' value='".$row['user']."' /></td></tr>";
		echo "<tr><td>pass:</td>";
		echo "  <td><input type='text' name='pass' value='".$row['password']." '/></td></tr>";
		
   echo "<tr><td colspan='3'>
<INPUT TYPE='submit' NAME='actualizar' VALUE='Enviar datos'>   
   </INPUT></td></tr><form>";




	}
	}
	
	}

	
  ?>
