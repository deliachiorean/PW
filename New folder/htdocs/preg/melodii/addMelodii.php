<?php
session_start();

$connection = mysqli_connect("localhost","root","","piese");

if(!$connection)
	die("Connection failded");

if(isset($_POST["artist"]))
	$nume = $_POST["artist"];
if(isset($_POST["titlu"]))
	$descriere = $_POST["titlu"];                       
if(isset($_POST["piesa"]))
	$producator = $_POST["piesa"];
if(isset($_POST["fileToUpload"]))
	$fileToUpload = $_POST["fileToUpload"];



$target_dir ="melodii/";
$numes=$_POST['var'];
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
echo "<br>".$target_file."<br>";
echo "$target_file";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
if(in_array($_FILES['fileToUpload']['type'],$mimes)){
  // do something
  $uploadOk = 1;
} else {
	$uploadOk = 0;
  die("Sorry, mime type not allowed");
}
// Check if image file is a actual image or fake image
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Allow certain file formats
if( $imageFileType != "csv" ) {
    echo "Sorry, only csv  files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$conn=new mysqli("localhost","root","","piese");
$query="insert into piesa (artist,titlu,piesa,fisier_versuri) values('$nume','$descriere','$producator','".$target_file."')";
if ($conn->query($query) === TRUE) {
    echo "New record created successfully";
   header("location:melodii.php");
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

