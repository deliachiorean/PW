<?php
session_start();
if (isset($_SESSION['username'])) {
    session_unset();
    session_destroy();
    header("Location: adminIndex.html");
} else {
    echo "Nu sunteti logat!!!";
}

?>