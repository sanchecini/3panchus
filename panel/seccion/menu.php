<?php
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

<div class="col-md-5">

<div class="card">
    <div class="card-header">
       Datos de Menu
    </div>

    <div class="card-body">
    <form id="nuevo" name="nuevo" method="POST" action="" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="id" id="id" value="<?php echo $menu['id']; ?>" >
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
        <label for="categoria">Categoria</label>
        <input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo $categoria; ?>" />
        </div>
                    
        <div class="form-group">
        <label for="precio">Precio</label>
        <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $precio; ?>" />
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
                    <th>Categoria</th>
                    <th>Precio</th>
                    <th>Accion</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach($lista_menu as $menu){?>
                <tr>
                    <td><?php echo $menu['nombre']; ?> </td>
                    <td><?php echo $menu['descripcion']; ?></td>
                    <td>
                        <img src="../../img/<?php echo $menu['imagen']; ?>" width="50" alt="">
                        
                    
                    </td>                    
                    <td><?php echo $menu['categoria']; ?></td>
                    <td><?php echo $menu['precio']; ?></td>
                    <td> 
                        <form method="post">
                            <input type="hidden" name="id" id="id" value="<?php echo $menu['id']; ?>" >

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