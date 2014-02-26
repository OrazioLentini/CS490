<?php
	$Username=$_POST['name'];
	$Password=$_POST['word'];
	$Check = $_POST['check'];
	
	$fields = array('Username' => $Username, 'Password' => $Password, 'Check' => $Check);
	$send = json_encode($fields);
	
	$crl = curl_init();
	//curl_setopt($crl, CURLOPT_URL, "http://web.njit.edu/~ovl2/CS490/Middle/middlelogin.php");
	curl_setopt($crl, CURLOPT_URL, "http://web.njit.edu/~rab25/CS490/Middle/middlelogin.php");
	curl_setopt($crl, CURLOPT_POST, 1);
	curl_setopt($crl, CURLOPT_POSTFIELDS, $send);
	curl_setopt($crl, CURLOPT_FOLLOWLOCATION, 1);

	$c = curl_exec($crl);
	curl_close($crl); 
?>
