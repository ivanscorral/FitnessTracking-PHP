<html>
  <head>
    <title>Registrarse</title>
    <script src="validateForm.js"></script>
  </head>
  <body>
    <form method="post" action="submit_user.php" name="register">
      Nombre de Usuario: <input type="text" name="username"></input><br>
      Nombre: <input type="text" name="name"></input><br>
      Apellido: <input type="text" name="surname"></input><br>
      Contraseña: <input type="password" name="pwd" oninput="validateForm()"></input><br>
      Confirmar contraseña: <input type="password" name="pwd2" oninput="validateForm()"></input><br><br>
      <input type="submit" name="submit" value="Registrarse" disabled></input>
      <p id="errpwd"></p>
    </form>
  </body>
  </html>
