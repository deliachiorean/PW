let xmlhttp;

let intrebareCurenta = -1;

afisareIntrebari();

function adaugareRaspuns() {
    // afisam raspunsurile intrebarii in div-ul curent
    xmlhttp = getXmlHttpObject();
    if (xmlhttp == null) {
        alert("Your browser does not support XMLHTTP!");
        return;
    }

    let raspuns = document.getElementById("inputRaspuns").value;
    let url = "adaugareRaspuns.php";

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            extindeIntrebare(intrebareCurenta);
        }
    };
    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("id="+intrebareCurenta+"&raspuns="+raspuns);
}

function extindeIntrebare(idIntrebare) {
    if (intrebareCurenta !== -1) {
        document.getElementById("divRaspuns" + intrebareCurenta).innerHTML="";
    }
    intrebareCurenta = idIntrebare;

    // afisam raspunsurile intrebarii in div-ul curent
    xmlhttp = getXmlHttpObject();
    if (xmlhttp == null) {
        alert("Your browser does not support XMLHTTP!");
        return;
    }

    let url = "afisareRaspunsuri.php?id="+intrebareCurenta;

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            let divRaspunsuri = document.getElementById("divRaspuns" + intrebareCurenta);
            divRaspunsuri.innerHTML = "";
            let valori = JSON.parse(xmlhttp.responseText);
            for (let i=0; i<valori.length; i++) {
                divRaspunsuri.innerHTML += "<div style='padding:2px'>" +
                                            "<div style=\"display: table-cell; vertical-align: middle;text-align: right;background-size: 100% 100%;height:200px;width:130px;background-image:url('"+valori[i][1] +"')\">" +
                                            valori[i][0] + "</div>" +
                                            "<div>" + valori[i][2] + " - added on " + valori[i][3] + "</div></div>" +
                                            "</div>";
            }
            divRaspunsuri.innerHTML += "<div>Adaugati un nou raspuns:<br/>" +

                                        "<input type='text' id='inputRaspuns'/><br/>" +
                                        "<button onclick='adaugareRaspuns()'>Adauga raspuns</button></div>";
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send(null);
}

function afisareIntrebari() {
    xmlhttp = getXmlHttpObject();
    if (xmlhttp == null) {
        alert("Your browser does not support XMLHTTP!");
        return;
    }

    let url = "afisareIntrebari.php";

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            let divIntrebari = document.getElementById("divIntrebari");
            divIntrebari.innerHTML = "";
            let valori = JSON.parse(xmlhttp.responseText);
            for (let i=0; i<valori.length; i++) {
                // div-ul intrebarii curente
                divIntrebari.innerHTML += "<div style='border:1px solid black'><div onclick='extindeIntrebare(" + valori[i][0] + ")'>" +
                                            "<div style=\"display: table-cell; vertical-align: middle;text-align: right;background-size: 100% 100%;height:200px;width:130px;background-image:url('"+valori[i][2] +"')\">" +
                                            valori[i][1] + "</div>" +
                                            "<div>" + valori[i][3] + " - added on " + valori[i][4] + "</div></div>" +
                                            "<div style='padding-left: 20px' id='divRaspuns" + valori[i][0] + "'></div>";

                // inchidem div-ul intrebarii
                divIntrebari.innerHTML += "</div>";
            }
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send(null);
}

function trimitereIntrebare() {
    let intrebare = document.getElementById("inputIntrebare").value;

    xmlhttp = getXmlHttpObject();
    if (xmlhttp == null) {
        alert("Your browser does not support XMLHTTP!");
        return;
    }

    let url = "adaugareIntrebare.php";

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            if (xmlhttp.responseText === "1") {
                document.getElementById("mesajDiv").innerHTML = "Intrebarea a fost adaugata cu succes!";
            }
            else {
                document.getElementById("mesajDiv").innerHTML = "Intrebarea nu a putut fi adaugata!";
            }
            afisareIntrebari();
        }
    };

    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("intrebare=" + intrebare);
}

function getXmlHttpObject() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    }
    return null;
}