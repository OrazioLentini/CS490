<?php
    session_start;
    include('theader.php');
?>

<?php
    $con = mysql_connect("sql.njit.edu","ovl2_proj","cs490");
    if(!$con) {
        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("ovl2_proj", $con);
    
    $Request = file_get_contents('php://input');
    $Quiz = json_decode($Request);
    
    
    $Name = $Quiz->QuizName;
    $size = Sizeof($Quiz->Points);

    for ($i=0; $i<$size; $i++) {
        $qus = $i + 1;
        $x = $Quiz->Points[$i];   
        $addPoints = mysql_query("UPDATE $Name set Points = '$x' WHERE QuestionNum= '$qus'");
    }
    
    echo "Quiz ".$Name." Created.";
?>