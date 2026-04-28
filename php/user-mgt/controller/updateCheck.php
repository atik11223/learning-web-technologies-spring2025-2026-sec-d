<?php
    session_start();

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
                    
                    // --- HISTORY LOGGING START ---
                    $old_data = [
                        'id' => $users[$i]['id'],
                        'old_username' => $users[$i]['username'],
                        'old_email' => $users[$i]['email'],
                        'time' => date("h:i:sa")
                    ];
                    
                    // Initialize history array if it doesn't exist
                    if(!isset($_SESSION['history'])){
                        $_SESSION['history'] = [];
                    }
                    // Add the old data to the history log
                    $_SESSION['history'][] = $old_data;
                    // --- HISTORY LOGGING END ---

                    // Update to new details
                    $users[$i]['username'] = $username;
                    $users[$i]['email'] = $email;
                    break;
                }
            }

            $_SESSION['users'] = $users;
            
            // Display history before redirecting (or redirect and show on another page)
            echo "<h2>Update Successful!</h2>";
            echo "<h3>Edit History:</h3>";
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Previous Username</th>
                        <th>Previous Email</th>
                        <th>Edit Time</th>
                    </tr>";
            
            foreach($_SESSION['history'] as $log){
                echo "<tr>
                        <td>{$log['id']}</td>
                        <td>{$log['old_username']}</td>
                        <td>{$log['old_email']}</td>
                        <td>{$log['time']}</td>
                      </tr>";
            }
            
            echo "</table><br>";
            echo "<a href='../view/user_list.php'>Back to User List</a>";
        }
    } else {
        echo "Invalid request!";
    }
?>