$(document).ready(function () {
    $("#submit").click(function () {
        console.log("click!!");
        console.log($("#username").val());
        console.log($("#password").val());
        $.post("admin.php",{
            "username": $("#username").val(),
            "password": $("#password").val()
        }, function (data, status) {
            if (data==1){
                $(window).attr('location','sprevalidare.php');
            }
            else {
                $(window).attr('location','admin.html');
            }
        });
    });

});