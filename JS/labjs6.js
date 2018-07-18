var table = new Array(3);
var empty = {
	x: 2,
	y: 2
};
//global variable

function RandomArrangementsForTheNumbers(a) {
    for ( let i = a.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [a[i], a[j]] = [a[j], a[i]];
    }
    return a;
}



function InitialTable() {
	var numbers = [];
	for (var i = 0; i < 9; i++) {
		numbers[i] = i + 1;
	}
	numbers[8] = 0;
	RandomArrangementsForTheNumbers(numbers);
	
	console.log(numbers);
	var current = 0;
	for (var i = 0; i < 3; i++) {
		table[i] = new Array(3);
		for (var j = 0; j < 3; j++) {
			table[i][j] = numbers[current];
			current++;
			if (table[i][j] == 0) {
				empty.x = i;
				empty.y = j;
			}
		}
	}
}

function ColorTable() {
	var tds = document.querySelectorAll("td");
	tds.forEach((td) => {
		var bg = "white", text = "black";
		console.log(" <<"+ td.innerText +">>");
		if (td.innerText == "") {
			bg = "black";
		}
		td.style.backgroundColor = bg;
		td.style.color = text;

	});
}

function InitializeTable() {
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
		if (j >= 3) {
			//go next line
			j = 0;
			i++;
		}
	}
};

function UP() {
	if (empty.x == 0) {
		document.querySelector("#error").innerText = "You can't move that way. Try again!";
	} else {
		[table[empty.x][empty.y], table[empty.x - 1][empty.y]] = [table[empty.x - 1][empty.y], table[empty.x][empty.y]];
		empty.x--;
		document.querySelector("#error").innerText = "";
	}
}


function DOWN() {
	if (empty.x == 2) {
		document.querySelector("#error").innerText = "You can't move that way. Try again!";
	} else {
		[table[empty.x][empty.y], table[empty.x + 1][empty.y]] = [table[empty.x + 1][empty.y], table[empty.x][empty.y]];
		empty.x++;
		document.querySelector("#error").innerText = "";
	}

}


function LEFT() {
	if (empty.y == 0) {
		document.querySelector("#error").innerText = "You can't move that way. Try again!";
	} else {
		[table[empty.x][empty.y], table[empty.x][empty.y - 1]] = [table[empty.x][empty.y - 1], table[empty.x][empty.y]];
		empty.y--;
		document.querySelector("#error").innerText = "";
	}	
}


function RIGHT() {
	if (empty.y == 2) {
		document.querySelector("#error").innerText = "You can't move that way. Try again!";
	} else {
		[table[empty.x][empty.y], table[empty.x][empty.y + 1]] = [table[empty.x][empty.y + 1], table[empty.x][empty.y]];
		empty.y++;
		document.querySelector("#error").innerText = "";
	}
}
function Winning() {
	var number = 1;
	for (var i = 0; i < 3; i++) {
		for (var j = 0; j < 3; j++) {
			if (i == 2 && j == 2) {
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

function win() {
	alert("Congrats!");
}

function handleKey(callback) {
	console.log("keypress");
	callback();
	InitializeTable();
	ColorTable();
	if (Winning()) {
		win();
	}
}

window.onload = () => {
	InitialTable();
	InitializeTable();
	ColorTable();
}

document.onkeydown = (key) => {
	if (key.key == "ArrowUp") {
		//arrow up pressed
		handleKey(DOWN);
	}

	if (key.key == "ArrowDown") {
		//arrow down pressed
		handleKey(UP);
	}

	if (key.key == "ArrowLeft") {
		//arrow left pressed
		handleKey(RIGHT);
	}

	if (key.key == "ArrowRight") {
		//arrow right pressed
		handleKey(LEFT);
	}
}
