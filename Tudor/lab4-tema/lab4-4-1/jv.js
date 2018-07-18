$(document).ready(function(){
    $("table tbody tr td:first-child").click(function(){
        var swapped = true;

        do {
            swapped = false;

            for (var c = 2; c <= $(this).parent().children().length - 1; c++) {
                var cellCurrValue = $(this).parent().children("td:nth-child(" + c + ")").text(),
                    cellNextValue = $(this).parent().children("td:nth-child(" + (c + 1) + ")").text();

                if ($.isNumeric(cellCurrValue))
                    cellCurrValue = parseInt (cellCurrValue);

                if ($.isNumeric(cellNextValue))
                    cellNextValue = parseInt (cellNextValue);

                // Ascending sort
                if (!$(this).hasClass("sorted-asc") &&
                    cellCurrValue > cellNextValue) {
                    for (var r = 1; r <= $(this).parent().parent().children().length; r++) {
                        var temp = $(this).parent().parent().children("tr:nth-child(" + r + ")").children("td:nth-child(" + c + ")").text();

                        $(this).parent().parent().children("tr:nth-child(" + r + ")").children("td:nth-child(" + c + ")").text(
                            $(this).parent().parent().children("tr:nth-child(" + r + ")").children("td:nth-child(" + (c + 1) + ")").text());

                        $(this).parent().parent().children("tr:nth-child(" + r + ")").children("td:nth-child(" + (c + 1) + ")").text(temp);
                    }

                    swapped = true;
                }
                // Descending sort
                else if (!$(this).hasClass("sorted-desc") && $(this).hasClass("sorted-asc") &&
                    cellCurrValue < cellNextValue) {
                    for (var r = 1; r <= $(this).parent().parent().children().length; r++) {
                        var temp = $(this).parent().parent().children("tr:nth-child(" + r + ")").children("td:nth-child(" + (c + 1) + ")").text();

                        $(this).parent().parent().children("tr:nth-child(" + r + ")").children("td:nth-child(" + (c + 1) + ")").text(
                            $(this).parent().parent().children("tr:nth-child(" + r + ")").children("td:nth-child(" + c + ")").text());

                        $(this).parent().parent().children("tr:nth-child(" + r + ")").children("td:nth-child(" + c + ")").text(temp);
                    }

                    swapped = true;
                }
            }
        } while (swapped);

        if ($(this).hasClass("sorted-asc"))
            $(this).removeClass("sorted-asc").addClass("sorted-desc");
        else
            $(this).removeClass("sorted-desc").addClass("sorted-asc");
    });
});
