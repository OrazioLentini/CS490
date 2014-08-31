<?php
    $con = mysql_connect("sql.njit.edu","ovl2_proj","cs490");
    if(!$con) {
        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("ovl2_proj", $con);
    
    $sql1 = mysql_query("SELECT 1 as tbl FROM MultipleChoice WHERE Question = 'Which Operator is used to create an object?' AND Difficulty = 'Easy' UNION SELECT 2 as tbl FROM TrueFalse WHERE Question = 'Which Operator is used to create an object?' AND Difficulty = 'Easy' UNION SELECT 3 as tbl FROM OpenEnded WHERE Question = 'Which Operator is used to create an object?' AND Difficulty = 'Easy' ");
        $info1 = mysql_fetch_assoc($sql1);
        
        $Ques = $info1['tbl'];
        
        if($Ques == '2') {
            echo '11';
        }
        if($Ques == '1') {
            echo '22';
        }
        if($Ques == '3') {
            echo '33';
        }
?>
        