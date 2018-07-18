<?php   
    session_start();
    if(!isset($_SESSION["raspCorecte"])){
        $raspCorecte=array();
        $_SESSION["raspCorecte"]=$raspCorecte;
    }
    $startQuestionTime=$_SESSION["timp"];
    $currentDate=new DateTime();

    $diferenta=date_diff($currentDate,$startQuestionTime);
    if($diferenta->format("%s")>5 || $diferenta->format("%i")>5 || $diferenta->format("%h")>5 ){
        ;
    }else{
   
    $data = json_decode(file_get_contents('php://input'), true);
    for($i=0;$i<count($data);$i++){
        $obj=(object)$data[$i];
        if(isset($obj->idIntrebare)){
            $conn =new mysqli("localhost", "root", "", "examen");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                $ok=0;
            }else{
                $sql="select r1,r2,r3,rc from intrebari where id=?";
                $stmt=$conn->prepare($sql);
                $stmt->bind_param("i",$obj->idIntrebare);
                $stmt->execute();
                $stmt->bind_result($r1,$r2,$r3,$rc);
                $stmt->fetch();
                
                if($rc==1){
                    $x=$r1;
                }else if($rc==2){
                    $x=$r2;
                }else{
                    $x=$r3;
                }
                if($x===$obj->answer){
                    $raspCorecte=$_SESSION["raspCorecte"];
                    array_push($raspCorecte,$obj->idIntrebare);
                    $_SESSION["raspCorecte"]=$raspCorecte;
                }
            }
        }
    }}
    header("location: main.php");
?>