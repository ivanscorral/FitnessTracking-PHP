<?php
    $conexion = new mysqli("localhost", "root" ,"" , "datos_fitness");

    //Comprobar si hay error al conectar

    if($conexion->connect_errno){
        echo 'Error en la conexion SQL: ' . $conexion->connect_error;
    }

    $test = $conexion->query("SET NAMES 'utf8'");

    if(isset($_POST['add'])){
        insertarEntrenamiento($conexion);
    }

    function registro($conexion){

    }

    function insertarEntrenamiento($conexion){
        $id_actividad = $_POST['tipoActividad'];
        $duracion = $_POST['duracion'];
        $fecha = $_POST['date'];
        $distancia = $_POST['distancia'];
        $intensidad;
        $insertQuery;

        if(isset($_POST['intensidad'])){
            $intensidad = $_POST['intensidad'];
        }

        $query = $conexion->query('SELECT intensidad FROM actividad WHERE id='.$id_actividad);
        $hasIntensidad = $query->fetch_assoc()['intensidad'];

        //TODO AÑADIR ID DE USUARIO AL INSERT
        
        if($hasIntensidad){
            $insert = $conexion->query('INSERT INTO entrenamiento(duracion, distancia, intensidad, id_actividad, fecha) VALUES ('.$duracion.', '.$distancia.', '.$intensidad.', '. $id_actividad.', '.', "'.$fecha .'")');
        }else{
            $insert = $conexion->query('INSERT INTO entrenamiento(duracion, distancia, id_actividad, fecha) VALUES ('.$duracion.', '.$distancia.', '.$id_actividad.', "'.$fecha .'")');
        }
        header("Location: index.php?sucess=true ",true,303);
        exit();
    }
?>
