<?php

require_once "../../config/conexion.php";

class Vacuna extends Conexion
{

    //Atributos de la clase
    protected static $conexion;

    private $idVacuna = null;

    private $idPrefijo = null;

    private $nombreVacuna = null;

    private $casaDistribuidora = null;

    private $descripcion = null;

    private $fechaVencimiento = null;

    private $lote = null;

    private $observaciones = null;

    //metodos de la clase

    public function __construct()
    {
    }

    //getters y setters

    public function getIdVacuna()
    {
        return $this->idVacuna;
    }

    public function setIdVacuna($idVacuna)
    {
        $this->idVacuna = $idVacuna;
    }

    public function getIdPrefijo()
    {
        return $this->idPrefijo;
    }

    public function setIdPrefijo($idPrefijo)
    {
        $this->idPrefijo = $idPrefijo;
    }

    public function getNombreVacuna()
    {
        return $this->nombreVacuna;
    }

    public function setNombreVacuna($nombreVacuna)
    {
        $this->nombreVacuna = $nombreVacuna;
    }

    public function getCasaDistribuidora()
    {
        return $this->casaDistribuidora;
    }

    public function setCasaDistribuidora($casaDistribuidora)
    {
        $this->casaDistribuidora = $casaDistribuidora;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getFechaVencimiento()
    {
        return $this->fechaVencimiento;
    }

    public function setFechaVencimiento($fechaVencimiento)
    {
        $this->fechaVencimiento = $fechaVencimiento;
    }

    public function getLote()
    {
        return $this->lote;
    }

    public function setLote($lote)
    {
        $this->lote = $lote;
    }

    public function getObservaciones()
    {
        return $this->observaciones;
    }

    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
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
        $query = "SELECT * FROM vacuna";
        $lista = array();
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $vacuna = new Vacuna();
                $prefijo = "VA";
                $vacuna->setIdVacuna($encontrado["id_vacuna"]);
                $id_personalizado = $prefijo . str_pad($vacuna->getIdVacuna(), 2, '0', STR_PAD_LEFT);
                $vacuna->setIdPrefijo($id_personalizado);
                $vacuna->setNombreVacuna($encontrado["nombre_vacuna"]);
                $vacuna->setCasaDistribuidora($encontrado["casa_distribuidora"]);
                $vacuna->setDescripcion($encontrado["descripcion"]);
                $vacuna->setFechaVencimiento($encontrado["fecha_vencimiento"]);
                $vacuna->setLote($encontrado["lote"]);
                $vacuna->setObservaciones($encontrado["observaciones"]);
                $lista[] = $vacuna;
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
        $query = "INSERT INTO `vacuna`(`nombre_vacuna`, `descripcion`, `fecha_vencimiento`, `lote`, `observaciones`,`casa_distribuidora` ) VALUES (:nombre_vacuna,:descripcion,:fecha_vencimiento,:lote, :observaciones,:casa_distribuidora)";
        try {
            self::getConexion();
            $nombre_vacuna = $this->getNombreVacuna();
            $descripcion = $this->getDescripcion();
            $casaDistribuidora = $this->getCasaDistribuidora();
            $fecha_vencimiento = $this->getFechaVencimiento();
            $lote = $this->getLote();
            $observaciones = $this->getObservaciones();


            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":nombre_vacuna", $nombre_vacuna, PDO::PARAM_STR);
            $resultado->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $resultado->bindParam(":casa_distribuidora", $casaDistribuidora, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_vencimiento", $fecha_vencimiento, PDO::PARAM_STR);
            $resultado->bindParam(":lote", $lote, PDO::PARAM_STR);
            $resultado->bindParam(":observaciones", $observaciones, PDO::PARAM_STR);

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
        $query = "SELECT * FROM vacuna where nombre_vacuna=:nombre_vacuna and casa_distribuidora=:casa_distribuidora";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $nombre_vacuna = $this->getNombreVacuna();
            $casa_distribuidora = $this->getCasaDistribuidora();
            $resultado->bindParam(":nombre_vacuna", $nombre_vacuna, PDO::PARAM_STR);
            $resultado->bindParam(":casa_distribuidora", $casa_distribuidora, PDO::PARAM_STR);
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

    public function verificarExistenciaId()
    {
        $query = "SELECT * FROM vacuna where id_vacuna=:id_vacuna";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $id = (int) substr($this->getIdPrefijo(), 3);
            $resultado->bindParam(":id_vacuna", $id, PDO::PARAM_STR);
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

    public function eliminar()
    {
        $idVacuna = $this->getIdVacuna();
        $query = "DELETE FROM vacuna WHERE `vacuna`.`id_vacuna` = :id_vacuna";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":id_vacuna", $idVacuna, PDO::PARAM_STR);
            $resultado->execute();
            self::desconectar();
            if (!(self::verificarExistenciaDb())) {
                return 0;
            } else {
                return 1;
            }
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }

    }




    public function listarVacunas(){
        $query = "SELECT id_vacuna, nombre_vacuna FROM vacuna";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error ".$Exception->getCode( ).": ".$Exception->getMessage( );;
            return json_encode($error);
        }
    }

   

}


?>