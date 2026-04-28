<?php
    $name = "Test";
    // $id = 12;
    // $cgpa =2.5;

    // $std = ['alamin', 12, 3.5];
    // $std = array('alamin', 12, 3.5);
    // $std[0];
    // $stds = [
    //     ['alamin', 12, 3.5],
    //     ['alamin', 1, 3.5],
    //     ['alamin', 2, 3.5]
    // ];
    // $stds[2][2];
    
    // $std['cgpa'];
    // $stds = [
    //     's1'=>['name'=>'alamin', 'id'=>12, 'cgpa'=>3.5],
    //     's2'=>['name'=>'xyz', 'id'=>2, 'cgpa'=>3.3],
    //     's3'=>['name'=>'abc', 'id'=>1, 'cgpa'=>3.2]
    // ];
    // $std['s2']['name'];

    // echo "TEST ".$name."<br>";
    // print ("Test:   -".$name);
    // print_r($std);
    //var_dump($std);
    $std = ['name'=>'alamin', 'id'=>12, 'cgpa'=>3.5];
    
    // for($a=0; $a<count($std); $a++){
    //     echo $std[$a];    
    // }

    foreach($std as $v){
        echo $v."<br>";
    }

    if(){

    }else{
        
    }
?>


<h1> Proifle Name: <?php if($name == ""){echo "not found!";}else{echo $name;}?></h1>
