var table = new Array(4);
var emptySlot = {
	x: 3,
	y: 3
};
//global variable

function shuffle(a) {
    for (let i = a.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [a[i], a[j]] = [a[j], a[i]];
    }
    return a;
}

function isWin() {
	var number = 1;
	for (var i = 0; i < 4; i++) {
		for (var j = 0; j < 4; j++) {
			if (i == 3 && j == 3) {
				number = 0;
			}
			if (table[i][j] != number) {
				return false;
			}
			number++;
		}
	}
	return true;
}

function generateInitialTable() {
	var numbers = [];
	for (var i = 0; i < 16; i++) {
		numbers[i] = i + 1;
	}
	numbers[15] = 0;
	shuffle(numbers);
	
	console.log(numbers);
	var current = 0;
	for (var i = 0; i < 4; i++) {
		table[i] = new Array(4);
		for (var j = 0; j < 4; j++) {
			table[i][j] = numbers[current];
			current++;
			if (table[i][j] == 0) {
				emptySlot.x = i;
				emptySlot.y = j;
			}
		}
	}
}

function setTableColors() {
	var tds = document.querySelectorAll("td");
	tds.forEach((td) => {
		var bg = "brown", text = "white";
		console.log(" <<"+ td.innerText +">>");
		if (td.innerText == "") {
			bg = "black";
		}
		td.style.backgroundColor = bg;
		td.style.color = text;

	});
}

function loadTableInDocument() {
	var tds = document.querySelectorAll("td");
	var i = 0, j = 0;

	//console.log(tds.length);
	for (var tdIndex = 0; tdIndex < tds.length; tdIndex++) {
		if (table[i][j] == 0) {
			tds[tdIndex].innerText = " ";	
		} else {
			tds[tdIndex].innerText = table[i][j];
		}
		j++;
		if (j >= 4) {
			//go next line
			j = 0;
			i++;
		}
	}
};

function upPressed() {
	if (emptySlot.x == 0) {
		document.querySelector("#errorMsg").innerText = "bad move";
	} else {
		[table[emptySlot.x][emptySlot.y], table[emptySlot.x - 1][emptySlot.y]] = 
		[table[emptySlot.x - 1][emptySlot.y], table[emptySlot.x][emptySlot.y]];
		emptySlot.x--;
		document.querySelector("#errorMsg").innerText = "";
	}
}


function downPressed() {
	if (emptySlot.x == 3) {
		document.querySelector("#errorMsg").innerText = "bad move";
	} else {
		[table[emptySlot.x][emptySlot.y], table[emptySlot.x + 1][emptySlot.y]] = 
		[table[emptySlot.x + 1][emptySlot.y], table[emptySlot.x][emptySlot.y]];
		emptySlot.x++;
		document.querySelector("#errorMsg").innerText = "";
	}

}


function leftPressed() {
	if (emptySlot.y == 0) {
		document.querySelector("#errorMsg").innerText = "bad move";
	} else {
		[table[emptySlot.x][emptySlot.y], table[emptySlot.x][emptySlot.y - 1]] = 
		[table[emptySlot.x][emptySlot.y - 1], table[emptySlot.x][emptySlot.y]];
		emptySlot.y--;
		document.querySelector("#errorMsg").innerText = "";
	}	
}


function rightPressed() {
	if (emptySlot.y == 3) {
		document.querySelector("#errorMsg").innerText = "bad move";
	} else {
		[table[emptySlot.x][emptySlot.y], table[emptySlot.x][emptySlot.y + 1]] = 
		[table[emptySlot.x][emptySlot.y + 1], table[emptySlot.x][emptySlot.y]];
		emptySlot.y++;
		document.querySelector("#errorMsg").innerText = "";
	}
}

function win() {
	alert("U WON LOL");
}

function handleKey(callback) {
	console.log("keypress");
	callback();
	loadTableInDocument();
	setTableColors();
	if (isWin()) {
		win();
	}
}

window.onload = () => {
	generateInitialTable();
	loadTableInDocument();
	setTableColors();
}

document.onkeydown = (key) => {
	if (key.key == "ArrowUp") {
		//arrow up pressed
		handleKey(downPressed);
	}

	if (key.key == "ArrowDown") {
		//arrow down pressed
		handleKey(upPressed);
	}

	if (key.key == "ArrowLeft") {
		//arrow left pressed
		handleKey(rightPressed);
	}

	if (key.key == "ArrowRight") {
		//arrow right pressed
		handleKey(leftPressed);
	}
}
