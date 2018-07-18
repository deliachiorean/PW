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
            <legend>Schimbare parola:</legend>
                Parola veche: <input type="text" id="parolaVeche"><br>
                 Parola noua: <input type="text" id="parolaNoua"><br>
                <button onclick="schimbaParola()">Schimba parola</button>
        </fieldset>
        <fieldset>
            <form enctype="multipart/form-data" action="incarcareAvatar.php" method="post">
                <legend>Upload avatar:</legend><input type="file" name="avatar"><br>
                <input type="submit" value="Incarca avatar"/>
            </form>
        </fieldset>
        <fieldset>
            <legend>Alegere culori:</legend>
            Culoare scris: <input type="color" id="scris"><br>
            Culoare background: <input type="color" id="background"><br>
            Culoare font: <input type="color" id="font"><br>
            <button onclick="retineCulori()">Retine schimbari</button>
        </fieldset>
        <b id="sprePaginaPrincipala"><a href="paginaPrincipala.php">Spre pagina principala</a></b>
    </div>
</body>
<script src="profile.js"></script>
</html>