
function validateName(form) {
	var name = form["nume"].value;
	if (name === "") {form["nume"].style.border = "2px solid red";
						return "Completati campul de nume";
	}
	form["nume"].style.border = "none";
	return "";
}

function validateAge(form) {
	var age = form["varsta"].value;
	if (age === "") {form["varsta"].style.border = "2px solid red";
					return "Completati campul de varsta";
	}
	form["varsta"].style.border = "none";
	return "";
}
function validateAgeDate(form) {
	var ageInput = form["varsta"];
	var dateInput = form["dataNasterii"];
	if (ageInput.value !== "" && dateInput.value !== "") {

		var year = form["dataNasterii"].value.split("-")[0];
		if (ageInput.value != 2018 - year) {
			ageInput.style.border = "2px solid red";
			dateInput.style.border = "2px solid red";
			return "Varsta si Data Nasterii nu sunt in concordanta";
		}
	}
	return "";
	
}
function validateBirth(form) {
	var date = form["dataNasterii"].value;
	if (date === "") {	form["dataNasterii"].style.border = "2px solid red";
						return "Completati campul cu data nasterii";
	}
	form["dataNasterii"].style.border = "none";
	return "";
}

function validateEmail(form) {
	var email = form["email"].value;
	if (email === "") { form["email"].style.border = "2px solid red";
					    return "Completati campul de email";
	}
	form["email"].style.border = "none";
	return "";
}









function validateFields(form) {
	var errors = "";

	var NE, AE, EE, DE;
	if (NE = validateName(form)) {errors += NE + "\n";	}
	if (AE = validateAge(form)) {errors += AE + "\n";}
	if (EE = validateEmail(form)) {	errors += EE + "\n";}
	if (DE = validateBirth(form)) {	errors += DE + "\n";}

	if (AGEDATEERROR = validateAgeDate(form)) {
		errors += AGEDATEERROR;
	}
	return errors;
}

function validate() {
	var form = document.forms["MyForm"];
	
	
	var errors = validateFields(form);

	if (errors != "") {
		alert(errors);
		return false;
	} else {
		alert("Register success!");
		return true;
	}
}




window.onload = function() {
}
