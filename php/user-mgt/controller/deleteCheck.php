<?php
    session_start(); // Start session to access user data

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $users = $_SESSION['users'];
        $found = false;

        // Loop through the users to find the one with the matching ID
        for($i = 0; $i < count($users); $i++){
            if($users[$i]['id'] == $id){
                // Remove the user from the array
                unset($users[$i]);
                $found = true;
                break;
            }
        }

        if($found){
            // Re-index the array to prevent empty gaps
            $_SESSION['users'] = array_values($users);
            header('location: ../view/user_list.php'); // Redirect back to list
        } else {
            echo "User not found!";
        }
    } else {
        echo "Invalid request!";
    }
?>