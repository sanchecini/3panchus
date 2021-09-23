<?php
include ("templates/encabezado.php");
include ("panel/config/conexion.php");



$sentenciaSQL= $conexion->prepare("SELECT * FROM menu");
$sentenciaSQL->execute();
$lista_menu=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaContacto= $conexion->prepare("SELECT * FROM contacto");
$sentenciaContacto->execute();
$lista_contacto=$sentenciaContacto->fetchAll(PDO::FETCH_ASSOC);

?>


    <section class="menu section bd-contenedor" id="eventos">
        
        <h2 class="section-title">Menu</h2>

        <div class="menu__continer bd-grid">
       
        <?php foreach($lista_menu as $menu) { ?>
            <div class="menu__content">
            
                <img src="img/<?php echo $menu['imagen']; ?>" alt="" class="menu__img">
                <h3 class="menu__name"><?php echo $menu['nombre']; ?></h3>
                <span class="menu__detail"><?php echo $menu['descripcion']; ?></span>
                
                
            </div>
            <?php } ?>
           
         </div>







<?php
include ("templates/pie.php");

?>