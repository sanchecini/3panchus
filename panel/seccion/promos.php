<?php

session_start();
if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
}


include("../template/encabezado.php");


$id=(isset($_POST['id']))?$_POST['id']:"";
$nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
$descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
$imagen=(isset($_FILES['imagen']['name']))?$_FILES['imagen']['name']:"";
$dias=(isset($_POST['dias']))?$_POST['dias']:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../config/conexion.php");





switch($accion){
    case "Guardar";

        $sentenciaSQL= $conexion->prepare("INSERT INTO promociones (nombre, descripcion, imagen, dias) VALUES (:nombre,:descripcion,:imagen,:dias)");
        $sentenciaSQL->bindParam(":nombre",$nombre);
        $sentenciaSQL->bindParam(":descripcion",$descripcion);
        
        $fecha = new DateTime();
        $nombreArchivo=($imagen!="")?$fecha->getTimestamp()."_".$_FILES["imagen"]["name"]:"imagen.jpg";
        $tmpImagen=$_FILES["imagen"]["tmp_name"];
        if($tmpImagen!=""){
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
        }


        $sentenciaSQL->bindParam(":imagen",$nombreArchivo);
        $sentenciaSQL->bindParam(":dias",$dias);
        
        $sentenciaSQL->execute();
        header("Location:promociones.php");
        
    break;

    case "Modificar";

    $sentenciaSQL= $conexion->prepare("UPDATE promociones SET nombre=:nombre, descripcion=:descripcion, dias=:dias WHERE id=:id");
    
    $sentenciaSQL->bindParam(':nombre',$nombre);
    $sentenciaSQL->bindParam(':descripcion',$descripcion);
    $sentenciaSQL->bindParam(':dias',$dias);
    
    $sentenciaSQL->bindParam(':id',$id);
    $sentenciaSQL->execute();

    

    if($imagen!=""){

        $fecha = new DateTime();
        $nombreArchivo=($imagen!="")?$fecha->getTimestamp()."_".$_FILES["imagen"]["name"]:"imagen.jpg";
        $tmpImagen=$_FILES["imagen"]["tmp_name"];

        move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
        
    
            $sentenciaSQL= $conexion->prepare("SELECT imagen FROM promociones WHERE id=:id");
            $sentenciaSQL->bindParam(":id",$id);
            $sentenciaSQL->execute();
            $promociones=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

                if(isset($promociones['imagen']) && ($promociones['imagen']!="imagen.jpg")){

                        if(file_exists("../../img/".$promociones["imagen"])){
                            unlink("../../img/".$promociones["imagen"]);
                        }

                }
        


        $sentenciaSQL= $conexion->prepare("UPDATE promociones SET imagen=:imagen WHERE id=:id");
        $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
        $sentenciaSQL->bindParam(':id',$id);
        $sentenciaSQL->execute();
        header("Location:promociones.php");
        
    }



      
    break;

    case "Cancelar";
        header("Location:promociones.php");
       
    break;



  
    case "Seleccionar";

        $sentenciaSQL= $conexion->prepare("SELECT * FROM promociones WHERE id=:id");
        $sentenciaSQL->bindParam(":id",$id);
        $sentenciaSQL->execute();
        $promociones=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $nombre=$promociones['nombre'];
        $descripcion=$promociones['descripcion'];
        $imagen=$promociones['imagen'];
        
        $dias=$promociones['dias'];
        



       
    break;



    case "Borrar";
    
       
    $sentenciaSQL= $conexion->prepare("SELECT imagen FROM promociones WHERE id=:id");
    $sentenciaSQL->bindParam(":id",$id);
    $sentenciaSQL->execute();
    $promociones=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

    if(isset($promociones['imagen']) && ($promociones['imagen']!="imagen.jpg")){

            if(file_exists("../../img/".$promociones["imagen"])){
                unlink("../../img/".$promociones["imagen"]);
            }

    }

    $sentenciaSQL= $conexion->prepare("DELETE FROM promociones WHERE id=:id");
    $sentenciaSQL->bindParam(":id",$id);
    $sentenciaSQL->execute();
    header("Location:promociones.php");
       
    break;

}


        $sentenciaSQL= $conexion->prepare("SELECT * FROM promociones");
        $sentenciaSQL->execute();
        $lista_promociones=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);




?>

<div class="col-md-5">

<div class="card">
    <div class="card-header">
       Datos de promociones
    </div>

    <div class="card-body">
    <form id="nuevo" name="nuevo" method="POST" action="" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="id" id="id" value="<?php echo $promociones['id']; ?>" >
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" />
        </div>
                    
        <div class="form-group">
        <label for="descripcion">Descripcion</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>" />
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
        <label for="categoria">Dias</label>
        <input type="text" class="form-control" id="dias" name="dias" value="<?php echo $dias; ?>" />
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
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Imagen</th>
                    <th>Dias</th>
                    <th>Accion</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach($lista_promociones as $promociones){?>
                <tr>
                    <td><?php echo $promociones['nombre']; ?> </td>
                    <td><?php echo $promociones['descripcion']; ?></td>
                    <td>
                        <img src="../../img/<?php echo $promociones['imagen']; ?>" width="50" alt="">
                        
                    
                    </td>                    
                    <td><?php echo $promociones['dias']; ?></td>
                   
                    <td> 
                        <form method="post">
                            <input type="hidden" name="id" id="id" value="<?php echo $promociones['id']; ?>" >

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