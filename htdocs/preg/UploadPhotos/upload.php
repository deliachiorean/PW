<?php
if(isset($_POST['submit']))
{
	$file = $_FILES['file'];
	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];
	
	$fileExt = explode('.',$fileName);
	$fileActualExt = strtolower(end($fileExt));
	
	$allowed = array('jpg','jpeg','png','pdf');
	if(in_array($fileActualExt,$allowed))
	{
		if($fileError === 0)
		{
			if($fileSize < 1000000)
			{//mai mic decat 1 kilo
				
				//prevent image to be deleted if there is another image named the same
				$fileNameNew = uniqid('',true).".".$fileActualExt;
				$fileDestination = 'uploads/'.$fileNameNew;
				//ulpoad the file from temporary location to ulpoads
				move_uploaded_file($fileTmpName,$fileDestination);
				header("Location: index.php?uploadsuccess");
				
			}else{
				echo "Your file is too big!";
			}
		}else{
			echo "There was an error uploading the file";
		}
		
	}else{
		echo "You can't upload files of this type!";
	}
	
}