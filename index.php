
<?php
include ("templates/encabezado.php");

include ("panel/config/conexion.php");

?>

<?php 
      $sentenciaPromociones= $conexion->prepare("SELECT * FROM promociones ORDER BY rand() LIMIT 1");
      $sentenciaPromociones->execute();
      $lista_slider=$sentenciaPromociones->fetchAll(PDO::FETCH_ASSOC);

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
        
         <section class="home" id="promociones">
         <?php foreach($lista_slider as $slider) { ?>
                <div class="home__container bd-container bd-grid">
                    <div class="home__data">
                        <h1 class="home__title"><?php echo $slider['nombre']; ?></h1>
                        <h2 class="home__subtitle"><?php echo $slider['descripcion']; ?></h2>
                        <h2 class=""><?php echo $slider['dias']; ?></h1>
                        <a href="promociones.php" class="button">Ver mas</a>
                    </div>
    
                    <img src="img/<?php echo $slider['imagen']; ?>" alt="" class="home__img">
                     <?php } ?>
                </div>
            </section>
<!--========== Nosotros ==========-->
       
<section class="about section bd-container" id="nosotros">
                <div class="about__container  bd-grid">
                <?php foreach($lista_nosotros as $nosotros) { ?>
                    <div class="about__data">
                        <span class="section-subtitle about__initial">Nosotros</span>
                        <h2 class="section-title about__initial"><?php echo $nosotros['nombre']; ?></h2>
                        <p class="about__description"><?php echo $nosotros['descripcion']; ?></p>
                        <a href="#" class="button">Mas información</a>
                    </div>

                    <img src="img/<?php echo $nosotros['imagen']; ?>" alt="" class="about__img">
                </div>
                <?php } ?>
            </section>


        <section class="menu section bd-contenedor" id="menu">
        
        <h2 class="section-title">Menu </h2>

        <div class="menu__container bd-grid">
       
        <?php foreach($lista_menu as $menu) { ?>
            <div class="menu__content">
            
                <img src="img/<?php echo $menu['imagen']; ?>" alt="" class="menu__img">
                <h3 class="menu__name"><?php echo $menu['nombre']; ?></h3>
                <span class="menu__detail"><?php echo $menu['descripcion']; ?></span>
                
                
            </div>
            <?php } ?>
            <div class="buttones">
            <a href="menu.php" class="button">Ver más</a>

            </div>
           
         </div>
         
    </section>
    

         


         



     <!--========== Galeria/Eventos ==========--> 
     <section class="menu section bd-contenedor" id="eventos">
        
        <h2 class="section-title">Galeria de Eventos </h2>

        <div class="menu__container bd-grid">
       
        <?php foreach($lista_eventos as $eventos) { ?>
            <div class="menu__content">
            
                <img src="img/<?php echo $eventos['imagen']; ?>" alt="" class="menu__img">
                <h3 class="menu__name"><?php echo $eventos['nombre']; ?></h3>
                <span class="menu__detail"><?php echo $eventos['descripcion']; ?></span>
                
                
            </div>
            <?php } ?>
            <div class="buttones">
            <a href="eventos.php" class="button">Ver más</a>

            </div>
         </div>
        
    </section>

    <!--========== Contacto ==========-->
    <section class="about section bd-container" id="contacto">
                <div class="about__container  bd-grid">
                <?php foreach($lista_contacto as $contacto) { ?>
                    <div class="about__data">
                        <span class="section-subtitle about__initial"><?php echo $contacto['nombre']; ?></span>
                        <h2 class="section-title about__initial"><?php echo $contacto['descripcion']; ?></h2>
                        <p class="about__description"><?php echo $contacto['domicilio']; ?>.</p>
                        <span class="section-subtitle about__initial"><?php echo $contacto['telefono']; ?></span>
                        <a href="#" class="button">Conocer más</a>
                    </div>

                    <img src="img/<?php echo $contacto['imagen']; ?>" alt="" class="about__img">
                </div>
                <?php } ?>
            </section>


            <section class="contact section bd-container" id="encuesta">
                <div class="contact__container bd-grid">
                    <div class="contact__data">
                        <span class="section-subtitle contact__initial">Encuesta</span>
                        <h2 class="section-title contact__initial">Necesitamos conocer tu opinion</h2>
                        <p class="contact__description">Solo con responder una pequeña encuesta</p>
                    </div>

                    <div class="contact__button">
                        <a href="index.php" class="button">Realizar</a>
                    </div>
                </div>
            </section>

            <br/>


<?php
include ("templates/pie.php");

?>