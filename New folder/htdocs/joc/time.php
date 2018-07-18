<?php
/**
 * Created by PhpStorm.
 * User: Coste Claudia Ioana
 * Date: 6/17/2018
 * Time: 12:11 AM
 */
session_start();
if (isset($_SESSION['timp'])){
    $_SESSION['timp']++;
    $var=$_SESSION['timp'];
    echo $var;
}
?>