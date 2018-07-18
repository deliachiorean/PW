<!DOCTYPE html>
<html lang="en">
<head>
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
<div id="main">
    <div id="From">
        <h3>Artisti:</h3>
        <ol id="Artisti">

        </ol>
    </div>
    <div id="To">
        <h4>Piese:</h4>
        <ol id="Piese">
        </ol>
    </div>
</div>
</body>
<script>
    function showArtisti() {
        if (window.XMLHttpRequest) {
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
        xmlhttp.send();
    }

    showArtisti();

    function showPiese(artist) {
        document.getElementById("selectedArtist").innerHTML = "Selected city: " + artist;
        if (artist === "") {
            document.getElementById("Piese").innerHTML = "";
            return;
        }
        if (window.XMLHttpRequest) {
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
        xmlhttp.send();
    }
</script>
</html>