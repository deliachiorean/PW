$(document).ready(function(){
    function moveItems(origin, dest) {
    $(origin).find(':selected').appendTo(dest);
}



    $('#right').dblclick(function () {
        moveItems('#select2', '#select1');
    });

    $('#left').dblclick('click', function () {
        moveItems('#select1', '#select2');
    });

});



