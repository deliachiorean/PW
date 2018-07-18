let xmlhttp;

function incarcaCereri() {
    xmlhttp = getXmlHttpObject();
    if (xmlhttp == null) {
        alert("Your browser does not support XMLHTTP!");
        return;
    }

    let url = "valideaza.php";

    xmlhttp.onreadystatechange = stateChanged;
    xmlhttp.open("GET", url, true);
    xmlhttp.send(null);
}

function confirmaCerere(id) {
    xmlhttp = getXmlHttpObject();
    if (xmlhttp == null) {
        alert("Your browser does not support XMLHTTP!");
        return;
    }

    let url = "confirmaCerere.php?id="+id;


    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            incarcaCereri();
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send(null);
}

function respingeCerere(id) {
    xmlhttp = getXmlHttpObject();
    if (xmlhttp == null) {
        alert("Your browser does not support XMLHTTP!");
        return;
    }

    let url = "respingeCerere.php?id="+id;

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            console.log("AICI");
            incarcaCereri();
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send(null);
}

function stateChanged() {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
        let divCereri=document.getElementById("cereri");
        divCereri.innerHTML=xmlhttp.responseText;
    }
}

function getXmlHttpObject() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    }
    return null;
}

incarcaCereri();