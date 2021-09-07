
<?php
include ("templates/encabezado.php");

include ("panel/config/conexion.php");

?>

<?php 

$sentenciaPromociones= $conexion->prepare("SELECT * FROM promociones WHERE id=1");
$sentenciaPromociones->execute();
$lista_slider=$sentenciaPromociones->fetchAll(PDO::FETCH_ASSOC);

$sentenciaPromociones2= $conexion->prepare("SELECT * FROM promociones WHERE id=2");
$sentenciaPromociones2->execute();
$lista_slider2=$sentenciaPromociones2->fetchAll(PDO::FETCH_ASSOC);

$sentenciaPromociones3= $conexion->prepare("SELECT * FROM promociones WHERE id=3");
$sentenciaPromociones3->execute();
$lista_slider3=$sentenciaPromociones3->fetchAll(PDO::FETCH_ASSOC);




      $sentenciaMenu= $conexion->prepare("SELECT * FROM menu LIMIT 3");
      $sentenciaMenu->execute();
      $lista_menu=$sentenciaMenu->fetchAll(PDO::FETCH_ASSOC);

      $sentenciaNosotros= $conexion->prepare("SELECT * FROM nosotros");
      $sentenciaNosotros->execute();
      $lista_nosotros=$sentenciaNosotros->fetchAll(PDO::FETCH_ASSOC);

      $sentenciaEventos= $conexion->prepare("SELECT * FROM eventos LIMIT 3");
      $sentenciaEventos->execute();
      $lista_eventos=$sentenciaEventos->fetchAll(PDO::FETCH_ASSOC);

      $sentenciaContacto= $conexion->prepare("SELECT * FROM contacto");
      $sentenciaContacto->execute();
      $lista_contacto=$sentenciaContacto->fetchAll(PDO::FETCH_ASSOC);
        
        
        ?>


    <!-- Main -->

    <main class="l-main">
        
        <!--========== Promociones ==========-->
        <section class="fooder" id="fooder">
     
    <div class="swiper-container fooder-slider">

<div class="swiper-wrapper wrapper">

    <div class="swiper-slide slide">
    <?php foreach($lista_slider as $slider) { ?>
        <div class="content" >
            <span>our special dish</span>
            <h3><?php echo $slider['nombre']; ?></h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit natus dolor cumque?</p>
            <a href="#" class="btn">order now</a>
        </div>
        <div class="image">
        <img src="img/<?php echo $slider['imagen']; ?>" alt="" class="">
        </div>
        <?php } ?>
    </div>
  

    <div class="swiper-slide slide">
    <?php foreach($lista_slider2 as $slider2) { ?>
        <div class="content">
            <span>our special dish</span>
            <h3><?php echo $slider2['nombre']; ?></h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit natus dolor cumque?</p>
            <a href="#" class="btn">order now</a>
        </div>
        <div class="image">
        <img src="img/<?php echo $slider2['imagen']; ?>" alt="" class="">
        </div>
        <?php } ?>
    </div>


    <div class="swiper-slide slide">
    <?php foreach($lista_slider3 as $slider3) { ?>
        <div class="content">
            <span>our special dish</span>
            <h3><?php echo $slider3['nombre']; ?></h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit natus dolor cumque?</p>
            <a href="#" class="btn">order now</a>
        </div>
        <div class="image">
        <img src="img/<?php echo $slider3['imagen']; ?>" alt="" class="">
        </div>
        <?php } ?>
    </div>

</div>

<div class="swiper-pagination"></div>

</div>

</section>

<?php
include ("templates/pie.php");

?>