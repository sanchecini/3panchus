<?php
include ("templates/encabezado.php");
include ("panel/config/conexion.php");



$sentenciaSQL= $conexion->prepare("SELECT * FROM eventos");
$sentenciaSQL->execute();
$lista_eventos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

        $sentenciaContacto= $conexion->prepare("SELECT * FROM contacto");
      $sentenciaContacto->execute();
      $lista_contacto=$sentenciaContacto->fetchAll(PDO::FETCH_ASSOC);


?>

<section class="menu section bd-contenedor" id="eventos">
        
        <h2 class="section-title">Galeria de Eventos </h2>

        <div class="menu__continer bd-grid">
       
        <?php foreach($lista_eventos as $eventos) { ?>
            <div class="menu__content">
            
                <img src="img/<?php echo $eventos['imagen']; ?>" alt="" class="menu__img">
                <h3 class="menu__name"><?php echo $eventos['nombre']; ?></h3>
                <span class="menu__detail"><?php echo $eventos['descripcion']; ?></span>
                
                
            </div>
            <?php } ?>
           
         </div>
        
    </section>






<?php
include ("templates/pie.php");

?>