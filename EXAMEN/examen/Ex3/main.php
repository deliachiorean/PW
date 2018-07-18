<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main</title>
	
</head>
<body>
    <script>
       (function() {
            <?php
                 session_start();
                 $_SESSION["timp"]=new DateTime();
                 if(!isset($_SESSION["nrSubmit"])){
                    session_unset(); 
                    session_destroy();
                 }
                if(!isset($_SESSION["nrSubmit"])){
                    $_SESSION["nrIntrebare"]=0;
                }else{
                    $_SESSION["nrIntrebare"]=$_SESSION["nrSubmit"];
                }
            ?>
        
            getNext();
            setInterval(function(){
                console.log("merge");
                var xhttp=new XMLHttpRequest();
                var formData = new FormData();
            
                var answers=[];
                var allInputs=document.getElementsByTagName("input");
                for(var i=0;i<allInputs.length;i++ ){
                    if(allInputs[i].type==="text"){
                        var myObj={
                            'camp':allInputs[i].name,
                            'value':allInputs[i].value
                        }
                        answers.push(myObj);
                    }
                    else if(allInputs[i].checked){
                        var myObj={
                            'idIntrebare':allInputs[i].className,
                            'answer':allInputs[i].value
                        };
                        answers.push(myObj);
                    }
                }
                xhttp.onreadystatechange=function () {
                    if (this.readyState == 4 && this.status == 200) {
                        window.location.replace("main.php");
                    }
                };
                xhttp.open("POST","submit.php",true);
                xhttp.setRequestHeader("Content-type", "application/json")
                var str_json = JSON.stringify(answers);
                xhttp.send(str_json);
                    },10000);
            })();

        function getNext(){
        
            var xhttp=new XMLHttpRequest();
            xhttp.onreadystatechange=function () {
                if (this.readyState == 4 && this.status == 200) {
                    var nrIntrebare=<?php  if(isset($_SESSION["nrIntrebare"])){echo $_SESSION["nrIntrebare"];}else{echo "0";} ?>;
                    var intrebari = JSON.parse(this.responseText);
                    var formular="<form onsubmit='return submitForm()'><div>";
                    if(nrIntrebare===0){
                        formular+="Nume<input type='text' placeholder='Enter name' name='nume' ><br><br>";
                        formular+="Email<input type='text' placeholder='Enter email' name='email'><br><br>"
                    }
                    var ok=0;
                    for(var i=0;i<intrebari.length;i++){
                        var intrebare=intrebari[i];
                        formular+=intrebare.intrebare+"<br><br>";
                        formular+=intrebare.r1+"<input class='"+intrebare.id+"' type='radio' name='"+i+"' value='"+intrebare.r1+"'"+"'><br><br>";
                        formular+=intrebare.r2+"<input class='"+intrebare.id+"' type='radio' name='"+i+"' value='"+intrebare.r2+"'"+"'><br><br>";
                        formular+=intrebare.r3+"<input class='"+intrebare.id+"' type='radio' name='"+i+"' value='"+intrebare.r3+"'"+"'><br><br>";
                        ok++;
                    }
                    
                    formular+="<input type='submit' value='Next'></div></form>";
                   
                         if(ok<3){
                            var formular="<form action='showCorrect.php' method='get'><div>";
                            for(var i=0;i<intrebari.length;i++){
                                var intrebare=intrebari[i];
                                formular+=intrebare.intrebare+"<br><br>";
                                formular+=intrebare.r1+"<input class='"+intrebare.id+"' type='radio' name='"+i+"' value='"+intrebare.r1+"'"+"'><br><br>";
                                formular+=intrebare.r2+"<input class='"+intrebare.id+"' type='radio' name='"+i+"' value='"+intrebare.r2+"'"+"'><br><br>";
                                formular+=intrebare.r3+"<input class='"+intrebare.id+"' type='radio' name='"+i+"' value='"+intrebare.r3+"'"+"'><br><br>";
                            }
                            formular+="<input type='submit' value='Finish'></div></form>";
                         }
                        document.body.innerHTML=formular;
                     }
                
            };
            xhttp.open("GET","next.php",true);
            xhttp.send();
        }

        function submitForm(){
            var xhttp=new XMLHttpRequest();
            var formData = new FormData();
        
            var answers=[];
            var allInputs=document.getElementsByTagName("input");
            for(var i=0;i<allInputs.length;i++ ){
                if(allInputs[i].type==="text"){
                    var myObj={
                        'camp':allInputs[i].name,
                        'value':allInputs[i].value
                    }
                    answers.push(myObj);
                }
                else if(allInputs[i].checked){
                    var myObj={
                        'idIntrebare':allInputs[i].className,
                        'answer':allInputs[i].value
                    };
                    answers.push(myObj);
                }
            }
            xhttp.onreadystatechange=function () {
                if (this.readyState == 4 && this.status == 200) {
                  return false;
                }
            };
            xhttp.open("POST","submit.php",true);
            xhttp.setRequestHeader("Content-type", "application/json")
            var str_json = JSON.stringify(answers);
            xhttp.send(str_json);
        }
    </script>
</body>
</html>