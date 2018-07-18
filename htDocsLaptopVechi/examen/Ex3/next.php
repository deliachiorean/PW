<?php
    session_start();
    //pun pe sesiune indicele curent al intrebarilor de unde iau gen daca e la 0 sau la perechea 3-6
    if(!isset($_SESSION["nrSubmit"])){
        $_SESSION["nrSubmit"]=0;
    }
    //verific daca am citit deja intrebarile, iar daca le-am citit din bd, nu le iau iar ci doar returnez
    //intrebarile ce urmeaza
    $arrayQuestions=array();
    //cu  ok asta ma asigur ca nu intalnesc ceva baiuri cand citesc
    $ok=1;
    if(!isset($_SESSION["intrebari"]) || $_SESSION["nrSubmit"]===0){
        $conn =new mysqli("localhost", "root", "", "examen");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            $ok=0;
        }else{
            $sql="SELECT id,intrebare,r1,r2,r3,rc FROM intrebari ";
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            $stmt->bind_result($id,$intrebare,$r1,$r2,$r3,$rc);
            $i=0;
            while($stmt->fetch()){
                $question=new stdClass();
                $question->id=$id;
                $question->intrebare=$intrebare;
                $question->r1=$r1;
                $question->r2=$r2;
                $question->r3=$r3;
                $question->rc=$rc;
                array_push($arrayQuestions,$question);
            }
            shuffle($arrayQuestions);
            $_SESSION["intrebari"]=$arrayQuestions; 
        }
    }
    $i=$_SESSION["nrSubmit"];
    $allQuestions=$_SESSION["intrebari"];
    //creez un array cu intrebarile curente ce trebuiesc trimise
    $currentQuestions=array();
    $j=$i+3;
    while($i<$j){
        $x=count($allQuestions);
        if($i<count($allQuestions)){
            array_push($currentQuestions,$allQuestions[$i]);
        }
        $i++;
    }
    $_SESSION["nrSubmit"]=$i;

    $myJson=json_encode($currentQuestions);
    echo $myJson;
?>