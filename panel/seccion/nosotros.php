<?php

session_start();
if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
}


include("../template/encabezado.php");


$id=(isset($_POST['id']))?$_POST['id']:"";
$nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
$imagen=(isset($_FILES['imagen']['name']))?$_FILES['imagen']['name']:"";
$descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
$descripcion2=(isset($_POST['descripcion2']))?$_POST['descripcion2']:"";
$mision=(isset($_POST['mision']))?$_POST['mision']:"";
$vision=(isset($_POST['vision']))?$_POST['vision']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../config/conexion.php");





switch($accion){
    case "Guardar";

        $sentenciaSQL= $conexion->prepare("INSERT INTO nosotros (nombre, imagen, descripcion, descripcion2, mision, vision) VALUES (:nombre,:imagen,:descripcion,:descripcion2,:mision,:vision)");
        $sentenciaSQL->bindParam(":nombre",$nombre);
        
        
        $fecha = new DateTime();
        $nombreArchivo=($imagen!="")?$fecha->getTimestamp()."_".$_FILES["imagen"]["name"]:"imagen.jpg";
        $tmpImagen=$_FILES["imagen"]["tmp_name"];
        if($tmpImagen!=""){
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
        }


        $sentenciaSQL->bindParam(":imagen",$nombreArchivo);
        $sentenciaSQL->bindParam(":descripcion",$descripcion);
        $sentenciaSQL->bindParam(":descripcion2",$descripcion2);
        $sentenciaSQL->bindParam(":mision",$mision);
        $sentenciaSQL->bindParam(":vision",$vision);
        $sentenciaSQL->execute();
        header("Location:nosotros.php");
        
    break;

    case "Modificar";

    $sentenciaSQL= $conexion->prepare("UPDATE nosotros SET nombre=:nombre, descripcion=:descripcion, descripcion2=:descripcion2, mision=:mision, vision=:vision WHERE id=:id");
    
    $sentenciaSQL->bindParam(':nombre',$nombre);
    $sentenciaSQL->bindParam(':descripcion',$descripcion);
    $sentenciaSQL->bindParam(':descripcion2',$descripcion2);
    $sentenciaSQL->bindParam(':mision',$mision);
    $sentenciaSQL->bindParam(':vision',$vision);
    
    $sentenciaSQL->bindParam(':id',$id);
    $sentenciaSQL->execute();

    

    if($imagen!=""){

        $fecha = new DateTime();
        $nombreArchivo=($imagen!="")?$fecha->getTimestamp()."_".$_FILES["imagen"]["name"]:"imagen.jpg";
        $tmpImagen=$_FILES["imagen"]["tmp_name"];

        move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
        
    
            $sentenciaSQL= $conexion->prepare("SELECT imagen FROM menu WHERE id=:id");
            $sentenciaSQL->bindParam(":id",$id);
            $sentenciaSQL->execute();
            $menu=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

                if(isset($menu['imagen']) && ($menu['imagen']!="imagen.jpg")){

                        if(file_exists("../../img/".$menu["imagen"])){
                            unlink("../../img/".$menu["imagen"]);
                        }

                }
        


        $sentenciaSQL= $conexion->prepare("UPDATE nosotros SET imagen=:imagen WHERE id=:id");
        $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
        $sentenciaSQL->bindParam(':id',$id);
        $sentenciaSQL->execute();
        header("Location:nosotros.php");
        
    }



      
    break;

    case "Cancelar";
        header("Location:nosotros.php");
       
    break;



    case "Seleccionar";

        $sentenciaSQL= $conexion->prepare("SELECT * FROM nosotros WHERE id=:id");
        $sentenciaSQL->bindParam(":id",$id);
        $sentenciaSQL->execute();
        $nosotros=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $nombre=$nosotros['nombre'];
        $imagen=$nosotros['imagen'];
        $descripcion=$nosotros['descripcion'];
        $descripcion2=$nosotros['descripcion2'];
        $mision=$nosotros['mision'];
        $vision=$nosotros['vision'];
        



       
    break;



    case "Borrar";
    
       
    $sentenciaSQL= $conexion->prepare("SELECT imagen FROM nosotros WHERE id=:id");
    $sentenciaSQL->bindParam(":id",$id);
    $sentenciaSQL->execute();
    $nosotros=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

    if(isset($nosotros['imagen']) && ($nosotros['imagen']!="imagen.jpg")){

            if(file_exists("../../img/".$nosotros["imagen"])){
                unlink("../../img/".$nosotros["imagen"]);
            }

    }

    $sentenciaSQL= $conexion->prepare("DELETE FROM nosotros WHERE id=:id");
    $sentenciaSQL->bindParam(":id",$id);
    $sentenciaSQL->execute();
    header("Location:nosotros.php");
       
    break;

}


        $sentenciaSQL= $conexion->prepare("SELECT * FROM nosotros");
        $sentenciaSQL->execute();
        $lista_nosotros=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);




?>

<div class="col-md-5">

<div class="card">
    <div class="card-header">
      Datos Nosotros
    </div>

    <div class="card-body">
    <form id="nuevo" name="nuevo" method="POST" action="" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="id" id="id" value="<?php echo $nosotros['id']; ?>" >
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" />
        </div>
                    
                           
        <div class="form-group">
        <label for="imagen">Imagen</label>

        <br/>
        
        <?php  if(($imagen)!=""){ ?>
            <img class="" src="../../img/<?php echo $imagen; ?>" width="50" alt="">
            
        <?php }?>

        <input type="file" class="form-control" id="imagen" name="imagen"  />
        </div>

        <div class="form-group">
        <label for="descripcion">Descripcion</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>" />
        </div>

        <div class="form-group">
        <label for="descripcion2">Descripcion2</label>
        <input type="text" class="form-control" id="descripcion2" name="descripcion2" value="<?php echo $descripcion2; ?>" />
        </div>

        <div class="form-group">
        <label for="descripcion2">Mision</label>
        <input type="text" class="form-control" id="mision" name="mision" value="<?php echo $mision; ?>" />
        </div>

        <div class="form-group">
        <label for="descripcion2">Vision</label>
        <input type="text" class="form-control" id="vision" name="vision" value="<?php echo $vision; ?>" />
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

<div class="col-sm-7" >
        <table class="table table-bordered" >
            <thead>
                <tr >
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Descripcion</th>
                    <th>Descripcion2</th>
                    <th>Mision</th>
                    <th>Vision</th>
                    <th>Accion</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach($lista_nosotros as $nosotros){?>
                <tr>
                    <td><?php echo $nosotros['nombre']; ?> </td>
                    <td>
                        <img src="../../img/<?php echo $nosotros['imagen']; ?>" width="50" alt="">
                        
                    
                    </td>   
                    <td><?php echo $nosotros['descripcion']; ?></td>
                    <td><?php echo $nosotros['descripcion2']; ?></td>    
                    <td><?php echo $nosotros['mision']; ?></td>   
                    <td><?php echo $nosotros['vision']; ?></td>                
                    
                    <td> 
                        <form method="post">
                            <input type="hidden" name="id" id="id" value="<?php echo $nosotros['id']; ?>" >

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