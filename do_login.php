<?php

  $conexion = new mysqli("localhost", "root" ,"password" , "datos_fitness");

  //Comprobar si hay error al conectar

  if($conexion->connect_errno){
      echo 'Error en la conexion SQL: ' . $conexion->connect_error;
  }

  $test = $conexion->query("SET NAMES 'utf8'");

  if(isset($_POST['submit'])){
    login($conexion);
  }

  function login($conexion){
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $query = $conexion->query('SELECT pwd FROM usuarios WHERE username="'.$username.'"');
    $hashdb = $query->fetch_assoc()['pwd'];
    if(password_verify($pwd, $hashdb)){
      session_start();
      $_SESSION['username'] = $username;
      header("Location: index.php");
      exit();
    }else{
      header("Location: login.php?error=true");
      exit();
    }
  }


 ?>
