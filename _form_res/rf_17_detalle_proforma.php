<?php
/*
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
$modulo = "INPC";
$opcion = "Portal de trámites";
//INCLUIR CLASES
include_once("./config/variables.php");
include_once("./includes/header.php");
if (isset($_COOKIE['usu_tinpc'])) {
    //echo "si tengo cookies";
    //header("Location:controller/login.php");
} else {
    //echo "no tengo cookies";
}
?>



</body>
</html>






