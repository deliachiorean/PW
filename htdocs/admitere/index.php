<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Inregistrare</title>
</head>

	<!-- script>
        $(function () {
            // $("#datepicker").datepicker({minDate: new Date(2018, 5, 20)});
            $("#datepicker").datepicker({minDate: new Date()});
        });
    </script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="select.js"></script>
    <style>
    .opt{
    	float:left;
    }
    #submitBtn{
    	margin-top: 200px;
    	margin-left: 20px;

    }

</style>
<body>
	<form enctype="multipart/form-data" action="salveazaDate.php" method="post">
	<label>Nume</label>
	<input type="text" name="nume" id="nume">
	<br>
	<label>Medie absolvire liceu</label>
	<input type="text" name="medie" id="medie">
	<br>
	<fildset id="fildset" margin-left="20px">
		<legend>NotaAleasaDintreMateriiBAC:</legend>
	<label>Nota</label>
	<input type="number" name="nota" id="nota">
	
	<label>Materie pentru Nota: </label>
	<input type="radio" name="materie" id="materie" >Matematica
	<input type="radio" name="materie" id="materie" >Informatica
	</fildset>
	<br>
	<label>Data nasterii</label>
	<input type="date" name="datepicker" id="datepicker" placeholder="Data nasterii" required>
	<br>

	<div class="form-group" id="img_div">
		Atasati diploma de BAC:
			<input type="file" name="avatar" id="avatar">
	</div>
	Selectati optiunile de inscriere:
	<br>
	<div class="opt">
		Optiuni Posibile:
		<br>
		<select id='items' multiple size='5'>
	    	<option>Informatica Romana </option>
	    	<option>Informatica Engleza</option>
	    	<option>Informatica Maghiara</option>
		    <option>Informatica Germana</option>
		    <option>Matematica Informatica Romana</option>
		    <option>Matematica Informatica Engleza</option>
		    <option>Matematica Engleza</option>
		    <option>Matematica Romana</option>

		    
		</select>
	</div>
	<div class="opt">
		Optiuni Alese:
		<br>
		<select id="selected_items" name="selected_items" multiple size='5'>
			
		    
		</select>
	</div>

<br>
<input type="submit" value="Save" id="submitBtn">
</form>

</body>
</html>