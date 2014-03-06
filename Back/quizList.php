<?php
    $con = mysql_connect("sql.njit.edu","ovl2_proj","cs490");
    if(!$con) {
        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("ovl2_proj", $con);
    
    $Quiz = mysql_query("SELECT QuizName, QuizID  FROM $QuizName WHERE QuizID = $QuizID");
    
    $listQuiz = array();
    
    while($q = mysql_fetch_assoc($Quiz)) {
            $listQuiz[] = $q;
    }
    
    $list = json_encode(array('Quizzes' => $listQuiz));
    echo $list;
    
    /*$crl = curl_init();
    //curl_setopt($crl, CURLOPT_URL, "http://web.njit.edu/~ovl2/CS490/Front/login.php");
    curl_setopt($crl, CURLOPT_URL, "http://web.njit.edu/~ic35/CS490/login/student/student.php");
    curl_setopt($crl, CURLOPT_POST, 1);
    curl_setopt($crl, CURLOPT_POSTFIELDS, $Qus);
    curl_setopt($crl, CURLOPT_FOLLOWLOCATION, 1);
    
    $outputDB = curl_exec($crl);
    curl_close($crl);*/
?>
