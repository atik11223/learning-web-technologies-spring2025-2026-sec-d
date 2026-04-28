<?php
    session_start();
    if(isset($_POST['submit'])){
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];

        if($username == "" || $password == ""){
                echo "null username/password!";
        }else{
            if($username == $password){
                $_SESSION['status'] = true;
                $_SESSION['username'] = $username;
                header('location: home.php');
            }else{
                echo "invalid user!";
            }
        }
    }else{
        echo "invalid request! please submit form...";
    }

?>