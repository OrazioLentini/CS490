<?php 
    $Name = $_POST['quizname'];
    $MC = $_POST['multiplechoice'];
    $TF = $_POST['truefalse'];
    $OE = $_POST['openended'];
    
    $fields = json_encode(array('QuizName' => $Name, 'MultipleChoice' => $MC, 'TrueFalse' => $TF, 'OpenEnded' => $OE, 'FeedBack'=>'FeedBack'));
    //echo $fields;
    
    $crl = curl_init();
    //curl_setopt($crl, CURLOPT_URL, "http://web.njit.edu/~ovl2/CS490/Back/grade.php");
    curl_setopt($crl, CURLOPT_URL, "http://web.njit.edu/~rab25/CS490/Test/populate.php.php");
    curl_setopt($crl, CURLOPT_POST, 1);
    curl_setopt($crl, CURLOPT_POSTFIELDS, $Qus);
    curl_setopt($crl, CURLOPT_FOLLOWLOCATION, 1);
    
    $outputDB = curl_exec($crl);
    curl_close($crl);
    
?>