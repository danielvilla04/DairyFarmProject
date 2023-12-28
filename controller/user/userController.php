<?php
require_once '../../model/user/User.php';
switch ($_GET['op']) {

    case 'insert':
        $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
        $email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
        $password = isset($_POST["password_hash"]) ? trim($_POST["password_hash"]) : "";
        $confirmPassword = isset($_POST["confirm_password"]) ? trim($_POST["confirm_password"]) : "";
        $agreeTerms = isset($_POST["terms"]) ? $_POST["terms"] : false;

        if (!$agreeTerms) {
            echo (4);
            exit; // Stop  
        }

        if ($password !== $confirmPassword) {
            echo (5);
            exit; // Stop
        }

        $ingresarUsuario = new User();
        $ingresarUsuario->setNombre($nombre);
        $ingresarUsuario->setEmail($email);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $ingresarUsuario->setPassword($hashedPassword);
        $ingresarUsuario->setTerms($agreeTerms);

        
        $encontrado = $ingresarUsuario->usuarioExiste();

        if ($encontrado) {
            echo (2);
            exit; 
        }

        $resultado = $ingresarUsuario->guardarDb();

        if (!($resultado)) {
            echo (1);
        } else {
            echo (3);
        }
}
?>