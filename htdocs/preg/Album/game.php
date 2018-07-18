<!DOCTYPE>
<html>
<head>
<title>Let's play a game</title>
<script src="images.js"></script>
</head>
<body>
<?php
session_start();
include 'db.php';

$dbImages = mysqli_query($conn,"SELECT fisier_imagine,descriere FROM images");
		if ($dbImages && mysqli_num_rows($dbImages) > 0) {
			$images = array();
			while($row = mysqli_fetch_array($dbImages)) {
				$images[] = array(
								'image' => $row['fisier_imagine'],
								'description' => $row['descriere']
							);
			}
			if (!empty($images)) {
				$descriptions = array_column($images, 'description');
				shuffle($descriptions); ?>
				<h4>Guess which is what</h4>
				<table id="guessTable" align="center"> <?php
					foreach ($images as $key => $image) { ?>
						<tr>
							<td><img id="image-<?php echo $key ?>" class="guess-image" width=250 height=250 src="<?php echo $image['image'] ?>"  onclick="imageClick(this)"></td>
							<td><span id="description-<?php echo $key ?>" class="guess-description" onclick="descriptionClick(this)"><?php echo $descriptions[$key] ?></span></td>
						</tr>
					<?php } ?>
				</table>
				
				<h4>Guessed</h4>
				<table id="guessedTable" align="center"></table>
				<form style="display: none" action="submitResult.php" method="POST" enctype="multipart/form-data" id="submitForm">
					<label>Name</label>
					<input type="text" name="name" id="name">
					<input id="guessTime" name='time' type="hidden">
					<br><br>
					<input type="submit" value="Submit" name="submit">
				</form><?php
			}
		}
?>
</body>
</html>