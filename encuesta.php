<?php
   include ("templates/encabezado.php");
   include ("panel/config/conexion.php");

   
   $sentenciaContacto= $conexion->prepare("SELECT * FROM contacto");
   $sentenciaContacto->execute();
   $lista_contacto=$sentenciaContacto->fetchAll(PDO::FETCH_ASSOC);

   $sentenciaEncuesta= $conexion->prepare("SELECT * FROM encuesta where id=1");
   $sentenciaEncuesta->execute();
   $lista_encuesta=$sentenciaEncuesta->fetchAll(PDO::FETCH_ASSOC);

   $sentenciaEncuesta2= $conexion->prepare("SELECT * FROM encuesta where id=2");
   $sentenciaEncuesta2->execute();
   $lista_encuesta2=$sentenciaEncuesta2->fetchAll(PDO::FETCH_ASSOC);

   $sentenciaEncuesta3= $conexion->prepare("SELECT * FROM encuesta where id=3");
   $sentenciaEncuesta3->execute();
   $lista_encuesta3=$sentenciaEncuesta3->fetchAll(PDO::FETCH_ASSOC);

   $sentenciaEncuesta4= $conexion->prepare("SELECT * FROM encuesta where id=4");
   $sentenciaEncuesta4->execute();
   $lista_encuesta4=$sentenciaEncuesta4->fetchAll(PDO::FETCH_ASSOC);

   $sentenciaEncuesta5= $conexion->prepare("SELECT * FROM encuesta where id=5");
   $sentenciaEncuesta5->execute();
   $lista_encuesta5=$sentenciaEncuesta5->fetchAll(PDO::FETCH_ASSOC);

 

   
   
?>
<?php
    include_once 'panel/seccion/survey.php';

 
    

?>

    <?php
        $survey = new Survey();
        
        $option = '';
        $consultas = $survey->consulta();
        if(isset($_POST['respuesta'])){
           
            
            $survey->setOptionSelected($_POST['respuesta']);
            $survey->vote();
        }
        if(isset($_POST['respuesta2'])){
           
            
            $survey->setOptionSelected($_POST['respuesta2']);
            $survey->vote2();
        }

        if(isset($_POST['respuesta3'])){
           
            
            $survey->setOptionSelected($_POST['respuesta3']);
            $survey->vote3();
        }
        if(isset($_POST['respuesta4'])){
           
            
            $survey->setOptionSelected($_POST['respuesta4']);
            $survey->vote4();
        }
        if(isset($_POST['respuesta5'])){
           
            
            $survey->setOptionSelected($_POST['respuesta5']);
            $survey->vote5();
        }

        
    ?>
<section class=" section bd-contenedor" id="eventos">
<div class="container">
       
<form action="#" method="POST">
            <div class="contener">
                <div class="preguntas">
                <?php foreach($lista_encuesta as $encuesta) { ?>
                    <h2><?php echo $encuesta['pregunta']; ?></h2>
                <div class="optiones">
                <input type="radio" name="respuesta" id="" value="Excelente" required>Excelente <br>
                <input type="radio" name="respuesta" id="" value="Buena">Buena <br>
                <input type="radio" name="respuesta" id="" value="Regular">Regular<br>
                <input type="radio" name="respuesta" id="" value="Mala">Mala<br>
                </div>
               
      
                </div>
                <?php } ?> 
            </div>

            <div class="contener">
                <div class="preguntas">
            <?php foreach($lista_encuesta2 as $encuesta2) { ?>
                    <h2><?php echo $encuesta['pregunta']; ?></h2>
                   
                    <div class="optiones">
                    <input type="radio" name="respuesta2" id="" value="Excelente" required>Excelente <br>
                    <input type="radio" name="respuesta2" id="" value="Buena">Buena 
                    <input type="radio" name="respuesta2" id="" value="Regular">Regular
                    <input type="radio" name="respuesta2" id="" value="Mala">Mala
                    </div>
            </div>
            <?php } ?>      
    </div>

    <div class="contener">
                <div class="preguntas">
    <?php foreach($lista_encuesta3 as $encuesta3) { ?>
                    <h2><?php echo $encuesta3['pregunta']; ?></h2>
                    <div class="optiones">
                <input type="radio" name="respuesta3" id="" value="Excelente" required>Excelente 
                <input type="radio" name="respuesta3" id="" value="Buena">Buena
                <input type="radio" name="respuesta3" id="" value="Regular">Regular
                <input type="radio" name="respuesta3" id="" value="Mala">Mala
                </div>
                </div>
            <?php } ?>      
    </div> 
    
    
    <div class="contener">
                <div class="preguntas">
    <?php foreach($lista_encuesta4 as $encuesta4) { ?>
                    <h2><?php echo $encuesta4['pregunta']; ?></h2>
              <div class="optiones">
                <input type="radio" name="respuesta4" id="" value="Excelente" required>Excelente 
                <input type="radio" name="respuesta4" id="" value="Buena">Buena 
                <input type="radio" name="respuesta4" id="" value="Regular">Regular
                <input type="radio" name="respuesta4" id="" value="Mala">Mala
               
                </div> 
            </div>
            <?php } ?>      
    </div>
                
    <div class="contener">
                <div class="preguntas">
    <?php foreach($lista_encuesta5 as $encuesta5) { ?>
                    <h2><?php echo $encuesta5['pregunta']; ?></h2>
                <div class="optiones">                       
                <input type="radio" name="respuesta5" id="" value="Excelente" required> Excelente 
                <input type="radio" name="respuesta5" id="" value="Buena">Buena 
                <input type="radio" name="respuesta5" id="" value="Regular">Regular
                <input type="radio" name="respuesta5" id="" value="Mala">Mala
                </div>
                </div>
            <?php } ?>    
            
    </div>
    <button class="button">¡He terminado!</button>  
        <input type="button" value="Resultados">
    
            
        </form>
        <div>
       
        </div>
        

    </div>

</section>
    <?php
include ("templates/pie.php");

?>








