<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Add melodii</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
	
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form role="form" method="post" autocomplete="off" enctype="multipart/form-data">
				<h2>Add melodii</h2>
				<hr>

				<div class="form-group">
					<input type="text" name="artist" id="artist" class="form-control input-lg" placeholder="artist" tabindex="1">
				</div>

				<div class="form-group">
					<input type="text" name="titlu" id="titlu" class="form-control input-lg" placeholder="titlu" tabindex="2">
				</div>
				
				<div class="form-group">
					<input type="text" name="piesa" id="piesa" class="form-control input-lg" placeholder="piesa" tabindex="3">
				</div>
				
				<div class="form-group">
					<strong>Select file to upload:</strong>
					<input type="file" name="fileToUpload" id="fileToUpload">
					<input type='hidden' name='var'>
				</div>
				
				<hr>
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Add melodii" class="btn btn-primary btn-block btn-lg" onclick="form.action='addMelodii.php'" tabindex="5"></div>
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Delete melodii" class="btn btn-primary btn-block btn-lg" onclick="form.action='removeMelodii.php'" tabindex="6"></div>
				</div>
				
				
				
			</form>
		</div>
	</div>
</div>
</body>
</html>
