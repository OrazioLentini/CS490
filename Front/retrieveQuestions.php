<?php 
    $request = file_get_contents('php://input');
    $x = json_decode($request);

    $sizeMC = Sizeof($x->MultipleChoice);
    $sizeTF = Sizeof($x->TrueFalse);
    $sizeOE = Sizeof($x->OpenEnded);
    
    for ($i=0; $i<$sizeMC; $i++) {
        $n = $x->MultipleChoice[$i]->QuestionNum;
        $q = $x->MultipleChoice[$i]->Question;
        echo $n." ".$q."<br>";
    }
    
    echo "<br><br>";
    
    for ($i=0; $i<$sizeTF; $i++) {
        $n = $x->TrueFalse[$i]->QuestionNum;
        $q = $x->TrueFalse[$i]->Question;
        echo $n." ".$q."<br>";
    }
    
    echo "<br><br>";
    
    for ($i=0; $i<$sizeOE; $i++) {
        $n = $x->OpenEnded[$i]->QuestionNum;
        $q = $x->OpenEnded[$i]->Question;
        echo $n." ".$q."<br>";
    }
?>

// This is a way to print all the questions but you prob use javascript so you can add stuff
/* This is what the json file looks like that is sent to the front.
{
    "MultipleChoice": [
        {
            "Question": "What was the first browser developed in Java?",
            "QuestionNum": "1"
        },
        {
            "Question": "What is the ability of an Java application to perform multiple tasks at the same time?",
            "QuestionNum": "2"
        },
        {
            "Question": "What consist of data and methods?",
            "QuestionNum": "3"
        },
        {
            "Question": "Which is a multi way branch statement?",
            "QuestionNum": "4"
        },
        {
            "Question": "Which Operator is used to create an object?",
            "QuestionNum": "5"
        },
        {
            "Question": "A compiler converts the Java program into an intermediate language representation is called ____?",
            "QuestionNum": "6"
        },
        {
            "Question": "Assume that x = -7, the Java operator x = x means that the final value of x is?",
            "QuestionNum": "7"
        },
        {
            "Question": "In Java, 31 % 9 equals?",
            "QuestionNum": "8"
        },
        {
            "Question": "Which of the following is a relation operator in Java?",
            "QuestionNum": "9"
        },
        {
            "Question": "Java has the capability to handle?",
            "QuestionNum": "10"
        },
        {
            "Question": "Which is not a data structure in java?",
            "QuestionNum": "11"
        }
    ],
    "TrueFalse": [
        {
            "Question": "True or False: Java is both Compiled and Interpreted.",
            "QuestionNum": "1"
        },
        {
            "Question": "True or False: Java programs that are written to run on the World Wide Web are called Applets.",
            "QuestionNum": "2"
        },
        {
            "Question": "True or False: Java syntax is based on Fortran 77.",
            "QuestionNum": "3"
        },
        {
            "Question": "True or False: The Break statement is used inside the switch to terminate a Statement Sequence?",
            "QuestionNum": "4"
        },
        {
            "Question": "True or False: The earlier name of Java was Pine?",
            "QuestionNum": "5"
        },
        {
            "Question": "True or False: In java the scanner class is used for user input?",
            "QuestionNum": "6"
        }
    ],
    "OpenEnded": [
        {
            "Question": "Write a for loop that places a 1 at every index in a 2d array.",
            "QuestionNum": "1"
        }
    ]
}*/
