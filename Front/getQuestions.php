<?php /*
    $db = curl_init();
    curl_setopt($db, CURLOPT_URL, "http://web.njit.edu/~ovl2/CS490/Back/getQuestions.php");
    curl_setopt($db, CURLOPT_POST, 1);
    curl_setopt($db, CURLOPT_FOLLOWLOCATION, 1);
    
    $outputDB = curl_exec($db);
    curl_close($db); */
    
    $request = file_get_contents('php://input');
    $x = json_decode($request);

    //$y = $x->MultipleChoice[0]->Question;
    //print_r($y);
?>

