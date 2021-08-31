<?php

session_start();
if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
}


include("../template/encabezado.php");

?>

<?php
    include_once 'survey.php';
?>

    <?php 

                $survey = new Survey();
                $queryLanguages = $survey->showResults();
              
        ?>

                <div class="card">

        <?php
        echo "<h2>" . $survey->getTotalVotes() . " votos totales</h2>";
                 
                    foreach ($queryLanguages as $lenguaje) {
                    $porcentaje = $survey->getPercentageVotes($lenguaje['voto1']);
                    ?>

                    <div class="opcion">
                        <?php 
                            $anchoBarra = $porcentaje * 5;
                            $estilo = "barra";
                            
                    
                            echo $lenguaje['respuesta'];
                        ?>
                        <div class="<?php echo $estilo; ?>" style="width: <?php echo $anchoBarra .'px'; ?>"><?php echo $porcentaje . '%'  ?></div>
                     </div>
                <?php } ?>

               
                </div>

<div class="card">

<?php
echo "<h2>" . $survey->getTotalVotes2() . " votos totales</h2>";
         
            foreach ($queryLanguages as $lenguaje2) {
            $porcentaje = $survey->getPercentageVotes2($lenguaje2['voto2']);
            ?>

            <div class="opcion">
            <?php 
                $anchoBarra = $porcentaje * 5;
                
                
        
                echo $lenguaje2['respuesta'];
            ?>
            <div class="barra2" style="width: <?php echo $anchoBarra .'px'; ?>"><?php echo $porcentaje . '%'  ?></div>
        </div>
        <?php } ?>

       
        </div>

        <div class="card">

<?php
echo "<h2>" . $survey->getTotalVotes3() . " votos totales</h2>";
         
            foreach ($queryLanguages as $lenguaje3) {
            $porcentaje = $survey->getPercentageVotes3($lenguaje3['voto3']);
            ?>

            <div class="opcion">
            <?php 
                $anchoBarra = $porcentaje * 5;
                $estilo = "barra3";
                
        
                echo $lenguaje3['respuesta'];
            ?>
            <div class="<?php echo $estilo; ?>" style="width: <?php echo $anchoBarra .'px'; ?>"><?php echo $porcentaje . '%'  ?></div>
        </div>
        <?php } ?>

       
        </div>

        <div class="card">

<?php
echo "<h2>" . $survey->getTotalVotes4() . " votos totales</h2>";
         
            foreach ($queryLanguages as $lenguaje4) {
            $porcentaje = $survey->getPercentageVotes3($lenguaje4['voto4']);
            ?>

            <div class="opcion">
            <?php 
                $anchoBarra = $porcentaje * 5;
                $estilo = "barra3";
                
        
                echo $lenguaje4['respuesta'];
            ?>
            <div class="<?php echo $estilo; ?>" style="width: <?php echo $anchoBarra .'px'; ?>"><?php echo $porcentaje . '%'  ?></div>
        </div>
        <?php } ?>

       
        </div>


        <div class="card">

<?php
echo "<h2>" . $survey->getTotalVotes5() . " votos totales</h2>";
         
            foreach ($queryLanguages as $lenguaje5) {
            $porcentaje = $survey->getPercentageVotes5($lenguaje5['voto5']);
            ?>

            <div class="opcion">
            <?php 
                $anchoBarra = $porcentaje * 5;
                $estilo = "barra3";
                
        
                echo $lenguaje5['respuesta'];
            ?>
            <div class="<?php echo $estilo; ?>" style="width: <?php echo $anchoBarra .'px'; ?>"><?php echo $porcentaje . '%'  ?></div>
        </div>
        <?php } ?>

       
        </div>


               

    






<?php
include("../template/pie.php");



?>

<style>

.opcion{
    padding: 5px 0;
}

.barra{
    background-color:rgb(152, 196, 236);
    border-radius: 4px;
    padding: 10px;
}
.barra2{
    background-color:red;
    border-radius: 4px;
    padding: 10px;
}
.barra3{
    background-color:gray;
    border-radius: 4px;
    padding: 10px;
}
.barra4{
    background-color:orange;
    border-radius: 4px;
    padding: 10px;
}
.barra5{
    background-color:yellow;
    border-radius: 4px;
    padding: 10px;
}

</style>