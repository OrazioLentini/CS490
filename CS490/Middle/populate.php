<?php

#this is the input that will be passed in a text area from the front end to myself
#just used a placeholder to make sure it works
#REPLACE THIS WITH THE INPUT FROM THE USER

$request = file_get_contents('php://input');
$x = json_decode($request);
$feedback = $x->FeedBack;
$OE = $x->OpenEnded;

#echo $feedback;
#echo $OE;


$output = $OE;

        #"
    	#	public static int output(int first, int second){
	#	int z = first + second;
	#	return z;
	#	
	#	}
	#	
	#	public static int output(int first, int second, int third){
	#	int z = ((first - second) - third);
	#	return z;
	#	
	#	}";
    
    
$file = "MyClass.java"; #this is the name of the predetermined java file, already populated with a class name.
$file2 = "ending.txt";
$error_output = "";
$java_output = "";
file_put_contents($file, $output, FILE_APPEND); #appends the input passed from the front end to the premade java file
$addition = file_get_contents($file2); #retrieves new code to perform "test"
file_put_contents($file, $addition, FILE_APPEND); #appends code to file to perform "test"
file_put_contents($file, "}", FILE_APPEND); #adds the extra closing brace that pairs up with the class name declaration
exec("javac MyClass.java"); #compiles the java code

$filetest = "MyClass.class"; 
if(file_exists($filetest) == true)
{
$java_output = shell_exec("java MyClass"); #echo the output of the java code. DON"T FORGET EXEC ONLY CAPTURES THE LAST LINE OF OUTPUT. I BELIEVE PASSTHRU CAPTURES IT ALL.
$new_output = explode(".", $java_output);
$grade = explode(":", $new_output[2]);

#echo $grade[1] will print the numeric grade. I believe it is stored as a string in an array.
    #not 100% sure, but it will affect any comparisons we do in order to establish a grade for the question.
    #tested, seems to be stored as an integer. should be able to export this number directly, or use it to calculate some grade.
#new_output[0] contains message explaining whether subtraction worked correctly or not.
#new_output[1] contains message explaining whether addition worked correctly or not.
    #can use the previous two values as feedback for the question. pass these values either way, since either way it explains
        #if a portion of the program was correct or not
#new_output[2] contains message explaining grade for the question (scale is either 0, 1, or 2 points, out of 2.)
    #meaning only possible percentages are 0, 50, or 100. Grades are given as intengers representing the percentage obtained.
    #this should probably be used more for a summary of the grade, as feedback. not in calculations.
#echo $java_output will output the entire string containing the informaton above. Not useful in this manner (I believe)
}

if(file_exists($filetest) != true) {
    $error_output = "Compilation error. 0 points were awarded.";
    $java_output = $error_output;
    $grade[1] = 0;
} #makes sure the class file was created aka checks compilation.

#error_output ONLY MATTERS WHEN compilation fails. otherwise the value is empty.
#changed the code so that if the java never compiles, it skips all of the calculations that then become irrelevant.


exec("cp -rf ./restore/MyClass.java ."); #copies the backup java file, containing only the class declaration, back into the main folder, in preparation for another student to take the exam
exec("rm MyClass.class"); #removes the class file created from a previous student taking the exam.
                            #had to change access rights for a lot of this stuff. previous line allows deletion of my files. risky stuff.
                            #for final project, don't forget to check and modify access rights 
    
#I don't know how to show you a listing of my directories, but it successfully appends to the file, compiles, runs, replaces the "correct" java file with the empty backup file, and removes the created class file.

#information I need to pass to you guys:
    #grade[1] contains their numberic grade, needed no matter what.
    #new_output[0] is FEEDBACK for the first part of the question.
    #new_output[1] is FEEDBACK for the second part of the question.
    #new_output[2] is OVERALL FEEDBACK for the question, simply stating their grade, in sentence form.
    #java_output outputs all new_output as one long string, which I separated into the separate parts. easier to work with.
    
    #if the above code never reaches compilation, none of these values are created, and should not be passed. In that case...
    #error_output explains that a compilation error was encountered, and 0 points will be awarded.
    #grade[1] will be then changed to reflect the compilation error, with 0 points for the question.
    
#still need to do:
    #receive input from the student taking the test. save it into first variable, $output
    #send relevant data to database for any necessary computations, saving, etc.
    #utilzing a try/catch block to test it, capturing any exceptions and flagging them. however, I can't think of any exceptions
        #that would be caught in order to test it. right now you basically get 100 or it doesn't compile. I can't think of
            #an example where it will compile but not give the right answer.
            
        $x->OpenEnded = $grade[1];
        $x->FeedBack = $java_output;
	$y = json_encode($x);
        #echo $y;
        
    $crl = curl_init();
    //curl_setopt($crl, CURLOPT_URL, "http://web.njit.edu/~ovl2/CS490/Front/login.php");
    curl_setopt($crl, CURLOPT_URL, "http://web.njit.edu/~ovl2/CS490/Back/grading.php");
    curl_setopt($crl, CURLOPT_POST, 1);
    curl_setopt($crl, CURLOPT_POSTFIELDS, $y);
    curl_setopt($crl, CURLOPT_FOLLOWLOCATION, 1);
    
    $outputDB = curl_exec($crl);
    curl_close($crl);

    
        
?>