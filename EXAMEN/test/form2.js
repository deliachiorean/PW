$(document).ready(function () {
    let nrPers = 1;
    console.log(document.session);
    $("#add").click(function (event) {
        console.log("Click on add");
        let string = '<br> <input type="text" id="nume' + nrPers + '" name="nume[]" placeholder="Nume" >' +
            ' <input type="text" id="prenume' + nrPers + '"  name="prenume[]" placeholder="Prenume" >';
        $("#form").append(string);
        console.log(string);
        nrPers = nrPers + 1;
    });

    $("#delete").click(function () {
        // console.log("Click on delete");
        $('#nume' + nrPers).remove();
        $('#prenume' + nrPers).remove();
        if (nrPers > 1) nrPers = nrPers - 1;
    });
});