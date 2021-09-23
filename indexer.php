
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

$sentenciaNosotros= $conexion->prepare("SELECT * FROM nosotros");
$sentenciaNosotros->execute();
$lista_nosotros=$sentenciaNosotros->fetchAll(PDO::FETCH_ASSOC);




        
        
        ?>


    <!-- Main -->

    <main class="l-main">
        
        <!--========== Promociones ==========-->
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  
  <section class="promos">
     <div class="slider bd-container bd-grid">
     <?php foreach($lista_slider as $slider) { ?>
        <div class="slide active" style="background-image: url('img/<?php echo $slider['imagen']; ?>');">
            <div class="container">
                <div class="caption transparente">
                    <h1><?php echo $slider['nombre']; ?></h1>
                    <p><?php echo $slider['descripcion']; ?></p>
                    <p><?php echo $slider['dias']; ?></p>
                    <a href="promociones.php">Ver más</a>
                </div>
                <?php } ?>
            </div>
        </div>


        <?php foreach($lista_slider2 as $slider2) { ?>
        <div class="slide" style="background-image: url('img/<?php echo $slider2['imagen']; ?>');">
            <div class="container">
                <div class="caption transparente">
                <h1><?php echo $slider2['nombre']; ?></h1>
                    <p><?php echo $slider2['descripcion']; ?></p>
                    <p><?php echo $slider2['dias']; ?></p>
                    <a href="promociones.php">Ver más</a>
                </div>
                <?php } ?>
            </div>
        </div>

        <?php foreach($lista_slider3 as $slider3) { ?>
        <div class="slide" style="background-image: url('img/<?php echo $slider3['imagen']; ?>'); ">
            <div class="container">
                <div class="caption transparente">
                <h1><?php echo $slider3['nombre']; ?></h1>
                    <p><?php echo $slider3['descripcion']; ?></p>
                    <p><?php echo $slider3['dias']; ?></p>
                    <a href="promociones.php">Ver más</a>
                </div>
                <?php } ?>
            </div>
        </div>
     </div>
   
    <!-- controls  -->
    <div class="controls">
        <div class="prev"><</div>
        <div class="next">></div>
    </div>

    <!-- indicators -->
    <div class="indicator">
    </div>

  </section>


       
<section class="about section bd-container" id="nosotros">
                <div class="about__container  bd-grid">
                <?php foreach($lista_nosotros as $nosotros) { ?>
                    <div class="about__data">
                        <span class="section-subtitle about__initial">Nosotros</span>
                        <h2 class="section-title about__initial"><?php echo $nosotros['nombre']; ?></h2>
                        <p class="about__description"><?php echo $nosotros['descripcion']; ?></p>
                        <a href="promociones.php" class="button">Mas información</a>
                    </div>

                    <img src="img/<?php echo $nosotros['imagen']; ?>" alt="" class="about__img">
                </div>
                <?php } ?>
            </section>


 <script src="script.js"></script>
 

<?php
include ("templates/pie.php");

?>