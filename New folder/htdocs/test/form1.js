let zborSelected;

function disableDates() {

}

function populareTabel(obj) {
    $.each(obj, function (index, value) {
        let string = '<tr><td>' + value.id + '</td><td>' + value.oras_plecare + '</td><td>' + value.oras_sosire + '</td>' +
            '<td>' + value.oraPlecare + '</td><td>' + value.oraSosire + '</td><td>' + value.ziSaptamana + '</td></tr>';
        $("#bodyTabel").append(string);
        // console.log(string);
    });
    $("#tabel tr").click(function (event) {
        let idRow = $(this).index();
        console.log(idRow);
        zborSelected = idRow;
        $("#idZbor").val($('#bodyTabel tr').eq(idRow)[0].children[0].textContent);
        console.log("Zbor id " + $("#idZbor").val());
        $(this).addClass("selected").siblings().removeClass("selected");
        let dateToday = new Date();
        $("#datepicker").datepicker(
            {
                minDate: new Date(),
                // beforeShowDay: disableDates
            }
        );

        $("#datepicker").change(
            function (event) {
                let dateZbor = new Date($(this).val());
                let zi = dateZbor.getDay();
                let ziZborTabel = $('#bodyTabel tr').eq(idRow)[0].children[5].textContent;
                if (zi != ziZborTabel) {
                    alert("Nu este disponibila ziua respectiva!");
                }
            }
        )
    });
}

$(document).ready(
    function () {
        $.get("getZboruri.php", function (data, status) {
            if (status === "success") {
                let obj = $.parseJSON(data);
                // console.log(obj);
                populareTabel(obj);
            }
        })
    }
);