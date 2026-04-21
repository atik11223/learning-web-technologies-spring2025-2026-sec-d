<?php
$currentErr = $newErr = $retypeErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current = $_POST["current_password"];
    $new = $_POST["new_password"];
    $retype = $_POST["retype_password"];

    // Validation Rules [cite: 24, 25]
    if ($new === $current) {
        $newErr = "New Password should not be same as the Current Password.";
    }
    
    if ($new !== $retype) {
        $retypeErr = "New Password must match with the Retyped Password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Change Password</title></head>
<body>
    <fieldset style="width: 400px;">
        <legend><b>CHANGE PASSWORD</b></legend> <form method="POST" action="">
            <label>Current Password :</label> <input type="password" name="current_password">
            <span style="color:red;">* <?php echo $currentErr; ?></span>
            <br><br>
            
            
            <label style="color: green;">New Password &nbsp;&nbsp;&nbsp;:</label> 
            <input type="password" name="new_password">
            <span style="color:red;">* <?php echo $newErr; ?></span>
            <br><br>

            <label style="color: red;">Retype New Password:</label> 
            <input type="password" name="retype_password">
            <span style="color:red;">* <?php echo $retypeErr; ?></span>
            <br><br>
            <hr>
            <input type="submit" value="Submit"> </form>
    </fieldset>
</body>
</html>