<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "datepersonale";

$conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error)
{
    die("Connection failed: " .$conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Problema3</title>
    <style>
        div
        {
            width: 230px;
            display: inline-block;
        }
    </style>
    <script>
        function show() {
            var xmlhttp;
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function ()
            {
                if(xmlhttp.readyState == 4)
                {
                    if (xmlhttp.status == 200)
                    {
                        document.getElementById("info").innerHTML = xmlhttp.responseText;
                    }
                }
            };
            xmlhttp.open('GET', 'ShowCNP.php',true);
            xmlhttp.send();
        }
        function MoveInfoIntoTable(inf)
        {
            var xmlhttp;
            var informatie = document.getElementById(inf);
            var k = informatie.options[informatie.selectedIndex].value;
            xmlhttp = new XMLHttpRequest();
            //console.log(informatie.name);
            xmlhttp.onreadystatechange = function()
            {
                if(xmlhttp.readyState == 4)
                {

                    if (xmlhttp.status == 200)
                    {
                        //console.log(xmlhttp.responseText );
                        var array = eval ('(' + xmlhttp.responseText + ')');
                        //console.log("asdasd");
                        for(var i=0; i<array.cnp.length; i++)
                        {

                            document.getElementById("cnp").value = array.cnp[0];
                            document.getElementById("nume").value = array.cnp[1];
                            document.getElementById("prenume").value = array.cnp[2];
                            document.getElementById("telefon").value = array.cnp[3];
                            document.getElementById("oras").value = array.cnp[4];
                        }
                    }
                    else
                        alert('Eroare request.status: ' + xmlhttp.status);
                }
            };
            xmlhttp.open('GET', 'from.php?' + informatie.name + '=' + k);
            xmlhttp.send('');
            myFunction();
        }
        function updateInfo()
        {
            var xmlhttp;
            var cnp = document.getElementById("cnp").value;
            var nume = document.getElementById("nume").value;
            var prenume = document.getElementById("prenume").value;
            var telefon = document.getElementById("telefon").value;
            var oras = document.getElementById("oras").value;
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function()
            {
                if(xmlhttp.readyState == 4)
                {
                    if (xmlhttp.status == 200)
                    {
                       alert(xmlhttp.responseText);
                    }
                    else
                        alert('Eroare request.status: ' + xmlhttp.status);
                }
            };
            xmlhttp.open('GET', 'update.php?cnp=' + cnp + '&nume=' + nume + '&prenume=' + prenume + '&telefon=' + telefon + '&oras=' + oras);
            xmlhttp.send('');
        }
        function myFunction()
        {
            document.getElementById("save").removeAttribute("disabled");
        }
    </script>
</head>
<body onload="show()">
<div>
    <select id="info" name="info" size="6" onchange="MoveInfoIntoTable('info')"></select>
</div>
<div>
    <form action="from.php" method="get" name="formular">
        <label>CNP</label>
        <input type="text" id="cnp" name="cnp" disabled>
        <label>Nume</label>
        <input type="text" id="nume" name="nume">
        <label>Prenume</label>
        <input type="text" id="prenume" name="prenume">
        <label>Telefon</label>
        <input type="text" id="telefon" name="telefon">
        <label>Oras</label>
        <input type="text" id="oras" name="oras">
    </form>
    <button id="save" disabled="disabled" onclick="updateInfo()">Salveaza</button>
</div>
</body>
</html>
