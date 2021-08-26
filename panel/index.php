<?php
	
	require "config/conexion.php";
	
	session_start();
	
	if($_POST){
		
		$usuario = $_POST['usuario'];
		$passwd = $_POST['passwd'];
		
		$sql = "SELECT id, passwd, nombre, tipo FROM usuarios WHERE usuario='$usuario'";
		//echo $sql;
		$resultado = $mysqli->query($sql);
		$num = $resultado->num_rows;
		
		if($num>0){
			$row = $resultado->fetch_assoc();
			$passwd_bd = $row['passwd'];
			
			$pass_c = sha1($passwd);
			
			if($passwd_bd == $pass_c){
				
				$_SESSION['id'] = $row['id'];
				$_SESSION['nombre'] = $row['nombre'];
				$_SESSION['tipo'] = $row['tipo'];
				
				header("Location: inicio.php");
				
			} else {
			
			echo "La contraseña no coincide";
			
			}
			
			
			} else {
			echo "NO existe usuario";
		}
		
		
		
	}
	
	
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="build/css/login.css" rel="stylesheet" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Iniciar Sesión</title>
</head>
<body>

<div class="login-formulario">
        <h1>Bienvenido</h1>
        <div class="contenedor">
            <div class="principal">
                <div class="contenido">
                    <h2>Iniciar Sesion</h2>
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                       <input type="text" name="usuario" placeholder="Usuario" autocomplete="off" require autofocus>
                       
                       <input type="password" name="passwd" placeholder="Contraseña" autocomplete="off" require autofocus="">

                       <button class="boton-login" type="submit" > Entrar </button>


                    </form>

                </div>

                    <div class="formulario-img">
                        <img src="build/img/3panchos.png" alt="">
                    </div>
            </div>


        </div>

    </div>
</body>
</html>