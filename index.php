<head>
    <title>Fitness Iván</title>
    <link rel="stylesheet" type="text/css" href="links.css">
</head>

  <body>
    <?php
        session_start();
        $username;

        //comprobar si está logueado

        if(isset($_SESSION['username'])){

          //está logueado

          $username = $_SESSION['username'];
          if(isset($_GET['sucess'])){
              if($_GET['sucess']){
                  echo '<div style="background-color:	rgb(217, 217, 217);"><p>Datos añadidos con éxito</p></div>';
              }
          }
          echo '<p>Bienvenido, <b>'.$username . '</b></p>';

          //Conexion SQL

          $conexion = new mysqli("localhost", "root" ,"" , "datos_fitness");

          //Comprobar si hay error al conectar

          if($conexion->connect_errno){
              echo 'Error en la conexion SQL: ' . $conexion->connect_error;
          }

          $test = $conexion->query("SET NAMES 'utf8'");

          //Rellenar menu de actividades

          $actividades = array();
          $actividadesQuery = $conexion->query('SELECT * FROM actividad');

          //cargar actividades

          while($respuesta = $actividadesQuery->fetch_assoc()){
             array_push($actividades, new Actividad($respuesta['nombre'], $respuesta['id'], $respuesta['intensidad']));
          }

          //formulario

          echo '<form method="post" action="add_data.php">
          Tipo de actividad: <select name="tipoActividad">
          <option value="0">Elegir...</option>';

          foreach ($actividades as $actividad) {
              echo '<option value="'.$actividad->idActividad.'">'.$actividad->nombreActividad.'</option>';
          }
          echo '</select> <br>';

          echo 'Duracion (min):  <input type="text" name="duracion" autocomplete="off"><br>
              Distancia (m):  <input type="text" name="distancia" autocomplete="off"><br>
              Intensidad:  <input type="text" name="intensidad" autocomplete="off"><br>
              Fecha (aaaa-mm-dd):  <input type="text" name="date"><br>
              <input type="submit" value="Añadir" name="add">
              </form>';

        }else{

          //no está logueado, redireccionando a login...

          header("Location: login.php");
          exit();
        }

        class Actividad {
            public $nombreActividad;
            public $idActividad;
            public $hasIntensidad;

            function __construct($nombreActividad, $idActividad, $hasIntensidad){
                $this->nombreActividad  = $nombreActividad;
                $this->idActividad = $idActividad;
                $this->hasIntensidad = $hasIntensidad;
            }
        }
    ?>
    <a href="mis_entrenamientos.php">Ver mis entrenamientos</a>
    <a href="logout.php">Cerrar sesión</a>
  </body>
