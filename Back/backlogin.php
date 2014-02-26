<?php
    $con = mysql_connect("sql.njit.edu","ovl2_proj","cs490");
    if(!$con) {
        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("ovl2_proj", $con);
   
    $request = file_get_contents('php://input');
    $recieve = json_decode($request);
    
    $User = $recieve->Username;
    $Pass = $recieve->Password;
    $Check = $recieve->Check;

   if ($Check == 'teacher') {
        
        $sql = mysql_query("SELECT COUNT(*) FROM TeacherLogin TL WHERE Teacher_ID = '$User' AND Teacher_PW = '$Pass'");
        $info = mysql_fetch_assoc($sql);
        $ver = $info['COUNT(*)'];
        
        if ($ver == 1) {
            session_start();
            $_SESSION['UserTC'] = $User;
            echo "teacher connected";
        }
        else {
            header ("Location: http://web.njit.edu/~ovl2/CS490/Front/login.html");
            echo "Invalid Login";
        }
    }
    
   if ($Check == 'student') {
        
        $sql = mysql_query("SELECT COUNT(*) FROM StudentLogin SL WHERE Student_ID = '$User' AND Student_PW = '$Pass'");
        $info = mysql_fetch_assoc($sql);
        $ver = $info['COUNT(*)'];
        
        if ($ver == 1) {
            session_start();
            $_SESSION['UserST'] = $User;
            echo "student connected";
        }
        else {
            header ("Location: http://web.njit.edu/~ovl2/CS490/Front/login.html");
            echo "Invalid Login";
        } 
    } 

    if ($Check == 'Login') {
        $reg = "INSERT INTO StudentLogin (Student_ID, Student_PW) VALUES ('$User', '$Pass')";
        $exec = mysql_query($reg, $con);
        header ("Location: http://web.njit.edu/~ovl2/CS490/Front/login.html");
    } 
?>
