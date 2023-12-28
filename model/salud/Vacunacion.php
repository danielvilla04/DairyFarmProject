<?php

require_once "../../config/conexion.php";

class Vacunacion extends Conexion
{

    //Atributos de la clase
    protected static $conexion;

    private $idVacunacion = null;

    private $idPrefijo = null;

    private $idVacuna = null;

    private $idAnimal = null;

    private $nombreVacuna = null;

    private $nombreAnimal = null;

    private $lugarAplicacion = null;

    private $dosisAplicada = null;

    private $fechaVacunacion = null;

    private $cantidadAnimales = null;

    //metodos de la clase

    public function __construct()
    {
    }

    //getters y setters

    public function getIdVacunacion()
    {
        return $this->idVacunacion;
    }

    public function setIdVacunacion($idVacunacion)
    {
        $this->idVacunacion = $idVacunacion;
    }

    public function getIdPrefijo()
    {
        return $this->idPrefijo;
    }

    public function setIdPrefijo($idPrefijo)
    {
        $this->idPrefijo = $idPrefijo;
    }

    public function getIdVacuna()
    {
        return $this->idVacuna;
    }

    public function setIdVacuna($idVacuna)
    {
        $this->idVacuna = $idVacuna;
    }

    public function getIdAnimal()
    {
        return $this->idAnimal;
    }

    public function setIdAnimal($idAnimal)
    {
        $this->idAnimal = $idAnimal;
    }

    public function getNombreVacuna()
    {
        return $this->nombreVacuna;
    }

    public function setNombreVacuna($nombreVacuna)
    {
        $this->nombreVacuna = $nombreVacuna;
    }

    public function getNombreAnimal()
    {
        return $this->nombreAnimal;
    }

    public function setNombreAnimal($nombreAnimal)
    {
        $this->nombreAnimal = $nombreAnimal;
    }

    public function getLugarAplicacion()
    {
        return $this->lugarAplicacion;
    }

    public function setLugarAplicacion($lugarAplicacion)
    {
        $this->lugarAplicacion = $lugarAplicacion;
    }

    public function getDosisAplicada()
    {
        return $this->dosisAplicada;
    }

    public function setDosisAplicada($dosisAplicada)
    {
        $this->dosisAplicada = $dosisAplicada;
    }

    public function getFechaVacunacion()
    {
        return $this->fechaVacunacion;
    }

    public function setFechaVacunacion($fechaVacunacion)
    {
        $this->fechaVacunacion = $fechaVacunacion;
    }

    public function getCantidadAnimales()
    {
        return $this->cantidadAnimales;
    }

    public function setCantidadAnimales($cantidadAnimales)
    {
        $this->cantidadAnimales = $cantidadAnimales;
    }

    //metodos de conexion

    public function getConexion()
    {
        self::$conexion = Conexion::conectar();
    }

    public function desconectar()
    {
        self::$conexion = null;
    }




    //metodos para los datos

    public function listarDB()
    {
        $query = "SELECT * FROM vacunacion
        INNER JOIN vacuna ON vacunacion.id_vacuna = vacuna.id_vacuna";
        $lista = array();
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $vacunacion = new Vacunacion();
                $prefijo = "VC";
                $vacunacion->setIdVacunacion($encontrado["id_vacunacion"]);
                $id_personalizado = $prefijo . str_pad($vacunacion->getIdVacunacion(), 2, '0', STR_PAD_LEFT);
                $vacunacion->setIdPrefijo($id_personalizado);
                $vacunacion->setIdVacuna($encontrado["id_vacuna"]);
                $vacunacion->setNombreVacuna($encontrado["nombre_vacuna"]);
                $vacunacion->setLugarAplicacion($encontrado["lugar_aplicacion"]);
                $vacunacion->setDosisAplicada($encontrado["dosis_aplicada"]);
                $vacunacion->setFechaVacunacion($encontrado["fecha_vacunacion"]);
                $vacunacion->setCantidadAnimales($encontrado["cantidad_animales"]);
                $lista[] = $vacunacion;
            }
            return $lista;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            ;
            return json_encode($error);
        }
    }

    public function guardarEnDb()
    {
        $query = "INSERT INTO `vacunacion`(`id_vacuna`, `lugar_aplicacion`, `fecha_vacunacion`, `dosis_aplicada`, `cantidad_animales`) VALUES (:id_vacuna, :lugar_aplicacion, :fecha_vacunacion, :dosis_aplicada, :cantidad_animales)";
        try {
            self::getConexion();
            $id_vacuna = $this->getIdVacuna();
            $lugar_vacunacion = $this->getLugarAplicacion();
            $fecha_vacunacion = $this->getFechaVacunacion();
            $dosis_aplicada = $this->getDosisAplicada();
            $cantidad_animales = $this->getCantidadAnimales();


            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":id_vacuna", $id_vacuna, PDO::PARAM_STR);
            $resultado->bindParam(":lugar_aplicacion", $lugar_vacunacion, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_vacunacion", $fecha_vacunacion, PDO::PARAM_STR);
            $resultado->bindParam(":dosis_aplicada", $dosis_aplicada, PDO::PARAM_STR);
            $resultado->bindParam(":cantidad_animales", $cantidad_animales, PDO::PARAM_STR);

            $resultado->execute();
            self::desconectar();
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            echo $error;
            return json_encode($error);
        }
    }

    
    public function verificarExistenciaDb()
    {
        $query = "SELECT * FROM vacunacion where id_vacuna=:id_vacuna and fecha_vacunacion=:fecha_vacunacion";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $id_vacuna = $this->getIdVacuna();
            $fecha_vacunacion = $this->getFechaVacunacion();
            $resultado->bindParam(":id_vacuna", $id_vacuna, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_vacunacion", $fecha_vacunacion, PDO::PARAM_STR);
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
            echo $error;
        }
    }

    public function obtenerId()
    {
        $query = "SELECT id_vacunacion FROM vacunacion where id_vacuna=:id_vacuna and fecha_vacunacion=:fecha_vacunacion";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $id_vacuna = $this->getIdVacuna();
            $fecha_vacunacion = $this->getFechaVacunacion();
            $resultado->bindParam(":id_vacuna", $id_vacuna, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_vacunacion", $fecha_vacunacion, PDO::PARAM_STR);
            $resultado->execute();
            $idVacunacion = null;
            $idVacunacion = $resultado->fetchColumn();
            self::desconectar();
            return $idVacunacion;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            echo $error;
        }
    }


    public function guardarVacunacionAnimal($id_animal)
    {
        $query = "INSERT INTO `vacunacion_animal`(`id_vacunacion`, `id_animal`) VALUES (:id_vacunacion, :id_animal)";
        try {
            self::getConexion();
            $id_vacunacion = $this->getIdVacunacion();

            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":id_vacunacion", $id_vacunacion, PDO::PARAM_STR);
            $resultado->bindParam(":id_animal", $id_animal, PDO::PARAM_STR);
            $resultado->execute();
            self::desconectar();
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            echo $error;
            return json_encode($error);
        }
    }

    public function listarVacunasPuestas()
    {
        $query = "SELECT SUM(cantidad_animales) AS total_vacunas_puestas FROM Vacunacion";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            $row = $resultado->fetch();
            $totalVacunas = $row['total_vacunas_puestas'];
            return $totalVacunas;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            echo $error;
            return json_encode($error);
        }
    }

    




}


?>