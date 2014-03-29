<?php
    session_start();
    include('sheader.php');
?>
    <h1></h1>
    <div class="create-content">
                <table border="1" cellpadding="1" cellspacing="0">
                    <?php
                        $request = file_get_contents('php://input');
                        $x = json_decode($request);

                        $sizeQuiz = Sizeof($x->Quiz);
                    ?>
                    <tr>
                        <th>&nbsp &nbsp</th><br />
                        <th>&nbsp Question &nbsp</th><br />
                        <th>&nbsp Option 1 &nbsp</th><br />
                        <th>&nbsp Option 2 &nbsp</th><br />
                        <th>&nbsp Option 3 &nbsp</th><br />
                        <th>&nbsp Option 4 &nbsp</th><br />
                        <th>&nbsp Answer &nbsp</th><br />
                        <th>&nbsp Your Answer &nbsp</th><br />
                        <th>&nbsp &nbsp</th><br />
                        <th>&nbsp Points Recieved &nbsp</th><br />
                    </tr>
                        <?php for($i=0; $i<$sizeQuiz; $i++) {
                            $qn = $x->Quiz[$i]->QuestionNum;
                            $q = $x->Quiz[$i]->Question;
                            $o1 = $x->Quiz[$i]->Opt1;
                            $o2 = $x->Quiz[$i]->Opt2;
                            $o3 = $x->Quiz[$i]->Opt3;
                            $o4 = $x->Quiz[$i]->Opt4;
                            $a = $x->Quiz[$i]->Answer;
                            $ya = $x->Quiz[$i]->YourAnswer;
                            $ci = $x->Quiz[$i]->CorInc;
                            $pr = $x->Quiz[$i]->PointRec;
                        ?>
                    <tr>
                        <td align="left"><pre><?php echo $qn;?></pre></td>
                        <td align="left"><pre><?php echo $q;?></pre></td>
                        <td align="left"><pre><?php echo $o1;?></pre></td>
                        <td align="left"><pre><?php echo $o2;?></pre></td>
                        <td align="left"><pre><?php echo $o3;?></pre></td>
                        <td align="left"><pre><?php echo $o4;?></pre></td>
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
