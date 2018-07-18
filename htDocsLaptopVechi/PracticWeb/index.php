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
        <legend>Settings</legend>
        <b>Logged in as: <i><?php echo $user; ?></i></b><br/>
        <b><a href="logout.php">Logout</a></b><br/>
    </fieldset>
    <fieldset>
        <legend>Adaugare Produs</legend>
        <form enctype="multipart/form-data" method="post" action="adaugareProdus.php">
            <table>
                <tr>
                    <td>Nume:</td>
                    <td><input type="text" name="nume"/></td>
                </tr>
                <tr>
                    <td>Descriere:</td>
                    <td><input type="text" name="descriere"/></td>
                </tr>
                <tr>
                    <td>Producator:</td>
                    <td><input type="text" name="producator"/></td>
                </tr>
                <tr>
                    <td>Pret:</td>
                    <td><input type="text" name="pret"/></td>
                </tr>
                <tr>
                    <td>Cantitate:</td>
                    <td><input type="text" name="cantitate"/></td>
                </tr>
                <tr>
                    <td>Poza:</td>
                    <td><input type="file" name="poza"/></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Adauga produs"/></td>
                    <td></td>
                </tr>
            </table>
        </form>
    </fieldset>
    <fieldset>
        <legend>Stergere Produse</legend>
        <div id="divProduse"></div>
    </fieldset>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="index.js"></script>
</html>
