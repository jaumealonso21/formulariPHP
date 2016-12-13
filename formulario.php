<HTML LANG="es">

<HEAD>
   <TITLE>Subida de ficheros</TITLE>
  </HEAD>

<BODY>
<?php

?>	<h2>Formulario de Registro</h2>
	<div class="group">
	  <form action="registro.php" method="POST">
		<label for="nombre">Nombre <span>(requerido)</span></label>
		<input type="text" name="nombre" class="form-input" required/>
			
		<label for="email">Email <span>(requerido)</span></label>
		<input type="email" name="email" class="form-input" />
			
		<label for="password">Contraseña <span>(requerido)</span></label>
		<input type="password" name="password" class="form-input" required/>
				
        <label for="nick">Nickname <span>(requerido)</span></label>
		<input type="text" name="user" class="form-input" / required>
               
        <input class="form-btn" name="submit" type="submit" value="Registrarme!!" />	
	  </form>
	</div>