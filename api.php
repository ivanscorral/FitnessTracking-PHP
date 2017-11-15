<?php
  include 'data_transactions.php';

  //TODO AÑADIR AUTH

  if(isset($_GET['username'])){
    $conexion = new mysqli("localhost", "root" ,"" , "datos_fitness");

    if($conexion->connect_errno){
        echo 'Error en la conexion SQL: ' . $conexion->connect_error;
    }

    get_data($_GET['username'], $conexion);
  }else{

  }

  function get_data($username, $conexion){
    $user_id = get_user_id($conexion, $username);
    $entrenamientos = get_entrenamientos($conexion, $user_id);
    echo json_encode($entrenamientos);
  }


 ?>
