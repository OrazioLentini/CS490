<?php
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    
    //$fields = array('Username' => $Username, 'Password' => $Password);
    
    $url = "https://moodleauth00.njit.edu/cpip_serv/login.aspx?esname=moodle";
    $postfields = "__VIEWSTATE=%2FwEPDwUJNDIzOTY1MjU5ZGQdLVY%2B81xpmN0ATE7y41EHAhVaCA%3D%3D&txtUCID=".$Username."&txtPasswd=".$Password."&btnLogin=Login&__EVENTVALIDATION=%2FwEWBAK7zbGBDQLr9O%2BIBwK01ba%2BBAKC3IeGDOn1GTxupWw9xfJhOXrBSFX6INdC";        
    
    // BOUNCE TO NJIT TO CHECK STATUS
    $bounce = curl_init();
    curl_setopt($bounce, CURLOPT_URL, $url);
    curl_setopt($bounce, CURLOPT_POST, 1);
    curl_setopt($bounce, CURLOPT_POSTFIELDS, $postfields);
    curl_setopt($bounce, CURLOPT_RETURNTRANSFER, 1);
    
    $outputBounce = curl_exec($bounce);
    $check = curl_getinfo($bounce, CURLINFO_HTTP_CODE);
    curl_close($bounce);
    
    if($check == 302){
        //echo "Successful";
        
        $db = curl_init();
        curl_setopt($db, CURLOPT_URL, "http://web.njit.edu/~ovl2/CS490/Back/backlogin.php");
        curl_setopt($db, CURLOPT_POST, 1);
        curl_setopt($db, CURLOPT_POSTFIELDS, "Username=$Username&Password=$Password&hp=$check");
        curl_setopt($db, CURLOPT_FOLLOWLOCATION, 1);
    
        $outputDB = curl_exec($db);
    }
    else{
        //echo "Unsuccessful";
        
        $db = curl_init();
        curl_setopt($db, CURLOPT_URL, "http://web.njit.edu/~ovl2/CS490/Back/backlogin.php");
        curl_setopt($db, CURLOPT_POST, 1);
        curl_setopt($db, CURLOPT_POSTFIELDS, "Username=$Username&Password=$Password&hp=$check");
        curl_setopt($db, CURLOPT_FOLLOWLOCATION, 1);
    
        $outputDB = curl_exec($db);
    }
?>

 
