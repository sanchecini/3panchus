<?php
   include("template/encabezado.php");
   
?>
<?php
    include_once 'panel/seccion/survey.php';

    
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <title>Encuesta</title>
</head>
<body>
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
    <form action="#" method="POST">
    
        <h2>Hola como estas?</h2>
       
        <input type="radio" name="respuesta" id="" value="Excelente" required>Excelente <br>
        <input type="radio" name="respuesta" id="" value="Buena">Buena <br>
        <input type="radio" name="respuesta" id="" value="Regular">Regular<br>
        <input type="radio" name="respuesta" id="" value="Mala">Mala<br>
        

        <h2>¿Cuál es tu lenguaje de programación favorito2?</h2>

        <input type="radio" name="respuesta2" id="" value="Excelente" required>Excelente <br>
        <input type="radio" name="respuesta2" id="" value="Buena">Buena <br>
        <input type="radio" name="respuesta2" id="" value="Regular">Regular<br>
        <input type="radio" name="respuesta2" id="" value="Mala">Mala<br>

        <h2>¿Cuál es tu lenguaje de programación favorito2?</h2>

        <input type="radio" name="respuesta3" id="" value="Excelente" required>Excelente <br>
        <input type="radio" name="respuesta3" id="" value="Buena">Buena <br>
        <input type="radio" name="respuesta3" id="" value="Regular">Regular<br>
        <input type="radio" name="respuesta3" id="" value="Mala">Mala<br>


        <h2>¿Cuál es tu lenguaje de programación favorito2?</h2>

        <input type="radio" name="respuesta4" id="" value="Excelente" required>Excelente <br>
        <input type="radio" name="respuesta4" id="" value="Buena">Buena <br>
        <input type="radio" name="respuesta4" id="" value="Regular">Regular<br>
        <input type="radio" name="respuesta4" id="" value="Mala">Mala<br>


        <h2>¿Cuál es tu lenguaje de programación favorito2?</h2>

        <input type="radio" name="respuesta5" id="" value="Excelente" required>Excelente <br>
        <input type="radio" name="respuesta5" id="" value="Buena">Buena <br>
        <input type="radio" name="respuesta5" id="" value="Regular">Regular<br>
        <input type="radio" name="respuesta5" id="" value="Mala">Mala<br>

        
        <input type="submit" value="Votar!">
        
    </form>
</body>
</html>










