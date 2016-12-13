<HTML LANG="es">

<HEAD>
   <TITLE>Listado de usuarios</TITLE>
 </HEAD>

<BODY>
<?php


require_once 'conexion.php';  //llamada al archivo de conexión
$conec =  mysqli_connect($hostname, $username,$password, $database);

// Check connection
if (!$conec) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM usuarios";
$result = mysqli_query($conec, $sql);

echo "<table class='table table-hover'>";
 print ("<TR>\n");
         print ("<TH>Nombre</TH>");
         print ("<TH>email</TH>");
         print ("<TH>user</TH>");
         print ("<TH>pass</TH>");
        
         print ("</TR>");
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {//Vector associativo al nombre del campo, no por posicion
        echo "<tr><td> " . $row["nombre"]. "</td><td>" . $row["email"]. " </td><td>" . $row["user"]. "</td><td>".$row["password"]."</td>";
      
          echo "<td>";
         
           echo "<form action='borrar.php' method='post'>";
          
            
           echo "<input type='hidden' value='".$row['id']."' name='id'>";
            
         echo "<input type='submit' name='borrar' value='borrar registro'>"; 
          
          
           
            
         echo "<input type='submit' name='editar' value='editar registro'>"; 
           echo "</form>";
           echo "</td></tr>";
        
          
    }
} else {
    echo "<tr><td colspam=5> 0 results</td>";
}
echo "</table>";
mysqli_close($conec);
