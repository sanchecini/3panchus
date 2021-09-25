


<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
        <link rel="stylesheet" href="../build/css/panel.css">
        <link rel="stylesheet" href="../build/css/navbar.css">
        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

  </head>
  

  <?php 
  $url="http://".$_SERVER['HTTP_HOST']."/3panchus"; 
  $route="/panel/seccion/"; 
  
  ?>
  



    <body id="body-pd">
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
                
            </div>
            <div class="header__img">
                <img src="../build/img/3panchos.png" alt="">
            </div>
           
        </header>

        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="<?php echo $url."/panel/inicio.php"; ?>"" class="nav__logo">
                        <i class='nav__logo-icon'><img src="../build/img/tresp.png" alt="" srcset=""></i>
                        <span class="nav__logo-name">TRES PANCHOS</span>
                    </a>

                    <div class="nav__list">
                        <a href="<?php echo $url.$route."promociones.php"; ?>" class="nav__link ">
                        <i class='bx bxs-offer nav__icon' ></i>
                       
                            <span class="nav__name">Promociones</span>
                        </a>
    
                        <a href="<?php echo $url.$route."nosotros.php"; ?>" class="nav__link ">
                        <i class='bx bxs-id-card bx-tada nav__icon' ></i>
                            <span class="nav__name">Nosotros</span>
                        </a>

                        <a href="<?php echo $url.$route."menu.php"; ?>" class="nav__link ">
                        <i class='bx bx-restaurant bx-tada nav__icon' ></i>
                            <span class="nav__name">Menú</span>
                        </a>

                        <a href="<?php echo $url.$route."eventos.php"; ?>" class="nav__link ">
                        <i class='bx bx-calendar-event bx-tada nav__icon' ></i>
                            <span class="nav__name">Eventos</span>
                        </a>

                        <a href="<?php echo $url.$route."contacto.php"; ?>" class="nav__link ">
                        <i class='bx bxs-contact bx-tada nav__icon' ></i>
                            <span class="nav__name">Contacto</span>
                        </a>

                        <a href="<?php echo $url.$route."encuesta.php"; ?>" class="nav__link ">
                        <i class='bx bx-book-content bx-burst nav__icon' ></i>
                            <span class="nav__name">Encuesta</span>
                        </a>

                        <a href="<?php echo $url.$route."usuario.php"; ?>" class="nav__link">
                        <i class='bx bxs-user-circle bx-burst nav__icon' ></i>
                            <span class="nav__name">Users</span>
                        </a>
                        
                        <a href="<?php echo $url; ?>" class="nav__link ">
                        <i class='bx bx-code bx-spin nav__icon' ></i>
                            <span class="nav__name">Sitio Web</span>
                        </a>
                    </div>
                </div>

                <a href="<?php echo $url.$route."cerrar.php"; ?>" class="nav__link">
                <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Cerrar Sesión</span>
                </a>
            </nav>
        </div>

       
      

        
