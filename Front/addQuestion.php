<?php
	session_start();
	if(isset($_POST['Question'])){
		if(!isset($_POST['Answer']) || $_POST['Answer'] == ""){
			echo "Sorry, important data to submit your question is missing. Please press back in your browser and try again and make sure you select a corr_ans ans for the question.";
			exit();
		}
		if(!isset($_POST['Type']) || $_POST['Type'] == ""){
			echo "Sorry, there was an error parsing the form. Please press back in your browser and try again";
			exit();
		}

	
	$Question = $_POST['Question'];
	$Opt1 = $_POST['Opt1'];
	$Opt2 = $_POST['Opt2'];
	$Opt3 = $_POST['Opt3'];
	$Opt4 = $_POST['Opt4'];
	$Answer = $_POST['Answer'];
	$Type = $_POST['Type'];
        
	$fields = array('Question' => $Question, 'Opt1' => $Opt1, 'Opt2' => $Opt2, 'Opt3' => $Opt3, 'Opt4' => $Opt4, 'Answer' => $Answer, 'Type' => $Type);
	$send = json_encode($fields);

	
	
	if($Type == 'TF'){
		if((!$Question) || (!$Opt1) || (!$Opt2) || (!$Answer)){
			echo "Sorry, All fields must be filled in to add a new question to the quiz. Please press back in your browser and try again.";
			exit();
			}else{
				header('Location:http://web.njit.edu/~ic35/CS490/login/teacher/create.php');
			}
		}
	if($Type == 'MC'){
		if((!$Question) || (!$Opt1) || (!$Opt2) || (!$Opt3) || (!$Opt4) || (!$Answer)){
			echo "Sorry, All fields must be filled in to add a new question to the quiz. Please press back in your browser and try again.";
			exit();
		}else{
			header('Location:http://web.njit.edu/~ic35/CS490/login/teacher/create.php');
		}
		
	}
	if($Type == 'OE'){
		if((!$Question) || (!$Opt1) || (!$Answer)){
			echo "Sorry, All fields must be filled in to add a new question to the quiz. Please press back in your browser and try again.";
			exit();
		}else{
			header('Location:http://web.njit.edu/~ic35/CS490/login/teacher/create.php');
		}
	}
	
	$crl = curl_init();
	//curl_setopt($crl, CURLOPT_URL, "http://web.njit.edu/~ovl2/CS490/Back/addQuestions.php");
	curl_setopt($crl, CURLOPT_URL, "http://web.njit.edu/~rab25/CS490/Middle/sendQuestions.php");
	curl_setopt($crl, CURLOPT_POST, 1);
	curl_setopt($crl, CURLOPT_POSTFIELDS, $send);
	curl_setopt($crl, CURLOPT_FOLLOWLOCATION, 1);
	
	$c = curl_exec($crl);
	curl_close($crl);
	}
	

	
?>
