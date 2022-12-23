<?php
//  echo $_SERVER["DOCUMENT_ROOT"];
//          
//echo $_SERVER['SERVER_NAME'];
include_once("./config/variables.php");
include_once("./includes/header.php");

$tramite = "100";
$fecha_ingreso = date("2022-12-20");
$usuario = "ebustillos"; //código usuario
//
$codigo_tramite = "04202212191611989";
$dirServidor = DIRSERVIDOR;
$rutaArchivos = RUTA_ARCHIVOSTRAMITES;

$carpeta = DIRSERVIDOR . RUTA_ARCHIVOSTRAMITES . $codigo_tramite;

if (!file_exists($carpeta)) {
    mkdir($carpeta, 0777, true);
    print "Carpeta creada: Direccion Servidor " . $dirServidor . " Ruta Archivos: " . $rutaArchivos;
} else {
    print "Carpeta ya creada: Direccion dirServidor " . $dirServidor . " Ruta Archivos: " . $rutaArchivos;
}
?>



<!--<!doctype html>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
</head>
<body>
<form id="loginform" method="post">
    <div>
        Username:
        <input type="text" name="username" id="username" />
        Password:
        <input type="password" name="password" id="password" />    
        <input type="submit" name="loginBtn" id="loginBtn" value="Login" />
    </div>
</form>
<script type="text/javascript">
$(document).ready(function() {
    $('#loginform').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'login.php',
            data: $(this).serialize(),
            success: function(response)
            {
                var jsonData = JSON.parse(response);
 
                // user is logged in successfully in the back-end
                // let's redirect
                if (jsonData.success == "1")
                {
                    location.href = 'my_profile.php';
                }
                else
                {
                    alert('Invalid Credentials!');
                }
           }
       });
     });
});
</script>
</body>
</html>-->