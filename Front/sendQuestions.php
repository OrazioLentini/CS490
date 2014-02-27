<?php
	$Question = $_POST['Question'];
	$Opt1 = $_POST['Opt1'];
	$Opt2 = $_POST['Opt2'];
	$Opt3 = $_POST['Opt3'];
	$Opt4 = $_POST['Opt4'];
	$Answer = $_POST['Answer'];
	$Type = $_POST['Type'];
	
	$fields = array('Question' => $Question, 'Opt1' => $Opt1, 'Opt2' => $Opt2, 'Opt3' => $Opt3, 'Opt4' => $Opt4, 'Answer' => $Answer, 'Type' => $Type);
	$send = json_encode($fields);
	
	$crl = curl_init();
	curl_setopt($crl, CURLOPT_URL, "http://web.njit.edu/~ovl2/CS490/Middle/sendQuestions.php");
	//curl_setopt($crl, CURLOPT_URL, "http://web.njit.edu/~rab25/CS490/Middle/sendQuestions.php");
	curl_setopt($crl, CURLOPT_POST, 1);
	curl_setopt($crl, CURLOPT_POSTFIELDS, $send);
	curl_setopt($crl, CURLOPT_FOLLOWLOCATION, 1);

	$c = curl_exec($crl);
	curl_close($crl); 
?>
