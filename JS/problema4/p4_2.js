function sortTable(table, column, reverse) {

    var table = table.tBodies[0];
	var tr = table.rows;
	var rowsArray = new Array();
	var i;
    for(i=0;i<tr.length;i++)
		rowsArray.push(tr[i]);
    

    if (!reverse) {
        reverse = 1;
    }
    else {
        reverse = -1;
    }

    rowsArray = rowsArray.sort(
        function (a, b) {
            return reverse * (a.cells[column].textContent.localeCompare(b.cells[column].textContent));
        }
    );

    for (i = 0; i < tr.length; i++) table.appendChild(rowsArray[i]);
}

function makeTableSortable(table) {
    var th = table.tHead.rows[0].cells;
    var i = th.length;

    while (i-- >= 0) {
        (function (i) {
            var rev = 1;
            th[i].addEventListener('click', function () { sortTable(table, i, (rev = 1 - rev)) });
        }(i));
    }
}

makeTableSortable(document.getElementById("fruitTabel"));