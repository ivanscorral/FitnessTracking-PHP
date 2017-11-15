<?php
    function get_user_id($conexion, $username){
      $query = $conexion->query('SELECT id FROM usuarios WHERE username="'.$username.'"');
      return $query->fetch_assoc()['id'];
    }

    function get_actividades($conexion){
      $actividades = array();
      $test = $conexion->query("SET NAMES 'utf8'");
      $actividadesQuery = $conexion->query('SELECT * FROM actividad');

      //cargar actividades

      while($respuesta = $actividadesQuery->fetch_assoc()){
        $actividades[$respuesta['id']] = $respuesta['nombre'];
      }

      return $actividades;
    }

    function get_entrenamientos($conexion, $user_id){
      $entrenamientos = array();
      $query = $conexion->query('SELECT id_actividad, duracion, distancia, intensidad, fecha FROM entrenamiento WHERE id_usuario='.$user_id.' ORDER BY fecha asc');

      while($respuesta = $query->fetch_assoc()){
        $respuesta['intensidad'] += 0;
        if($respuesta['intensidad'] == 0){
          $respuesta['intensidad'] = null;
        }
        array_push($entrenamientos, $respuesta);
      }
      return $entrenamientos;
    }

?>
