<?php
    session_start;
    include('sheader.php');

    $con = mysql_connect("sql.njit.edu","ovl2_proj","cs490");
    if(!$con) {
        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("ovl2_proj", $con);
    
    $Request = file_get_contents('php://input');
    $Quiz = json_decode($Request);
    
    $Name = $Quiz->QuizName;
    $User = 'User';
    
    $QuizName = $Name.$User;

    $result = mysql_query("SELECT Question, Opt1, Opt2, Opt3, Opt4, Answer, YourAnswer, CorInc, PointRec, QuestionNum FROM $QuizName");
    
    $list = array();
    
    while($q = mysql_fetch_assoc($result)) {
            $list[] = $q;
    }
    
    $x = json_encode(array('Quiz' => $list));

    $crl = curl_init();
    //curl_setopt($crl, CURLOPT_URL, "http://web.njit.edu/~rab25/CS490/Middle/getQuestions.php");
    curl_setopt($crl, CURLOPT_URL, "http://web.njit.edu/~ic35/CS490/login/student/review.php");
    //curl_setopt($crl, CURLOPT_URL, "http://web.njit.edu/~ovl2/CS490/login/student/review.php");
    curl_setopt($crl, CURLOPT_POST, 1);
    curl_setopt($crl, CURLOPT_POSTFIELDS, $x);
    curl_setopt($crl, CURLOPT_FOLLOWLOCATION, 1);
    
    $outputDB = curl_exec($crl);
    curl_close($crl);

?>