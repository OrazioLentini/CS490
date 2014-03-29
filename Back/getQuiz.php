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
    
    $quizMC = mysql_query("SELECT Question, Opt1, Opt2, Opt3, Opt4, QuestionNum FROM `$Name` WHERE `Opt3` != '' AND `Opt4` != ''");
    $quizTF = mysql_query("SELECT Question, Opt1, Opt2, QuestionNum FROM `$Name` WHERE `Opt1` = 'True' AND `Opt2` = 'False'");
    $quizOE = mysql_query("SELECT Question FROM `$Name` WHERE Answer != 'A' AND Answer != 'B' AND Answer != 'C' AND Answer != 'D' AND Answer != 'True' AND Answer != 'False'");
    
    $MCquestions = array();
    $TFquestions = array();
    $OEquestions = array();
    
    while($mc = mysql_fetch_assoc($quizMC)) {
            $MCquestions[] = $mc;
    }
    
    while($tf = mysql_fetch_assoc($quizTF)) {
            $TFquestions[] = $tf;
    }
    
    while($oe = mysql_fetch_assoc($quizOE)) {
            $OEquestions[] = $oe;
    }
    
    
    $Quiz = json_encode(array('QuizName' => $Name, 'MultipleChoice' => $MCquestions, 'TrueFalse' => $TFquestions, 'OpenEnded' => $OEquestions));
    //echo $Quiz;
    
    $crl = curl_init();
    //curl_setopt($crl, CURLOPT_URL, "http://web.njit.edu/~ovl2/CS490/login/student/takeQuiz.php");
    curl_setopt($crl, CURLOPT_URL, "http://web.njit.edu/~ic35/CS490/login/student/takeQuiz.php");
    curl_setopt($crl, CURLOPT_POST, 1);
    curl_setopt($crl, CURLOPT_POSTFIELDS, $Quiz);
    curl_setopt($crl, CURLOPT_FOLLOWLOCATION, 1);
    
    $outputDB = curl_exec($crl);
    curl_close($crl); 
?>
