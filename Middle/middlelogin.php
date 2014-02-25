<?php
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    
    $url = "https://moodleauth00.njit.edu/cpip_serv/login.aspx?esname=moodle";
    $postfields = "__VIEWSTATE=%2FwEPDwUJNDIzOTY1MjU5ZGQdLVY%2B81xpmN0ATE7y41EHAhVaCA%3D%3D&txtUCID=".$Username."&txtPasswd=".$Password."&btnLogin=Login";        
    
    // BOUNCE TO NJIT TO CHECK STATUS
    $bounce = curl_init();
    curl_setopt($bounce, CURLOPT_URL, $url);
    curl_setopt($bounce, CURLOPT_POST, 1);
    curl_setopt($bounce, CURLOPT_POSTFIELDS, $postfields);
    curl_setopt($bounce, CURLOPT_RETURNTRANSFER, 1);
    
    $outputBounce = curl_exec($bounce);
    $check = curl_getinfo($bounce, CURLINFO_HTTP_CODE);
    curl_close($bounce);

    // SENDS POST TO BACKEND TO CHECK DATABASE

    $db = curl_init();
    curl_setopt($db, CURLOPT_URL, "http://web.njit.edu/~ovl2/CS490/Back/backlogin.php");
    curl_setopt($db, CURLOPT_POST, 1);
    //curl_setopt($db, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($db, CURLOPT_POSTFIELDS, "Username=$Username&Password=$Password&Check=$check");
    curl_setopt($db, CURLOPT_FOLLOWLOCATION, 1);
    
    $outputDB = curl_exec($db);
    curl_close($db);
?>

 
