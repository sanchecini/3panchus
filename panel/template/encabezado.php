


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
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    

  </head>
  

  <?php 
  $url="http://".$_SERVER['HTTP_HOST']."/3panchus"; 
  $route="/panel/seccion/"; 
  
  ?>
  



    <body id="body-pd">
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='fa fa-bars' id="header-toggle"></i>
            </div>

           
        </header>

        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="<?php echo $url."/panel/inicio.php"; ?>"" class="nav__logo">
                        <i class=' nav__logo-icon'><img src="../build/img/tresp.png" alt="" srcset=""></i>
                        <span class="nav__logo-name">TRES PANCHOS</span>
                    </a>

                    <div class="nav__list">
                        <a href="<?php echo $url.$route."promociones.php"; ?>" class="nav__link active">
                        <i class='fa fa-money nav__icon' ></i>
                            <span class="nav__name">Promociones</span>
                        </a>
    
                        <a href="<?php echo $url.$route."nosotros.php"; ?>" class="nav__link ">
                        <i class='fa fa-id-card-o nav__icon' ></i>
                            <span class="nav__name">Dashboard</span>
                        </a>

                        <a href="<?php echo $url.$route."menu.php"; ?>" class="nav__link ">
                        <i class='fa fa-cutlery nav__icon' ></i>
                            <span class="nav__name">Menú</span>
                        </a>

                        <a href="<?php echo $url.$route."eventos.php"; ?>" class="nav__link ">
                        <i class='fa fa-calendar-check-o nav__icon' ></i>
                            <span class="nav__name">Eventos</span>
                        </a>

                        <a href="<?php echo $url.$route."contacto.php"; ?>" class="nav__link ">
                        <i class='fa fa-phone-square nav__icon' ></i>
                            <span class="nav__name">Contacto</span>
                        </a>

                        <a href="<?php echo $url.$route."encuesta.php"; ?>" class="nav__link ">
                        <i class='fa fa-pencil-square-o nav__icon' ></i>
                            <span class="nav__name">Encuesta</span>
                        </a>

                        <a href="<?php echo $url.$route."usuario.php"; ?>" class="nav__link">
                            <i class='fa fa-user-o nav__icon' ></i>
                            <span class="nav__name">Users</span>
                        </a>
                        
                        <a href="<?php echo $url; ?>" class="nav__link ">
                        <i class='fa fa-file-text-o nav__icon' ></i>
                            <span class="nav__name">Sitio Web</span>
                        </a>
                    </div>
                </div>

                <a href="<?php echo $url.$route."cerrar.php"; ?>" class="nav__link">
                    <i class='fa fa-sign-out nav__icon' ></i>
                    <span class="nav__name">Cerrar Sesión</span>
                </a>
            </nav>
        </div>

       
      

        
