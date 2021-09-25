<?php

session_start();
if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
}


include("../template/encabezado.php");


$id=(isset($_POST['id']))?$_POST['id']:"";
$userio=(isset($_POST['usuario']))?$_POST['usuario']:"";
$passwd=(isset($_POST['passwd']))?$_POST['passwd']:"";
$nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
$tipo=(isset($_POST['tipo']))?$_POST['tipo']:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../config/conexion.php");





switch($accion){
    case "Guardar";

        $pass_c = sha1($passwd);
        $sentenciaSQL= $conexion->prepare("INSERT INTO usuarios (usuario, passwd, nombre, tipo) VALUES (:usuario,:passwd,:nombre,:tipo)");
        $sentenciaSQL->bindParam(":usuario",$userio);
        $sentenciaSQL->bindParam(":passwd",$pass_c);
        

        


        $sentenciaSQL->bindParam(":nombre",$nombre);
        $sentenciaSQL->bindParam(":tipo",$tipo);
    
        $sentenciaSQL->execute();
        header("Location:usuario.php");
        
    break;

    case "Modificar";

    
    $sentenciaSQL= $conexion->prepare("UPDATE usuarios SET usuario=:usuario, passwd=:passwd, nombre=:nombre, tipo=:tipo WHERE id=:id");
    $pass_c = sha1($passwd);
        $sentenciaSQL->bindParam(":usuario",$userio);
        $sentenciaSQL->bindParam(":passwd",$pass_c);
        $sentenciaSQL->bindParam(":nombre",$nombre);
       $sentenciaSQL->bindParam(":tipo",$tipo);
    $sentenciaSQL->bindParam(':id',$id);
    $sentenciaSQL->execute();

    
        header("Location:usuario.php");
        
    



      
    break;

    case "Cancelar";
        header("Location:usuario.php");
       
    break;



    case "Seleccionar";

        $sentenciaSQL= $conexion->prepare("SELECT * FROM usuarios WHERE id=:id");
        $sentenciaSQL->bindParam(":id",$id);
        $sentenciaSQL->execute();
        $usuarios=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $userio=$usuarios['usuario'];
        $passwd=$usuarios['passwd'];
        $nombre=$usuarios['nombre'];
        $tipo=$usuarios['tipo'];
       



       
    break;



    case "Borrar";
    
      
    $sentenciaSQL= $conexion->prepare("DELETE FROM usuarios WHERE id=:id");
    $sentenciaSQL->bindParam(":id",$id);
    $sentenciaSQL->execute();
    header("Location:usuario.php");
       
    break;

}


        $sentenciaSQL= $conexion->prepare("SELECT * FROM usuarios");
        $sentenciaSQL->execute();
        $lista_usuarios=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);




?>
<div class="container">
        <h1>Usuarios</h1>
        <form id="nuevo" name="nuevo" method="POST" action="" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="id" id="id" value="<?php echo $usuarios['id']; ?>" >
            <div class="row">
                    <div class="column">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="" id="usuario" name="usuario" value="<?php echo $userio; ?>" required/>
                    </div>

                    <div class="column">
                        <label for="passwd">Contraseña</label>
                        <input type="password" class="" id="passwd" name="passwd" value="" required/>       
                    </div>
                    
            </div>
                   
       
                            
                <div class="row">
                <div class="column">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required/>
                    </div>
                    <div class="column">
                        <label for="tipo">Tipo</label>
                        <input type="text" class="" id="tipo" name="tipo" value="<?php echo $tipo; ?>" required />
                    </div>
                </div>

                
			
        <div class="" role="" >
        <button id="guardar" name="accion" <?php echo($accion=="Seleccionar")?"disabled":""; ?> value="Guardar" type="submit" class="buttones btn-succes">Guardar</button>
        <button id="modificar" name="accion" <?php echo($accion!="Seleccionar")?"disabled":""; ?> value="Modificar" type="submit" class="buttones btn-modificar">Modificar</button>
        <button id="cancelar" name="accion" <?php echo($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" type="submit" class="buttones btn-rojo">Cancelar</button>
		
        </div>
				
				
		
				
	</form>
    </div>

    <br/>
    
  

       
    <table class="table">
     <thead>
     	<tr>
     	 <th>Usuario</th>
         <th>Contraseña</th>
         <th>Nombre</th>
         <th>Tipo</th>
         <th>Accion</th>

     	</tr>
     </thead>
     <tbody>
     <?php foreach($lista_usuarios as $usuarios){?>
     	 
           <td data-label="Usuario"><?php echo $usuarios['usuario']; ?> </td>
           <td data-label="Contraseña"><?php echo $usuarios['passwd']; ?></td>
           <td data-label="Nombre"><?php echo $usuarios['nombre']; ?></td>
           <td data-label="Tipo"><?php echo $usuarios['tipo']; ?></td>
                                   
                   
                    <td data-label="Acciones"> 
                        <form method="post">
                            <input type="hidden" name="id" id="id" value="<?php echo $usuarios['id']; ?>" >

                            <input type="submit" name="accion" value="Seleccionar" class="buttones btn-seleccionar" >
                            
                            <input type="submit" name="accion" value="Borrar" class="buttones btn-rojo" >


                        </form>
                
                    </td>
                </tr>

           <?php } ?>
     </tbody>
   </table>











<?php
include("../template/pie.php");



?>