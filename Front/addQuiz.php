<?php
session_start();

    $quizName = $_POST['quizName'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $MC = $_POST['multiplechoice'];
    $TF = $_POST['truefalse'];
    $OE = $_POST['openended'];
    
    $fields = json_encode(array('QuizName' => $quizName, 'StartDate' => $startDate, 'EndDate' => $endDate, 'MultipleChoice' => $MC, 'TrueFalse' => $TF, 'OpenEnded' => $OE));
    //echo $fields;
    
    $crl = curl_init();
    curl_setopt($crl, CURLOPT_URL, "http://web.njit.edu/~ovl2/CS490/Back/createQuiz.php");
    //curl_setopt($crl, CURLOPT_URL, "http://web.njit.edu/~rab25/CS490/Middle/addQuiz.php");
    curl_setopt($crl, CURLOPT_POST, 1);
    curl_setopt($crl, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($crl, CURLOPT_FOLLOWLOCATION, 1);

    $c = curl_exec($crl);
    curl_close($crl); 
?>
