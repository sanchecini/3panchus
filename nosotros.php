<?php
include ("templates/encabezado.php");
include ("panel/config/conexion.php");



$sentenciaSQL= $conexion->prepare("SELECT * FROM nosotros");
$sentenciaSQL->execute();
$lista_nosotros=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaContacto= $conexion->prepare("SELECT * FROM contacto");
$sentenciaContacto->execute();
$lista_contacto=$sentenciaContacto->fetchAll(PDO::FETCH_ASSOC);


?>




<section class="about section bd-container" id="nosotros">
                <div class="about__container  bd-grid">
                <?php foreach($lista_nosotros as $nosotros) { ?>
                    <div class="about__data">
                        <span class="section-subtitle about__initial">Nosotros</span>
                        <h2 class="section-title about__initial"><?php echo $nosotros['nombre']; ?></h2>
                        <p class="about__description"><?php echo $nosotros['descripcion']; ?></p>
                        <p class="about__description"><?php echo $nosotros['descripcion2']; ?></p>
                        
                    </div>

                    <img src="img/<?php echo $nosotros['imagen']; ?>" alt="" class="about__img">
                </div>
                <?php } ?>
            </section>

            <section class="services section bd-container" id="services">
                
                <h2 class="section-title familiar">100% Familiar</h2>

                <div class="services__container  bd-grid">
                    <div class="services__content">
                        
                        <h3 class="services__title">Mision</h3>
                        <p class="services__description"><?php echo $nosotros['mision']; ?>.</p>
                    </div>

                    <div class="services__content">
                       
                        <h3 class="services__title">Visión</h3>
                        <p class="services__description"><?php echo $nosotros['vision']; ?>.</p>
                    </div>

                   
                </div>
            </section>

<?php 

include ("templates/pie.php");

?>
