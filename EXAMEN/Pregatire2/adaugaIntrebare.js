let xmlhttp;

let intrebareCurenta = -1;

function adaugaIntrebare() {
    xmlhttp = getXmlHttpObject();
    if (xmlhttp == null) {
        alert("Your browser does not support XMLHTTP!");
        return;
    }
    let intrebare=document.getElementById("inputIntrebare").value;

    let url = "adaugaIntrebare.php?intrebare="+intrebare;

    xmlhttp.onreadystatechange = stateChanged;
    xmlhttp.open("GET", url, true);
    xmlhttp.send(null);
}

function incarcareIntrebari() {
    xmlhttp = getXmlHttpObject();
    if (xmlhttp == null) {
        alert("Your browser does not support XMLHTTP!");
        return;
    }

    let url = "incarcareIntrebari.php";

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            //afisare intrebari
            let valori = JSON.parse(xmlhttp.responseText);
            let i;
            for (i=0; i<valori.length; i++){
                let content = "<div>"+valori[i][1]+" "+valori[i][2]+"<br><img src="+valori[i][3]+" alt=\"Avatar\" height=\"42\" width=\"42\"></div><br><button onclick='afisareRaspunsuri("+valori[i][4]+")' class=\"collapsible\">"+valori[i][0]+"</button><div style='padding-left:40px' id='divRaspuns" + valori[i][4] + "'></div>";
                $("#setColapsari").append( content );
            }
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send(null);
}

function adaugareRaspuns() {
    xmlhttp = getXmlHttpObject();
    if (xmlhttp == null) {
        alert("Your browser does not support XMLHTTP!");
        return;
    }

    let raspuns = document.getElementById("inputRaspuns").value;
    let url = "incarcareRaspuns.php";

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            afisareRaspunsuri(intrebareCurenta);
        }
    };
    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("id=" + intrebareCurenta + "&raspuns=" + raspuns);
}

function afisareRaspunsuri(idIntrebare){
    if (intrebareCurenta !== -1) {
        document.getElementById("divRaspuns" + intrebareCurenta).innerHTML="";
    }
    intrebareCurenta = idIntrebare;

    xmlhttp = getXmlHttpObject();
    if (xmlhttp == null) {
        alert("Your browser does not support XMLHTTP!");
        return;
    }


    let url = "afisareRaspunsuri.php?intrebare="+idIntrebare;

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            document.getElementById("divRaspuns" + intrebareCurenta).innerHTML = "";
            //afisare raspunsuri
            let valori = JSON.parse(xmlhttp.responseText);
            let i;
            for (i=0; i<valori.length; i++){
                let content = "<div style='border: 1px solid black'>"+valori[i][1]+" "+valori[i][2]+"<br><img src="+valori[i][3]+" alt=\"Avatar\" height=\"42\" width=\"42\">" + valori[i][0] + "</div>";
                document.getElementById("divRaspuns" + intrebareCurenta).innerHTML+=content;
            }
            let content = "<div>Raspuns nou:<br><input type='text' id='inputRaspuns'/><br><button onclick='adaugareRaspuns()'>Adauga raspuns</button></div>";
            document.getElementById("divRaspuns" + intrebareCurenta).innerHTML += content;
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send(null);
}

function stateChanged() {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
        //se executa cand se termina call-ul ajax catre php
        incarcareIntrebari();
    }
}

function getXmlHttpObject() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    }
    return null;
}

incarcareIntrebari();