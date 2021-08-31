<?php
if(isset($_POST['encuesta'])):

    ?>
<pre>
<?php echo var_dump($_POST); ?>

</pre>
<?php
try {

  require_once('includes/funciones/bd_conexiones.php');

  if($_POST)
  	{
  	foreach ($_POST as $clave=>$valor)
     		{
if($clave != 'encuesta'){
          $stmt = $conn->prepare("INSERT INTO respuestas(codigo_pregunta, respuesta) VALUES (?, ?)");
          $stmt->bind_param("is", $clave, $valor);
          $stmt->execute();
}
     		}
  	}


$stmt->close();
$conn->close();

header('Location: encuesta.php?exitoso=1');

  }

   catch (Exception $e){

     echo $e->getMessage();
   }


else:
header('Location: encuesta.php?fallo=1');
endif;
