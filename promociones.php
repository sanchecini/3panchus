<?php
include ("templates/encabezado.php");
include ("panel/config/conexion.php");



$sentenciaSQL= $conexion->prepare("SELECT * FROM promociones");
$sentenciaSQL->execute();
$lista_promociones=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaContacto= $conexion->prepare("SELECT * FROM contacto");
      $sentenciaContacto->execute();
      $lista_contacto=$sentenciaContacto->fetchAll(PDO::FETCH_ASSOC);


?>


  <!--========== Promociones ==========-->
        
  <section class="menu section bd-contenedor" id="menu">
        
        <h2 class="section-title">Promociones </h2>

        <div class="menu__container bd-grid">
       
        <?php foreach($lista_promociones as $promociones) { ?>
            <div class="menu__content">
            
                <img src="img/<?php echo $promociones['imagen']; ?>" alt="" class="menu__img">
                <h3 class="menu__name"><?php echo $promociones['nombre']; ?></h3>
                <span class="menu__detail"><?php echo $promociones['descripcion']; ?></span>
                
                
            </div>
            <?php } ?>
           
         </div>
        
    </section>






<?php
include ("templates/pie.php");

?>