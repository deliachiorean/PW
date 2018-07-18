<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>First page</title>
    
<style>
/* Style the Image Used to Trigger the Modal */
#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content, #caption { 
    animation-name: zoom;
    animation-duration: 0.6s;
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
</style>
</head>

<body id="body">
<div class="container">

	<div class="row">
	</div>
	<div id="rezultate"></div>
	<div>
		<p><a href='logout.php'>Logout</a></p>
	</div>
	
	
</div>
<script type="text/javascript">
loadCereri();
		function detaliaza(poza)
		{
			var modal = document.getElementById("myModal");
  
		  // Get the image and insert it inside the modal - use its "alt" text as a caption
		  //var id = 'myImg' + $j;
		  //var img = document.getElementById(id);
		  var modalImg = document.getElementById("img01");
		  var captionText = document.getElementById("caption");
		  //img.onclick = function(){
			  modal.style.display = "block";
			  modalImg.src = poza.src;
			  captionText.innerHTML = poza.alt;
			  //captionText.innerHTML = poza.getAttribute("alt");
		  //}
		  
		  // Get the <span> element that closes the modal
		  var span = document.getElementsByClassName("close")[0];
		  
		  // When the user clicks on <span> (x), close the modal
		  span.onclick = function() { 
			  modal.style.display = "none";
		  }
		}
		
		// Creem un apel AJAX 
		function loadCereri() {
			let toShow = "";
			let request = new XMLHttpRequest();
			let cereriContainer = document.getElementById('rezultate');
			request.onreadystatechange = function () {
				if (request.readyState === 4 && request.status === 200) {
					let row = JSON.parse(request.responseText);
					cereriContainer.innerHTML = '';
					$j=0;
					for (let i in row) {
						var myVar = 'myImg' + $j;
						img='<img id="myImg'+$j+'" src="'+row[i].poza+'" width="200" height="200" alt = "Username: '+row[i].first_name+' Gender: '+row[i].gender+ ' Email: '+row[i].email+' Mobile_no: '+row[i].mobile_no+'Picture: '+row[i].poza+ '" onclick="detaliaza(this)"' + '></br> ' + '<div id="myModal" class="modal"><span class="close">&times;</span><img class="modal-content" id="img01"><div id="caption"></div></div>';

						// Alcatuim elementele listei de afisare
						toShow = toShow + img;
						
						
						
						
						
						$j++;

						// console.log(res);
						// console.log(toShow);
						cereriContainer.innerHTML = toShow;
						
					}
				}
			};
			request.open('GET', 'getUsers.php', true);
			request.send();
		}

		// Apelul se realizeaza doar la incarcarea paginii 
		//loadCereri(document.getElementById("search"));

		// Setam un interval la care sa se realizeze apelul automat
		//setInterval(loadCereri, 5000);
</script>




</body>
</html>