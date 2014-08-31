<?php
            session_start();
            session_destroy();
		print "<h1> User Logout</h1>";
		print '<script> window.location = "http://web.njit.edu/~ic35/CS490/login/index.php"; </script>"';
?>