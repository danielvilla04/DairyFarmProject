<?php

require_once "../../config/conexion.php";

class Enfermedad extends Conexion
{

    //Atributos de la clase
    protected static $conexion;

    private $idEnfermedad =null;

    private $idPrefijo =null;

    private $nombreEnfermedad = null;

    private $descripcion = null;

    private $sintomas = null;

    private $tratamiento = null;

    //metodos de la clase

    public function __construct()
    {
    }

    //getters y setters

    public function getIdPrefijo()
    {
        return $this->idPrefijo;
    }

    public function setIdPrefijo($idPrefijo)
    {
        $this->idPrefijo = $idPrefijo;
    }

    public function getIdEnfermedad()
    {
        return $this->idEnfermedad;
    }

    public function setIdEnfermedad($idEnfermedad)
    {
        $this->idEnfermedad = $idEnfermedad;
    }

    public function getNombreEnfermedad()
    {
        return $this->nombreEnfermedad;
    }

    public function setNombreEnfermedad($nombreEnfermedad)
    {
        $this->nombreEnfermedad = $nombreEnfermedad;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getSintomas()
    {
        return $this->sintomas;
    }

    public function setSintomas($sintomas)
    {
        $this->sintomas = $sintomas;
    }

    public function getTratamiento()
    {
        return $this->tratamiento;
    }

    public function setTratamiento($tratamiento)
    {
        $this->tratamiento = $tratamiento;
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

    public function concatenarID(){
     
    }


    public function listarDB()
    {
        $query = "SELECT * FROM enfermedad";
        $lista = array();
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $enfermedad = new Enfermedad();
                $prefijo ="EF";
                $enfermedad->setIdEnfermedad($encontrado["id_enfermedad"]);
                $id_personalizado = $prefijo . str_pad($enfermedad->getIdEnfermedad(), 2, '0', STR_PAD_LEFT);
                $enfermedad->setIdPrefijo($id_personalizado);
                $enfermedad->setnombreEnfermedad($encontrado["nombre_enfermedad"]);
                $enfermedad->setDescripcion($encontrado["descripcion"]);
                $enfermedad->setSintomas($encontrado["sintomas"]);
                $enfermedad->setTratamiento($encontrado["tratamiento"]);
                $lista[] = $enfermedad;
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
        $query = "INSERT INTO `enfermedad`(`nombre_enfermedad`, `descripcion`, `sintomas`, `tratamiento`) VALUES (:nombre_enfermedad,:descripcion,:sintomas,:tratamiento)";
        try {
            self::getConexion();
            $nombre_enfermedad = $this->getNombreEnfermedad();
            $descripcion = $this->getDescripcion();
            $sintomas = $this->getSintomas();
            $tratamiento = $this->getTratamiento();


            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":nombre_enfermedad", $nombre_enfermedad, PDO::PARAM_STR);
            $resultado->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $resultado->bindParam(":sintomas", $sintomas, PDO::PARAM_STR);
            $resultado->bindParam(":tratamiento", $tratamiento, PDO::PARAM_STR);

            $resultado->execute();
            self::desconectar();
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            echo $error;
            return json_encode($error);
        }
    }

    public function verificarExistenciaDb(){
            $query = "SELECT * FROM enfermedad where nombre_enfermedad=:nombre_enfermedad";
            
            try {
             self::getConexion();
                $resultado = self::$conexion->prepare($query);		
                $nombreEnfermedad= $this->getNombreEnfermedad();	
                $resultado->bindParam(":nombre_enfermedad",$nombreEnfermedad,PDO::PARAM_STR);
                $resultado->execute();
                self::desconectar();
                $encontrado = false;
                foreach ($resultado->fetchAll() as $reg) {
                    $encontrado = true;
                }
                return $encontrado;
               } catch (PDOException $Exception) {
                   self::desconectar();
                   $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
                 return $error;
               } 
        }

    public function eliminar()
    {
        $nombre = $this->getNombreEnfermedad();
        $query = "DELETE FROM enfermedad WHERE `enfermedad`.`nombre_enfermedad` = :nombre_enfermedad";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":nombre_enfermedad", $nombre, PDO::PARAM_STR);
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


    public function actualizarEnfermedad(){
        $query = "update enfermedad set descripcion=:descripcion,sintomas=:sintomas,tratamiento=:tratamiento where nombre_enfermedad=:nombre_enfermedad";
        try {
            self::getConexion();
            $nombreEnfermedad = $this->getNombreEnfermedad();
            $descripcion=$this->getDescripcion();
            $sintomas=$this->getSintomas();
            $tratamiento=$this->getTratamiento();
            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":nombre_enfermedad",$nombreEnfermedad, PDO::PARAM_STR);
            $resultado->bindParam(":descripcion",$descripcion,PDO::PARAM_STR);
            $resultado->bindParam(":sintomas",$sintomas,PDO::PARAM_STR);
            $resultado->bindParam(":tratamiento",$tratamiento,PDO::PARAM_STR);
            self::$conexion->beginTransaction();//desactiva el autocommit
            $resultado->execute();
            self::$conexion->commit();//realiza el commit y vuelve al modo autocommit
            self::desconectar();
            return $resultado->rowCount();
        } catch (PDOException $Exception) {
            self::$conexion->rollBack();
            self::desconectar();
            $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
            echo $error;
        }
    }

    public function listarEnfermedades(){
        $query = "SELECT id_enfermedad, nombre_enfermedad FROM enfermedad";
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