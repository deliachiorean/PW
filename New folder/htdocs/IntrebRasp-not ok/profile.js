let xmlhttp;
function retineCulori(){
	xmlhttp=getXmlHttpObject();
	if(xmlhttp==null){
		alert("yout browser does not support xmlhttp");
		return;
	}
	let scris=document.getElementById("scris").value;
	let background=document.getElementById("background").value;
	let font=document.getElementById("font").value;

	let url="retineCulori.php";
	xmlhttp.onreadystatechange=stateChanged;
	xmlhttp.open("POST",url,true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-forml-urlencoded")
	xmlhttp.send("scris="+ scris+"&background="+background+"&font="+font);
}

function schimbaParola(){
	xmlhttp=getXmlHttpObject();
	if(xmlhttp==null){
		alert("your browser does not support xmlhttp");
		return;
	}
	let parolaVeche=document.getElementById("parolaVeche").value;
	let parolaNoua=document.getElementById("parolaNoua").value;
	let url="schimbaParola.php";

	xmlhttp.onreadystatechange=stateChanged;
	xmlhttp.open("POST",url,true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-forml-urlencoded");
	xmlhttp.send("parolaVeche="+parolaVeche+"&parolaNoua="+parolaNoua);
}

function stateChanged(){
	if(xmlhttp.readyState===4 && xmlhttp.status===200){
		console.log(xmlhttp.responseText);
		alert("modificari realizate cu succes");
	}

}

function getXmlHttpObject(){
	if(window.XMLHttpRequest){
		return new XMLHttpRequest();
	}
	return null;
}
incarcaIntrebari();
