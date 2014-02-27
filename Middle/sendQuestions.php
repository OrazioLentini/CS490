<?php
    $request = file_get_contents('php://input');

    $sendDB = curl_init();
    curl_setopt($sendDB, CURLOPT_URL, "http://web.njit.edu/~ovl2/CS490/Back/addQuestions.php");
    curl_setopt($sendDB, CURLOPT_POST, 1);
    curl_setopt($sendDB, CURLOPT_POSTFIELDS, $request);
    curl_setopt($sendDB, CURLOPT_FOLLOWLOCATION, 1);
    
    $DB = curl_exec($sendDB);
    curl_close($DB);  
?>

 
