




<?php include_once 'template/encabezado.php'; ?>


<main class="contenedor-contacto seccion contenido-centrado">
<?php
if(isset($_GET['exitoso'])):

  echo  '<h1 class="centrar-texto"><i class="far fa-smile"></i></br>!Gracias por darnos su opinion!</h1>';

endif;



 ?>
  <fieldset><legend><h1>Queremos conocer tu punto de vista...</h1></legend>

  <form id="formulario2" action="mandar_formulario.php" method="post">

                <div>
                  <?php

                  try {

                    require_once('panel/config/conexion.php');

                    $sql = " SELECT * FROM formulario";
                    $resultado = $conn->query($sql);

                  }

                  catch (Exception $e){
                    echo $e->getMessage();
                  }
                   ?>


                  <?php
                     $cadena = "";                   //feach_assoc
                  $i = 1;
                  while ($pregunta= $resultado->fetch_array(MYSQLI_ASSOC)) {


                    $cadena = str_replace("_", " ", $pregunta['opciones']);

                  ?>
                <h3><?php echo $i.". ".$pregunta['pregunta'];  ?></h3>
<div class="forma-contacto">

    <?php




    $arreglo = explode(",",  $cadena);


    foreach ($arreglo as $opciones) {

$opciones = trim($opciones);

      ?>
  <div class="opcion">


                <label><?php echo $opciones;?></label>
                <input type="radio" name="<?php echo $pregunta['codigo_pregunta']; ?>" id="<?php echo $pregunta['codigo_pregunta']; ?>"  value="<?php echo $opciones; ?>">
   </div>

<?php

}

 ?>

                </div>
<?php
$i++;
}
 ?>
      </div>
      <input type="hidden" name="accion" id="accion" value="enviar">
                <input type="submit" class="boton boton-amarillo" name="encuesta" value="¡Listo, he terminado!"><br/><br/>

        </form>
        <div id="Gracias"></div>
     </fieldset>
</main>
<script>

 $(document).ready(function(){
  var accion = document.getElementById("accion");
  $("#formulario2").submit(function() {



    if(
      <?php

try {

  require_once('panel/config/conexion.php');

  $sql = " SELECT * FROM formulario";
  $resultado = $conn->query($sql);

}

catch (Exception $e){
  echo $e->getMessage();
}
 ?>


<?php                    //feach_assoc

while ($pregunta= $resultado->fetch_array(MYSQLI_ASSOC)) {

  ?>
      $("#formulario2 input[name='<?php echo $pregunta['codigo_pregunta']; ?>']:radio").is(':checked') &&

<?php } ?>

      $(accion.value == "enviar")){
      return true;
    }
    else{
      return false;
    }

});
});
</script>
<?php include_once 'template/pie.php'; ?>








