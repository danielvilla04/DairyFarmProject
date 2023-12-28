<?php

require_once "../../config/conexion.php";

class produccion extends Conexion
{

    //Atributos de la clase
    protected static $conexion;

    private $areteAnimal = null;

    private $idProduccion = null;

    private $idAnimal= null;

    private $fechaProduccion = null;

    private $kilosProducidos = null;

    private $idPrefijo = null;

    private $observaciones = null;


    //metodos de la clase

    public function __construct()
    {

    }

    //getters y setters

    public function getIdAnimal ()
    {
        return $this->idAnimal ;
    }

    public function setIdAnimal ($idAnimal)
    {
        $this->idAnimal  = $idAnimal ;
    } 

    public function getAreteAnimal ()
    {
        return $this->areteAnimal ;
    }

    public function setAreteAnimal ($areteAnimal)
    {
        $this->areteAnimal  = $areteAnimal ;
    } 
    
    public function getIdProduccion ()
    {
        return $this->idProduccion; 
    
    }

    public function setIdProduccion($idProduccion)
{  
    $this->idProduccion = $idProduccion;
}


    public function getFechaProduccion ()
    {
        return $this->fechaProduccion;
    }

    public function setFechaProduccion ($fechaProduccion )
    {
        $this->fechaProduccion  = $fechaProduccion;
    }

     
    public function getKilosProducidos ()
    {
        return $this->kilosProducidos ;
    }
    public function setKilosProducidos ($kilosProducidos )
    {
        $this->kilosProducidos  = $kilosProducidos;
    }

    public function getIdPrefijo()
    {
        return $this->idPrefijo;
    }

    public function setIdPrefijo($idPrefijo)
    {
        $this->idPrefijo = $idPrefijo;
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
        $query = "SELECT *
        FROM produccion 
       INNER JOIN animal ON produccion.id_vaca = animal.id_animal";
        $lista = array();
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $Produccion = new produccion();
                $prefijo = "PR";
                $Produccion->setIdProduccion($encontrado["idProduccion"]);
                $id_personalizado = $prefijo . str_pad($Produccion->getIdProduccion(), 2, '0', STR_PAD_LEFT);
                $Produccion->setIdPrefijo($id_personalizado);
                $Produccion->setAreteAnimal($encontrado["numero_arete"]);
                $Produccion->setIdAnimal($encontrado["id_vaca"]);
                $Produccion->setFechaProduccion($encontrado["fecha"]);
                $Produccion->setKilosProducidos($encontrado["litros"]);
                $Produccion->setObservaciones($encontrado["observacionesPr"]);
                $lista[] = $Produccion;
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
        $query = "INSERT INTO `produccion` (`fecha`, `id_vaca`, `litros`, `observacionesPr`) VALUES (:fecha, :id_vaca, :litros, :observacionesPr);";
        try {
            self::getConexion();
          
            $id_animal = $this->getIdAnimal();
            $fecha_Produccion = $this->getFechaProduccion();
            $observaciones = $this->getObservaciones();
            $kilosProducidos = $this->getKilosProducidos();

            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":id_vaca", $id_animal, PDO::PARAM_STR);
            $resultado->bindParam(":fecha", $fecha_Produccion, PDO::PARAM_STR);
            $resultado->bindParam(":observacionesPr", $observaciones, PDO::PARAM_STR);
            $resultado->bindParam(":litros", $kilosProducidos, PDO::PARAM_STR);

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
        $query = "SELECT * FROM produccion where produccion.id_vaca=:id_vaca  and fecha =:fecha_produccion";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $idAnimal = $this->getIdAnimal();
            $fechaProduccion = $this->getFechaProduccion();
            $resultado->bindParam(":id_vaca", $idAnimal, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_produccion", $fechaProduccion, PDO::PARAM_STR);
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

    public function verificarExistenciaModificar()
    {

         $idProduccion = $this->getIdProduccion();
        $query = "DELETE FROM Produccion WHERE `Produccion`.`id_Produccion` = :id_Produccion";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":id_Produccion", $idProduccion, PDO::PARAM_STR);
         
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
        $idProduccion = $this->getIdProduccion();
        $query = "DELETE FROM produccion WHERE `produccion`.`idProduccion` = :idProduccion";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":idProduccion", $idProduccion, PDO::PARAM_STR);
            $resultado->execute();
            self::desconectar();
            if (!(self::verificarExistenciaModificar())) {
                return 1;
            } else {
                return 0;
            }
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }

    }


    

    public function obtenerCantidadProduccion() {
        $query = "SELECT COUNT(*) as cantidad FROM produccion";

        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            $cantidad = $resultado->fetchColumn();
            self::desconectar();

            return $cantidad;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode(['error' => $error]);
        }
    }

    public function obtenerSumaIngresos() {
        $query = "SELECT SUM(litros) as suma FROM produccion";

        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            $suma = $resultado->fetchColumn();
            self::desconectar();

            return $suma;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode(['error' => $error]);
        }
    }


}


?>