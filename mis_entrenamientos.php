<html>
  <head>
    <title>Mis entrenamientos</title>
    <link rel="stylesheet" type="text/css" href="links.css">
  </head>
  <body>
    <?php
      include 'data_transactions.php';
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
        $conexion = new mysqli("localhost", "root" ,"password" , "datos_fitness");
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

     ?>
     <a href="index.php">Volver</a>
     <a href="logout.php">Cerrar sesión</a>
</body>
</html>
