<!DOCTYPE html>
<html>

<head>
	<title>Banca</title>
    <link rel="stylesheet" href="css/style.css" media="screen" title="no title" charset="utf-8">
	<script type="text/javascript" src="jquery-2.1.4.js"></script>
    <script src="tsorter.js" type="text/javascript"></script>
</head>
<body>

<p> Welcome, 
	<?php 
		session_start(); 
		$_DB_servername = "localhost";
$_DB_name = "examen1";
$_DB_username = "root" ;
$_DB_password = "";
$_URL_SITE= "http://localhost/tranzactii";
		if(!isset($_SESSION["username"]) || empty($_SESSION["username"]))
			header("Location: $_URL_SITE");
		echo $_SESSION["username"];
	?>! 
</p>

<p> <a href = "logout.php"> Logout </a> </p>
<p> Suma disponibila: <span id="sold"> 0 </span> Lei</p>
<p> Transer catre userii: 
	<ul id = "users">
	</ul>
</p>

<div id = "transferMoney">
    Suma transferata: 
    <input type = "number" name = "amount" id = "amount">
    <button id = "buttonTransfer"> Transfera </button>
    </form>
</div>

<p id = "transferResult"> </p>
<p> Tranzactii: 
	<table id="transactions">
		<thead>
			<th data-tsorter="numeric"> Id </th>
			<th> Utilizator sursa </th>
			<th> Utilizator destinatie </th>
			<th data-tsorter="numeric"> Suma </th>
			<th data-tsorter="date"> Data </th>
		</thead>
		<tbody>
			
		</tbody>
	</table>
</p>

<button id = "buttonDisplayTransations"> Afiseaza tranzactii</button>
<button onclick="location.href='displayTransactions.html'"> Afiseaza tranzactii in pagina noua</button>
<button id = "buttonDisplayTransationsDiv"> Afiseaza tranzactii Div</button>

<div id = "transactionsDiv">
    <p><a href="#" id="close">Close</a></p>

    <table id = "transactionsTableDiv">
        <thead>
            <th> Id </th>
            <th> Utilizator sursa </th>
            <th> Utilizator destinatie </th>
            <th> Suma </th>
            <th> Data </th>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</div>




<script type="text/javascript">
        // aici cod de jQuery

        function init() {
            var sorter = tsorter.create('transactions');
        }

        function init2() {
            var sorter = tsorter.create('transactionsTableDiv');
        }

        $('document').ready(function() {
            init();
            init2();
            function displaySold() {
                $.ajax({
                    url: "getSold.php",
                    dataType: 'json'
                    // dataType: 'text'
                })
                .done(function( data ) {
                    //console.log(data);
                    for (var i = 0; i < data.length; i++) {
                        $("#sold").empty().append(data[i].sold);
                    }
                });
            };

            function displayUsers() {
                $.ajax({
                    url: "getUsers.php",
                    dataType: 'json'
                    // dataType: 'text'
                })
                .done(function( data ) {
                    //console.log(data);
                    $("#users").empty();
                    for (var i = 0; i < data.length; i++) {
                        $("#users").append("<li id="+ data[i].id +">"+ data[i].username +"</li>");
                    }
                });
            };

            displaySold();
            displayUsers();

            function displayTransactions() {
                $.ajax({
                    url: "getTransactions.php",
                    dataType: 'json'
                    // dataType: 'text'
                })
                .done(function( data ) {
                    //console.log(data);
                    $("#transactions tbody").empty();
                    for (var i = 0; i < data.length; i++) {
                        $("#transactions tbody").append("<tr> <td>"+ data[i].id + "</td>" +
                                                "<td>"+ data[i].userSource + "</td>" +
                                                "<td>"+ data[i].userTarget + "</td>" +
                                                "<td>"+ data[i].amount + "</td>" +
                                                "<td>"+ data[i].date_time + "</td> </tr>" );
                    }
                });
            };

            function displayTransactionsDiv() {
                $.ajax({
                    url: "getTransactions.php",
                    dataType: 'json'
                    // dataType: 'text'
                })
                .done(function( data ) {
                    //console.log(data);
                    $("#transactionsTableDiv tbody").empty();
                    for (var i = 0; i < data.length; i++) {
                        $("#transactionsTableDiv tbody").append("<tr> <td>"+ data[i].id + "</td>" +
                                                "<td>"+ data[i].userSource + "</td>" +
                                                "<td>"+ data[i].userTarget + "</td>" +
                                                "<td>"+ data[i].amount + "</td>" +
                                                "<td>"+ data[i].date_time + "</td> </tr>" );
                    }
                });
            };

            
            $(document).on("click","#buttonDisplayTransations", function() {
                $("#transactions").css("display", "block");
                displayTransactions();
            });

            $(document).on("click","#buttonDisplayTransationsDiv", function() {
                $("#transactionsDiv").css("display", "block");
                displayTransactionsDiv();
            });

            $("#close").click(function(){
                $("#transactionsDiv").css("display", "none");
            });


            var currentID = -1;
            $(document).on("click","#users li", function() {
                currentID = parseInt(this.id);
                $("#transferMoney").css("display", "block");
                //console.log("din user: " + currentID);
            });

            $(document).on("click","#buttonTransfer", function() {
                //console.log("din button: " + currentID);
                if(currentID <= 0)
                    return false;
                    
                var sumaTransferata = -1;
                sumaTransferata = parseInt($("#amount").val(), 10);
                
                if(sumaTransferata <= 0)
                    return false;

                //console.log(sumaTransferata);
                $.ajax({
                    url: "transfer.php",
                    type: "post",
                    data: {"id": currentID, "amount": sumaTransferata},
                    dataType: 'text'
                })
                .done(function( data ) {
                    $("#transferResult").text(data);
                    $("#transferMoney").css("display", "none");
                    displaySold();
                });
                
            });

            $(document).on("click", "body", function(){
                $("#transferResult").empty();

            });


        }); // end -> document ready   
    </script>




</body>
</html>

