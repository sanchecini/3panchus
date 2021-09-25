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
$categoria=(isset($_POST['categoria']))?$_POST['categoria']:"";
$precio=(isset($_POST['precio']))?$_POST['precio']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../config/conexion.php");





switch($accion){
    case "Guardar";

        $sentenciaSQL= $conexion->prepare("INSERT INTO menu (nombre, descripcion, imagen, categoria, precio) VALUES (:nombre,:descripcion,:imagen,:categoria,:precio)");
        $sentenciaSQL->bindParam(":nombre",$nombre);
        $sentenciaSQL->bindParam(":descripcion",$descripcion);
        
        $fecha = new DateTime();
        $nombreArchivo=($imagen!="")?$fecha->getTimestamp()."_".$_FILES["imagen"]["name"]:"imagen.jpg";
        $tmpImagen=$_FILES["imagen"]["tmp_name"];
        if($tmpImagen!=""){
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
        }


        $sentenciaSQL->bindParam(":imagen",$nombreArchivo);
        $sentenciaSQL->bindParam(":categoria",$categoria);
        $sentenciaSQL->bindParam(":precio",$precio);
        $sentenciaSQL->execute();
        header("Location:menu.php");
        
    break;

    case "Modificar";

    $sentenciaSQL= $conexion->prepare("UPDATE menu SET nombre=:nombre, descripcion=:descripcion, categoria=:categoria, precio=:precio WHERE id=:id");
    
    $sentenciaSQL->bindParam(':nombre',$nombre);
    $sentenciaSQL->bindParam(':descripcion',$descripcion);
    $sentenciaSQL->bindParam(':categoria',$categoria);
    $sentenciaSQL->bindParam(':precio',$precio);
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
        


        $sentenciaSQL= $conexion->prepare("UPDATE menu SET imagen=:imagen WHERE id=:id");
        $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
        $sentenciaSQL->bindParam(':id',$id);
        $sentenciaSQL->execute();
        header("Location:menu.php");
        
    }



      
    break;

    case "Cancelar";
        header("Location:menu.php");
       
    break;



    case "Seleccionar";

        $sentenciaSQL= $conexion->prepare("SELECT * FROM menu WHERE id=:id");
        $sentenciaSQL->bindParam(":id",$id);
        $sentenciaSQL->execute();
        $menu=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $nombre=$menu['nombre'];
        $descripcion=$menu['descripcion'];
        $imagen=$menu['imagen'];
        $categoria=$menu['categoria'];
        $precio=$menu['precio'];



       
    break;



    case "Borrar";
    
       
    $sentenciaSQL= $conexion->prepare("SELECT imagen FROM menu WHERE id=:id");
    $sentenciaSQL->bindParam(":id",$id);
    $sentenciaSQL->execute();
    $menu=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

    if(isset($menu['imagen']) && ($menu['imagen']!="imagen.jpg")){

            if(file_exists("../../img/".$menu["imagen"])){
                unlink("../../img/".$menu["imagen"]);
            }

    }

    $sentenciaSQL= $conexion->prepare("DELETE FROM menu WHERE id=:id");
    $sentenciaSQL->bindParam(":id",$id);
    $sentenciaSQL->execute();
    header("Location:menu.php");
       
    break;

}


        $sentenciaSQL= $conexion->prepare("SELECT * FROM menu");
        $sentenciaSQL->execute();
        $lista_menu=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);




?>

<
<div class="container">
        <h1>Menú</h1>
    <form id="nuevo" name="nuevo" method="POST" action="" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="id" id="id" value="<?php echo $menu['id']; ?>" >
    
    <div class="row">
                    <div class="column">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required />
                    </div>

                    <div class="column">
                            <label for="imagen">Imagen</label>

                            <br/>

                            <?php  if(($imagen)!=""){ ?>
                                <img class="" src="../../img/<?php echo $imagen; ?>" width="50" alt="">
                                
                            <?php }?>

                            <input type="file" class="form-control" id="imagen" name="imagen" required />
                    </div>
         </div>

         <div class="row">
                    <div class="column">
                        <label for="nombre">Descripción</label>
                        <input type="text" class="form-" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>" required />
                    </div>
             </div>
                    
             <div class="row">
                    <div class="column">
                    <label for="categoria">Categoria</label>
                     <input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo $categoria; ?>" required />
                    </div>
                    <div class="column">
                      <label for="precio">Precio</label>
                     <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $precio; ?>" required />
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
                    <th>Categoria</th>
                    <th>Precio</th>
                    <th>Accion</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach($lista_menu as $menu){?>
                <tr>
                    <td data-label="Nombre"><?php echo $menu['nombre']; ?> </td>
                    <td data-label="Descripción"><?php echo $menu['descripcion']; ?></td>
                    <td data-label="Imagen">
                        <img src="../../img/<?php echo $menu['imagen']; ?>" width="50" alt="">
                        
                    
                    </td>                    
                    <td data-label="Categoría"><?php echo $menu['categoria']; ?></td>
                    <td data-label="Precio"><?php echo $menu['precio']; ?></td>
                    <td data-label="Acciones"> 
                        <form method="post">
                            <input type="hidden" name="id" id="id" value="<?php echo $menu['id']; ?>" >

                           
                            <input type="submit" name="accion" value="Seleccionar" class="buttones btn-seleccionar" >
                            
                            <input type="submit" name="accion" value="Borrar" class="buttones btn-rojo" >


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