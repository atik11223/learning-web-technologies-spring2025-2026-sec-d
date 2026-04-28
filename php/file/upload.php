<?php

    $src = $_FILES['myfile']['tmp_name'];
    $ext = explode('.', $_FILES['myfile']['name']);
    $count = count($ext);
    $newName = time().".".$ext[$count-1];
    $des = 'upload/'.$newName;
    
    if(move_uploaded_file($src, $des)){
        echo "Success";
    }else{
        echo "Error";
    }
?>