let xmlhttp;

function incarcareCereri() {
    xmlhttp = getXmlHttpObject();
    if (xmlhttp == null) {
        alert("Your browser does not support XMLHTTP!");
        return;
    }

    let url = "afisareCereri.php";

    xmlhttp.onreadystatechange = stateChanged;
    xmlhttp.open("GET", url, true);
    xmlhttp.send(null);
}

function stateChanged() {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
        let valori = JSON.parse(xmlhttp.responseText);
        let table=document.getElementById("tabelCereri");
        table.innerHTML="";

        let row=table.insertRow(-1);
        let cellNrInregistrare=row.insertCell(-1);
        cellNrInregistrare.innerHTML="<b>Nr. inregistrare</b>";

        let cellDataEfectuare=row.insertCell(-1);
        cellDataEfectuare.innerHTML="<b>Data efectuare</b>";

        let cellEmail=row.insertCell(-1);
        cellEmail.innerHTML="<b>Email</b>";

        let cellTelefon=row.insertCell(-1);
        cellTelefon.innerHTML="<b>Telefon</b>";

        let cellStatus=row.insertCell(-1);
        cellStatus.innerHTML="<b>Status</b>";

        for (let i=0; i<valori.length; i++){
            let row = table.insertRow(-1);

            let cellNrInregistrare = row.insertCell(-1);
            cellNrInregistrare.innerHTML=valori[i][0];

            let cellDataEfectuare = row.insertCell(-1);
            cellDataEfectuare.innerHTML=valori[i][1];

            let cellEmail = row.insertCell(-1);
            cellEmail.innerHTML=valori[i][2];

            let cellTelefon = row.insertCell(-1);
            cellTelefon.innerHTML=valori[i][3];

            let cellStatus = row.insertCell(-1);
            if (valori[i][4]==="inAsteptare"){
                cellStatus.innerHTML="<img width='20' height='20' src='Resurse/inAsteptare.gif'/>";
            }
            if (valori[i][4]==="confirmata"){
                cellStatus.innerHTML="<img width='20' height='20'  src='Resurse/confirmata.png'/>";

            }
            if (valori[i][4]==="respinsa"){
                cellStatus.innerHTML="<img width='20' height='20'  src='Resurse/respinsa.png'/>";
            }
        }
    }
}

function getXmlHttpObject() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    }
    return null;
}

incarcareCereri();

setInterval(function(){
    incarcareCereri();
}, 5000);