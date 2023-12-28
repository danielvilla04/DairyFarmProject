<?php
require_once '../../config/conexion.php';

class User extends Conexion
{

    protected static $conexion;

    private $idUsuario = null;
    private $nombre = null;
    private $email = null;

    private $confirmPassword = null;
    private $password = null;

    private $terms = null;

    // Getter and Setter methods...
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function getConfirmarPassword()
    {
        return $this->confirmPassword;
    }

    public function setConfirmarPassword($confirmPassword)
    {
        $this->confirmPassword = $confirmPassword;
    }



    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }


    public function getTerms()
    {
        return $this->terms;
    }

    public function setTerms($terms)
    {
        $this->terms = $terms;
    }




    //conexion a base de datos
    public function getConexion()
    {
        self::$conexion = Conexion::conectar();
    }
    //desconexion con base de datos
    public function desconectar()
    {
        self::$conexion = null;
    }

    public function guardarDb()
    {

        $query = "INSERT INTO `users` (`name`, `email`, `password_hash`, `temrs`) VALUES (:nombre, :email, :password_hash, :terms)";


        try {
            self::getConexion();
            $nombre = $this->getNombre();
            $email = $this->getEmail();
            $password_hash = $this->getPassword();
            $terms = $this->getTerms();

            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $resultado->bindParam(':email', $email, PDO::PARAM_STR);
            $resultado->bindParam(':password_hash', $password_hash, PDO::PARAM_STR);
            $resultado->bindParam(':terms', $terms, PDO::PARAM_STR);

            $resultado->execute();
            self::desconectar();
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode($error);
        }
    }
    public function usuarioExiste()
    {
        $query = "SELECT COUNT(*) as count FROM `users` WHERE `email` = :email";

        try {
            self::getConexion();
            $email = $this->getEmail();

            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(':email', $email, PDO::PARAM_STR);
            $resultado->execute();

            $count = $resultado->fetch(PDO::FETCH_ASSOC)['count'];

            self::desconectar();

            return $count > 0;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }

    public function obtenerPassword()
    {
        $query = "SELECT password_hash FROM `users` WHERE `email` = :email";

        try {
            self::getConexion();
            $email = $this->getEmail();
            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(':email', $email, PDO::PARAM_STR);
            $resultado->execute();

            $passwordHash = $resultado->fetchColumn();

            self::desconectar();

            return $passwordHash;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }
    public function verificarEmail()
    {
        $query = "SELECT * FROM users where email=:email";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $email = $this->getEmail();
            $resultado->bindParam(":email", $email, PDO::PARAM_STR);
            $resultado->execute();
            $resultado->execute();
            self::desconectar();
            $encontrado = false;
            foreach ($resultado->fetchAll() as $reg) {
                $encontrado = true;
            }
            return $encontrado;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }
}

