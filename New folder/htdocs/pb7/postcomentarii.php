<?php
$filename="pb7php.html";
$nume= $_POST['nume'];
$com= $_POST['comentariu'];
	
// Write the contents to the file, 
// using the FILE_APPEND flag to append the content to the end of the file
// and the LOCK_EX flag to prevent anyone else writing to the file at the same time
file_put_contents($filename, $nume, FILE_APPEND | LOCK_EX);
file_put_contents($filename, $com, FILE_APPEND | LOCK_EX);


echo "Comentariul a fost adaugat cu succes pe pagina articolului!";
?>