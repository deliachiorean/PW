let xmlhttp;

function schimbareParola() {
    let parolaVeche = document.getElementById("inputParolaVeche").value;
    let parolaNoua = document.getElementById("inputParolaNoua").value;

    xmlhttp = getXmlHttpObject();
    if (xmlhttp == null) {
        alert("Your browser does not support XMLHTTP!");
        return;
    }

    let url = "schimbareParola.php";

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            if (xmlhttp.responseText === "1") {
                document.getElementById("mesajDiv").innerHTML = "Parola a fost schimbata cu succes!";
            }
            else {
                document.getElementById("mesajDiv").innerHTML = "Parola incorecta!";
            }
        }
    };

    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("parolaVeche=" + parolaVeche + "&parolaNoua=" + parolaNoua);
}

function schimbareStil() {
    let culoareScris = document.getElementById("inputCuloareScris").value;
    let culoareFundal = document.getElementById("inputCuloareFundal").value;
    let font = document.getElementById("selectFont").value;

    xmlhttp = getXmlHttpObject();
    if (xmlhttp == null) {
        alert("Your browser does not support XMLHTTP!");
        return;
    }

    let url = "schimbareStil.php";

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            if (xmlhttp.responseText === "1") {
                document.getElementById("mesajDiv").innerHTML = "Stilul a fost schimbat cu succes!";
            }
            else {
                document.getElementById("mesajDiv").innerHTML = "Stilul nu a putut fi schimbat!";
            }
        }
    };

    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("culoareScris=" + culoareScris + "&culoareFundal=" + culoareFundal + "&font=" + font);
}

function getXmlHttpObject() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    }
    return null;
}