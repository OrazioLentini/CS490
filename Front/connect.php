<?php
	$Username=$_POST['name'];
	$Password=$_POST['word'];
	$db = curl_init();
	curl_setopt($db, CURLOPT_URL, "http://web.njit.edu/~rab25");
	 curl_setopt($db, CURLOPT_POST, 1);
    //curl_setopt($db, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($db, CURLOPT_POSTFIELDS, "Username=$Username&Password=$Password");
    curl_setopt($db, CURLOPT_FOLLOWLOCATION, 1);
    
    $outputDB = curl_exec($db);
    curl_close($db);
?>
