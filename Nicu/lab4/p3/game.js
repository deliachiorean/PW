function Cell(val, rev) {
	this.value = val;
	this.revealed = rev;
	this.found = false;
}

function Game() {
	this.table = null;
	this.helper = null;
	this.state = {
		isRevealing: false,
		lastValue: null,

		lastPos: {
			x: null,
			y: null
		}
	}

	this.run = function() {
		this.generateNewTable();

		this.helper = new DocumentObjectHelper();
		this.addCellActions(this.table, this.helper.loadTableInDocument, this.state);
		this.helper.loadTableInDocument(this.table);
	
	}

	this.generateNewTable = function() {
		this.table = [];
		//init matrix
		for (var i = 0; i < 6; i++) {
			this.table[i] = [];
		}
		var numbers = this.getNumbersShuffled(50);
		var numberIndex = 0;
		for (var i = 0; i < 6; i++) {
			for (var j = 0; j < 6; j++) {
				this.table[i][j] = new Cell(numbers[numberIndex], false);
				numberIndex++;
			}
		}
	}

	//returns an array of numbers
	//each number has its pair
	//array is shuffled
	this.getNumbersShuffled = function(maxNum) {
		var numbers = [];
		for (var i = 0; i < 36 - 1; i += 2) {
			var randValue = Math.floor(Math.random() * maxNum);
			numbers[i] = randValue //place a random number
			numbers[i + 1] = randValue; //place pair
		}
		numbers = this.shuffle(numbers);
		return numbers;
	}

	this.shuffle = function(a) {
	    for (let i = a.length - 1; i > 0; i--) {
	        const j = Math.floor(Math.random() * (i + 1));
	        [a[i], a[j]] = [a[j], a[i]];
	    }
	    return a;
	}

	this.addCellActions = function(table, callback, state) {
		var tds = document.querySelectorAll("td");
		for (var i = 0; i < tds.length; i++) {
			tds[i].onclick = function() {
				var y = this.cellIndex;
				var x = this.parentNode.rowIndex;
				console.log("clicked " + x + ", " + y + " === " + table[x][y]);
				console.log("last value is " + state.lastValue);

				if (!state.isRevealing) {
					state.lastValue = table[x][y].value;
					state.lastPos.x = x;
					state.lastPos.y = y;
					table[x][y].revealed = true;
					state.isRevealing = true;
				} else {
					console.log(state.lastValue + " " + table[x][y].value);
					if (x !== state.lastPos.x || y !== state.lastPos.y) {
						
						if (state.lastValue !== table[x][y].value) {
							table[x][y].revealed = true;
							setTimeout(function() {
								table[state.lastPos.x][state.lastPos.y].revealed = false;
								table[x][y].revealed = false;
								callback(table);
							}, 1000);
							
						} else {
							table[state.lastPos.x][state.lastPos.y].revealed = true;
							table[x][y].revealed = true;
							table[state.lastPos.x][state.lastPos.y].found = true;
							table[x][y].found = true;
						}
						state.isRevealing = false;
					}
					
				}
				//table[x][y].revealed = true;
				callback(table);
			}
		}
	}

}

function DocumentObjectHelper() {
	this.loadTableInDocument = function(table) {
		var tds = document.querySelectorAll("td");
		var i = 0, j = 0;

		var tdIndex = 0;
		for (var i = 0; i < 6; i++) {
			for (var j = 0; j < 6; j++) {
				if (table[i][j].found) {
					tds[tdIndex].onclick = null;
					tds[tdIndex].style.backgroundColor = "green";
				}
				if (table[i][j].revealed) {
					tds[tdIndex].innerText = table[i][j].value;
				} else {
					tds[tdIndex].innerText = "?";
				}
				tdIndex++;
			}
		}
	};

	

}



window.onload = function() {
	var game = new Game();
	game.run();
}