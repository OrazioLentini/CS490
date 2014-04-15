<?php
    session_start();
    include('theader.php');
                        
    
?>
    <script src="../js/function.js"></script>
    <div class="create-content">
        <h1>Question Bank</h1>
            <form class="choice" action="../question/addQuiz.php" method="post">
               Quiz &nbspName: <input type="text" name="quizName" autocomplete="on" required/><br />
               Start  &nbspDate: <input type="date" name="startDate" placeholder="yyyy-mm-dd" /><br />
               End    &nbspDate: <input type="date" name="endDate" placeholder="yyyy-mm-dd" /><br />
                <table class="create-quiz" border="auto" cellpadding="auto" cellspacing="auto">
                <div class="create-content">
                        <h2>What type of question would you like to add into Quiz?</h2>
                        <button type="button" onClick="choicetype('TF', 'MC', 'OE')" return false>True/False</button>&nbsp;&nbsp;
                        <button type="button" onClick="choicetype('MC', 'TF', 'OE')" return false>Multiple Choice</button>&nbsp;&nbsp;
                        <button type="button" onclick="choicetype('OE', 'MC', 'TF')" return false>Short Answer</button>
                </div>
                </table>
                    <?php
                         $request = file_get_contents('php://input');
                        $x = json_decode($request);
                        $sizeMC = Sizeof($x->MultipleChoice);
                        $sizeTF = Sizeof($x->TrueFalse);
                        $sizeOE = Sizeof($x->OpenEnded);
                    ?>
                    <div class="content-create" id="MC">
                    <tr>
                        <th>Multiple Choice</th><br />
                    </tr>
                        <?php for($i=0; $i<$sizeMC; $i++) {
                            $n = $x->MultipleChoice[$i]->QuestionNum;
                            $q = $x->MultipleChoice[$i]->Question;
                            ?>
                    <tr>
                        <td align=left><pre><?php echo "<input id='choice' name='multiplechoice[]' type='checkbox' value=$n>"; echo " ".$n." "." ";  echo $q; ?></pre></td>
                    </tr>
                    <?php } ?>
                    </div>
                    <div class="content-create" id="TF">
                    <tr>
                        <th>True/False</th>
                    </tr>
                        <?php for($i=0; $i<$sizeTF; $i++) {
                             $n = $x->TrueFalse[$i]->QuestionNum;
                             $q = $x->TrueFalse[$i]->Question;
                            ?>
                    <tr>
                        <td align=left><pre><?php echo "<input id='choice' name='truefalse[]' type='checkbox' value=$n>"; echo " ".$n." "." "; echo $q; ?></pre></td>
                    </tr>
                    <?php } ?>
                    </div>
                    <div class="content-create" id="OE">
                    <tr>
                        <th>Open-End</th>
                    </tr>
                        <?php for($i=0; $i<$sizeOE; $i++) {
                            $n = $x->OpenEnded[$i]->QuestionNum;
                            $q = $x->OpenEnded[$i]->Question;
                            ?>
                    <tr>
                        <td align=left><pre><?php echo "<input id='choice' name='openended[]' type='checkbox' value=$n>"; echo " ".$n." "." "; echo $q; ?></pre></td>
                    </tr>
                    <?php } ?>
                    </div>
                <p></p>
               
                <input type="hidden" value="CQ" name="type">
                <input type="submit" value="Create a Quiz">
               
            </form>
    </div>
    </div>
<?php
    include('../footer.html');
?>