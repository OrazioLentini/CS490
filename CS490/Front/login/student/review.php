<?php
    session_start();
    include('sheader.php');
?>
    <h1>Review Quiz</h1>
    <div class="create-content" id="a">
                <table border="1" cellpadding="1" cellspacing="0">
                    <?php
                        $request = file_get_contents('php://input');
                        $x = json_decode($request);

                        $sizeQuiz = Sizeof($x->Quiz);
                    ?>
                    <tr>
                        <th>&nbsp &nbsp</th><br />
                        <th>&nbsp Question &nbsp</th><br />
                        <th>&nbsp Answer &nbsp</th><br />
                        <th>&nbsp Your Answer &nbsp</th><br />
                        <th>&nbsp &nbsp</th><br />
                        <th>&nbsp Points Recieved &nbsp</th><br />
                    </tr>
                        <?php for($i=0; $i<$sizeQuiz; $i++) {
                            $qn = $x->Quiz[$i]->QuestionNum;
                            $q = $x->Quiz[$i]->Question;
                            $a = $x->Quiz[$i]->Answer;
                            $ya = $x->Quiz[$i]->YourAnswer;
                            $ci = $x->Quiz[$i]->CorInc;
                            $pr = $x->Quiz[$i]->PointRec;
                        ?>
                    <tr>
                        <td align="left"><pre><?php echo $qn;?></pre></td>
                        <td align="left"><pre><?php echo $q;?></pre></td>
                        <td align="left"><pre><?php echo $a;?></pre></td>
                        <td align="left"><pre><?php echo $ya;?></pre></td>
                        <td align="left"><pre><?php echo $ci;?></pre></td>
                        <td align="left"><pre><?php echo $pr;?></pre></td>
                    </tr>
                    <?php } ?>
                </table>
    </div>


<?php
    include('../footer.html');
?>