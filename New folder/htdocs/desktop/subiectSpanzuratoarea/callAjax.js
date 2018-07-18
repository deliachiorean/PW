$(function() {

	$('#btnAdd').on( "click", function() {
		adaugaCuvant();
	});
	getCuvinte();
	

});


function adaugaCuvant()
{
	var cuvant=$("#cuvant").val();
	$.ajax({
		url:"addCuvant.php",
		type:"POST",
		data:{'cuvant':cuvant},
		error:function()
		{
			$("#eroare").append("A aparut o eroare la adaugare cuvant");
		},
		success:function(data) {
			$("#container").empty();	
			getCuvinte();


		}
		});
}

function getCuvinte()
{
	 $.ajax({
		url:"getCuvinte.php",
		type:"GET",
		success:function(data) {
			var types=JSON.parse(data);

			var tabel=$("<table id='tabelCuvinte' ></table>");
			var thead=$("<thead></thead>");
			var tr1 = $("<tr></tr>");
			var th1 = $("<th></th>").append("Cuvant");
			tr1.append(th1);
			thead.append(tr1);
			tabel.append(thead);
			var tbody=$("<tbody></tbody>");
			tabel.append(tbody);
			types.forEach(d=>
			{
				var tr = $("<tr></tr>");
				var td = $("<td></td>").append(d['cuvant']);
				var td2 = $("<td></td>");
				var button=$("<button id='sterge' onClick=stergeCuvant("+d['id'] +")>Sterge</button>");
				td2.append(button);
				tr.append(td).append(td2);
				tbody.append(tr);
			});
			$("#container").append(tabel);	

			$("#sterge").on( "click", function() {
				stergeCuvant($(this).data('id'));
			});
		}
	});
}

function stergeCuvant(id)
{
	$.ajax({
		url:"stergeCuvant.php",
		type:"POST",
		data:{'idCuvant':id},
		error:function(data)
		{
			$("#eroare").append("A aparut o eroare la stergere cuvant");
		},
		success:function(data) {
			$("#container").empty();	
			getCuvinte();
		}
		});
}
