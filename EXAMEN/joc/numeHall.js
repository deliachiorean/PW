$(document).ready(function () {
    $("#addNume").click(function () {
        $.get("addHall.php?nume="+$("#nume").val(),function (data,status) {
            $(window).attr('location','hallOfFame.html');
        })
    })
});