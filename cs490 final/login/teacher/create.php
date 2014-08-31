<?php
    session_start();
    include('theader.php');
    include('addQuestion.php');
?>
<?php 
$msg = "";
if(isset($_GET['msg'])){
	$msg = $_GET['msg'];
}
?>

    <script src="../js/function.js"></script>
    <div class="create-content">
            <p><?php echo $msg; ?></p>
            <h2>What type of question would you like to create?</h2>
            <button onClick="choicetype('TF', 'MC', 'OE')">True/False</button>&nbsp;&nbsp;
            <button onClick="choicetype('MC', 'TF', 'OE')">Multiple Choice</button>&nbsp;&nbsp;
            <button onclick="choicetype('OE', 'MC', 'TF')">Open Ended</button>
    </div>
   
    <div class="content-create" id="TF">
            <h3>True or False</h3>
            <form action="../question/addQuestion.php" name="addQuestion" method="post">
                <b>Please type your new question here</b>
                <br />
    		<textarea id="TFQ" name="Question" style="width:400px;height:95px;"></textarea>
            <br />
            <br />
                <b>Please select whether true or false is the correct answer</b>
            <br />
                <label style="cursor:pointer;">
                    <input type="radio" name="Answer" value="True">
                </label>
                    <input type="text" id="Opt1" name="Opt1" value="True" readonly>&nbsp;
            <br />
   	    <br />
                <label style="cursor:pointer;">
                    <input type="radio" name="Answer" value="False">
                </label>
                    <input type="text" id="Opt2" name="Opt2" value="False" readonly>&nbsp;
            <br />
            <br />
	    <strong>Please select the difficulty of the question</strong>
                    <br />
                    <label style="cursor:pointer;">
                        <input type="radio" name="Diff" value="Easy">&nbsp;Easy&nbsp;
		    </label>
		    <label style="cursor:pointer;">
                        <input type="radio" name="Diff" value="Medium">&nbsp;Medium&nbsp;
		    </label>
		    <label style="cursor:pointer;">
                        <input type="radio" name="Diff" value="Hard">&nbsp;Hard &nbsp;
		    </label>
	    <br />
                <input type="hidden" value="TF" name="Type">
                <input type="submit" value="Add To Quiz">
            </form>
    </div>
    <div class="content-create" id="MC">
         	<h3>Multiple Choice</h3>
            <form action="../question/addQuestion.php" name="addQuestion" method="post">
                <b>Please type your new question here</b>
                    <br />
                <textarea id="MCQ" name="Question" style="width:400px;height:95px;"></textarea>
                    <br />
                    <br />
                <strong>Please create the first answer for the question</strong>
                    <br />
                    <label style="cursor:pointer;">
                        <input type="radio" name="Answer" value="A">&nbsp;A&nbsp;
                    </label>
                        <input type="text" id="Opt1" name="Opt1">
                    <br />
                    <br />
                <strong>Please create the second answer for the question</strong>
                    <br />
                    <label style="cursor:pointer;">
                        <input type="radio" name="Answer" value="B">&nbsp;B&nbsp;
                    </label>
                        <input type="text" id="Opt2" name="Opt2">
                    <br />
                    <br />
                <strong>Please create the third answer for the question</strong>
                    <br />
                    <label style="cursor:pointer;">
                        <input type="radio" name="Answer" value="C">&nbsp;C&nbsp;
                    </label>
                        <input type="text" id="Opt3" name="Opt3">
                    <br />
                    <br />
                <strong>Please create the fourth answer for the question</strong>
                    <br />
                    <label style="cursor:pointer;">
                        <input type="radio" name="Answer" value="D">&nbsp;D&nbsp;
                    </label>
                        <input type="text" id="Opt4" name="Opt4">
                    <br />
                    <br />
		    <strong>Please select the difficulty of the question</strong>
                    <br />
                    <label style="cursor:pointer;">
                        <input type="radio" name="Diff" value="Easy">&nbsp;Easy&nbsp;
		    </label>
		    <label style="cursor:pointer;">
                        <input type="radio" name="Diff" value="Medium">&nbsp;Medium&nbsp;
		    </label>
		    <label style="cursor:pointer;">
                        <input type="radio" name="Diff" value="Hard">&nbsp;Hard &nbsp;
		    </label>
                    <br />
                    <br />
		    <br />
                    <input type="hidden" value="MC" name="Type">
                    <input type="submit" value="Add To Quiz">
            </form>
    </div>
    <div class="content-create" id="OE">
            <h3>Open Ended</h3>
    	<form action="../question/addQuestion.php" name="addQuestion" method="post">
            <strong>Please type your new question here</strong>
            <br />
    		<textarea id="OEQ" name="Question" style="width:400px;height:95px;"></textarea>
            <br />
	    <br />
	     <b>Test Case:</b>
	    <textarea type="text" id="Opt1" name="Opt1" style="width:320px; min-height: 15px; max-height: none;"></textarea>
	    <br />
	    <strong>Please type the answer here</strong>
	    <br />
		<textarea id="OEA" name="Answer" style="width:400px; min-height: 100px; max-height: none;"></textarea>
   	    <br />
	    <strong>Please select the difficulty of the question</strong>
                    <br />
                     <label style="cursor:pointer;">
                        <input type="radio" name="Diff" value="Easy">&nbsp;Easy&nbsp;
		    </label>
		    <label style="cursor:pointer;">
                        <input type="radio" name="Diff" value="Medium">&nbsp;Medium&nbsp;
		    </label>
		    <label style="cursor:pointer;">
                        <input type="radio" name="Diff" value="Hard">&nbsp;Hard &nbsp;
		    </label>
		    <br />
                <input type="hidden" value="OE" name="Type">
                <input type="submit" value="Add To Quiz">
        </form>
	<br />
    </div>
    </div>
<?php
    include('../footer.html');
?>