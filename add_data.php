<?php
    $conexion = new mysqli("localhost", "root" ,"password" , "datos_fitness");
    session_start();
    $username = $_SESSION['username'];

    //Comprobar si hay error al conectar

    if($conexion->connect_errno){
        echo 'Error en la conexion SQL: ' . $conexion->connect_error;
    }

    $test = $conexion->query("SET NAMES 'utf8'");

    if(isset($_POST['add'])){
        insertarEntrenamiento($conexion, $username);
    }

    function get_user_id($conexion, $username){
      $query = $conexion->query('SELECT id FROM usuarios WHERE username="'.$username.'"');
      return $query->fetch_assoc()['id'];
    }


    function insertarEntrenamiento($conexion, $username){
        $id_actividad = $_POST['tipoActividad'];
        $duracion = $_POST['duracion'];
        $mins = explode(':', $duracion)[0];
        $segs = explode(':', $duracion)[1];
        $mins = $mins + ($segs / 60);
        $fecha = $_POST['date'];
        $distancia = $_POST['distancia'];
        $id_usuario = get_user_id($conexion, $username);
        $intensidad = 0;
        $insertQuery;

        if(isset($_POST['intensidad'])){
            $intensidad = $_POST['intensidad'];
        }

        $query = $conexion->query('SELECT intensidad FROM actividad WHERE id='.$id_actividad);
        $hasIntensidad = $query->fetch_assoc()['intensidad'];

        if($hasIntensidad){
          echo 'INSERT INTO entrenamiento(duracion, distancia, intensidad, id_actividad, id_usuario, fecha) VALUES ('.$mins.', '.$distancia.', '.$intensidad.', '. $id_actividad.', '. $id_usuario.', '.', "'.$fecha .'")';
            $insert = $conexion->query('INSERT INTO entrenamiento(duracion, distancia, intensidad, id_actividad, id_usuario, fecha) VALUES ('.$mins.', '.$distancia.', '.$intensidad.', '. $id_actividad.', '. $id_usuario.', "'.$fecha .'")');
        }else{
            $insert = $conexion->query('INSERT INTO entrenamiento(duracion, distancia, id_actividad, id_usuario, fecha) VALUES ('.$mins.', '.$distancia.', '. $id_actividad.', '. $id_usuario.', "'.$fecha .'")');
        }
        header("Location: index.php?sucess=true");
        exit();
    }
?>
