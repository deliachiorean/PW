function validateForm() {
	var form = document.forms["pw-form"];
	
	
	var errors = validateFields(form);

	if (errors != "") {
		alert(errors);
		return false;
	} else {
		alert("Register success!");
		return true;
	}
}

function validateFields(form) {
	var errors = "";

	var nameErr, ageErr, emailErr, dateErr;
	if (nameErr = validateName(form)) {
		errors += nameErr + "\n";
	}
	
	if (ageErr = validateAge(form)) {
		errors += ageErr + "\n";
	}

	if (emailErr = validateEmail(form)) {
		errors += emailErr + "\n";
	}

	if (dateErr = validateBirth(form)) {
		errors += dateErr + "\n";
	}

	if (correspondAgeErr = validateAgeBirthDate(form)) {
		errors += correspondAgeErr;
	}
	return errors;
}

//returns error message if age and birth date values correspond, empty string else
function validateAgeBirthDate(form) {
	var ageInput = form["age"];
	var dateInput = form["birth-date"];
	if (ageInput.value !== "" && dateInput.value !== "") {

		var year = form["birth-date"].value.split("-")[0];
		if (ageInput.value != 2018 - year) {
			ageInput.style.border = "2px solid red";
			dateInput.style.border = "2px solid red";
			return "Age and birth date do not correspond";
		}
	}
	return "";
	
}

//returns error message if name input is invalid, empty string else
function validateName(form) {
	var name = form["name"].value;
	if (name === "") {
		//color name field
		form["name"].style.border = "2px solid red";
		//return
		return "Must fill name field";
	}
	form["name"].style.border = "none";
	return "";
}

//returns error message if age input is invalid, empty string else
function validateAge(form) {
	var age = form["age"].value;
	if (age === "") {
		//color age field
		form["age"].style.border = "2px solid red";
		//return
		return "Must fill age field";
	}
	form["age"].style.border = "none";
	return "";
}

//returns error message if email input is invalid, empty string else
function validateEmail(form) {
	var email = form["email"].value;
	if (email === "") {
		//color email field
		form["email"].style.border = "2px solid red";
		//return
		return "Must fill email field";
	}
	form["email"].style.border = "none";
	return "";
}

//returns error message if birth date input is invalid, empty string else
function validateBirth(form) {
	var date = form["birth-date"].value;
	if (date === "") {
		//color email field
		form["birth-date"].style.border = "2px solid red";
		//return
		return "Must fill birth date field";
	}
	form["birth-date"].style.border = "none";
	return "";
}

window.onload = function() {
	//add form restrictions here
}
