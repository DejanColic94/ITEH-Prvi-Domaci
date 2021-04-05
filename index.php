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
    include "loginObrada.php";
  ?>

  <body>

<form class="box" action="" method="POST">
  <h1>Log In</h1>
  <input type="text" id="username" name="username" placeholder="Enter Username">
  <input type="password" id="password" name="password" placeholder="Enter Password">
  <input type="submit"  name="submit" value="Log In">
  <span > <?php echo $errorMessage; ?> </span>
</form>

  
  </body>
</html>

