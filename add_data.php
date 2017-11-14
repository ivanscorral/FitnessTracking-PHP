<?php
    $conexion = new mysqli("localhost", "root" ,"" , "datos_fitness");
     
    //Comprobar si hay error al conectar

    if($conexion->connect_errno){
        echo 'Error en la conexion SQL: ' . $conexion->connect_error;
    }
	//commit test
    $test = $conexion->query("SET NAMES 'utf8'");

    if(isset($_POST['add'])){
        insertarEntrenamiento($conexion);
    }

    function registro($conexion){
        
    }

    function insertarEntrenamiento($conexion){
        $id_actividad = $_POST['tipoActividad'];
        $duracion = $_POST['duracion'];
        $distancia = $_POST['distancia'];
        $intensidad;
        $insertQuery;

        if(isset($_POST['intensidad'])){
            $intensidad = $_POST['intensidad'];
        }

        $query = $conexion->query('SELECT intensidad FROM actividad WHERE id='.$id_actividad);
        $hasIntensidad = $query->fetch_assoc()['intensidad'];
        if($hasIntensidad){
            $insert = $conexion->query('INSERT INTO entrenamiento(duracion, distancia, intensidad, id_actividad) VALUES ('.$duracion.', '.$distancia.', '.$intensidad.', '. $id_actividad.')'); 
        }else{
            $insert = $conexion->query('INSERT INTO entrenamiento(duracion, distancia, id_actividad) VALUES ('.$duracion.', '.$distancia.', '.$id_actividad.')'); 
        }
        header("Location: index.php?sucess=true ",true,303);  
        exit();  
    }
?>