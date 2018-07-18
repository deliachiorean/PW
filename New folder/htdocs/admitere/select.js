$(document).ready(function(){
	$('#items').on('dblclick', function () {
		    $('#items').find(':selected').appendTo('#selected_items');

	});

	$('#selected_items').on('dblclick', function () {
		$('#selected_items').find(':selected').appendTo('#items');

	});
});