function incarcareProduse() {
    $.post("afisareProduse.php",
        {
            text: ""
        },
        function(result) {
            $("#divProduse").empty();
            let produse = JSON.parse(result);
            for (let i=0; i<produse.length; i++) {
                $("#divProduse").append("<div style='border: 1px solid black; margin-top: 10px; padding: 4px'>Id: " +
                 produse[i][0] + "<br>Nume: " + produse[i][1] + "<br>Descriere: " + produse[i][2] + "<br><button onclick='stergeProdus(" + 
                 produse[i][0] + ")'>Sterge produs</button></div>");
            }
        });
}

function stergeProdus(id) {
    $.ajax({url: "stergereProdus.php?id="+id, success: function(result){
        incarcareProduse();
    }});
}

$(function(){
    incarcareProduse();
});
