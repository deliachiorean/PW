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
    <title>Tree View</title>
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
                        var array = eval('(' + xmlhttp.responseText + ')');
                        console.log(xmlhttp.responseText);
                        for(var i=0; i<array.tree.length; i+=3) {
                            if ( array.tree[i + 2] ==0) {
                                var ul = document.createElement('ul');
                                var li = document.createElement('li');
                                li.innerHTML = array.tree[i + 1];
                                li.id = array.tree[i];
                                ul.appendChild(li);
                                document.getElementById("lista").appendChild(ul);
                            }
                            else
                            {
                                    var ul2 = document.createElement('ul');
                                    var li2 = document.createElement('li');
                                    li2.innerHTML = array.tree[i+1];
                                    ul2.id = array.tree[i];
                                    ul2.appendChild(li2);
                                    document.getElementById(array.tree[i+2]).appendChild(ul2);
                            }
                        }
                    }
                }
            };

            xmlhttp.open('GET', 'show.php',true);
            xmlhttp.send();
        }
    </script>
</head>
<body onload="show()">
<div id="lista"></div>
</body>
</html>

