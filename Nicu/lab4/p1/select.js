var select1 = document.getElementById("select1");
var select2 = document.getElementById("select2");

var select1Options = [];
var select2Options = [];


function clickedOption() {
	console.log(this.text);
	var index = 0;
	//check where it has to go
	if (this.classList.contains("s1")) {
		// element is in s1 and has to go to s2
		select2Options.push(this.text);
		index = select1Options.indexOf(this.text);
		select1Options.splice(index, 1);
	} else {
		// element is in s2 and has to go to s1
		select1Options.push(this.text);
		index = select2Options.indexOf(this.text);
		select2Options.splice(index, 1);
	}
	refreshOptions();
}

function refreshOptions() {
	deleteOptions();
	createOptions();
}

// adds options from arrays to select1 and select2
function createOptions() {
	select1Options.forEach((element) => {
		var option = document.createElement("option");
		option.text = element;
		option.classList.add("s1");
		select1.add(option);
	});

	select2Options.forEach((element) => {
		var option = document.createElement("option");
		option.text = element;
		option.classList.add("s2");
		select2.add(option);
	});
	addClickActions();
}


// deletes all options from selects
function deleteOptions() {
	select1.innerHTML = "";
	select2.innerHTML = "";
}

//gets all optons from each select and puts them in the arrays
function getSelectOptions() {
	var i = 0;
	document.querySelectorAll(".s1").forEach((x) => {
		select1Options[i] = x.value;
		i++;
	});
	i = 0;
	document.querySelectorAll(".s2").forEach((x) => {
		select2Options[i] = x.value;
		i++;
	});
}

//sets action when double clicked for each option
function addClickActions() {
	document.querySelectorAll("option").forEach((option) => {
		option.ondblclick = clickedOption;
	})
}

window.onload = function() {
	getSelectOptions();
	addClickActions();
}