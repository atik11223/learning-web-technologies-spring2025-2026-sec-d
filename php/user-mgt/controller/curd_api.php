<?php
session_start();
require_once('../model/db.php'); // Include the database connection

// Security check to protect the API
if(!isset($_COOKIE['status'])){ 
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access. Please log in.']);
    exit();
}

// Check if the AJAX request has sent our payload
if (isset($_POST['payload'])) {
    $request = json_decode($_POST['payload']);
    $action = $request->action; 
    $response = [];
    
    $conn = getConnection(); // Open the database connection

    // --- READ ---
    if ($action == 'read') {
        $sql = "SELECT id, username, email FROM users";
        $result = mysqli_query($conn, $sql);
        
        $users = [];
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $users[] = $row;
            }
        }
        $response = ['status' => 'success', 'data' => $users];
    }
    
    // --- CREATE ---
    elseif ($action == 'create') {
        // Always escape strings before inserting into the database to prevent SQL injection
        $username = mysqli_real_escape_string($conn, $request->user->username);
        $email = mysqli_real_escape_string($conn, $request->user->email);
        
        $sql = "INSERT INTO users (username, email) VALUES ('{$username}', '{$email}')";
        
        if(mysqli_query($conn, $sql)) {
            $response = ['status' => 'success', 'message' => 'User created successfully!'];
        } else {
            $response = ['status' => 'error', 'message' => 'Failed to create user.'];
        }
    }
    
    // --- UPDATE ---
    elseif ($action == 'update') {
        $id = mysqli_real_escape_string($conn, $request->user->id);
        $username = mysqli_real_escape_string($conn, $request->user->username);
        $email = mysqli_real_escape_string($conn, $request->user->email);
        
        $sql = "UPDATE users SET username='{$username}', email='{$email}' WHERE id='{$id}'";
        
        if(mysqli_query($conn, $sql)) {
            $response = ['status' => 'success', 'message' => 'User updated successfully!'];
        } else {
            $response = ['status' => 'error', 'message' => 'Failed to update user.'];
        }
    }
    
    // --- DELETE ---
    elseif ($action == 'delete') {
        $id = mysqli_real_escape_string($conn, $request->id);
        
        $sql = "DELETE FROM users WHERE id='{$id}'";
        
        if(mysqli_query($conn, $sql)) {
            $response = ['status' => 'success', 'message' => 'User deleted successfully!'];
        } else {
            $response = ['status' => 'error', 'message' => 'Failed to delete user.'];
        }
    }

    mysqli_close($conn); // Close the connection
    
    // Return JSON to the frontend
    echo json_encode($response);
}
?>