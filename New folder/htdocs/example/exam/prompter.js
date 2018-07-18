function setPage(data){
	$('#content').empty();
    $('#content').text(data.text);
}

function showJS(id) {
	let req = new XMLHttpRequest();

    req.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            const data_received = JSON.parse(this.responseText).data;
            console.log(data_received);
            setPage(data_received);
            time = parseInt(data_received.secunde.toString() + "000");
            console.log(time);
            move();
            nextID = parseInt(data_received.id) + 1;
            toJS = setTimeout(function(){
            	boolJS = true; boolJQ = false;
            	let newId = parseInt(data_received.id) + 1;
            	nextID = newId;
	    		if (newId <= max) {
	    			showJQ(newId);
	    		}
            }, time);
        }
    }

    req.open("GET", `http://localhost/exam/get_mesaj.php?id=${id}`, true);
    req.send();
}

function showJQ(id) {
	$.get(`http://localhost/exam/get_mesaj.php?id=${id}`, val => {
    	$('#content').empty();
    	setPage(val.data);
    	time = parseInt(val.data.secunde.toString() + "000");
    	console.log(time);
    	move();
    	nextID = parseInt(val.data.id) + 1;
    	toJQ = setTimeout(function(){
    		boolJS = false; boolJQ = true;
    		let newId = parseInt(val.data.id) + 1;
    		nextID = newId;
    		if (newId <= max) {
    			showJS(newId);
    		}
		}, time);
    });
}

function showNext(nr) {
	if (nr % 2 == 0) {
		showJS(nr);
		boolJS = true; boolJQ = false;
		nr++;
	}
	else {
		showJQ(nr);
		nr++;
	}
}

var time = 0, max, to, boolJQ, boolJS, nextID;

function showMessages() {
	var nr = 0;//, max;

	$.get(`http://localhost/exam/get_last.php`, val => {
		console.log(val.data.lastId);
    	nr = val.data.lastId;
    	console.log(max);
    	$.get(`http://localhost/exam/get_max.php`, val => {
    	max = val.data.id;
    	console.log(max);
    	});
    	if (nr == max)
    		nr = 0;
		showNext(nr);
    });
}

function move() {
	$('#myBar').css('width', '1%');
    var elem = document.getElementById("myBar"); 
    var width = 1;
    var id = setInterval(frame, time/10);
    function frame() {
        if (width >= 100) {
            clearInterval(id);
        } else {
            width+=10; 
            elem.style.width = width + '%'; 
        }
    }
}

$(document).ready( () => {
	$("#start").click(function() {
		showMessages();
		move();
	});
});