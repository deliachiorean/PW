$(document).ready(function () {
    $.get("getCuvinte.php", function (data, status) {
        if (status === "success") {
            let array = $.parseJSON(data);
            console.log(array);
            $.each(array, function (index, value) {
                $("#listaCuvinte").append('<li>' +value.cuvant + '</li>').append('<a href="deleteCuv.php?id='+value.id+'">Sterge</a>');
            });
        }
    });
    $("#addCuvant").click(function () {
        $.get("addCuvinte.php?cuvant="+$("#cuvant").val(),function (data,status) {
            if (status==="success"){
                alert("Cuvant adaugat cu succes!");
                location.reload();
                $("#cuvant").val("");
            }
        })
    })

});