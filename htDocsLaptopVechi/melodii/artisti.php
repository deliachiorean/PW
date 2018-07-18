<html>
<body>
<?php

$conn = new mysqli("localhost", "root", "","piese");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

getDepartures($conn);


function getDepartures($conn){
    $sqlCommand = "SELECT DISTINCT artist FROM piesa";
    $result = mysqli_query($conn,$sqlCommand);
    while($row = mysqli_fetch_array($result)) {
        echo " <a data-toggle='collapse' href='#collapse1'><li  class='list-group-item' class ="."artist"." onclick="."showPiese(this.innerText)>" . $row['artist'] . "</li></a>";
    }
}
mysqli_close($conn);
?>
</body>
</html>