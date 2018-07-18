var table;
var state = {
	searching: false,
	last: null
}
function generateNewTable() {
	table = [];
	
	var numbers = getNumbersShuffled(50);
	for (var i = 0; i < 36; i++) {
		table[i] = numbers[i];
	}
}

function getNumbersShuffled(maxNum) {
	var numbers = [];
	for (var i = 0; i < 36 - 1; i += 2) {
		var randValue = Math.floor(Math.random() * maxNum);
		numbers[i] = randValue //place a random number
		numbers[i + 1] = randValue; //place pair
	}
	numbers = shuffle(numbers);
	return numbers;
}

function shuffle(a) {
    for (let i = a.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [a[i], a[j]] = [a[j], a[i]];
    }
    return a;
}

function drawTable() {
	var i = 0;
	$("td").each(function() {
		if (!$(this).hasClass("hidden")) {
			$(this).html(table[i])
			.css({
				"background-color": "grey",
				"background-image": "url(\"profi/prof" + table[i] + ".jpg\""
			});
		} else {
			$(this).html(table[i])
			.css({
				"background-color": "grey",
				"background-image": "none"

			});
		}
		

		i++;
	});
	$(".hidden").html("?");
	
	$(".found").css({"background-color": "rgba(0,255,0,0.4)"});
	
}

$(function() {

	$("td").addClass("hidden");
	generateNewTable();
	drawTable();
	$("td").on("click", function() {
		$(this).removeClass("hidden");
		
		drawTable();
		if (state.searching) {
			if (state.last.html() === $(this).html() && $(".hidden").length % 2 === 0) {
				//we found value
				state.last.removeClass("hidden");
				state.last.addClass("found");
				$(this).addClass("found");
				drawTable();
			} else {
				setTimeout(() => {
					$(this).addClass("hidden");
					state.last.addClass("hidden");
					drawTable();
				}, 1000);
			}
			state.searching = false;

		} else {
			state.last = $(this);
			state.searching = true;
		}
		if ($(".hidden").length === 0) {
			alert("you won");
		}
		
		
		
	});
})