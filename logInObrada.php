<?php
    include "database.php";
    $db = new Database('booktracker');


    $errorMessage = '';

    if(isset($_POST['submit'])) {
        if(empty($_POST['username']) || empty($_POST['password'])) {
            $errorMessage = "Username or Password is invalid!";
        }else {
            // izvlacim username i password iz POST superglobalne
            $username = $_POST['username'];
            $password = $_POST['password'];

            $db->select("radnik","*",null,null,null,"username = '$username' AND password ='$password'",null);

            $rows = $db->records;
            if($rows == 1) {
                header("Location: home.php");
                $db->Commit();
            }else {
                $errorMessage = "Username or Password is invalid!";
                $db->Rollback();
            }

        }
    }
?>