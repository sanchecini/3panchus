
<?php

session_start();
if(!isset($_SESSION['id'])){
    header("Location: index.php");
}

include("template/encabezado.php");

?>

           


<?php
include("template/pie.php");
?>     