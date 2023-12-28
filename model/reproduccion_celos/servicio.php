<?php

require_once "../../config/conexion.php";

class servicio extends Conexion
{

    //Atributos de la clase
    protected static $conexion;
    private $idServicio = null;
    private $idAnimalVaca = null;

    private $idPrefijo = null;

    private $areteAnimal = null;
    private $tipoServicio = null;


    private $fechaDiagnostico = null;

    private $observaciones = null;


    //metodos de la clase

    public function __construct()
    {
    }

    //getters y setters
    public function setIdServicio($idServicio)
    {
        $this->idServicio = $idServicio;
    }

    public function getIdServicio()
    {
        return $this->idServicio;
    }

    public function setIdAnimalVaca($idAnimalVaca)
    {
        $this->idAnimalVaca = $idAnimalVaca;
    }

    public function getIdAnimalVaca()
    {
        return $this->idAnimalVaca;
    }



    public function setIdPrefijo($idPrefijo)
    {
        $this->idPrefijo = $idPrefijo;
    }

    public function getIdPrefijo()
    {
        return $this->idPrefijo;
    }



    public function setAreteAnimal($areteAnimal)
    {
        $this->areteAnimal = $areteAnimal;
    }

    public function getAreteAnimal()
    {
        return $this->areteAnimal;
    }
    public function setTipoServicio($tipoServicio)
    {
        $this->tipoServicio = $tipoServicio;
    }

    public function getTipoServicio()
    {
        return $this->tipoServicio;
    }

    public function setFechaDiagnostico($fechaDiagnostico)
    {
        $this->fechaDiagnostico = $fechaDiagnostico;
    }

    public function getFechaDiagnostico()
    {
        return $this->fechaDiagnostico;
    }

    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    }

    public function getObservaciones()
    {
        return $this->observaciones;
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
        $query = "SELECT * FROM servicio 
        INNER JOIN animal ON servicio.id_animal = animal.id_animal";
        $lista = array();
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $servicio = new servicio();
                $prefijo = "SE";
                $servicio->setIdservicio($encontrado["id_servicio"]);
                $id_personalizado = $prefijo . str_pad($servicio->getIdservicio(), 2, '0', STR_PAD_LEFT);
                $servicio->setIdPrefijo($id_personalizado);
                $servicio->setAreteAnimal($encontrado["numero_arete"]);
                $servicio->setIdAnimalVaca($encontrado["id_animal"]);
                $servicio->setFechaDiagnostico($encontrado["fecha_servicio"]);
                $servicio->setTipoServicio($encontrado["tipo_servicio"]);
                $servicio->setObservaciones($encontrado["observaciones"]);
                $lista[] = $servicio;
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
        $query = "INSERT INTO `servicio` ( `id_animal`, `fecha_servicio`, `tipo_servicio`,`observaciones`) VALUES (:id_vaca,:fecha_servicio, :tipo_servicio,:observaciones)";

        try {
            self::getConexion();
            $id_vaca = $this->getIdAnimalVaca();
            $fecha_servicio = $this->getFechaDiagnostico();
            $tipo_servicio = $this->getTipoServicio();
            $observaciones = $this->getObservaciones();

            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":id_vaca", $id_vaca, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_servicio", $fecha_servicio, PDO::PARAM_STR);
            $resultado->bindParam(":tipo_servicio", $tipo_servicio, PDO::PARAM_STR);
            $resultado->bindParam(":observaciones", $observaciones, PDO::PARAM_STR);
            $resultado->execute();
            $id_servicio = self::$conexion->lastInsertId();
            if ($this->verificarExistenciaServicio($id_servicio)) {
            
                // Insertar el registro en Vaca_Prenada
                $queryVacaPrenada = "INSERT INTO `Vaca_Prenada` (`id_servicio`) VALUES (:id_servicio)";
                $resultadoVacaPrenada = self::$conexion->prepare($queryVacaPrenada);
                $resultadoVacaPrenada->bindParam(":id_servicio", $id_servicio, PDO::PARAM_STR);
                $resultadoVacaPrenada->execute();
                self::desconectar();
            } else {
                echo "El servicio no existe.";
            }
            

            
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            echo $error;
            return json_encode($error);
        }
    }


// Función para verificar la existencia de un servicio
private function verificarExistenciaServicio($id_servicio)
{
    $query = "SELECT COUNT(*) FROM `servicio` WHERE `id_servicio` = :id_servicio";
    $resultado = self::$conexion->prepare($query);
    $resultado->bindParam(":id_servicio", $id_servicio, PDO::PARAM_STR);
    $resultado->execute();

    $count = $resultado->fetchColumn();

    return $count > 0;
}

    public function verificarExistenciaDb()
    {
        $query = "SELECT * FROM servicio where servicio.id_animal=:id_animal and fecha_servicio =:fecha_servicio";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $idAnimalVaca = $this->getIdAnimalVaca();
            $fechaDiagnostico = $this->getFechaDiagnostico();
            $resultado->bindParam(":id_animal", $idAnimalVaca, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_servicio", $fechaDiagnostico, PDO::PARAM_STR);
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

    public function verificarExistenciaId()
    {
        $query = "SELECT * FROM servicio where id_servicio=:id_servicio";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $id = (int) substr($this->getIdPrefijo(), 3);
            $resultado->bindParam(":id_servicio", $id, PDO::PARAM_STR);
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

  

    public function listarServicios()
    {
        $query = "SELECT Servicio.*, Animal.numero_arete
        FROM Servicio
        INNER JOIN Animal ON Servicio.id_animal = Animal.id_animal
        WHERE Servicio.fecha_servicio >= CURDATE() - INTERVAL 1 MONTH;";
        $lista = array();
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $servicio = new servicio();
                $servicio->setAreteAnimal($encontrado["numero_arete"]);
                $servicio->setFechaDiagnostico($encontrado["fecha_servicio"]);
                $servicio->setTipoServicio($encontrado["tipo_servicio"]);
                $lista[] = $servicio;
            }
            return $lista;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            ;
            return json_encode($error);
        }
    }

    

    public function obtenerCantidadServicio() {
        $query = "SELECT COUNT(*) as cantidad FROM servicio";

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

    public function obtenerServicios()
    {
        $query = "SELECT *
                  FROM servicio 
                  INNER JOIN Animal ON Servicio.id_animal = Animal.id_animal";

        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            ;
            return json_encode($error);
        }
    }
    





}


?>