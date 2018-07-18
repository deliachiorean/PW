class Fruit {
	constructor(name, price, qnt) {
		this.name = name;
		this.price = price;
		this.quantity = qnt;
	}
}

class Table {
	constructor(id, fruits) {
		this.id = id;
		this.fruits = fruits;
		this.ascending = true; // true if table needs to be sorted in ascending order, false else
	}
}

let tables = [];

function sortFruits(tableId, criteria) {
	let compareFunction = null;
	let table = findTable(tableId);
	if (table.ascending) {
		if (criteria === "Fructe") {
			compareFunction = (f1, f2) => { return f1.name > f2.name; };
		} else if (criteria === "Pret") {
			compareFunction = (f1, f2) => { return f1.price > f2.price; };
		} else {
			compareFunction = (f1, f2) => { return f1.quantity > f2.quantity; };
		}
	} else {
		if (criteria === "Fructe") {
			compareFunction = (f1, f2) => { return f1.name < f2.name; };
		} else if (criteria === "Pret") {
			compareFunction = (f1, f2) => { return f1.price < f2.price; };
		} else {
			compareFunction = (f1, f2) => { return f1.quantity < f2.quantity; };
		}
	}
	
	table.ascending = !table.ascending;
	for (let i = 0; i < table.fruits.length; i++) {
		for (let j = i; j < table.fruits.length; j++) {
			if (compareFunction(table.fruits[i], table.fruits[j])) {
				[table.fruits[i], table.fruits[j]] = [table.fruits[j], table.fruits[i]];
			}
		}
	}
}

function findTable(id) {
	for (let i = 0; i < tables.length; i++) {
		//console.log(tables[i]);
		if (tables[i].id === id) {
			return tables[i];
		}
	}
}

function addSortActions() {
	let heads = document.getElementsByClassName("head");
	for (let i = 0; i < heads.length; i++) {
		heads[i].onclick = () => { 
			let tableId = heads[i].parentNode.parentNode.parentNode.id;
			sortFruits(tableId, heads[i].innerText);
			drawTable(tableId);
		};

	}
}

function getColumn(table, columnIndex) {
	let cells = [];
	let len = table.rows.length;
	//console.log(table.rows);
	for (let i = 0; i < len; i++) {
		let row = table.rows[i];
		cells.push(row.cells[columnIndex]);
	}
	return cells;
}

function getFruits(table) {
	let fruitCol = getColumn(table, 0);
	let priceCol = getColumn(table, 1);
	let qntCol = getColumn(table, 2);
	//console.log(fruitRow.children);
	let fruits = []
	for (let i = 1; i < fruitCol.length; i++) {
		let fruit = new Fruit(fruitCol[i].innerText, 
			priceCol[i].innerText, 
			qntCol[i].innerText);
		fruits.push(fruit);
	}
	//console.log(fruits);
	return fruits;
}

function loadTables() {
	let tbls = document.querySelectorAll(".tabel-sortabil");
	tbls.forEach((tbl) => {
		let tblId = tbl.id;
		let fruits = getFruits(tbl);
		//console.log(fruits);
		let newTable = new Table(tblId, fruits);
		tables.push(newTable);
	});
}

function drawTable(tableId) {
	let table = document.getElementById(tableId);
	table.innerHTML = "";

	let headsRow = table.insertRow(0);
	let fruitHead = headsRow.insertCell(0);
	let priceHead = headsRow.insertCell(1);
	let qntHead = headsRow.insertCell(2);

	fruitHead.className = "fruits";
	fruitHead.innerText = "Fructe";

	priceHead.className = "price";
	priceHead.innerText = "Pret";

	qntHead.className = "quantity";
	qntHead.innerText = "Cantitate";
	
	[fruitHead, priceHead, qntHead].forEach((elem) => {
		elem.className = "head";
	});

	let backTable = findTable(tableId);
	for (let i = 0; i < backTable.fruits.length; i++) {
		let row = table.insertRow(i+1);

		let fruitCell = row.insertCell(0);
		let priceCell = row.insertCell(1);
		let qntCell = row.insertCell(2);

		fruitCell.innerText = backTable.fruits[i].name;
		priceCell.innerText = backTable.fruits[i].price;
		qntCell.innerText = backTable.fruits[i].quantity;
	}

	addSortActions();
}

window.onload = function() {
	loadTables();
	addSortActions();

}