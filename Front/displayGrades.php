<?php
    session_start();
    include('sheader.php');
?>
    <h1>Quiz Grades</h1>
    <div class="create-content">
                <table border="1" cellpadding="1" cellspacing="0">
                    <?php
                        $request = file_get_contents('php://input');
                        $x = json_decode($request);

                        $sizeQuiz = Sizeof($x->Quizzes);
                    ?>
                    <tr>
                        <th>&nbsp Quiz Name &nbsp</th><br />
                        <th>&nbsp Questions Correct &nbsp</th><br />
                        <th>&nbsp Total Possible Points &nbsp</th><br />
                        <th>&nbsp Grade &nbsp</th><br />
                    </tr>
                        <?php for($i=0; $i<$sizeQuiz; $i++) {
                            $n = $x->Quizzes[$i]->QuizName;
                            $tc = $x->Quizzes[$i]->TotalCorrect;
                            $tp = $x->Quizzes[$i]->TotalPoints;
                            $g = $x->Quizzes[$i]->Grade;
                        ?>
                    <tr>
                        <td align="center"><pre><?php echo $n;?></pre></td>
                        <td align="center"><pre><?php echo $tc;?></pre></td>
                        <td align="center"><pre><?php echo $tp;?></pre></td>
                        <td align="center"><pre><?php echo $g;?></pre></td>
                    </tr>
                    <?php } ?>
                </table>
    </div>
<?php
    include('../footer.html');
?>
