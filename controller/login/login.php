<?php
session_start();

require_once '../../model/user/User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"]; 
    $password = $_POST["password"];

    $user = new User();
    $user->setEmail($email);
    $estado = $user->verificarEmail();
    if ($estado) {
        $passwordDb = $user->obtenerPassword();
        $hashFromDatabase = $passwordDb; 


        if (password_verify($password, $hashFromDatabase)) {

            $_SESSION["loggedin"] = true;
            $_SESSION["email"] = $email;
            echo 1;
        } else {

            echo 2;
        }
    }
    else{
        echo 3;
    }

}
?>