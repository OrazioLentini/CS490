<?php
    $con = mysql_connect("sql.njit.edu","ovl2_proj","cs490");
    if(!$con) {
        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("ovl2_proj", $con);
    
    $sqlMC = mysql_query("SELECT Question, QuestionNum  FROM MultipleChoice");
    $sqlTF = mysql_query("SELECT Question, QuestionNum FROM TrueFalse");
    $sqlOE = mysql_query("SELECT Question, QuestionNum FROM OpenEnded");

    $MCquestions = array();
    $TFquestions = array();
    $OEquestions = array();
    
    while($mc = mysql_fetch_assoc($sqlMC)) {
            $MCquestions[] = $mc;
    }
    
    while($tf = mysql_fetch_assoc($sqlTF)) {
            $TFquestions[] = $tf;
    }
    
    while($oe = mysql_fetch_assoc($sqlOE)) {
            $OEquestions[] = $oe;
    }
    
    //echo json_encode($MCquestions);
    //echo json_encode($TFquestions);
    
    $Qus = json_encode(array('MultipleChoice' => $MCquestions, 'TrueFalse' => $TFquestions, 'OpenEnded' => $OEquestions));
    
    $crl = curl_init();
    curl_setopt($crl, CURLOPT_URL, "http://web.njit.edu/~ovl2/CS490/Front/getQuestions.php");
    curl_setopt($crl, CURLOPT_POST, 1);
    curl_setopt($crl, CURLOPT_POSTFIELDS, $Qus);
    curl_setopt($crl, CURLOPT_FOLLOWLOCATION, 1);
    
    $outputDB = curl_exec($crl);
    curl_close($crl);
?>
