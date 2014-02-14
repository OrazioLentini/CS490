<?php
    $con = mysql_connect("sql.njit.edu","ovl2_proj","EWzpulq1");
    if(!$con) {
        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("ovl2_proj", $con);
   
    $User = $_POST['Username'];
    $Pass = $_POST['Password'];
    $Bounce = $_POST['Check'];
    
    $sql = mysql_query("SELECT COUNT(*) FROM Login L WHERE Username = '$User' AND Password = '$Pass'");
    $info = mysql_fetch_assoc($sql);
    $ver = $info['COUNT(*)'];
    
    //echo $ver;
    if($Bounce == 302){
        $njit = 'SUCCESSFUL';
    }
    else{
        $njit = 'UNSUCCESSFUL';
    }
    
    if($ver == 1){
        $db = 'SUCCESSFUL';
    }
    else{
        $db = 'UNSUCCESSFUL';
    }
    
    printf ("NJIT Login: ");
    echo "<b>$njit</b>";
    echo "<br>";
    printf ("Project Login: ");
    echo "<b>$db</b>";
   

?>
