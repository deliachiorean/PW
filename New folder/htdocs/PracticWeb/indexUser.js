let xmlhttp;

function inchidereDialog() {
    $("#dialog").dialog("close");
}

function incarcareProduse() {
    xmlhttp = getXmlHttpObject();
    if (xmlhttp == null) {
        alert("Your browser does not support XMLHTTP!");
        return;
    }

    let textCautat = $("#inputNumeProdus").val();
    let url = "afisareProduse.php";

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            let result = xmlhttp.responseText;
            $("#divProduse").empty();
            let produse = JSON.parse(result);
            /*for (let i = 0; i < produse.length; i++) {
                $("#divProduse").append("<div class='divProdus'>Nume: " + produse[i][1] + "</br></div>");
            }*/
            $("#inputNumeProdus").autocomplete({
                minLength: 0,
                source: produse,
                select: function(event, ui) {
                    $.ajax({url: "adaugareClick.php?id="+ui.item[0], method: "GET"});
                    $("#dialog").html("<div>" +
                                        "<img width='200' height='200' class='img' src='" + ui.item[6] + "'/>" +
                                      "</div>" +
                                      "<div>Nume: " + ui.item[1] + "</div>" +
                                      "<div>Descriere: " + ui.item[2] + "</div>" +
                                      "<div>Producator: " + ui.item[3] + "</div>" +
                                      "<div>Pret: " + ui.item[4] + " RON</div>" +
                                      "<div>Cantitate: " + ui.item[5] + " buc.</div>" +
                                      "<div id='chartContainer' style='height: 130px; width: 100%'></div>" +
                                      "<img src='x.svg' width='10' height='10' style='position: relative; left: 190px; top: 22px; z-index: 10' onclick='inchidereDialog()'/>");
                    $("#dialog").dialog("open");

                    $.ajax({
                        url: "afisarePopularitate.php?id="+ui.item[0], method: "GET", success: function(result) {
                            //let valori = [{x: 1, y: 1}, {x: 2, y: 2}];
                            let valori=[];
                            let rezultat = JSON.parse(result);
                            for (let i=0; i<rezultat.length; i++) {
                                valori.push({label: rezultat[i].split(" ")[1], y: (i + 1)});
                            }

                            let options = {
                                animationEnabled: true,
                                theme: "light2",
                                title:{
                                    text: "Popularitate"
                                },
                                axisX:{
                                    interval: 1
                                },
                                axisY: {
                                    title: "Click-uri",
                                    minimum: 0
                                },
                                toolTip:{
                                    shared:true
                                },
                                legend:{
                                    cursor:"pointer",
                                    verticalAlign: "bottom",
                                    horizontalAlign: "left",
                                    dockInsidePlotArea: true,
                                    itemclick: toogleDataSeries
                                },
                                data: [{
                                    type: "line",
                                    showInLegend: true,
                                    name: "Click-uri",
                                    markerType: "square",
                                    color: "#FF0000",
                                    dataPoints: valori
                                }]
                            };

                            $("#chartContainer").CanvasJSChart(options);
                        }
                    });

                    return false;
                }
            }).autocomplete("instance")._renderItem = function(ul,item) {
                return $("<li>")
                    .append("<table>" +
                                "<tr>" +
                                    "<td rowspan='2'><img width='50' height='50' src='" + item[6] + "'/></td>" +
                                    "<td>" + item[1] + "</td>" +
                                "</tr>" +
                                "<tr>" +
                                    "<td>" + item[4] + " RON</td>" +
                                "</tr>" +
                            "</table>")
                    .appendTo(ul);
            };
        }
    };
    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("text="+textCautat);
}

$(function(){
    incarcareProduse();
    $("#inputNumeProdus").on("input",incarcareProduse);
    $("#dialog").dialog({
        autoOpen: false,
        modal: true,
        height: 500,
        width: 500,
        show: {
            effect: "blind",
            duration: 500
        },
        hide: {
            effect: "blind",
            duration: 500
        }
    });
});

function getXmlHttpObject() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    }
    return null;
}

function toogleDataSeries(e){
    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
        e.dataSeries.visible = false;
    } else{
        e.dataSeries.visible = true;
    }
    e.chart.render();
}