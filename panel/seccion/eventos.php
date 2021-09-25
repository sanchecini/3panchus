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
        <h1>Eventos</h1>
       
        <form id="nuevo" name="nuevo" method="POST" action="" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="id" id="id" value="<?php echo $eventos['id']; ?>" >
            <div class="row">
                    <div class="column">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required >
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
                        <label for="descripcion">Descripción</label>
                         <input type="text" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>" required>
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
     	<tr>
     	 <th>Nombre</th>
         <th>Descripcion</th>
         <th>Imagen</th>
         <th>Accion</th>

     	</tr>
     </thead>
     <tbody>
     <?php foreach($lista_eventos as $eventos){?>
     	 
           <td data-label="Nombre"><?php echo $eventos['nombre']; ?> </td>
                    <td data-label="Descripción"><?php echo $eventos['descripcion']; ?></td>
                    <td data-label="Imagen">
                        <img src="../../img/<?php echo $eventos['imagen']; ?>" width="50" alt="">
                        
                    
                    </td>                    
                   
                    <td data-label="Acciones"> 
                        <form method="post">
                            <input type="hidden" name="id" id="id" value="<?php echo $eventos['id']; ?>" >

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