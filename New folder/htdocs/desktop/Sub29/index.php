<?php
    session_start();
    if (!isset($_SESSION['utilizator'])) {
        header("location: login.php");
        die();
    }
    $user=$_SESSION['utilizator'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
</head>
<body>
    <fieldset>
        <legend>Setari</legend>
        <b>Logged in as: <i><?php echo $user; ?></i></b><br/>
        <b><a href="logout.php">Logout</a></b><br/>
        <b><a href="profile.php">Go to your profile</a></b><br/>
    </fieldset>
    <fieldset>
        <legend>Pune Intrebare</legend>
        Intrebare:<input type="text" id="inputIntrebare"><br/>
        <button onclick="trimitereIntrebare()">Trimite Intrebare</button><br/>
        <div id="mesajDiv"></div>
    </fieldset>
    <fieldset>
        <legend>Intrebari Curente</legend>
        <div id="divIntrebari"></div>
    </fieldset>
</body>
<script src="index.js"></script>
</html>
