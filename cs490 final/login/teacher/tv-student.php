<?php
    session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta name="description" content=""/>
	<meta name="author" content=""/>
	<link rel="shortcut icon" href="../../docs-assets/ico/favicon.png"/>
	<title>Online Quiz</title>
	<link href="../css/bootstrap.css" rel="stylesheet"/>
	<link href="../css/mainstyle.css" rel="stylesheet"/>
	<!--[if lt IE 9]>
	    <script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script>
	<![endif]-->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
	    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	    <script src="../js/function.js"></script>
    </head>
    <body>
	<div id="wrap">
	    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
		    <div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			    <span class="sr-only">Toggle navigation</span>
			    <span class="icon-bar"/>
			    <span class="icon-bar"/>
			    <span class="icon-bar"/>
			</button>
			    <a class="navbar-brand" href="../index.php">CS 490</a>
		    </div>
		    <div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
			    <li class="active">
				<a href="http://web.njit.edu/~ic35/CS490/login/teacher/tv-student.php">Student</a>
			    </li>
                            <li>
                                <a href="http://web.njit.edu/~ovl2/CS490/Back/quizList.php">Take Quiz</a>
                            </li>
                            <li>
                                <a href="http://web.njit.edu/~ic35/CS490/login/student/displayGrades.php">Grade</a>
                            </li>
			    <li>
				<a href="http://web.njit.edu/~ic35/CS490/login/logout.php">LogOut</a>
			    </li>
			</ul>
		    </div>
		</div>
	    </div>
	    <div class="container">
		 <div class="alert alert-success">
		    <b>Welcome Professor  <?php echo $Username ?>  !</b>
		</div>
		    <p>Hello Professor <?php echo $Username ?>,  this pages is how the student views on this online exam.</p>
                    <a type="button" href="teacher.php"> back to teacher page</a>
	    </div>
<?php
    include('../footer.html');
?>