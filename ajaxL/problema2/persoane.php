<?php

?>

<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Persoane</title>
    <style>
        table
        {
            border: 1px solid black;
        }
        #lungime
        {
            color: white;
        }
    </style>
    <script>
        var p = 0, length = 0;
        show(p);
        function show(p) {
            var xmlhttp;
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function ()
            {
                if(xmlhttp.readyState == 4)
                {
                    if (xmlhttp.status == 200)
                    {
                         document.getElementById("pers").innerHTML = xmlhttp.responseText;
                         length = document.getElementById("lungime").innerHTML;
                    }
                }
            };
            xmlhttp.open('GET', 'tabel.php?' + 'persoana' + '=' + p);
            xmlhttp.send();
        }
        function next()
        {
            myFunctionRemovePrev();
            if(p < length - 1)
            {
                p = p + 3;
                show(p);
            }
            if(p == length - 1)
            {
               myFunctionSetNext();
            }
        }
        function prev()
        {
            if(p == 3)
            {
                myFunctionSetPrev();
            }
            if(p - 3 >= 0)
            {
                p = p - 3;
                show(p);
            }
            if(p < length - 1)
            {
                myFunctionRemoveNext();
            }

        }
        function myFunctionRemovePrev()
        {
            document.getElementById("prev").removeAttribute("disabled");
        }
        function myFunctionRemoveNext()
        {
            document.getElementById("next").removeAttribute("disabled");
        }
        function myFunctionSetPrev()
        {
            document.getElementById("prev").setAttribute("disabled","disabled");
        }
        function myFunctionSetNext()
        {
            document.getElementById("next").setAttribute("disabled","disabled");
        }
    </script>
</head>
<body>
<button id="prev" disabled="disabled" onclick="prev()">Previous</button>
<button id="next" onclick="next()">Next</button>
<br> <br>
<div id="pers">
</div>
</body>
</html>