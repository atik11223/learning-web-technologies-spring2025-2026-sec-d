<?php
// Initialize variables to hold error messages and input values
$usernameErr = $passwordErr = "";
$username = $password = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (strlen($username) < 2) {
        $usernameErr = "User Name must contain at least two (2) characters.";
    } else {
        $isValidUsername = true;
        
        // Loop through every single character in the username
        for ($i = 0; $i < strlen($username); $i++) {
            $char = $username[$i];
            
            // Check if the character is NOT a letter, NOT a number, and NOT an allowed symbol
            if (!(
                ($char >= 'a' && $char <= 'z') || 
                ($char >= 'A' && $char <= 'Z') || 
                ($char >= '0' && $char <= '9') || 
                $char === '.' || 
                $char === '-' || 
                $char === '_'
            )) {
                $isValidUsername = false;
                break; // Stop checking once we find a bad character
            }
        }

        if ($isValidUsername === false) {
            $usernameErr = "User Name can contain alpha numeric characters, period, dash or underscore only.";
        }
    }

    if (strlen($password) < 8) {
        $passwordErr = "Password must not be less than eight (8) characters.";
    } else {
        $hasSpecialChar = false;
        
        // Loop through every single character in the password
        for ($i = 0; $i < strlen($password); $i++) {
            $char = $password[$i];
            
            // Check if the character matches one of the required symbols
            if ($char === '@' || $char === '#' || $char === '$' || $char === '%') {
                $hasSpecialChar = true;
                break; // Stop checking once we find at least one special character
            }
        }

        if ($hasSpecialChar === false) {
            $passwordErr = "Password must contain at least one of the special characters (@, #, $, %).";
        }
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