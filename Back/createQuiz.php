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
    
    //print_r($Quiz);

    $sizeMC = Sizeof($Quiz->MultipleChoice);
    $sizeTF = Sizeof($Quiz->TrueFalse);
    $sizeOE = Sizeof($Quiz->OpenEnded);
    $Name = $Quiz->QuizName;
    $Start = $Quiz->StartDate;
    $End = $Quiz->EndDate;
    
    
    $insertQuiz = "INSERT INTO Quizzes (QuizName, StartDate, EndDate) VALUES ('$Name', '$Start', '$End')";
    $exec = mysql_query($insertQuiz, $con);
    
    
    $quizID = mysql_query("SELECT QuizID FROM Quizzes WHERE QuizName = '$Name'");
    $info = mysql_fetch_assoc($quizID);
    $id = $info['QuizID'];
    
    //$create = mysql_query("CREATE TABLE `ovl2_proj`.`$Name` (`Question` TEXT,`Opt1` VARCHAR(255),`Opt2` VARCHAR(255),`Opt3` VARCHAR(255),`Opt4` VARCHAR(255),`Answer` VARCHAR(255),`QuizID` INT(255))");
    $create = mysql_query("CREATE TABLE `ovl2_proj`.`$Name` (`Question` TEXT NOT NULL, `Opt1` VARCHAR(255) NOT NULL, `Opt2` VARCHAR(255) NOT NULL, `Opt3` VARCHAR(255) NOT NULL, `Opt4` VARCHAR(255) NOT NULL, `Answer` VARCHAR(255) NOT NULL, `QuestionNum` INT(255) NOT NULL AUTO_INCREMENT, `QuizID` INT NOT NULL, PRIMARY KEY (`QuestionNum`))");
  
    
    for ($i=0; $i<$sizeMC; $i++) {
        $num = $Quiz->MultipleChoice[$i];
        $sql1 = mysql_query("SELECT Question, Opt1, Opt2, Opt3, Opt4, Answer FROM MultipleChoice WHERE QuestionNum = '$num'");
        $info1 = mysql_fetch_assoc($sql1);
        
        $Ques = $info1['Question'];
        $Opt1 = $info1['Opt1'];
        $Opt2 = $info1['Opt2'];
        $Opt3 = $info1['Opt3'];
        $Opt4 = $info1['Opt4'];
        $Ansr = $info1['Answer'];
        
        //echo $Ques." ".$Opt1." ".$Opt2." ".$Opt3." ".$Opt4." ".$Ansr;
        $insMC = "INSERT INTO $Name(Question, Opt1, Opt2, Opt3, Opt4, Answer, QuizID) VALUES ('$Ques', '$Opt1', '$Opt2', '$Opt3', '$Opt4', '$Ansr', '$id')";
        $exec1 = mysql_query($insMC, $con);
    } 
    
    for ($i=0; $i<$sizeTF; $i++) {
        $num = $Quiz->TrueFalse[$i];
        $sql2 = mysql_query("SELECT Question, Opt1, Opt2, Answer FROM TrueFalse WHERE QuestionNum = '$num'");
        $info2 = mysql_fetch_assoc($sql2);
        
        $Ques = $info2['Question'];
        $Opt1 = $info2['Opt1'];
        $Opt2 = $info2['Opt2'];
        $Ansr = $info2['Answer'];
        
        //echo $Ques." ".$Opt1." ".$Opt2." ".$Ansr;
        $insTF = "INSERT INTO $Name (Question, Opt1, Opt2, Answer, QuizID) VALUES ('$Ques', '$Opt1', '$Opt2', '$Ansr', '$id')";
        $exec2 = mysql_query($insTF, $con);
    } 
    
    for ($i=0; $i<$sizeOE; $i++) {
        $num = $Quiz->OpenEnded[$i];
        $sql3 = mysql_query("SELECT Question, Answer FROM OpenEnded WHERE QuestionNum = '$num'");
        $info3 = mysql_fetch_assoc($sql3);
        
        $Ques = $info3['Question'];
        $Opt1 = $info3['Opt1'];
        $Opt2 = $info3['Opt2'];
        $Ansr = $info3['Answer'];
        
        //echo $Ques;
        $insOE = "INSERT INTO $Name (Question, Answer, QuizID) VALUES ('$Ques', '$Ansr', '$id')";
        $exec3 = mysql_query($insOE, $con);
    }
    
    Echo "Quiz Created."
?>
