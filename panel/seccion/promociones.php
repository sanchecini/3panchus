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

<div class="container">
        <h1>Promociones</h1>
    <form id="nuevo" name="nuevo" method="POST" action="" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="id" id="id" value="<?php echo $promociones['id']; ?>" >
    

        <div class="row">
                    <div class="column">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required />
                    </div>
                    
                    <div class="column">
                        <label for="categoria">Dias</label>
                        <input type="text" class="form-control" id="dias" name="dias" value="<?php echo $dias; ?>" required />   
                    </div>

                    <div class="column">
                        <label for="imagen">Imagen</label>

                         <input type="file" id="imagen" name="imagen"  />
                    </div>
                    <div class="column">
                        <?php  if(($imagen)!=""){ ?>
                            <img class="" src="../../img/<?php echo $imagen; ?>" width="50" alt="">
                            
                        <?php }?>
                        </div>
         </div>
         <div class="row">
                    <div class="column">
                        <label for="descripcion">Descripcion</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>" required />
                    </div>
                    
        </div>

               
                   
               
                    
        
        <div class="" role="" >
        <button id="guardar" name="accion" <?php echo($accion=="Seleccionar")?"disabled":""; ?> value="Guardar" type="submit" class="buttones btn-succes">Guardar</button>
        <button id="modificar" name="accion" <?php echo($accion!="Seleccionar")?"disabled":""; ?> value="Modificar" type="submit" class=" buttones btn-modificar">Modificar</button>
        <button id="cancelar" name="accion" <?php echo($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" type="submit" class="buttones btn-rojo">Cancelar</button>
		
        </div>
				
        </form>
    </div>


 <br/>


<table class="table">
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
                <td data-label="Nombre"><?php echo $promociones['nombre']; ?> </td>
                <td data-label="Descripción"><?php echo $promociones['descripcion']; ?></td>
                <td data-label="Imagen">
                        <img src="../../img/<?php echo $promociones['imagen']; ?>" width="50" alt="">
                        
                    
                    </td>                    
                    <td data-label="Días"><?php echo $promociones['dias']; ?></td>
                   
                    <td data-label="Acciones"> 
                        <form method="post">
                            <input type="hidden" name="id" id="id" value="<?php echo $promociones['id']; ?>" >

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