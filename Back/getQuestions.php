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
    
    echo json_encode(array('MultipleChoice' => $MCquestions, 'TrueFalse' => $TFquestions, 'OpenEnded' => $OEquestions));
?>
