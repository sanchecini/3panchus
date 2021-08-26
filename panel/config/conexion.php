<?php

$host="localhost";
$bd="3panchos";
$usuario="root";
$contrasena="";

    try{
      
        $conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$contrasena);
        if($conexion){
           
        }
    
    }catch(Exception $ex){
        
        echo $ex->getMessage();



        
    }



$mysqli = new mysqli("localhost", "root", "", "3panchos");





    ?>