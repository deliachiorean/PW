$(document).ready(function () {
   $.get("hall.php",function (data,status) {
       if (status==="success"){
            console.log(data);
            let obj=$.parseJSON(data);
            let arrayTimp=obj.timp;
            let arrayIncercari=obj.incercari;
            completareTabelTimp(arrayTimp);
            completareTabelIncercari(arrayIncercari);
       }
   });

    function completareTabelIncercari(arrayIncercari) {
        $("#bodyHallIncercari").append('<tr><td>'+arrayIncercari[0].nume+'</td><td>'+arrayIncercari[0].incercari+'</td><td>'+arrayIncercari[0].timp+'</td></tr>');
        $("#bodyHallIncercari").append('<tr><td>'+arrayIncercari[1].nume+'</td><td>'+arrayIncercari[1].incercari+'</td><td>'+arrayIncercari[1].timp+'</td></tr>');
        $("#bodyHallIncercari").append('<tr><td>'+arrayIncercari[2].nume+'</td><td>'+arrayIncercari[2].incercari+'</td><td>'+arrayIncercari[2].timp+'</td></tr>');
        $("#hallIncercari").tablesorter({debug: true});
    }
    function completareTabelTimp(arrayTimp) {
        $("#bodyHallTimp").append('<tr><td>'+arrayTimp[0].nume+'</td><td>'+arrayTimp[0].incercari+'</td><td>'+arrayTimp[0].timp+'</td></tr>');
        $("#bodyHallTimp").append('<tr><td>'+arrayTimp[1].nume+'</td><td>'+arrayTimp[1].incercari+'</td><td>'+arrayTimp[1].timp+'</td></tr>');
        $("#bodyHallTimp").append('<tr><td>'+arrayTimp[2].nume+'</td><td>'+arrayTimp[2].incercari+'</td><td>'+arrayTimp[2].timp+'</td></tr>');
        $("#hallTimp").tablesorter({ debug: true});
    }

});