<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="logo.ico" type="image/x-icon">
  </head>
  <?php
    include "database.php";
    $db = new Database('booktracker');
  ?>

  <body>

<form class="box" action="logIn.php" method="POST">
  <h1>Log In</h1>
  <input type="text" name="username" placeholder="Enter Username">
  <input type="password" name="password" placeholder="Enter Password">
  <input type="submit" name="button" value="Log In">
</form>


  </body>
</html>

<?php
  $db->select("radnik","*",null,null,null);
  while($red = $db->getResult()->fetch_object()) :
  echo "<br>";
  echo "<br>";  
  echo $red->id;
  echo "<br>";
  echo $red->ime;
  echo "<br>";
  echo $red->prezime;
  echo "<br>";
  echo $red->username;
  echo "<br>";
  echo $red->password;
  endwhile;
?>