<?php
// Initialize variables to hold error messages and input values
$usernameErr = $passwordErr = "";
$username = $password = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validation for Username [cite: 13, 14]
    if (strlen($username) < 2) {
        $usernameErr = "User Name must contain at least two (2) characters.";
    } elseif (!preg_match("/^[a-zA-Z0-9._-]+$/", $username)) {
        $usernameErr = "User Name can contain alpha numeric characters, period, dash or underscore only.";
    }

    // Validation for Password [cite: 15, 16]
    if (strlen($password) < 8) {
        $passwordErr = "Password must not be less than eight (8) characters.";
    } elseif (!preg_match("/[@#$%]/", $password)) {
        $passwordErr = "Password must contain at least one of the special characters (@, #, $, %).";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
    <fieldset style="width: 300px;">
        <legend><b>LOGIN</b></legend> <form method="POST" action="">
            <label>User Name:</label> <input type="text" name="username" value="<?php echo $username; ?>">
            <span style="color:red;">* <?php echo $usernameErr; ?></span>
            <br><br>
            
            <label>Password :</label> <input type="password" name="password">
            <span style="color:red;">* <?php echo $passwordErr; ?></span>
            <br><br>
            
            <input type="checkbox" name="remember"> Remember Me <br><br>
            
            <input type="submit" value="Submit"> <a href="#">Forgot Password?</a>
        </form>
    </fieldset>
</body>
</html>