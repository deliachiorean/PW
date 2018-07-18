var carousel = document.querySelector("ol");
var items = carousel.children;
var PozaCurenta = 0;
var itemCount = items.length;
console.log(items);




function translateRight() {
	return -500 * (PozaCurenta + 1);
}

function translateLeft() {
	return -500 * (PozaCurenta - 1);
}

function goToLeft() {
	setDurations(2);
	var translate = translateLeft();
	console.log(translate);
	if (PozaCurenta === 0) {
		PozaCurenta = 7;
		translate = translateLeft();
		carousel.style.transform = "translate(" + translate + "px, 0)";
	} else {
		carousel.style.transform = "translate(" + translate + "px, 0)";
		
	}
	PozaCurenta--;
	
	setTimeout(function() {
		setDurations(0);
	}, 2000);
}
function goToRight() {
	if (PozaCurenta >= itemCount) {
		PozaCurenta = 0;
	}
	setDurations(2);
	var translate = translateRight();
	console.log(translate);
	if (PozaCurenta === itemCount - 1) {
		carousel.style.transform = "translate(0, 0)";
	} else {
		carousel.style.transform = "translate(" + translate + "px, 0)";
	}
	PozaCurenta++;

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
			autoInterval = setInterval(goToRight, 3000);
		} else {
			clearInterval(autoInterval);
		}
	}
}