function bubbleSortTable(id, row, dir) {
    var tbody = document.getElementById(id).children[0];
    var rows = tbody.children.length;
    var cols = tbody.children[row].children.length - 1;
    
    var swapped = true;
    do {
        swapped = false;
        
        for (var c = 1; c < cols; c++) {
            var CurrentCell, NextCell;
            
            if (rowIsNumeric(id, row)) {
                CurrentCell = parseInt(tbody.children[row].children[c].innerHTML);
                NextCell = parseInt(tbody.children[row].children[c + 1].innerHTML);
            } else {
                CurrentCell = tbody.children[row].children[c].innerHTML;
                NextCell = tbody.children[row].children[c + 1].innerHTML;
            }
            
            
            if (dir == 'asc' && CurrentCell > NextCell) {
                for (var r = 0; r < rows; r++) {
                    var temp = tbody.children[r].children[c].innerHTML;
                    tbody.children[r].children[c].innerHTML = tbody.children[r].children[c + 1].innerHTML;
                    tbody.children[r].children[c + 1].innerHTML = temp;
                }
                
                swapped = true;
            }
            else if (dir == 'desc' && NextCell > CurrentCell) {
                for (var r = 0; r < rows; r++) {
                    var temp = tbody.children[r].children[c + 1].innerHTML;
                    tbody.children[r].children[c + 1].innerHTML = tbody.children[r].children[c].innerHTML;
                    tbody.children[r].children[c].innerHTML = temp;
                }
                
                swapped = true;
            }
        }
    } while (swapped);
    if (dir == 'asc')
        tbody.children[row].children[0].setAttribute("onclick", "bubbleSortTable('" + id + "', " + row + ", 'desc');");
    else
        tbody.children[row].children[0].setAttribute("onclick", "bubbleSortTable('" + id + "', " + row + ", 'asc');");
}

function rowIsNumeric(id, row) {
    var tbody = document.getElementById(id).children[0];
    var cols = tbody.children[row].children.length - 1;
    
    for (var c = 1; c < cols; c++)
        if (! isNumeric(tbody.children[row].children[c].innerHTML))
            return false;
            
    return true;
}

function isNumeric(n) {
  return ! isNaN (parseFloat(n)) && isFinite (n);
}
