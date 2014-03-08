Enter file contents here<?php
    session_start;
    include('sheader.php');
?>

<?php
    $con = mysql_connect("sql.njit.edu","ovl2_proj","cs490");
    if(!$con) {
        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("ovl2_proj", $con);
    
    $grd = mysql_query("SELECT QuizName, TotalCorrect, TotalPoints, Grade FROM Grades WHERE StudentID = '1' ORDER BY `Grades`.`QuizName` ASC");
    $info = mysql_fetch_assoc($grades);
    $id = $info['QuizID'];
    
    $quizGrades = array();
    
    while($qg = mysql_fetch_assoc($grd)) {
            $quizGrades[] = $qg;
    }
    
    $fields = json_encode(array('Quizzes' => $quizGrades));
    //echo $fields;
    
    $crl = curl_init();
    curl_setopt($crl, CURLOPT_URL, "http://web.njit.edu/~ovl2/CS490/Middle/getGrades.php");
    //curl_setopt($crl, CURLOPT_URL, "http://web.njit.edu/~ic35/CS490/login/student/displayGrade.php");
    curl_setopt($crl, CURLOPT_POST, 1);
    curl_setopt($crl, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($crl, CURLOPT_FOLLOWLOCATION, 1);
    
    $outputDB = curl_exec($crl);
    curl_close($crl); 
?>
