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

<div class="container">
        <h1>Nosotros</h1>
    <form id="nuevo" name="nuevo" method="POST" action="" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="id" id="id" value="<?php echo $nosotros['id']; ?>" >
            <div class="row">
                            <div class="column">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required />
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

        <div class="row">
                    <div class="column">
                        <label for="descripcion2">Descripcion2</label>
                        <input type="text" class="form-control" id="descripcion2" name="descripcion2" value="<?php echo $descripcion2; ?>" required />
                    </div>
                    
        </div>

        <div class="row">
                    <div class="column">
                            <label for="mision">Mision</label>
                             <input type="text" class="form-control" id="mision" name="mision" value="<?php echo $mision; ?>" required/>
                    </div>
                    <div class="column">
                        <label   label for="mision">Vision</label>
                        <input type="text" class="form-control" id="vision" name="vision" value="<?php echo $vision; ?>" required/>
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
                    <td data-label="Nombre"><?php echo $nosotros['nombre']; ?> </td>
                    <td data-label="Imagen">
                        <img src="../../img/<?php echo $nosotros['imagen']; ?>" width="50" alt="">
                        
                    
                    </td>   
                    <td data-label="Descripcion"><?php echo $nosotros['descripcion']; ?></td>
                    <td data-label="Descripcion2"><?php echo $nosotros['descripcion2']; ?></td>    
                    <td data-label="Misión"><?php echo $nosotros['mision']; ?></td>   
                    <td data-label="Visión"><?php echo $nosotros['vision']; ?></td>                
                    
                    <td> 
                        <form method="post">
                            <input type="hidden" name="id" id="id" value="<?php echo $nosotros['id']; ?>" >

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