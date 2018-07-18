<?php


session_start();
if (!isset($_SESSION['utilizator'])) {
    header("location: logare.php");
    die();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
</head>
<body>
    <div id="container">
        
        <fieldset>
            <form enctype="multipart/form-data" action="incarcareAvatar.php" method="post">
                <legend>Upload avatar:</legend><input type="file" name="avatar"><br>
                <input type="submit" value="Incarca avatar"/>
            </form>
        </fieldset>
        
        <b id="sprePaginaPrincipala"><a href="paginaPrincipala.php">Spre pagina principala</a></b>
    </div>
</body>

</html>