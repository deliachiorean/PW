var carousel = document.querySelector("ol");
var items = carousel.children;
var currentItemIndex = 0;
var itemCount = items.length;
console.log(items);

function translateRight() {
	if (currentItemIndex >= itemCount) {
		currentItemIndex = 0;
	}
	setDurations(2);
	var translateAmount = getTranslateAmountRight();
	console.log(translateAmount);
	if (currentItemIndex === itemCount - 1) {
		carousel.style.transform = "translate(0, 0)";
	} else {
		carousel.style.transform = "translate(" + translateAmount + "px, 0)";
	}
	currentItemIndex++;
	// reset durations
	setTimeout(function() {
		setDurations(0);
	}, 2000);
	
}


function getTranslateAmountRight() {
	return -500 * (currentItemIndex + 1);
}

function getTranslateAmountLeft() {
	return -500 * (currentItemIndex - 1);
}

function translateLeft() {
	setDurations(2);
	var translateAmount = getTranslateAmountLeft();
	console.log(translateAmount);
	if (currentItemIndex === 0) {
		currentItemIndex = 7;
		translateAmount = getTranslateAmountLeft();
		carousel.style.transform = "translate(" + translateAmount + "px, 0)";
	} else {
		carousel.style.transform = "translate(" + translateAmount + "px, 0)";
		
	}
	currentItemIndex--;
	// reset durations
	setTimeout(function() {
		setDurations(0);
	}, 2000);
}

function setDurations(sec) {
	carousel.style.transitionDuration = sec + "s";
}

function initCarousel() {
	var percent = 0;
	for (var i = 0; i < itemCount; i++) {

		items[i].style.left = 500 * percent + "px";
		percent += 1;
	}
}


var autoInterval;
window.onload = function() {
	initCarousel();
	document.getElementById("auto").onchange = function() {
		if (this.checked) {
			autoInterval = setInterval(translateRight, 3000);
		} else {
			clearInterval(autoInterval);
		}
	}
}