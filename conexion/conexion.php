<?php
 function conectaDb() {
    try 
       {
        $conn = new PDO('mysql:host=localhost;dbname=sennova2;charset=utf8', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
       }

    catch(PDOException $e){
        echo "Error: en la conexion ".$e->getMessage();
    }
 }