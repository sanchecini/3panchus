<?php
include ("templates/encabezado.php");
include ("panel/config/conexion.php");



$sentenciaSQL= $conexion->prepare("SELECT * FROM contacto");
$sentenciaSQL->execute();
$lista_contacto=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>

<section class="about section bd-container" id="nosotros">
                <div class="about__container  bd-grid">
                <?php foreach($lista_contacto as $contacto) { ?>
                    <div class="about__data">
                        <span class="section-subtitle about__initial"><?php echo $contacto['nombre']; ?></span>
                        <h2 class="section-title about__initial"><?php echo $contacto['descripcion']; ?></h2>
                        <p class="about__description"><?php echo $contacto['domicilio']; ?></p>
                        <p class="about__description"><?php echo $contacto['municipio']; ?></p>
                        <p class="about__description"><?php echo $contacto['telefono']; ?></p>
                        
                    </div>

                    <img src="img/<?php echo $contacto['imagen']; ?>" alt="" class="about__img">
                </div>
                <?php } ?>
            </section>

            <section class="services section bd-container" id="services">
                
                <h2 class="section-title">100% Familiar</h2>

                <div class="services__container  bd-grid">
                    <div class="services__content">
                        
                        <h3 class="services__title">UBICACION</h3>
                        <p class="services__description"></p>
                        <iframe width="600" height="450" style="border:0" loading="lazy" allowfullscreen
                                src="https://www.google.com/maps/embed/v1/view?zoom=17&center=19.8155,-104.2313&key=..."></iframe>
                    </div>

                    

                   
                </div>
            </section>






<?php
include ("templates/pie.php");

?>