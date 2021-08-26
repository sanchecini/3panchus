<?php
include ("template/encabezado.php");
include ("panel/config/conexion.php");



$sentenciaSQL= $conexion->prepare("SELECT * FROM encuesta");
$sentenciaSQL->execute();
$lista_encuesta=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>




<?php foreach($lista_encuesta as $encuesta) {?>

    <div class="jumbotron">

    
        <h1 class="display-3"><?php echo $encuesta['pregunta']; ?></h1>
		<br/>

        <input type="radio" name="lenguaje" id="" value="Excelente">Excelente <br>
		<input type="radio" name="lenguaje" id="" value="Buena">Buena <br>
		<input type="radio" name="lenguaje" id="" value="Regular">Regular<br>
		<input type="radio" name="lenguaje" id="" value="Mala">Mala<br>
		

		<input type="submit" value="Votar">
       
       
       
    </div>
    
    

    <?php } ?>
 




<?php 

include ("template/pie.php");

?>
