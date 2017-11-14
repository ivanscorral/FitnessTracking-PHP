<html>
  <head>
    <title>Log-in</title>
  </head>
  <body>
    <?php
      if(isset($_GET['error'])){
        if($_GET['error']){
          echo '<p>Contraseña y/o usuario incorrectos</p>';
        }
      }
    ?>
    <form method="post" action="do_login.php" name="login">
      Nombre de Usuario: <input type="text" name="username"></input><br>
      Contraseña: <input type="password" name="pwd"></input><br>
      <input type="submit" name="submit" value="Log-in"></input>
      <p id="errpwd"></p>
    </form>
    <a href="register.php">No tienes cuenta? Regístrate!</a>
  </body>
</html>
