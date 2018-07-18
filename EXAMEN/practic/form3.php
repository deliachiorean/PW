<?php

session_start();
require_once "connect.php";

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
            <form enctype="multipart/form-data">
                <legend>Upload avatar:</legend>
                <input type="file" name="avatar" id="avatar"><br>
                
           <label>introduceti mail:</label>
            <input type="email" id=email><br>
            <!--<button onclick="retineemail()">Inregistrare</button>-->
            <input type="submit" value="inregistreaza" onclick="salveazaDatele()" />
           <br>
        </form>
        </fieldset>

        <!--<button onclick="salveazaDatele()">inregistreaza tot</button>-->
        <b id="goback"><a href="form2.php">Spre pagina anterioara</a></b>
    </div>
</body>
<script src="form3.js"></script>
</html>