<?php
    session_start(); //

    if(isset($_POST['submit'])){
        $id       = $_POST['id'];
        $username = $_POST['username'];
        $email    = $_POST['email'];

        if($username == "" || $email == ""){
            echo "Null username or email!";
        } else {
            $users = $_SESSION['users'];
            
            for($i = 0; $i < count($users); $i++){
                if($users[$i]['id'] == $id){
                    // Update the details for this specific index
                    $users[$i]['username'] = $username;
                    $users[$i]['email'] = $email;
                    break; 
                }
            }

            $_SESSION['users'] = $users;

            header('location: ../view/user_list.php');
        }
    } else {
        echo "Invalid request!"; //
    }
?>