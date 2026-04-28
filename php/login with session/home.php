<?php
    session_start();
    //print_r($_SESSION);
    if(!isset($_SESSION['status'])){
         header('location: login.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page</title>
</head>
<body>
        <h1>Welcome Home! <?php echo $_SESSION['username'];?> </h1>
        <a href='logout.php'>logout</a>
</body>
</html>

