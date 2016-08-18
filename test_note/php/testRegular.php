<?php
$regularExpression = $_POST['regularExpression'];  
$textContent = $_POST['textContent'];  
if (preg_match_all ($regularExpression, $textContent, $result)){  
    if ($result[2]){  
        $regexResult = $result[2];  
        echo json_encode($regexResult);  
    }  

}  