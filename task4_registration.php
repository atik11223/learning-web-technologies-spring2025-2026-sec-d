<?php
$nameErr = $emailErr = $userErr = $passErr = $confPassErr = $genderErr = $dobErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Basic empty checks as "appropriate validations" [cite: 32]
    if (empty($_POST["name"])) $nameErr = "Name is required";
    
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }

    if (empty($_POST["username"])) $userErr = "Username is required";
    
    if (empty($_POST["password"])) $passErr = "Password is required";
    
    if ($_POST["password"] !== $_POST["confirm_password"]) {
        $confPassErr = "Passwords do not match";
    }

    if (empty($_POST["gender"])) $genderErr = "Gender is required";
    if (empty($_POST["dob"])) $dobErr = "Date of Birth is required";
}
?>

<!DOCTYPE html>
<html>
<head><title>Registration</title></head>
<body>
    <fieldset style="width: 500px;">
        <legend><b>REGISTRATION</b></legend> <form method="POST" action="">
            Name : <input type="text" name="name"> <span style="color:red;">* <?php echo $nameErr;?></span><hr> Email : <input type="text" name="email"> <span style="color:red;">* <?php echo $emailErr;?></span><hr> User Name : <input type="text" name="username"> <span style="color:red;">* <?php echo $userErr;?></span><hr> Password : <input type="password" name="password"> <span style="color:red;">* <?php echo $passErr;?></span><hr> Confirm Password: <input type="password" name="confirm_password"> <span style="color:red;">* <?php echo $confPassErr;?></span><hr> <fieldset>
                <legend>Gender</legend> <input type="radio" name="gender" value="Male"> Male 
                <input type="radio" name="gender" value="Female"> Female 
                <input type="radio" name="gender" value="Other"> Other <span style="color:red;">* <?php echo $genderErr;?></span>
            </fieldset><hr>
            
            <fieldset>
                <legend>Date of Birth</legend> <input type="date" name="dob"> (dd/mm/yyyy) <span style="color:red;">* <?php echo $dobErr;?></span>
            </fieldset><hr>

            <input type="submit" value="Submit"> <input type="reset" value="Reset">
        </form>
    </fieldset>
</body>
</html>