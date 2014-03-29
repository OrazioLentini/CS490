<?php
    session_start;
    include('sheader.php');
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
    //$OEcheck = 'compiled';
    $OEpoints = $Quiz->OpenEnded;
    $sizeMC = Sizeof($Quiz->MultipleChoice);
    $sizeTF = Sizeof($Quiz->TrueFalse);
    $student = 'User';
    
    //echo $OEpoints;
    
    //echo $Name;
    $MCscore = 0;
    $TFscore = 0;
    $OEscore = 0;
    $qus = 0;
    $User = 1;
    
    $studentQuiz = $Name.$student;
    //echo $studentQuiz;
    
    $create = mysql_query("CREATE TABLE `ovl2_proj`.`$studentQuiz`(`Question` text,`Opt1` varchar(255) DEFAULT NULL,`Opt2` varchar(255) DEFAULT NULL,`Opt3` varchar(255) DEFAULT NULL,`Opt4` varchar(255) DEFAULT NULL,`Answer` varchar(255) DEFAULT NULL,`QuestionNum` int(255) NOT NULL AUTO_INCREMENT,`QuizID` int(255) DEFAULT NULL ,PRIMARY KEY (`QuestionNum`))");    
    $copy = mysql_query("INSERT INTO `ovl2_proj`.`$studentQuiz` SELECT * FROM `ovl2_proj`.`$Name`");
    $addYA = mysql_query("ALTER TABLE `$studentQuiz` ADD `YourAnswer` TEXT NOT NULL AFTER `Answer`");
    $addCI = mysql_query("ALTER TABLE `$studentQuiz` ADD `CorInc` TEXT NOT NULL AFTER `YourAnswer`");
    $addPR = mysql_query("ALTER TABLE `$studentQuiz` ADD `PointRec` TEXT NOT NULL AFTER `CorInc`");
    
    //$Y = mysql_query("UPDATE $studentQuiz set YourAnswer='A' WHERE QuestionNum='1'");
    
    for ($i=0; $i<$sizeMC; $i++) {
        $qus = $i + 1;
        
        $ans = $Quiz->MultipleChoice[$i];
        $gradeMC = mysql_query("SELECT COUNT(*) FROM $Name  WHERE QuestionNum = '$qus' AND Answer = '$ans'");
        $info = mysql_fetch_assoc($gradeMC);
        $correctMC = $info['COUNT(*)'];
        
        $addAnsMC = mysql_query("UPDATE $studentQuiz set YourAnswer = '$ans' WHERE QuestionNum= '$qus'");
        
        if ($correctMC == 1) {
            $addCorInc = mysql_query("UPDATE $studentQuiz set CorInc = 'Correct' WHERE QuestionNum= '$qus'");
            $addPoints = mysql_query("UPDATE $studentQuiz set PointRec = '1' WHERE QuestionNum= '$qus'");
        }
        if ($correctMC == 0) {
            $addCorInc = mysql_query("UPDATE $studentQuiz set CorInc = 'Incorrect' WHERE QuestionNum= '$qus'");
            $addPoints = mysql_query("UPDATE $studentQuiz set PointRec = '0' WHERE QuestionNum= '$qus'");
        }
        
        $MCscore = $MCscore + $correctMC;
    }
    
    for ($i=0; $i<$sizeTF; $i++) {
        $qus = $qus + 1;
        
        $ans = $Quiz->TrueFalse[$i];
        $gradeTF = mysql_query("SELECT COUNT(*) FROM $Name  WHERE QuestionNum = '$qus' AND Answer = '$ans'");
        $info2 = mysql_fetch_assoc($gradeTF);
        $correctTF = $info2['COUNT(*)'];
        
        $addAnsTF = mysql_query("UPDATE $studentQuiz set YourAnswer = '$ans' WHERE QuestionNum= '$qus'");
        
        if ($correctTF == 1) {
            $addCorInc = mysql_query("UPDATE $studentQuiz set CorInc = 'Correct' WHERE QuestionNum= '$qus'");
            $addPoints = mysql_query("UPDATE $studentQuiz set PointRec = '1' WHERE QuestionNum= '$qus'");
        }
        if ($correctTF == 0) {
            $addCorInc = mysql_query("UPDATE $studentQuiz set CorInc = 'Incorrect' WHERE QuestionNum= '$qus'");
            $addPoints = mysql_query("UPDATE $studentQuiz set PointRec = '0' WHERE QuestionNum= '$qus'");
        }
        
        $TFscore = $TFscore + $correctTF;
    } 
    
    //$qus = $qus + 1;
    //$addAnsOE = mysql_query("UPDATE $studentQuiz set YourAnswer = '$ans' WHERE QuestionNum= '$qus'");

    /*
    if ($OEcheck == 'compiled') {
        $OEscore = 5;
    } */
    
    $qus = $qus + 1;
    $addPoints = mysql_query("UPDATE $studentQuiz set PointRec = '$OEpoints' WHERE QuestionNum= '$qus'");

    $tot = mysql_query("SELECT COUNT(*) FROM $Name");
    $info3 = mysql_fetch_assoc($tot);
    $totalQus = $info3['COUNT(*)'];
    
    $Total = $totalQus + 4;
    
    $Score = $MCscore + $TFscore + $OEpoints;
    $g = (($Score / $Total)*100);
    $Grade = round($g,2);
    
    if($Grade >= 90) {
        $comments = 'Awesome Job!';
    }
    if($Grade >= 80 && $Grade < 90) {
        $comments = 'Good Job!';
    }
    if($Grade >= 70 && $Grade < 80) {
        $comments = 'Ok!';
    }
    if($Grade >= 65 && $Grade < 70) {
        $comments = 'Terrible!';
    }
    if($Grade < 65) {
        $comments = 'Failing! Please See Me!';
    }
    
    $insGrade = "INSERT INTO Grades (QuizName, TotalCorrect, TotalPoints, Grade, Comments, Released, StudentID) VALUES ('$Name', '$Score', '$Total', '$Grade', '$comments', '0', '$User')";
    $exec1 = mysql_query($insGrade, $con);
    
    echo "Your quiz has been submitted for Grading."; 
    
    //CREATE TABLE `ovl2_proj`.`Quiz1User`(`Question` text,`Opt1` varchar( 255 ) DEFAULT NULL,`Opt2` varchar( 255 ) DEFAULT NULL,`Opt3` varchar( 255 ) DEFAULT NULL,`Opt4` varchar( 255 ) DEFAULT NULL,`Answer` varchar( 255 ) DEFAULT NULL,`QuestionNum` int( 255 ) NOT NULL AUTO_INCREMENT,`QuizID` int( 255 ) DEFAULT NULL ,PRIMARY KEY ( `QuestionNum` ) ); INSERT INTO `ovl2_proj`.`Quiz1User` SELECT * FROM `ovl2_proj`.`Quiz1` ;
    //ALTER TABLE `Quiz1User` ADD `YourAnswer` VARCHAR( 255 ) NOT NULL AFTER `Answer`
?>

 
