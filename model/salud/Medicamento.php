<?php

require_once "../../config/conexion.php";

class Medicamento extends Conexion
{

    //Atributos de la clase
    protected static $conexion;

    private $idMedicamento = null;

    private $idPrefijo = null;

    private $nombreMedicamento = null;

    private $tipoMedicamento = null;

    private $descripcion = null;

    private $fechaVencimiento = null;

    private $lote = null;

    private $presentacion = null;

    //metodos de la clase

    public function __construct()
    {
    }

    //getters y setters

    public function getIdMedicamento()
    {
        return $this->idMedicamento;
    }

    public function setIdMedicamento($idMedicamento)
    {
        $this->idMedicamento = $idMedicamento;
    }

    public function getIdPrefijo()
    {
        return $this->idPrefijo;
    }

    public function setIdPrefijo($idPrefijo)
    {
        $this->idPrefijo = $idPrefijo;
    }

    public function getNombreMedicamento()
    {
        return $this->nombreMedicamento;
    }

    public function setNombreMedicamento($nombreMedicamento)
    {
        $this->nombreMedicamento = $nombreMedicamento;
    }

    public function getTipoMedicamento()
    {
        return $this->tipoMedicamento;
    }

    public function setTipoMedicamento($tipoMedicamento)
    {
        $this->tipoMedicamento = $tipoMedicamento;
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

    public function getPresentacion()
    {
        return $this->presentacion;
    }

    public function setPresentacion($presentacion)
    {
        $this->presentacion = $presentacion;
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
        $query = "SELECT * FROM Medicamento";
        $lista = array();
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $Medicamento = new Medicamento();
                $prefijo = "ME";
                $Medicamento->setIdMedicamento($encontrado["id_medicamento"]);
                $id_personalizado = $prefijo . str_pad($Medicamento->getIdMedicamento(), 2, '0', STR_PAD_LEFT);
                $Medicamento->setIdPrefijo($id_personalizado);
                $Medicamento->setNombreMedicamento($encontrado["nombre_medicamento"]);
                $Medicamento->setTipoMedicamento($encontrado["tipo"]);
                $Medicamento->setDescripcion($encontrado["descripcion"]);
                $Medicamento->setFechaVencimiento($encontrado["fecha_vencimiento"]);
                $Medicamento->setLote($encontrado["lote"]);
                $Medicamento->setPresentacion($encontrado["presentacion"]);
                $lista[] = $Medicamento;
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
        $query = "INSERT INTO `medicamento` (`nombre_medicamento`, `tipo`, `descripcion`, `fecha_vencimiento`, `lote`, `presentacion`) VALUES (:nombre_medicamento, :tipo, :descripcion, :fecha_vencimiento, :lote, :presentacion)";
        try {
            self::getConexion();
            $nombre_medicamento = $this->getNombreMedicamento();
            $descripcion = $this->getDescripcion();
            $tipo = $this->getTipoMedicamento();
            $fecha_vencimiento = $this->getFechaVencimiento();
            $lote = $this->getLote();
            $presentacion = $this->getPresentacion();


            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":nombre_medicamento", $nombre_medicamento, PDO::PARAM_STR);
            $resultado->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $resultado->bindParam(":tipo", $tipo, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_vencimiento", $fecha_vencimiento, PDO::PARAM_STR);
            $resultado->bindParam(":lote", $lote, PDO::PARAM_STR);
            $resultado->bindParam(":presentacion", $presentacion, PDO::PARAM_STR);

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
        $query = "SELECT * FROM Medicamento where nombre_medicamento=:nombre_medicamento and tipo=:tipo";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $nombre_medicamento = $this->getNombreMedicamento();
            $tipo = $this->getTipoMedicamento();
            $resultado->bindParam(":nombre_medicamento", $nombre_medicamento, PDO::PARAM_STR);
            $resultado->bindParam(":tipo", $tipo, PDO::PARAM_STR);
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
        $query = "SELECT * FROM Medicamento where id_medicamento=:id_medicamento";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $id = $this->getIdMedicamento();
            $resultado->bindParam(":id_medicamento", $id, PDO::PARAM_STR);
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
        $idMedicamento = $this->getIdMedicamento();
        $query = "DELETE FROM Medicamento WHERE `medicamento`.`id_medicamento` = :id_medicamento";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":id_medicamento", $idMedicamento, PDO::PARAM_STR);
            $resultado->execute();
            self::desconectar();
            if (!(self::verificarExistenciaId())) {
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



    public function listarMedicamentos(){
        $query = "SELECT id_medicamento, nombre_medicamento FROM medicamento";
        
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error ".$Exception->getCode( ).": ".$Exception->getMessage( );;
            return json_encode($error);
        }
    }

}


?>