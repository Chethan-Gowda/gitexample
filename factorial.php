<?php
    $toGenerateFactorial = 5;
    $factorial =1;

    for($x = $toGenerateFactorial; $x>=1; $x--){
       $factorial = $factorial * $x;
    }
    echo "Factorial of $toGenerateFactorial is $factorial";  
?>
