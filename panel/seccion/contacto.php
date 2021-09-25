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
$domicilio=(isset($_POST['domicilio']))?$_POST['domicilio']:"";
$municipio=(isset($_POST['municipio']))?$_POST['municipio']:"";
$telefono=(isset($_POST['telefono']))?$_POST['telefono']:"";


$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../config/conexion.php");





switch($accion){
    case "Guardar";

        $sentenciaSQL= $conexion->prepare("INSERT INTO contacto (nombre, imagen, descripcion, domicilio, municipio, telefono) VALUES (:nombre,:imagen,:descripcion,:domicilio,:municipio,:telefono)");
        $sentenciaSQL->bindParam(":nombre",$nombre);
        $sentenciaSQL->bindParam(":descripcion",$descripcion);
        
        $fecha = new DateTime();
        $nombreArchivo=($imagen!="")?$fecha->getTimestamp()."_".$_FILES["imagen"]["name"]:"imagen.jpg";
        $tmpImagen=$_FILES["imagen"]["tmp_name"];
        if($tmpImagen!=""){
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
        }


        $sentenciaSQL->bindParam(":imagen",$nombreArchivo);


        $sentenciaSQL->bindParam(":domicilio",$domicilio);
        $sentenciaSQL->bindParam(":municipio",$municipio);
        $sentenciaSQL->bindParam(":telefono",$telefono);
        $sentenciaSQL->execute();
        header("Location:contacto.php");
        
    break;

    case "Modificar";

    $sentenciaSQL= $conexion->prepare("UPDATE contacto SET nombre=:nombre, descripcion=:descripcion, domicilio=:domicilio, municipio=:municipio, telefono=:telefono WHERE id=:id");
    
    $sentenciaSQL->bindParam(':nombre',$nombre);
    $sentenciaSQL->bindParam(':descripcion',$descripcion);
    $sentenciaSQL->bindParam(":domicilio",$domicilio);
        $sentenciaSQL->bindParam(":municipio",$municipio);
        $sentenciaSQL->bindParam(":telefono",$telefono);
    $sentenciaSQL->bindParam(':id',$id);
    $sentenciaSQL->execute();
    if($imagen!=""){

        $fecha = new DateTime();
        $nombreArchivo=($imagen!="")?$fecha->getTimestamp()."_".$_FILES["imagen"]["name"]:"imagen.jpg";
        $tmpImagen=$_FILES["imagen"]["tmp_name"];

        move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
        
    
            $sentenciaSQL= $conexion->prepare("SELECT imagen FROM contacto WHERE id=:id");
            $sentenciaSQL->bindParam(":id",$id);
            $sentenciaSQL->execute();
            $contacto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

                if(isset($contacto['imagen']) && ($contacto['imagen']!="imagen.jpg")){

                        if(file_exists("../../img/".$contacto["imagen"])){
                            unlink("../../img/".$contacto["imagen"]);
                        }

                }
        


        $sentenciaSQL= $conexion->prepare("UPDATE contacto SET imagen=:imagen WHERE id=:id");
        $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
        $sentenciaSQL->bindParam(':id',$id);
        $sentenciaSQL->execute();
        header("Location:contacto.php");
        
    }
    
        


        


      
    break;

    

    case "Cancelar";
        header("Location:contacto.php");
       
    break;



    case "Seleccionar";

        $sentenciaSQL= $conexion->prepare("SELECT * FROM contacto WHERE id=:id");
        $sentenciaSQL->bindParam(":id",$id);
        $sentenciaSQL->execute();
        $contacto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $nombre=$contacto['nombre'];
        $imagen=$contacto['imagen'];
        $descripcion=$contacto['descripcion'];
        $domicilio=$contacto['domicilio'];
        $municipio=$contacto['municipio'];
        $telefono=$contacto['telefono'];



       
    break;



    case "Borrar";

    $sentenciaSQL= $conexion->prepare("SELECT imagen FROM contacto WHERE id=:id");
    $sentenciaSQL->bindParam(":id",$id);
    $sentenciaSQL->execute();
    $contacto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

    if(isset($contacto['imagen']) && ($contacto['imagen']!="imagen.jpg")){

            if(file_exists("../../img/".$contacto["imagen"])){
                unlink("../../img/".$contacto["imagen"]);
            }

    }

    $sentenciaSQL= $conexion->prepare("DELETE FROM contacto WHERE id=:id");
    $sentenciaSQL->bindParam(":id",$id);
    $sentenciaSQL->execute();
    header("Location:contacto.php");
       
    break;

}


        $sentenciaSQL= $conexion->prepare("SELECT * FROM contacto");
        $sentenciaSQL->execute();
        $lista_contacto=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);




?>

<div class="container">
        <h1>Contacto</h1>
    <form id="nuevo" name="nuevo" method="POST" action="" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="id" id="id" value="<?php echo $contacto['id']; ?>" >
    
    <div class="row">
                    <div class="column">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" readonly />
                    </div>

                    <div class="column">
                        <label for="imagen">Imagen</label>

                      
                        
                        <input type="file" class="form-control" id="imagen" name="imagen"  />
                        
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
                        <label for="categoria">Domicilio</label>
                        <input type="text" class="form-control" id="domicilio" name="domicilio" value="<?php echo $domicilio; ?>" required />
                    </div>
                    
                    <div class="column">
                        <label for="precio">Municipio</label>
                        <input type="text" class="form-control" id="municipio" name="municipio" value="<?php echo $municipio; ?>" required />
                    </div>
                            
                    <div class="column">
                        <label for="precio">Telefono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono; ?>" required />
                    </div>        
         </div>

			
        <div class="" role="" >
        
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
                    <th>Domicilio</th>
                    <th>Municipio</th>
                    <th>Telefono</th>
                    <th>Accion</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach($lista_contacto as $contacto){?>
                <tr>
                    <td><?php echo $contacto['nombre']; ?> </td>
                    <td>
                        <img src="../../img/<?php echo $contacto['imagen']; ?>" width="50" alt="">
                        
                    
                    </td>            
                    <td><?php echo $contacto['descripcion']; ?></td>
                    <td>
                    <?php echo $contacto['domicilio']; ?></
                        
                    
                    </td>                    
                    <td><?php echo $contacto['municipio']; ?></td>
                    <td><?php echo $contacto['telefono']; ?></td>
                    <td> 
                        <form method="post">
                            <input type="hidden" name="id" id="id" value="<?php echo $contacto['id']; ?>" >

                            
                            <input type="submit" name="accion" value="Seleccionar" class="buttones btn-seleccionar" >
                            
                           
                            
                           


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