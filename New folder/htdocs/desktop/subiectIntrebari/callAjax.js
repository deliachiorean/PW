var interval=null;
$(function() {

	$('#startTest').on( "click", function() {
		$(this).attr("disabled", true);
		next(0);
		startInterval();
	});

	$('#reincepeTest').attr("disabled", true);

});

function reincepe()
{
	window.location.href="http://localhost/subiectIntrebari/start.html";
}

function startInterval()
{
	var start=0;
	interval=setInterval(function()
	{
		var data;
		if(start==0){
			data={
				"nume":$("#nume").val(),
				"email":$("#email").val(),
				
			}

			getRaspunsuri(data);		
		}
		else{
			data={};
			getRaspunsuri(data);
		}
		
		sendSet(data);
		start=start+3;
		next(start); 
	}, 7000);

}

function getRaspunsuri(data)
{
	var intrebari = $(".intrebare");
	var i =1;
	intrebari.each(intr=> {
		var idIntr= $(intrebari[intr]).data('id');
		data["intrebare"+i]=idIntr;
		data["raspuns"+i]=$('input[name=radio'+idIntr+']:checked').data("nr");
		i++;
	});
}

function sendSet(data)
{
	$.ajax({
		url:"addRaspuns.php",
		type:"POST",
		data:data,
		error:function()
		{
			$("#container").empty();
			$("#container").append("Nu ati completat emailul si numele. Nu puteti continua testul. Aveti doar 7 secunde");
			clearInterval(interval);
		}
		});
}

function next(start)
{
	$("#container").empty();
	if(start==0)
	{
		var spanNume=$("<span></span>").append("Nume");
		var nume=$("<input type='text' id='nume'></input>");
		var spanEmail=$("<span></span>").append("Email");
		var email=$("<input type='text' id='email'></input>");
		$("#container").append(spanNume).append(nume).append(spanEmail).append(email);
	}

	$.ajax({
		url:"next.php?start="+start,
		type:"GET",
		success:function(data) {
			var types=JSON.parse(data);	
			if(types.length==0)
			{
				clearInterval(interval);
				getPunctaj();
			}

			var div;	
			types.forEach(intrebare=>
			{
				div = $("<div class='intrebare' data-id="+intrebare['id']+"></div>").append(intrebare["intrebare"]).append("<br>");
				div.append($("<input type='radio' name='radio"+intrebare['id']+"' data-nr=1>"+intrebare['r1']+"<br>"));
				div.append($("<input type='radio' name='radio"+intrebare['id']+"' data-nr=2>"+intrebare['r2']+"<br>"));
				div.append($("<input type='radio' name='radio"+intrebare['id']+"' data-nr=3>"+intrebare['r3']+"<br>"));	
				$("#container").append(div);
			});
			
		}
		});

}

function getPunctaj()
{
	$.ajax({
		url:"getPunctaj.php",
		type:"GET",
		success:function(data) {
			var types=JSON.parse(data);	
			types.forEach(punctaj=>
			{
				$("#container").append("S-a terminat testul");
				$("#container").append("<br>");
				clearInterval(interval);
				$("#container").append(punctaj["punctaj"]+"/"+punctaj["nr"]);
				$('#reincepeTest').attr("disabled", false);

			});	
		}
	});
}