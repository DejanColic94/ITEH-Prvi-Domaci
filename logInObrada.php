<?php
    
    include "database.php";
    $db = new Database('booktracker');


    $errorMessage = '';

    if(isset($_POST['submit'])) {
        if(empty($_POST['username'])) {
            $errorMessage = "Username cannot be empty!";
        }else if(empty($_POST['password'])) {
            $errorMessage = "Password cannot be empty!";
        }else {
            // izvlacim username i password iz POST superglobalne
            $username = $_POST['username'];
            $password = $_POST['password'];

            $db->select("radnik","*",null,null,null,"username = '$username' AND password ='$password'",null);

            $rows = $db->getRecords();
            if($rows == 1) {
                 
               // header("Location: knjiga.php");
               header("Location: autor.php");
                $db->Commit();
            }else {
                $errorMessage = "Username or Password is invalid!";
                $db->Rollback();
            }

        }
    }
?>