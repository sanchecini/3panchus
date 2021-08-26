


<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  
  </head>
  <body>

  <?php 
  $url="http://".$_SERVER['HTTP_HOST']."/3panchus"; 
  $route="/panel/seccion/"; 
  
  ?>



      <nav class="navbar navbar-expand navbar-light bg-light">
          <div class="nav navbar-nav">
              <a class="nav-item nav-link active" href="#">Panel</a>
              <a class="nav-item nav-link" href="<?php echo $url."/panel/inicio.php"; ?>">Inicio</a>
              <a class="nav-item nav-link" href="<?php echo $url.$route."menu.php"; ?>">Menu</a>
              <a class="nav-item nav-link" href="<?php echo $url.$route."nosotros.php"; ?>">Nosotros</a>
              <a class="nav-item nav-link" href="<?php echo $url.$route."promociones.php"; ?>">Promociones</a>
              <a class="nav-item nav-link" href="<?php echo $url.$route."eventos.php"; ?>">Eventos</a>
              <a class="nav-item nav-link" href="<?php echo $url.$route."contacto.php"; ?>">Contacto</a>
              <a class="nav-item nav-link" href="<?php echo $url.$route."encuesta.php"; ?>">Encuesta</a>
              <a class="nav-item nav-link" href="<?php echo $url.$route."usuario.php"; ?>">Usuarios</a>
              <a class="nav-item nav-link" href="<?php echo $url.$route."cerrar.php"; ?>">Cerrar Sesion</a>
              <a class="nav-item nav-link" href="<?php echo $url; ?>">Ver sitio web</a>
          </div>
      </nav>

    <div class="container">
        <div class="row">


        
