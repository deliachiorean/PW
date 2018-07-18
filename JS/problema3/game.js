function Cell(val, rev) {
	this.value = val;
	this.revealed = rev;
	this.found = false;
}

function Game() {
	this.table = null;
	this.help = null;
	this.state = {
		isRevealing: false,
		lastValue: null,

		lastPos: {
			x: null,
			y: null
		},
		clickDisabled: false
	}

	this.run = function() {
		this.generateNewTable();

		this.help = new Casuta();
		this.addCellActions(this.table, this.help.loadTable, this.state);
		this.help.loadTable(this.table);
	
	}

	this.generateNewTable = function() {
		this.table = [];
		//init matrix
		for (var i = 0; i < 4; i++) {
			this.table[i] = [];
		}
		var numbers = this.getNumbersShuffled(24);
		var numberIndex = 0;
		for (var i = 0; i < 4; i++) {
			for (var j = 0; j < 4; j++) {
				this.table[i][j] = new Cell(numbers[numberIndex], false);
				numberIndex++;
			}
		}
	}

	//returneaza sirul de numere , fiecare cu o pereche si amestecate
	this.getNumbersShuffled = function(maxNum) {
		var numbers = [];
		for (var i = 0; i < 16 - 1; i += 2) {
			var randValue = Math.floor(Math.random() * maxNum);
			//nr aleator
			numbers[i] = randValue 
			//pereche
			numbers[i + 1] = randValue; 
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

	this.addCellActions = function(table, loadTable, state) {
		var tds = document.querySelectorAll("td");
		for (var i = 0; i < tds.length; i++) {
			tds[i].onclick = function() {
				if (!state.clickDisabled) {
					var y = this.cellIndex;
					var x = this.parentNode.rowIndex;
					
					if (!state.isRevealing) {
						//primul din pereche

						state.lastValue = table[x][y].value;
						state.lastPos.x = x;
						state.lastPos.y = y;
						table[x][y].revealed = true;
						state.isRevealing = true;
					} else {
						//verfifcam daca se potrivesc
						if (x !== state.lastPos.x || y !== state.lastPos.y) {
							
							if (state.lastValue !== table[x][y].value) {
								table[x][y].revealed = true;
								state.clickDisabled = true; 
								//dupa 2 secunde facem disable
								setTimeout(function() { 
									table[state.lastPos.x][state.lastPos.y].revealed = false;
									table[x][y].revealed = false;
									loadTable(table);
									state.clickDisabled = false;
								}, 2000);
								
							} else { 
								//am gasit corespondeta
								table[state.lastPos.x][state.lastPos.y].revealed = true;
								table[x][y].revealed = true;
								//marcam perechea ca gasita
								table[state.lastPos.x][state.lastPos.y].found = true;
								table[x][y].found = true;
							}
							
							state.isRevealing = false;
						}
						
					}
					
					loadTable(table);
				}
			}
		}
	}

	this.disableActions = function() {
		var tds = document.querySelectorAll("td");
		for (var i = 0; i < tds.length; i++) {
			tds[i].onclick = null;
		}
	}

}

function Casuta() {
	this.loadTable = function(table) {
		var tds = document.querySelectorAll("td");
		var i = 0, j = 0;

		var tdIndex = 0;
		for (var i = 0; i < 4; i++) {
			for (var j = 0; j < 4; j++) {
				if (table[i][j].found) {
					tds[tdIndex].onclick = null;
					
				}
				if (table[i][j].revealed) {
					console.log("url(\"./profi/prof\"" + table[i][j].value + ")");
					tds[tdIndex].style.backgroundImage = "url(\"fructe/fruct" + table[i][j].value + ".jpg\")";
					tds[tdIndex].style.backgroundColor = "transparent";
					tds[tdIndex].innerText = "";
				} else {
					tds[tdIndex].style.backgroundImage = "none";
					tds[tdIndex].style.backgroundColor = "teal";
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