<?php

session_start();
if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
}


include("../template/encabezado.php");


$id=(isset($_POST['id']))?$_POST['id']:"";
$pregunta=(isset($_POST['pregunta']))?$_POST['pregunta']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";




include("../config/conexion.php");





switch($accion){
    case "Guardar";

        $sentenciaSQL= $conexion->prepare("INSERT INTO encuesta (pregunta) VALUES (:pregunta)");
        $sentenciaSQL->bindParam(":pregunta",$pregunta);
        
       
        $sentenciaSQL->execute();
        header("Location:encuesta.php");
        
    break;

    case "Modificar";

    $sentenciaSQL= $conexion->prepare("UPDATE encuesta SET pregunta=:pregunta WHERE id=:id");
    
    $sentenciaSQL->bindParam(':pregunta',$pregunta);
    
    $sentenciaSQL->bindParam(':id',$id);
    $sentenciaSQL->execute();

        
     
        $sentenciaSQL->execute();
        header("Location:encuesta.php");
        
    



      
    break;

    case "Cancelar";
        header("Location:encuesta.php");
       
    break;

    case "Resultados";
    
       
    header("Location: encuesta_resultados.php");
    
       
    break;



    case "Seleccionar";

        $sentenciaSQL= $conexion->prepare("SELECT * FROM encuesta WHERE id=:id");
        $sentenciaSQL->bindParam(":id",$id);
        $sentenciaSQL->execute();
        $encuesta=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $pregunta=$encuesta['pregunta'];
       



       
    break;



    case "Borrar";
    
       
    
    $sentenciaSQL= $conexion->prepare("DELETE FROM encuesta WHERE id=:id");
    $sentenciaSQL->bindParam(":id",$id);
    $sentenciaSQL->execute();
    header("Location:encuesta.php");
       
    break;

    

}


        $sentenciaSQL= $conexion->prepare("SELECT * FROM encuesta");
        $sentenciaSQL->execute();
        $lista_encuesta=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);




?>

<div class="col-md-5">

<div class="card">
    <div class="card-header">
       Datos de Encuesta
    </div>

    <div class="card-body">
    <form id="nuevo" name="nuevo" method="POST" action="" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="id" id="id" value="<?php echo $encuesta['id']; ?>" >
    <div class="form-group">

        <label for="nombre">Pregunta</label>
        <input type="text" class="form-control" id="pregunta" name="pregunta" value="<?php echo $pregunta; ?>" />
        </div>
                    
        
        <div class="btn-group" role="group" aria-label="">
        <button id="guardar" name="accion" <?php echo($accion=="Seleccionar")?"disabled":""; ?> value="Guardar" type="submit" class="btn btn-success">Guardar</button>
        <button id="modificar" name="accion" <?php echo($accion!="Seleccionar")?"disabled":""; ?> value="Modificar" type="submit" class="btn btn-warning">Modificar</button>
        <button id="cancelar" name="accion" <?php echo($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" type="submit" class="btn btn-danger">Cancelar</button>
        <button id="resultados" name="accion"  value="Resultados" type="submit" class="btn btn-success">Resultados</button>
		
        </div>
				
				
		
				
	</form>
    </div>

    
    </div>

        
        
        
</div>

<div class="col-md-7" >
        <table class="table table-bordered" >
            <thead>
                <tr >
                    <th>Pregunta</th>
                    <th>Accion</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach($lista_encuesta as $encuesta){?>
                <tr>
                    <td> <?php echo $encuesta['pregunta'];?> </td>
                   
                    <td> 
                        <form method="post">
                            <input type="hidden" name="id" id="id" value="<?php echo $encuesta['id']; ?>" >

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