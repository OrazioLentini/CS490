<?php
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    $Check = $_POST['Check'];
        
    $loginDB = curl_init();
    curl_setopt($loginDB, CURLOPT_URL, "http://web.njit.edu/~ovl2/CS490/Back/login.php");
    curl_setopt($logibDB, CURLOPT_POST, 1);
    curl_setopt($loginDB, CURLOPT_POSTFIELDS, "Username=$Username&Password=$Password&Check=$Check");
    curl_setopt($loginDB, CURLOPT_FOLLOWLOCATION, 1);
    
    $outLoginDB = curl_exec($loginDB);
    curl_close($loginDB); 
?>

 
