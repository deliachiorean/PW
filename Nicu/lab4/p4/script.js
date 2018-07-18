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

function getFruits(table) {
	let fruitRow = table.rows[0];
	let priceRow = table.rows[1];
	let qntRow = table.rows[2];
	//console.log(fruitRow.children);
	let fruits = []
	for (let i = 1; i < fruitRow.children.length; i++) {
		let fruit = new Fruit(fruitRow.children[i].innerText, 
			priceRow.children[i].innerText, 
			qntRow.children[i].innerText);
		fruits.push(fruit);
	}
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
	let fruitRow = table.insertRow(0);
	let priceRow = table.insertRow(1);
	let qntRow = table.insertRow(2);

	fruitRow.className = "fruits";
	priceRow.className = "price";
	qntRow.className = "quantity";

	let fruitHead = fruitRow.insertCell(0);
	let priceHead = priceRow.insertCell(0);
	let qntHead = qntRow.insertCell(0);
	[fruitHead, priceHead, qntHead].forEach((elem) => {
		elem.className = "head";
	});
	fruitHead.innerText = "Fructe";
	priceHead.innerText = "Pret";
	qntHead.innerText = "Cantitate";

	let backTable = findTable(tableId);
	for (let i = 0; i < backTable.fruits.length; i++) {
		let fruitCell = fruitRow.insertCell(i+1);
		let priceCell = priceRow.insertCell(i+1);
		let qntCell = qntRow.insertCell(i+1);

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