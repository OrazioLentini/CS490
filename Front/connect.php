<?php
        $Username=$_POST['Username'];
        $Password=$_POST['Password'];

        $crl =curl_init();
        curl_setopt($crl, CURLOPT_URL,
        "http://web.njit.edu/~rab25/CS490/Middle/middlelogin.php");
        curl_setopt($crl, CURLOPT_POST, 1);
        curl_setopt($crl, CURLOPT_POSTFIELDS, "Username=$Username&Password=$Password");
        curl_setopt($crl, CURLOPT_FOLLOWLOCATION, 1);
        $crlm = curl_exec($crl);
        curl_close($crl);

?>
