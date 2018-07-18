<?php


$conn = new mysqli("localhost","root","","trenuri");
if($conn->connect_error)
{
    die("Connection failed: " .$conn->connect_error);
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Trenuri</title>
    <style>
        table{
            border:1px solid black;
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
                         document.getElementById("plecare").innerHTML = xmlhttp.responseText;
                    }
                }
            };
            xmlhttp.open("GET","plecare.php",true);
            xmlhttp.send();
        }

        function afisareSosiri(p, s)
        {
            var request;
            var plecare = document.getElementById(p);
            var dest = document.getElementById(s);
            var statie = plecare.options[plecare.selectedIndex].value;
            request = new XMLHttpRequest();

            request.onreadystatechange = function()
            {
                if(request.readyState == 4)
                {

                    if (request.status == 200)
                    {
                        document.getElementById("sosire").innerHTML = request.responseText;

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
<body onload="show()">
<select id="plecare" name="plecare" onchange="afisareSosiri('plecare','sosire')">

</select>
<div id="sosire" >

</div>
<div id="a"></div>
</body>
</html>