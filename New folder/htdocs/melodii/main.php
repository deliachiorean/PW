<!DOCTYPE html>
<html lang="en">
<head>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <title>Exercitiul 1</title>
    <style>
		#selectedCity{
			color:red;
			}
        #main {
            display: flex;
        }

        ol {
            width: 200px;
        }

        h3 {
            width: 200px;
			color: green;
        }
		h4 {
            width: 200px;
			color: blue;
        }
    </style>
	
</head>
<body>
<h1 id="selectedArtist">Selected artist:</h1>
<div class="container">
 
  <div class="panel-group">
    <div class="panel panel-default">
	<ul>
      <div class="panel-heading">
        <h4 class="panel-title">
         <ol id="Artisti">

        </ol>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse">
        <ol class="list-group" id="Piese"></ol>
      
      </div>
	  </ul>
    </div>
  </div>
</div>

</body>
<script>
    function showArtisti() {
       /* if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("Artisti").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "artisti.php?", true);
        xmlhttp.send();*/
		 //$(document).ready(function()
         $.ajax({type:"GET",url: "artisti.php", success: function(result){
            $("#Artisti").html(result);
        }});
    }

    showArtisti();

    function showPiese(artist) {
        document.getElementById("selectedArtist").innerHTML = "Selected city: " + artist;
        if (artist === "") {
            document.getElementById("Piese").innerHTML = "";
            return;
        }
        /*if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("Piese").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "piese.php?q=" + artist, true);
        xmlhttp.send();*/
		 $.ajax({type:"GET",url: "piese.php", data: {q: artist},success: function(result){
            $("#Piese").html(result);
        }});
    }
</script>
</html>