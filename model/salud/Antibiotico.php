<?php

require_once "../../config/conexion.php";

class Antibiotico extends Conexion
{

    //Atributos de la clase
    protected static $conexion;

    private $idAntibiotico = null;

    private $idPrefijo = null;

    private $nombreAntibiotico = null;

    private $tipoAntibiotico = null;

    private $descripcion = null;

    private $fechaVencimiento = null;

    private $lote = null;

    private $diasRetiro = null;

    //metodos de la clase

    public function __construct()
    {
    }

    //getters y setters

    public function getIdAntibiotico()
    {
        return $this->idAntibiotico;
    }

    public function setIdAntibiotico($idAntibiotico)
    {
        $this->idAntibiotico = $idAntibiotico;
    }

    public function getIdPrefijo()
    {
        return $this->idPrefijo;
    }

    public function setIdPrefijo($idPrefijo)
    {
        $this->idPrefijo = $idPrefijo;
    }

    public function getNombreAntibiotico()
    {
        return $this->nombreAntibiotico;
    }

    public function setNombreAntibiotico($nombreAntibiotico)
    {
        $this->nombreAntibiotico = $nombreAntibiotico;
    }

    public function getTipoAntibiotico()
    {
        return $this->tipoAntibiotico;
    }

    public function setTipoAntibiotico($tipoAntibiotico)
    {
        $this->tipoAntibiotico = $tipoAntibiotico;
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

    public function getDiasRetiro()
    {
        return $this->diasRetiro;
    }

    public function setDiasRetiro($diasRetiro)
    {
        $this->diasRetiro = $diasRetiro;
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
        $query = "SELECT * FROM antibiotico";
        $lista = array();
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $Antibiotico = new Antibiotico();
                $prefijo = "AN";
                $Antibiotico->setIdAntibiotico($encontrado["id_antibiotico"]);
                $id_personalizado = $prefijo . str_pad($Antibiotico->getIdAntibiotico(), 2, '0', STR_PAD_LEFT);
                $Antibiotico->setIdPrefijo($id_personalizado);
                $Antibiotico->setNombreAntibiotico($encontrado["nombre_antibiotico"]);
                $Antibiotico->setTipoAntibiotico($encontrado["tipo"]);
                $Antibiotico->setDescripcion($encontrado["descripcion"]);
                $Antibiotico->setFechaVencimiento($encontrado["fecha_vencimiento"]);
                $Antibiotico->setLote($encontrado["lote"]);
                $Antibiotico->setDiasRetiro($encontrado["dias_retiro_leche"]);
                $lista[] = $Antibiotico;
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
        $query = "INSERT INTO `antibiotico` (`nombre_antibiotico`, `tipo`, `descripcion`, `fecha_vencimiento`, `lote`, `dias_retiro_leche`) VALUES (:nombre_antibiotico, :tipo, :descripcion, :fecha_vencimiento, :lote, :dias_retiro_leche)";
        try {
            self::getConexion();
            $nombre_antibiotico = $this->getNombreAntibiotico();
            $descripcion = $this->getDescripcion();
            $tipo = $this->getTipoAntibiotico();
            $fecha_vencimiento = $this->getFechaVencimiento();
            $lote = $this->getLote();
            $diasRetiro = $this->getDiasRetiro();


            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":nombre_antibiotico", $nombre_antibiotico, PDO::PARAM_STR);
            $resultado->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $resultado->bindParam(":tipo", $tipo, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_vencimiento", $fecha_vencimiento, PDO::PARAM_STR);
            $resultado->bindParam(":lote", $lote, PDO::PARAM_STR);
            $resultado->bindParam(":dias_retiro_leche", $diasRetiro, PDO::PARAM_STR);

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
        $query = "SELECT * FROM Antibiotico where nombre_antibiotico=:nombre_antibiotico and tipo=:tipo";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $nombre_antibiotico = $this->getNombreAntibiotico();
            $tipo = $this->getTipoAntibiotico();
            $resultado->bindParam(":nombre_antibiotico", $nombre_antibiotico, PDO::PARAM_STR);
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
        $query = "SELECT * FROM antibiotico where id_antibiotico=:id_antibiotico";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $id = $this->getIdAntibiotico();
            $resultado->bindParam(":id_antibiotico", $id, PDO::PARAM_STR);
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
        $idAntibiotico = $this->getIdAntibiotico();
        $query = "DELETE FROM Antibiotico WHERE `antibiotico`.`id_antibiotico` = :id_antibiotico";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":id_antibiotico", $idAntibiotico, PDO::PARAM_STR);
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



    public function listarAntibioticos(){
        $query = "SELECT id_antibiotico, nombre_antibiotico FROM antibiotico";
        
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