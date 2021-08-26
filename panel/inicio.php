
<?php

session_start();
if(!isset($_SESSION['id'])){
    header("Location: index.php");
}

include("template/encabezado.php");

?>

            <div class="col-md-12">
            <div class="jumbotron">
                <h1 class="display-3">Poner mas INFORMACION</h1>
                <p class="lead">Jumbo helper text</p>
                <hr class="my-2">
                <p>More info</p>
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="Jumbo action link" role="button">Jumbo action name</a>
                </p>
            </div>


            </div>


<?php
include("template/pie.php");
?>     