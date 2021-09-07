




     </div>
    </div>
    
<!--========== FOOTER ==========-->


<footer class="footer section bd-container">
            <div class="footer__container bd-grid">
                <div class="footer__content">
            <a href="#" class="footer__logo">Los Tres Panchos</a>
            <span class="footer__description">Restaurante - Bar</span>
            <div>
                <a href="https://www.facebook.com/Lostrespanchoselgrullo" class="footer__social"><i class="fa fa-facebook"></i></a>
                <a href="#" class="footer__social"><i class="fa fa-instagram"></i></a>
                
            </div>
        </div>

        <div class="footer__content">
            <h3 class="footer__title">Servicios</h3>
            <ul>
                <li><a href="#" class="footer__link">Envios</a></li>
                <li><a href="promociones.php" class="footer__link">Promociones</a></li>
                <li><a href="contacto.php" class="footer__link">Reservaciones</a></li>
                
            </ul>
        </div>

        <div class="footer__content">
            <h3 class="footer__title">Información</h3>
            <ul>
                <li><a href="index.php" class="footer__link">Encuesta</a></li>
                <li><a href="contacto.php" class="footer__link">Mapa</a></li>
                
            </ul>
        </div>
        <?php foreach($lista_contacto as $contacto) { ?>
        <div class="footer__content">
            <h3 class="footer__title">Ubicación</h3>
            <ul>
                <li><?php echo $contacto['municipio']; ?></li>
                <li><?php echo $contacto['domicilio']; ?> </li>
                <li><?php echo $contacto['telefono']; ?></li>
                <li>panchos@gmail.com</li>
            </ul>
        </div>
        <?php } ?>
    </div>
    <p class="footer__copy"> Los Tres Panchos &copy; <?php echo date('Y'); ?></p>
</footer>



    <!-- Scroll reveal-->

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="build/js/main.js"></script>
    


</body>
</html>

