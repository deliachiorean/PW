<?php
    session_start();
    if (!isset($_SESSION['utilizator'])) {
        header("location: login.php");
        die();
    }
    $culoareScris = "";
    $culoareFundal = "";
    $font = "";
    $caleImagine = "avatar/";

    $servername = "localhost";
    $usernameBD = "root";
    $passwordBD = "root";
    $dbname = "pregatire2";

    // Create connection
    $conn = new mysqli($servername, $usernameBD, $passwordBD, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $utilizator = $_SESSION['utilizator'];

    $sql = "select * from users where utilizator='$utilizator'";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $culoareScris = $row["culoareScris"];
    $culoareFundal = $row["culoareFundal"];
    $font = $row["font"];
    $caleImagine = $caleImagine . $row["numePoza"];

    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
</head>
<body>
    <div id="mesajDiv"></div>
    <fieldset>
        <legend>Schimbare parola</legend>
        Parola veche:<input type="text" id="inputParolaVeche"/><br>
        Parola noua:<input type="text" id="inputParolaNoua"/><br>
        <button onclick="schimbareParola()">Schimbare parola</button>
    </fieldset>
    <fieldset>
        <legend>Schimbare avatar</legend>
        <form enctype="multipart/form-data" method="post" action="schimbareAvatar.php">
            Avatar curent:<br>
            <?php
            echo "<img src='$caleImagine' width='130' height='200'/>";
            ?>
            <br/>
            Avatar nou:<input type="file" name="avatarNou"/><br>
            <input type="submit" value="Schimbare avatar"/>
        </form>
    </fieldset>
    <fieldset>
        <legend>Schimbare stil</legend>
        Culoare scris:
        <?php
        echo "<input type='color' id='inputCuloareScris' value='$culoareScris'/>";
        ?>
        <br/>
        Culoare fundal:
        <?php
        echo "<input type='color' id='inputCuloareFundal' value='$culoareFundal'/>";
        ?>
        <br/>
        Font:
        <?php
        echo "<select id='selectFont' >";
        if ($font === 'Arial')
            echo "<option value='Arial' selected='selected'>Arial</option>";
        else
            echo "<option value='Arial'>Arial</option>";
        if ($font === 'Comic Sans')
            echo "<option value='Comic Sans' selected='selected'>Comic Sans</option>";
        else
            echo "<option value='Comic Sans'>Comic Sans</option>";
        if ($font === 'Times New Roman')
            echo "<option value='Times New Roman' selected='selected'>Times New Roman</option>";
        else
            echo "<option value='Times New Roman'>Times New Roman</option>";
        echo "</select>";
        ?>
        <br/>
        <button onclick="schimbareStil()">Schimbare stil</button>
    </fieldset>
    <b><a href="index.php">Go to the main page</a></b><br/>
</body>
<script src="profile.js"></script>
</html>
