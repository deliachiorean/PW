<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trenuri";

$conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error)
{
    die("Connection failed: " .$conn->connect_error);
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Trenuri</title>
    <style>
        table{
            border:1px solid black;
        }
    </style>
    <script>
        $(document).ready(function() {
            var xmlhttp;
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function ()
            {
                if(xmlhttp.readyState == 4)
                {
                    if (xmlhttp.status == 200)
                    {
                        $("#plecare").html(xmlhttp.responseText);
                    }
                }
            };
            xmlhttp.open("GET","plecare.php",true);
            xmlhttp.send();
        });

        function afisareSosiri(s, p)
        {
            var request;
            var plecare = document.getElementById(s);
            var dest = document.getElementById(p);
            var statie = plecare.options[plecare.selectedIndex].value;
            request = new XMLHttpRequest();

            request.onreadystatechange = function()
            {
                if(request.readyState == 4)
                {

                    if (request.status == 200)
                    {
                        $("#sosire").html(request.responseText);
                    }
                    else
                        alert('Eroare request.status: ' + request.status);
                }
            };
            request.open('GET', 'sosire.php?' + plecare.name + '=' + statie);
            request.send('');
        }
    </script>
</head>
<body>
<select id="plecare" name="plecare" onchange="afisareSosiri('plecare','sosire')">

</select>
<div id="sosire" >

</div>
<div id="a"></div>
</body>
</html>