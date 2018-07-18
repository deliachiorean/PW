var start = 0;

function invalidGuess(imageId, descriptionId) {
	var image = document.getElementById(imageId);
	image.classList.remove("clicked");
	
	var description = document.getElementById(descriptionId);
	description.classList.remove("clicked");

	image.className += " invalid-guess";
	description.className += " invalid-guess";
	
	window.setTimeout(function(){
		image.classList.remove("invalid-guess");
		description.classList.remove("invalid-guess");
	}, 1250);
}


function isTableEmpty() {
	var rows = document.getElementById('guessTable').rows;
	for (var i = 0; i < rows.length; i++) {
	   if (rows[i].children[0].childNodes.length != 0 || rows[i].children[1].childNodes.length != 0) {
			return false;
	   }
	}
	
	return true;
}

function validGuess(imageId, descriptionId) {
	var image = document.getElementById(imageId);
	image.classList.remove("clicked");
	
	var description = document.getElementById(descriptionId);
	description.classList.remove("clicked");

	var table = document.getElementById("guessedTable");
	var row = table.insertRow(table.length);
	var cell1 = row.insertCell(0);
	var cell2 = row.insertCell(1); 
	
	image.remove();
	cell1.innerHTML = image.outerHTML;
	
	description.remove();
	cell2.innerHTML = description.innerHTML;
	
	if (isTableEmpty()) {
		var date = new Date();
		var duration = date.getTime() - start;
		
		var xhttp = new XMLHttpRequest();
		var postParams = "time=" + duration;

		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				if (xhttp.responseText == 'true') {
					document.getElementById("submitForm").style.display = '';
					document.getElementById("guessTime").value = duration;
					alert('Congrats, you are in the top 3! Submit your time!')
				} else {
					alert("Congrats, but you were not fast enough!");
				}
			}
		};
		
		xhttp.open("POST", "isGood.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(postParams);
	}
}

function isGuessCorrect(imageId, imageName, descriptionId, description) {
	var xhttp = new XMLHttpRequest();
	var postParams = "imageName=" + imageName + "&description=" + description;

	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			if (xhttp.responseText == 'valid') {
				validGuess(imageId, descriptionId);
			} else {
				invalidGuess(imageId, descriptionId);
			}
		}
	};
	
	xhttp.open("POST", "verifyGuess.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(postParams);
}

function imageClick(element) {
	var images = document.getElementsByClassName("guess-image");
	for(var i = 0; i < images.length; i++)
	{
	   images.item(i).classList.remove("clicked");
	}
	
	document.getElementById(element.id).className += " clicked";
	//var imagePath = element.src.substring(element.src.lastIndexOf('/') + 1);
		
	var descriptions = document.getElementsByClassName("guess-description");
	for(var i = 0; i < descriptions.length; i++)
	{
	   if (descriptions.item(i).classList.contains("clicked")) {
			isGuessCorrect(element.id,descriptions.item(i).id, descriptions.item(i).textContent);, //imagePath, descriptions.item(i).id, descriptions.item(i).textContent);
	   }
	}
}

function descriptionClick(element) {
	var descriptions = document.getElementsByClassName("guess-description");
	for(var i = 0; i < descriptions.length; i++)
	{
	   descriptions.item(i).classList.remove("clicked");
	}
	
	document.getElementById(element.id).className += " clicked";
	var description = element.textContent;
		
	var images = document.getElementsByClassName("guess-image");
	for(var i = 0; i < images.length; i++)
	{
	   if (images.item(i).classList.contains("clicked")) {
		   	//var imagePath = images.item(i).src.substring(images.item(i).src.lastIndexOf('/') + 1);
			isGuessCorrect(images.item(i).id,element.id, description);//, imagePath, element.id, description);
	   }
	}
}

function initialize() {
	var date = new Date();
	start = date.getTime();
}