<?php

    function getConnection(){
    	$server="localhost";
    	$user="root";
    	$password='R7u$kP0n@Wc3';
    	$db = "clinica_citas_db";
    	//crear variable de conecxion a la DB
    	$connection = new mysqli($server,$user,$password,$db);

    	//evaluar la conexion de la base de datos
    	if($connection -> connect_errno){
            die("Conexión fallida: ".$connection -> connect_errno);
		}
		return $connection;
     }
