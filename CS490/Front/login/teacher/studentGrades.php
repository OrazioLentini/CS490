<?php
    session_start();
    include('theader.php'); 
?>

<div class="create-content">
    <h1>Release Grades</h1>
    <form class="choice" action="http://web.njit.edu/~ovl2/CS490/Back/release.php" method="post">
                <input type="submit" value="Release Grades">
    </form>
</div>
<div class="create-content">

    <h1>Get Grades</h1>
    <form class="choice" action="http://web.njit.edu/~ovl2/CS490/Back/getStudentGrades.php" method="post">
                <input type="submit" value="Get Grades">
    </form>
</div>

</div>
<?php
    session_start();
    include('../footer.html')
?>
