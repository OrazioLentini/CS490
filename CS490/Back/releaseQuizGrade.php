<?php
    session_start;
    include('theader.php');

    $con = mysql_connect("sql.njit.edu","ovl2_proj","cs490");
    if(!$con) {
        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("ovl2_proj", $con);
    
    $request = file_get_contents('php://input');
    $recieve = json_decode($request);
    
    $name = $recieve->QuizName;
    
    $release = mysql_query("UPDATE Grades set Released = 'Released' WHERE QuizName= '$name'");

    echo $name." Grades have been released.";
?>
