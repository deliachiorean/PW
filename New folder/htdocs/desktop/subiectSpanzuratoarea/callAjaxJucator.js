$(function() {
	getCuvantStart();
	$('#btnGhiceste').on( "click", function() {
		ghiceste();
	});
});



function getCuvantStart()
{
	 $.ajax({
		url:"getRandomNr.php",
		type:"GET",
		success:function(data) {
			var types=JSON.parse(data);		
			$("#cuvant").append(types['cuvant']);	
			$("#id").val(types['id']);	
			}
	});
}

function ghiceste()
{
	var litera=$("#litera").val();
	var cuvant=$("#cuvant").text();
	var id=$("#id").val();
	$.ajax({
		url:"ghiceste.php",
		type:"POST",
		data:{'idCuvant':id,'litera':litera,'cuvant':cuvant},
		error:function(data)
		{
			$("#eroare").append("A aparut o eroare la trimitere cuvant");
		},
		success:function(data) {
			$("#cuvant").text(data);	
		}
		});
}

