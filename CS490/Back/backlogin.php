<?php
    session_start();
    include('theader.php');
?>
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
            
            print '<script type="text/javascript"> window.location = "teacher/teacher.php"</script>';
        } 
        else {
            //header ("Location: http://web.njit.edu/~ic35/CS490/login/login.php");
            //print '<div class="alert alert-danger"><strong>Bad Login</strong> Username or password is incorrect.</div>';
            print '<script type="text/javascript"> window.location = "login.php"</script>';

            /*print '<script type="text/javascript">'; 
            print 'alert("Invalid Username or Password")';
            print '</script>'; */
        } 
    }
    
   if ($Check == 'student') {
        
        $sql = mysql_query("SELECT COUNT(*) FROM StudentLogin SL WHERE Student_ID = '$User' AND Student_PW = '$Pass'");
        $info = mysql_fetch_assoc($sql);
        $ver = $info['COUNT(*)'];
        
        if ($ver == 1) {
            session_start();
            $_SESSION['UserST'] = $User;
            
            print '<script type="text/javascript"> window.location = "student/student.php"</script>';
        }
        else {
            //header ("Location: http://web.njit.edu/~ic35/CS490/login/login.php");
            print '<script type="text/javascript"> window.location = "login.php"</script>';
            //echo "Invalid Login";
        } 
    }
?>
