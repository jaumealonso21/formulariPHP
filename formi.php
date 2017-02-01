<?php

$enviar = filter_input(0, 'submit');//El 0 és INPUT_POST
//$errorNom = ""; $errorApellidos = ""; $errorNick = ""; $errorDate = ""; $errorGenero = "";
$errorNom = $errorApellidos = $errorNick = $errorDate = $errorGenero = "";
$checkH = $checkD = "";
//$nombre = filter_input(INPUT_POST, 'nombre');
//$enviar = true; //True dóna per enviat el formulari
if(isset($enviar)){
    $errors = ["Está vacío", "Sólo caracteres", "La fecha no es correcta", "Eres menor de edad"];
    
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $apellidos = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nick = filter_input(INPUT_POST, 'nick', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $date = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $genero = filter_input(INPUT_POST, 'genero');
    
    if($nombre === "") {
        $errorNom = $errors[0];
    }elseif (!ctype_alpha($nombre)) {//Només lletres i espais
        $errorNom = $errors[1]; 
    }
    if($apellidos === "") {
        $errorApellidos = $errors[0];
    }elseif (!ctype_alpha($apellidos)) {//Només lletres i espais
        $errorApellidos = $errors[1]; 
    }
    if($nick === "") {
        $errorNick = $errors[0];
    }//Pot contenir lletres i números
    if ($date === ""){
        $errorDate = $errors[0];
    }else{
        //$dateSplit = explode("/", $date);
        list($dia, $mes, $any) = explode("/", $date);
        //$verifDate = checkdate($dateSplit[1], $dateSplit[0], $dateSplit[2]);
        $verifDate = checkdate($mes, $dia, $any);//month, day, year
        if($verifDate){
//            $any_dif = date("Y") - $dateSplit[2];
//            $mes_dif = date("m") - $dateSplit[1];
//            $dia_dif = date("d") - $dateSplit[0];

            $any_dif = date("Y") - $any;
            $mes_dif = date("m") - $mes;
            $dia_dif = date("d") - $dia;
            if($any_dif<18){
                $errorDate = $errors[3];//Menor d'edat
            }elseif ($any_dif===18) {//Comprovem mesos
                if($mes_dif<0){
                    $errorDate = $errors[3];//Menor d'edat
                }elseif ($mes_dif===0){//Comprovem dies
                    if($dia_dif<0){
                        $errorDate = $errors[3];//Menor d'edat
                    }
                }
            }
            
        }else{
            $errorDate = $errors[2];//Data incorrecta
        }
    }
    if (!$genero){//No hi ha res
        $errorGenero = $errors[0];   
    }else{//Deixar activat el botó seleccionat
        switch ($genero){
        case "home":
            $checkH = "checked";
            $checkD = "";
            break;
        case "dona":
            $checkH = "";
            $checkD = "checked";      
            break;
        default:
            $checkH = $checkD = false;
            break;
        }
            
    }
    
}else{//Evita errors
    $nombre = "";
    $apellidos = "";
    $nick = "";
    $date = "";
    $genero = "";
    $checkH = $checkD = "";
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
   <title>Formulario</title>
   <style>
       span {
           color: red;
       }
       .req {
           color: gray;
           font-style: italic;
       }
   </style>
</head>

<body>
    <?php echo $genero; ?>
<h2>Formulario de Registro</h2>
<form action="formi.php" method="POST">
    
    <table>
        <tr>
            <td>
                <label for="nombre">Nombre <span class="req">(requerido)</span></label>
    <input type="text" name="nombre" id="nombre" value="<?php echo $nombre ?>" />
    <span><?php echo $errorNom; ?></span></td>
        </tr>
        <tr>
            <td>
                <label for="apellidos">Apellidos <span class="req">(requerido)</span></label>
    <input type="text" name="apellidos" id="apellidos" value="<?php echo $apellidos ?>" />
    <span><?php echo $errorApellidos; ?></span></td>
        </tr>
       <tr>
            <td>
                <label for="nick">Nickname <span class="req">(requerido)</span></label>
    <input type="text" name="nick" id="nick" value="<?php echo $nick ?>" />
    <span><?php echo $errorNick; ?></span></td>
        </tr>
       <tr>
            <td>
                <label for="data">Data naixament <span class="req">(requerido)</span></label>
                <input type="text" name="data" id="data" value="<?php echo $date ?>" placeholder="dd/mm/yyyy" />
    <span><?php echo $errorDate; ?></span></td>
        </tr>
        <tr>
            <td>
              <span>Gènere: </span>
    <label for="H"><span>H</span></label>
    <input type="radio" name="genero" id="H" value="home" <?php echo $checkH; ?> />
    <label for="D"><span>D</span></label>
    <input type="radio" name="genero" id="D" value="dona" <?php echo $checkD; ?> />
    <span><?php echo $errorGenero; ?></span>
            </td>
        </tr>
<!--        <tr>
            <td>
               <label for="password">Password <span>(requerido)</span></label>
    <input type="password" name="password" id="password" /> 
            </td>
        </tr>-->
        <tr>
            <td>
                <input name="submit" type="submit" value="Enviar!!" />
            </td>
        </tr>
    </table>	
</form>
