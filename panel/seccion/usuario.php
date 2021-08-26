<?php
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

<div class="col-md-5">

<div class="card">
    <div class="card-header">
       Datos de Usuario
    </div>

    <div class="card-body">
    <form id="nuevo" name="nuevo" method="POST" action="" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="id" id="id" value="<?php echo $usuarios['id']; ?>" >
    <div class="form-group">
        <label for="nombre">Usuario</label>
        <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $userio; ?>" />
        </div>
                    
        <div class="form-group">
        <label for="descripcion">Contraseña</label>
        <input type="text" class="form-control" id="passwd" name="passwd" value="" />
        </div>
                   
       
        <div class="form-group">
        <label for="categoria">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" />
        </div>
                    
        <div class="form-group">
        <label for="precio">Tipo</label>
        <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo $tipo; ?>" />
        </div>
			
        <div class="btn-group" role="group" aria-label="">
        <button id="guardar" name="accion" <?php echo($accion=="Seleccionar")?"disabled":""; ?> value="Guardar" type="submit" class="btn btn-success">Guardar</button>
        <button id="modificar" name="accion" <?php echo($accion!="Seleccionar")?"disabled":""; ?> value="Modificar" type="submit" class="btn btn-warning">Modificar</button>
        <button id="cancelar" name="accion" <?php echo($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" type="submit" class="btn btn-danger">Cancelar</button>
		
        </div>
				
				
		
				
	</form>
    </div>

    
    </div>

        
        
        
</div>

<div class="col-md-7" >
        <table class="table table-bordered" >
            <thead>
                <tr >
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Accion</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach($lista_usuarios as $usuarios){?>
                <tr>
                    <td><?php echo $usuarios['usuario']; ?> </td>
                    <td><?php echo $usuarios['passwd']; ?></td>
                             
                    <td><?php echo $usuarios['nombre']; ?></td>
                    <td><?php echo $usuarios['tipo']; ?></td>
                    <td> 
                        <form method="post">
                            <input type="hidden" name="id" id="id" value="<?php echo $usuarios['id']; ?>" >

                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary" >
                            
                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger" >


                        </form>
                
                    </td>
                </tr>
                
                <?php } ?>
            </tbody>
        </table>


</div>











<?php
include("../template/pie.php");



?>