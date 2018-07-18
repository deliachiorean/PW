<html>
<body>
<?php

$conn = new mysqli("localhost", "root", "","piese");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
getPiese($conn,$_GET['q']);
function getPiese($conn,$artist){
    $sqlCommand = "SELECT DISTINCT titlu FROM piesa WHERE artist = '" . $artist . "' ;";
    $result = mysqli_query($conn,$sqlCommand);
    while($row = mysqli_fetch_array($result)) {
        echo "<li class ="."piese".">" . $row['titlu'] . "</li>";
    }
}
mysqli_close($conn);
?>
</body>
</html>