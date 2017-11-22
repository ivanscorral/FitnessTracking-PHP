<?php

  $conexion = new mysqli("localhost", "root" ,"password" , "datos_fitness");

  //Comprobar si hay error al conectar

  if($conexion->connect_errno){
      echo 'Error en la conexion SQL: ' . $conexion->connect_error;
  }

  $test = $conexion->query("SET NAMES 'utf8'");

  if(isset($_POST['submit'])){
    submit_user($conexion);
  }

  function submit_user($conexion){
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $pwd2 = $_POST['pwd2'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    if(strcmp($pwd, $pwd2) == 0){
      $hash = password_hash($pwd, PASSWORD_DEFAULT);
      $query = $conexion->query('INSERT INTO usuarios(username, pwd, name, surname) VALUES("'.$username.'", "'.$hash.'", "'.$name.'", "'.$surname.'")');
      header('Location: login.php');
      exit();
    }

  }

 ?>
