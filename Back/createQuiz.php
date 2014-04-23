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
    $sizeE = Sizeof($Quiz->Easy);
    $sizeM = Sizeof($Quiz->Medium);
    $sizeH = Sizeof($Quiz->Hard);
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
    /*
    for ($i=0; $i<$sizeE; $i++) {
        $q = $Quiz->Easy[$i];
        $sqlE = mysql_query("SELECT 1 as tbl FROM MultipleChoice WHERE Question = '$q' AND Difficulty = 'Easy' UNION SELECT 2 as tbl FROM TrueFalse WHERE Question = '$q' AND Difficulty = 'Easy' UNION SELECT 3 as tbl FROM OpenEnded WHERE Question = '$q' AND Difficulty = 'Easy' ");
        $infoE = mysql_fetch_assoc($sqlE);
        
        $tbl = $infoE['tbl'];
        
        if($tbl == '2') {
            $sqlETF = mysql_query("SELECT Question, Opt1, Opt2, Answer FROM TrueFalse WHERE Question = '$q'");
            $infoETF = mysql_fetch_assoc($sqlETF);
            
            $Ques = $infoETF['Question'];
            $Opt1 = $infoETF['Opt1'];
            $Opt2 = $infoETF['Opt2'];
            $Ansr = $infoETF['Answer'];
            
            //echo $Ques." ".$Opt1." ".$Opt2." ".$Ansr;
            $insETF = "INSERT INTO $Name (Question, Opt1, Opt2, Answer, QuizID) VALUES ('$Ques', '$Opt1', '$Opt2', '$Ansr', '$id')";
            $execETF = mysql_query($insETF, $con);
        }
        
        if($tbl == '1') {
            $sqlEMC = mysql_query("SELECT Question, Opt1, Opt2, Opt3, Opt4, Answer FROM MultipleChoice WHERE QuestionNum = '$q'");
            $infoEMC = mysql_fetch_assoc($sqlEMC);
            
            $Ques = $infoEMC['Question'];
            $Opt1 = $infoEMC['Opt1'];
            $Opt2 = $infoEMC['Opt2'];
            $Opt3 = $infoEMC['Opt3'];
            $Opt4 = $infoEMC['Opt4'];
            $Ansr = $infoEMC['Answer'];
            
            //echo $Ques." ".$Opt1." ".$Opt2." ".$Opt3." ".$Opt4." ".$Ansr;
            $insEMC = "INSERT INTO $Name(Question, Opt1, Opt2, Opt3, Opt4, Answer, QuizID) VALUES ('$Ques', '$Opt1', '$Opt2', '$Opt3', '$Opt4', '$Ansr', '$id')";
            $execEMC = mysql_query($insEMC, $con);
        }
        if($tbl == '3') {
            $sqlEOE = mysql_query("SELECT Question, Answer FROM OpenEnded WHERE QuestionNum = '$q'");
            $infoEOE = mysql_fetch_assoc($sqlEOE);
            
            $Ques = $infoEOE['Question'];
            $Opt1 = $infoEOE['Opt1'];
            $Opt2 = $infoEOE['Opt2'];
            $Ansr = $infoEOE['Answer'];
            
            //echo $Ques;
            $insEOE = "INSERT INTO $Name (Question, Answer, QuizID) VALUES ('$Ques', '$Ansr', '$id')";
            $execEOE = mysql_query($insEOE, $con);
        }
    }
    
    for ($i=0; $i<$sizeM; $i++) {
        $q = $Quiz->Medium[$i];
        $sqlM = mysql_query("SELECT 1 as tbl FROM MultipleChoice WHERE Question = '$q' AND Difficulty = 'Medium' UNION SELECT 2 as tbl FROM TrueFalse WHERE Question = '$q' AND Difficulty = 'Medium' UNION SELECT 3 as tbl FROM OpenEnded WHERE Question = '$q' AND Difficulty = 'Medium' ");
        $infoM = mysql_fetch_assoc($sqlM);
        
        $tbl = $infoM['tbl'];
        
        if($tbl == '2') {
            $sqlMTF = mysql_query("SELECT Question, Opt1, Opt2, Answer FROM TrueFalse WHERE Question = '$q'");
            $infoMTF = mysql_fetch_assoc($sqlMTF);
            
            $Ques = $infoMTF['Question'];
            $Opt1 = $infoMTF['Opt1'];
            $Opt2 = $infoMTF['Opt2'];
            $Ansr = $infoMTF['Answer'];
            
            //echo $Ques." ".$Opt1." ".$Opt2." ".$Ansr;
            $insMTF = "INSERT INTO $Name (Question, Opt1, Opt2, Answer, QuizID) VALUES ('$Ques', '$Opt1', '$Opt2', '$Ansr', '$id')";
            $execMTF = mysql_query($insMTF, $con);
        }
        
        if($tbl == '1') {
            $sqlMMC = mysql_query("SELECT Question, Opt1, Opt2, Opt3, Opt4, Answer FROM MultipleChoice WHERE QuestionNum = '$q'");
            $infoMMC = mysql_fetch_assoc($sqlMMC);
            
            $Ques = $infoMMC['Question'];
            $Opt1 = $infoMMC['Opt1'];
            $Opt2 = $infoMMC['Opt2'];
            $Opt3 = $infoMMC['Opt3'];
            $Opt4 = $infoMMC['Opt4'];
            $Ansr = $infoMMC['Answer'];
            
            //echo $Ques." ".$Opt1." ".$Opt2." ".$Opt3." ".$Opt4." ".$Ansr;
            $insMMC = "INSERT INTO $Name(Question, Opt1, Opt2, Opt3, Opt4, Answer, QuizID) VALUES ('$Ques', '$Opt1', '$Opt2', '$Opt3', '$Opt4', '$Ansr', '$id')";
            $execMMC = mysql_query($insMMC, $con);
        }
        if($tbl == '3') {
            $sqlMOE = mysql_query("SELECT Question, Answer FROM OpenEnded WHERE QuestionNum = '$q'");
            $infoMOE = mysql_fetch_assoc($sqlMOE);
            
            $Ques = $infoMOE['Question'];
            $Opt1 = $infoMOE['Opt1'];
            $Opt2 = $infoMOE['Opt2'];
            $Ansr = $infoMOE['Answer'];
            
            //echo $Ques;
            $insMOE = "INSERT INTO $Name (Question, Answer, QuizID) VALUES ('$Ques', '$Ansr', '$id')";
            $execMOE = mysql_query($insMOE, $con);
        }
    }
    
    
    for ($i=0; $i<$sizeH; $i++) {
        $q = $Quiz->Hard[$i];
        $sqlH = mysql_query("SELECT 1 as tbl FROM MultipleChoice WHERE Question = '$q' AND Difficulty = 'Hard' UNION SELECT 2 as tbl FROM TrueFalse WHERE Question = '$q' AND Difficulty = 'Hard' UNION SELECT 3 as tbl FROM OpenEnded WHERE Question = '$q' AND Difficulty = 'Hard'");
        $infoH = mysql_fetch_assoc($sqlH);
        
        $tbl = $infoH['tbl'];
        
        if($tbl == '2') {
            $sqlHTF = mysql_query("SELECT Question, Opt1, Opt2, Answer FROM TrueFalse WHERE Question = '$q'");
            $infoHTF = mysql_fetch_assoc($sqlHTF);
            
            $Ques = $infoHTF['Question'];
            $Opt1 = $infoHTF['Opt1'];
            $Opt2 = $infoHTF['Opt2'];
            $Ansr = $infoHTF['Answer'];
            
            //echo $Ques." ".$Opt1." ".$Opt2." ".$Ansr;
            $insHTF = "INSERT INTO $Name (Question, Opt1, Opt2, Answer, QuizID) VALUES ('$Ques', '$Opt1', '$Opt2', '$Ansr', '$id')";
            $execHTF = mysql_query($insHTF, $con);
        }
        
        if($tbl == '1') {
            $sqlHMC = mysql_query("SELECT Question, Opt1, Opt2, Opt3, Opt4, Answer FROM MultipleChoice WHERE QuestionNum = '$q'");
            $infoHMC = mysql_fetch_assoc($sqlHMC);
            
            $Ques = $infoHMC['Question'];
            $Opt1 = $infoHMC['Opt1'];
            $Opt2 = $infoHMC['Opt2'];
            $Opt3 = $infoHMC['Opt3'];
            $Opt4 = $infoHMC['Opt4'];
            $Ansr = $infoHMC['Answer'];
            
            //echo $Ques." ".$Opt1." ".$Opt2." ".$Opt3." ".$Opt4." ".$Ansr;
            $insEMC = "INSERT INTO $Name(Question, Opt1, Opt2, Opt3, Opt4, Answer, QuizID) VALUES ('$Ques', '$Opt1', '$Opt2', '$Opt3', '$Opt4', '$Ansr', '$id')";
            $execEMC = mysql_query($insEMC, $con);
        }
        if($tbl == '3') {
            $sqlHOE = mysql_query("SELECT Question, Answer FROM OpenEnded WHERE QuestionNum = '$q'");
            $infoHOE = mysql_fetch_assoc($sqlHOE);
            
            $Ques = $infoHOE['Question'];
            $Opt1 = $infoHOE['Opt1'];
            $Opt2 = $infoHOE['Opt2'];
            $Ansr = $infoHOE['Answer'];
            
            //echo $Ques;
            $insHOE = "INSERT INTO $Name (Question, Answer, QuizID) VALUES ('$Ques', '$Ansr', '$id')";
            $execHOE = mysql_query($insHOE, $con);
        }
    } /*
    Echo "Quiz Created."
?>
