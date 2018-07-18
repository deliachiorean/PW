$(document).ready(function () {
    $.get("start.php", function (data, status) {
        if (status === "success") {
            obj = $.parseJSON(data);
            nivel = obj.nivel;
            console.log(obj);
            $("#rand").append('<td>' + obj.primaLitera + '</td>');
            $("#rand").append('<td></td>');
            $("#rand").append('<td></td>');
            if (nivel > 1) $("#rand").append('<td></td>');
            if (nivel > 2) $("#rand").append('<td></td>');
            $("#rand").append('<td>' + obj.ultimaLitera + '</td>');

            $("#nivel").text("Nivel: " + obj.nivel);
            $("#timp").text("Timp: " + obj.timp);
            $("#numarIncercari").text("Numar incercari: " + obj.nrIncercari);

            array=obj.litereGhicite;
            // console.log(array);
            completareLitereGhicite(array);
            if (obj.deGhicit===0 && obj.nivel===3){
                $(window).attr('location','numeHall.html');
            }
        }
    });

    $("#ghicesteLitera").click(function () {
        // console.log($("#litera").val());
        litera=$("#litera").val();
        $.get("start.php?litera="+litera, function (data, status) {
            //console.log(data);
            $("#litera").val("");
            location.reload();
        })
    });

    function completareLitereGhicite(array) {
        $.each(array, function (index, value) {
            console.log("Pozitie: "+value.pozitie);
            $("#rand td:nth-child("+(value.pozitie+1)+")").text(value.litera);
            //console.log($("#rand td:nth-child("+(value.pozitie+1)+")"));
        });
    }

    setTimeout(function () {
        $.get("time.php",function (data,status) {
            if (status==="success"){
                $("#timp").text("Timp: " + data);
                //location.reload();
            }
        })
    },1000);
});