<?php 
        session_start();
	include ('header.php');
	include ('logincheck.php');
       
?>
        <div class="container">
            <div class="loginform">
                <form id="login" action='logincheck.php' method='post' accept-charset='UTF-8'>
                    <fieldset>
                        <h1>Log In</h1>
                        <input type='hidden' name='submitted' id='submitted' value='1' />
                
                        <label for='username'>Username:</label>
                        <input type='text' name='Username' id='Username' maxlength='50' autofocus= /><br />
                
                        <label for='password'>Password:</label>
                        <input type='password' name='Password' id='Password' maxlength='50' required/><br />
                
                        <label class='radio-inline'>
                        <input name="Check" class="Check" id='Check' type="radio" value="teacher" />Teacher
                        </label>
                        
                        <label class='radio-inline'>
                        <input name="Check" class="Check" id='Check' type="radio" value="student" />Student
                        </label>
                        <br />
                        <br />
                        <label class='button'>
                        <input type='submit' name='submit' value='Log In' />
                        </label>
                    </fieldset>
                </form>
            </div>
        </div>
<?php
    include('footer.html');
?>