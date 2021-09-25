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

$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../config/conexion.php");





switch($accion){
    case "Guardar";

        $sentenciaSQL= $conexion->prepare("INSERT INTO eventos (nombre, descripcion, imagen) VALUES (:nombre,:descripcion,:imagen)");
        $sentenciaSQL->bindParam(":nombre",$nombre);
        $sentenciaSQL->bindParam(":descripcion",$descripcion);
        
        $fecha = new DateTime();
        $nombreArchivo=($imagen!="")?$fecha->getTimestamp()."_".$_FILES["imagen"]["name"]:"imagen.jpg";
        $tmpImagen=$_FILES["imagen"]["tmp_name"];
        if($tmpImagen!=""){
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
        }


        $sentenciaSQL->bindParam(":imagen",$nombreArchivo);
       
        $sentenciaSQL->execute();
        header("Location:eventos.php");
        
    break;

    case "Modificar";

    $sentenciaSQL= $conexion->prepare("UPDATE eventos SET nombre=:nombre, descripcion=:descripcion WHERE id=:id");
    
    $sentenciaSQL->bindParam(':nombre',$nombre);
    $sentenciaSQL->bindParam(':descripcion',$descripcion);
    
    $sentenciaSQL->bindParam(':id',$id);
    $sentenciaSQL->execute();

    

    if($imagen!=""){

        $fecha = new DateTime();
        $nombreArchivo=($imagen!="")?$fecha->getTimestamp()."_".$_FILES["imagen"]["name"]:"imagen.jpg";
        $tmpImagen=$_FILES["imagen"]["tmp_name"];

        move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
        
    
            $sentenciaSQL= $conexion->prepare("SELECT imagen FROM eventos WHERE id=:id");
            $sentenciaSQL->bindParam(":id",$id);
            $sentenciaSQL->execute();
            $menu=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

                if(isset($menu['imagen']) && ($menu['imagen']!="imagen.jpg")){

                        if(file_exists("../../img/".$menu["imagen"])){
                            unlink("../../img/".$menu["imagen"]);
                        }

                }
        


        $sentenciaSQL= $conexion->prepare("UPDATE eventos SET imagen=:imagen WHERE id=:id");
        $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
        $sentenciaSQL->bindParam(':id',$id);
        $sentenciaSQL->execute();
        header("Location:eventos.php");
        
    }



      
    break;

    case "Cancelar";
        header("Location:eventos.php");
       
    break;



    case "Seleccionar";

        $sentenciaSQL= $conexion->prepare("SELECT * FROM eventos WHERE id=:id");
        $sentenciaSQL->bindParam(":id",$id);
        $sentenciaSQL->execute();
        $eventos=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $nombre=$eventos['nombre'];
        $descripcion=$eventos['descripcion'];
        $imagen=$eventos['imagen'];
      



       
    break;



    case "Borrar";
    
       
    $sentenciaSQL= $conexion->prepare("SELECT imagen FROM eventos WHERE id=:id");
    $sentenciaSQL->bindParam(":id",$id);
    $sentenciaSQL->execute();
    $menu=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

    if(isset($eventos['imagen']) && ($eventos['imagen']!="imagen.jpg")){

            if(file_exists("../../img/".$eventos["imagen"])){
                unlink("../../img/".$eventos["imagen"]);
            }

    }

    $sentenciaSQL= $conexion->prepare("DELETE FROM eventos WHERE id=:id");
    $sentenciaSQL->bindParam(":id",$id);
    $sentenciaSQL->execute();
    header("Location:eventos.php");
       
    break;

}


        $sentenciaSQL= $conexion->prepare("SELECT * FROM eventos");
        $sentenciaSQL->execute();
        $lista_eventos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);




?>

<div class="container">
        <h1>Ingresar datos</h1>
       
        <form id="nuevo" name="nuevo" method="POST" action="" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="id" id="id" value="<?php echo $eventos['id']; ?>" >
            <div class="row">
                    <div class="column">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="name" placeholder="Your name here">
                    </div>

               
                    <div class="column">
                <label for="imagen">Imagen</label>

                <br/>
                
                <?php  if(($imagen)!=""){ ?>
                    <img class="" src="../../img/<?php echo $imagen; ?>" width="50" alt="">
                    
                <?php }?>

                <input type="file" class="form-control" id="imagen" name="imagen"  />
             </div>
               </div>
           
            <div class="row">
                        
             <div class="column">
                        <label for="descripcion">Descripción</label>
                        <textarea id="issue" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>" rows="3"></textarea>
                    </div>
             </div>
           
         <div class="btn-group" role="group" aria-label="">
        <button id="guardar" name="accion" <?php echo($accion=="Seleccionar")?"disabled":""; ?> value="Guardar" type="submit" class="btn btn-success">Guardar</button>
        <button id="modificar" name="accion" <?php echo($accion!="Seleccionar")?"disabled":""; ?> value="Modificar" type="submit" class="btn btn-warning">Modificar</button>
        <button id="cancelar" name="accion" <?php echo($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" type="submit" class="btn btn-danger">Cancelar</button>
		
        </div>

        </form>
    </div>






    <table class="table">
     <thead>
     	<tr>
     	 <th>Nombre</th>
         <th>Descripcion</th>
         <th>Imagen</th>
         <th>Accion</th>

     	</tr>
     </thead>
     <tbody>
     <?php foreach($lista_eventos as $eventos){?>
     	 
           <td data-label="S.No"><?php echo $eventos['nombre']; ?> </td>
                    <td><?php echo $eventos['descripcion']; ?></td>
                    <td>
                        <img src="../../img/<?php echo $eventos['imagen']; ?>" width="50" alt="">
                        
                    
                    </td>                    
                   
                    <td> 
                        <form method="post">
                            <input type="hidden" name="id" id="id" value="<?php echo $eventos['id']; ?>" >

                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary" >
                            
                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger" >


                        </form>
                
                    </td>
                </tr>

           <?php } ?>
     </tbody>
   </table>




<?php
include("../template/pie.php");



?>