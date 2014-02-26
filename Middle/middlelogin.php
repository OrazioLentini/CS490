<?php
    $request = file_get_contents('php://input');
    
    $loginDB = curl_init();
    curl_setopt($loginDB, CURLOPT_URL, "http://web.njit.edu/~ovl2/CS490/Back/backlogin.php");
    curl_setopt($logibDB, CURLOPT_POST, 1);
    curl_setopt($loginDB, CURLOPT_POSTFIELDS, $request);
    curl_setopt($loginDB, CURLOPT_FOLLOWLOCATION, 1);
    
    $outLoginDB = curl_exec($loginDB);
    curl_close($loginDB);  
?>

 
