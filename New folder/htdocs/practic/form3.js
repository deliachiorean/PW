let xmlhttp;

// function retineemail() {
//     xmlhttp = getXmlHttpObject();
//     if (xmlhttp == null) {
//         alert("Your browser does not support XMLHTTP!");
//         return;
//     }
//     let email=document.getElementById("email").value;

//     let url = "retineEmail.php";

//     xmlhttp.onreadystatechange = stateChanged;
//     xmlhttp.open("POST", url, true);
//     xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     xmlhttp.send("email="+email);
// }

function salveazaDatele(){
    xmlhttp=getXmlHttpObject();
    if(xmlhttp==null){
       alert("Your browser does not support XMLHTTP!");
        return;
    }

    let nume=document.getElementById("nume").value;
    let prenume=document.getElementById("prenume").value;
    let username=document.getElementById("username").value;
    let password=document.getElementById("password").value;
    let email=document.getElementById("email").value;
    let avatar=document.getElementById("avatar").value;

    let url= "retineDatele.php";

    xmlhttp.onreadystatechange = stateChanged;
    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("nume="+nume+"&prenume="+prenume+"&username="+username+"&password="+password+"&email="+email+"&avatar="+avatar);
}

function stateChanged() {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
        console.log(xmlhttp.responseText);
        //se executa cand se termina call-ul ajax catre php
        alert("Modificari realizate cu succes!");
    }
}

function getXmlHttpObject() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    }
    return null;
}

