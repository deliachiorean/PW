<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exercitiul 1</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="alineaza.css"/>
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
<table id="productsTable">
</table>
<!--form method="post"  enctype="multipart/form-data"-->
        <span for="nume">Denumire</span>
        <br/>
        <input name="nume" id="nume"  type="text">
        <br/>
	
		<span for="descriere">Descriere</span>
        <br/>
        <input name="descriere" id="descriere" type="text" >
		
		<br/>
        <!--input type="submit" id = "searchBtn" value="Cauta Produs"-->
		<input id="btn" type="button" value="Cauta Produs" />
		<!--button>Cauta Produs</button-->
		
<!--/form-->

<div id="main">
    <div id="From">
        <h3>Produse:</h3>
        <ol id="Departures">
        </ol>
    </div>
 
</div>

</body>
<script>



 
$(document).ready(function () {
    function list() {
        $.ajax({
            type: "GET",
            url: "list.php"
        })
            .done(function (data) {
                var products = JSON.parse(data);
                var content = "<tr><td>Nume</td><td>Descriere</td><td>Producator</td><td>Pret</td><td>Cantitate</td><td>Poza</td></tr>";
                for (let i = 0; i < products.length; i++) {
                    content += "<tr><td id='nume" + products[i].id + "'>" + products[i].nume + "</td>";
                    content += "<td id='descriere" + products[i].id + "'>" + products[i].descriere + "</td>";
                    content += "<td id='producator" + products[i].id + "'>" + products[i].producator + "</td>";
					 content += "<td id='pret" + products[i].id + "'>" + products[i].pret + "</td>";
                    content += "<td id='cantitate" + products[i].id + "'>" + products[i].cantitate + "</td>";
                   content += "<td id='poza"+ + products[i].id + "'>"+"<img src='"+ products[i].poza +">"+"</td></tr>";
                    
                   //  content += "<tr><td>" + products[i].nume + "</td>" + "<td>" + products[i].descriere + "</td>" + "<td>" + products[i].producator + "</td>" + "<td>" + products[i].pret + "</td>"+"<td>" + products[i].cantitate + "</td>"+
                   // "<td>"+"<img src='"+ products[i].poza +">"+"</td>"+ "</tr>";
                }
                $("table#productsTable").html(content);
            });
    }

	list();
});


/*	
$('#btn').click(function(){
		
		 <div class="modal-content">
            <span class="close-button">&times;</span>
            <h1>Hello, I am a modal!</h1>
        </div>
		
    });*/

//jquery+apel ajax jq
/*$('#btn').click(function(){
    //function showProdus() {
		var nume = $('#nume').val();
		var desc = $('#descriere').val();
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("Departures").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "searchProdus.php"+"?nume="+nume+"&descriere="+desc, true);
        xmlhttp.send();
		 $.ajax({url: "searchProdus.php"+"?nume="+nume+"&descriere="+desc,type:GET,dataType:'json' , success: function(result){
        $("#Departures").html(result);
    }});
	}
	);
*/
 

/*
//jquery+apel  ajax js
$('#btn').click(function(){
    //function showProdus() {
		var nume = $('#nume').val();
		var desc = $('#descriere').val();
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("Departures").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "searchProdus.php"+"?nume="+nume+"&descriere="+desc, true);
        xmlhttp.send();
	}
	);
*/
/*
$(document).ready(function() {
  $('#btn').click(function() {
    alert("Hello");
  });
});*/ 
   // showProdus();
</script>
</html>