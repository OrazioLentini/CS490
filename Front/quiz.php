<?php
    session_start();
    include('theader.php');
                        
    
?>
    <div class="create-content">
        <h1>Question Bank</h1>
            <form class="choice" action="../question/addQuiz.php" method="post">
                Quiz &nbspName: <input type="text" name="quizName" autocomplete="off" required/><br />
                Start  &nbspDate: <input type="date" name="startDate" placeholder="yyyy-mm-dd" required /><br />
                End    &nbspDate: <input type="date" name="endDate" placeholder="yyyy-mm-dd" required /><br />
                <table border="1" cellpadding="1" cellspacing="0">
                    <?php
                         $request = file_get_contents('php://input');
                        $x = json_decode($request);

                        $sizeMC = Sizeof($x->MultipleChoice);
                        $sizeTF = Sizeof($x->TrueFalse);
                        $sizeOE = Sizeof($x->OpenEnded);
                    ?>
                    <tr>
                        <th>Multiple Choice</th><br />
                    </tr>
                        <?php for($i=0; $i<$sizeMC; $i++) {
                            $n = $x->MultipleChoice[$i]->QuestionNum;
                            $q = $x->MultipleChoice[$i]->Question;
                        ?>
                    <tr>
                        <td align="left"><pre><?php echo "<input id='choice' name='multiplechoice[]' type='checkbox' value=$n>"; echo " ".$n." "." ";  echo $q; ?></pre></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <th>True/False</th>
                    </tr>
                        <?php for($i=0; $i<$sizeTF; $i++) {
                             $n = $x->TrueFalse[$i]->QuestionNum;
                             $q = $x->TrueFalse[$i]->Question;
                        ?>
                    <tr>
                        <td align="left"><pre><?php echo "<input id='choice' name='truefalse[]' type='checkbox' value=$n>"; echo " ".$n." "." "; echo $q; ?></pre></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <th>Open-End</th>
                    </tr>
                        <?php for($i=0; $i<$sizeOE; $i++) {
                            $n = $x->OpenEnded[$i]->QuestionNum;
                            $q = $x->OpenEnded[$i]->Question;
                            ?>
                    <tr>
                        <td align="left"><pre><?php echo "<input id='choice' name='openended[]' type='checkbox' value=$n>"; echo " ".$n." "." "; echo $q; ?></pre></td>
                    </tr>
                    <?php } ?>
                </table>
                <input type="hidden" value="CQ" name="type">
                <input type="submit" value="Create a Quiz">
            </form>
    </div>
<?php
    include('../footer.html');
?>
