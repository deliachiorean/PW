<?php
    session_start();
    $allQuestions=$_SESSION["intrebari"];
    $correctAnswers=$_SESSION["raspCorecte"];
    echo "<html><body>";
    echo "Scor:".count($correctAnswers)."/".count($allQuestions);
    echo "<br>Gresite:";
    for($i=0;$i<count($allQuestions);$i++){
        $ok=1;
        for($j=0;$j<count($correctAnswers);$j++){
            if(intval($allQuestions[$i]->id)===intval($correctAnswers[$j])){
                $ok=0;
                break;
            }
        }
        if($ok===1){
            echo "<br>".$allQuestions[$i]->intrebare;
            echo "<br>Raspuns corect:".$allQuestions[$i]->rc;
        }
    }
    echo "<br><a href='des.php'>Revin</a>";
    echo "</body></html>";
    $_SESSION["intrebari"]=shuffle($_SESSION["intrebari"]);
?>