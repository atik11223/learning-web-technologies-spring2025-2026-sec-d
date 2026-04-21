<?php
$uploadErr = "";
$uploadedImagePath = ""; // We will store the saved file's path here

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_pic"])) {
    $file = $_FILES["profile_pic"];
    $fileName = $file["name"];
    $fileSize = $file["size"];
    $fileTmpName = $file["tmp_name"]; // PHP stores uploaded files in a temporary location first
    
    // Get the file extension
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
    // Allowed extensions
    $allowed = array("jpeg", "jpg", "png");

    // Validations
    if (!in_array($fileExt, $allowed)) {
        $uploadErr = "Picture format must be in jpeg or jpg or png.";
    } elseif ($fileSize > 4194304) { 
        $uploadErr = "Picture size should not be more than 4MB.";
    } else {
        // VALIDATION PASSED - NOW WE SAVE THE FILE
        
        $targetDir = "uploads/"; // The folder we just created
        // We add time() to the filename so if you upload two images named "pic.jpg", they don't overwrite each other
        $targetFile = $targetDir . time() . "_" . basename($fileName); 
        
        // move_uploaded_file moves it from the temp location to your uploads folder
        if (move_uploaded_file($fileTmpName, $targetFile)) {
            $uploadErr = "<span style='color:green;'>File uploaded successfully!</span>";
            $uploadedImagePath = $targetFile; // Save the path so HTML can use it
        } else {
            $uploadErr = "Sorry, there was an error saving your file. Did you create the 'uploads' folder?";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Profile Picture</title></head>
<body>
    <fieldset style="width: 300px;">
        <legend><b>PROFILE PICTURE</b></legend>
        <form method="POST" action="" enctype="multipart/form-data"> 
            
            <?php if (!empty($uploadedImagePath)): ?>
                <img src="<?php echo $uploadedImagePath; ?>" alt="Profile Picture" width="150" height="150" style="object-fit: cover;"><br><br>
            <?php else: ?>
                <img src="https://via.placeholder.com/150" alt="Profile Icon"><br><br>
            <?php endif; ?>

            <input type="file" name="profile_pic">
            <br><br>
            <hr>
            <input type="submit" value="Submit">
            <br>
            <span style="color:red;"><?php echo $uploadErr; ?></span>
        </form>
    </fieldset>
</body>
</html>