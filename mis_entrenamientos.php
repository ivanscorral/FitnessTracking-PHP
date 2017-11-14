<html>
  <head>
    <title>Mis entrenamientos</title>
    <link rel="stylesheet" type="text/css" href="links.css">
  </head>
  <body>
    <?php
      $username;
      session_start();

      //comprobar sesión

      if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        crearTablas($username);
      }else{
        echo '<script>document.write("<p> No has iniciado sesión, inicia sesión <a href=login.php>aquí</a></p>")</script>';
      }

      function crearTablas($username){
        //conexion sql
        $conexion = new mysqli("localhost", "root" ,"" , "datos_fitness");
        if($conexion->connect_errno){
            echo 'Error en la conexion SQL: ' . $conexion->connect_error;
        }

        $actividades = get_actividades($conexion);

        $user_id = get_user_id($conexion, $username);
        $entrenamientos = get_entrenamientos($conexion, $user_id);

        //tabla

        echo '<table border=1 id=tabla_actividades>
                <tr>
                  <th>Actividad</th>
                  <th>Duracion (min)</th>
                  <th>Distancia (m)</th>
                  <th>Intensidad</th>
                  <th>Fecha</th>
                </tr>';

        foreach ($entrenamientos as $entrenamiento) {
          echo '<tr>';
          foreach ($entrenamiento as $indice =>$valor) {
            if(strcmp($indice, 'id_actividad') != 0){
              if($valor != null){
                echo '<td>'.$valor.'</td>';
              }else{
                echo '<td bgcolor="grey"></td>';
              }
            }else{
              echo '<td>'.$actividades[$valor].'</td>';
            }
          }
          echo '</tr>';

        }
        echo '</table>';
      }

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
     <a href="index.php">Volver</a>
     <a href="logout.php">Cerrar sesión</a>
</body>
</html>
