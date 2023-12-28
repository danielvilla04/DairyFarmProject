<?php
session_start();

// Cerrar sesión
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    session_destroy();
    echo 1;
    exit;
}
else{
    echo 2;
}
?>