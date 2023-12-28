<?php

require_once "../../config/conexion.php";

class celos extends Conexion
{

    //Atributos de la clase
    protected static $conexion;
    private $idCelo =null;
    private $idAnimal =null;

    private $idPrefijo = null;

    private $detallesCelo = null;

    private $areteAnimal = null;

    private $fechaDiagnostico = null;

    private $observaciones = null;


    //metodos de la clase

    public function __construct()
    {
    }

    //getters y setters
    public function getAreteAnimal()
    {
        return $this->areteAnimal;
    }

    public function setAreteAnimal($areteAnimal)
    {
        $this->areteAnimal = $areteAnimal;
    }

    public function getIdPrefijo()
    {
        return $this->idPrefijo;
    }
    public function setIdPrefijo($idPrefijo)
    {
        $this->idPrefijo = $idPrefijo;
    }
    public function getIdAnimal()
    {
        return $this->idAnimal;
    }
    public function setIdAnimal($idAnimal)
    {
        $this->idAnimal = $idAnimal;
    }
    public function setIdCelo($idCelo)
    {
        $this->idCelo = $idCelo;
    }

    public function getIdCelo()
    {
        return $this->idCelo;
    }


    public function getDetallesCelos()
    {
        return $this->detallesCelo;
    }

    public function setDetallesCelo($detallesCelo)
    {
        $this->detallesCelo = $detallesCelo;
    }

    public function getFechaDiagnostico()
    {
        return $this->fechaDiagnostico;
    }

    public function setFechaDiagnostico($fechaDiagnostico)
    {
        $this->fechaDiagnostico = $fechaDiagnostico;
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
        $query = "SELECT * FROM celo 
        INNER JOIN animal ON celo.id_animal = animal.id_animal";
                $lista = array();
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $celo = new celos();
                $prefijo = "CE";
                $celo->setIdCelo($encontrado["id_celo"]);
                $id_personalizado = $prefijo . str_pad($celo->getIdcelo(), 2, '0', STR_PAD_LEFT);
                $celo->setIdPrefijo($id_personalizado);
                $celo->setIdAnimal($encontrado["id_animal"]);
                $celo->setAreteAnimal($encontrado["numero_arete"]);
                $celo->setFechaDiagnostico($encontrado["fecha_celo"]);
                $celo->setDetallesCelo($encontrado["detalles_celo"]);
           
                $lista[] = $celo;
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
        $query = "INSERT INTO `celo` (`id_celo`, `id_animal`, `fecha_celo`, `detalles_celo`) VALUES (:id_celo, :id_animal, :fecha_celo, :detalles_celo)";
        try {
            self::getConexion();
            $id_celo = $this->getIdCelo();
            $id_animal = $this->getIdAnimal();
           
            $fecha_diagnostico = $this->getFechaDiagnostico();
            $detalles_celo = $this->getDetallesCelos();
         


            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":id_celo", $id_celo, PDO::PARAM_STR);
            $resultado->bindParam(":id_animal", $id_animal, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_celo", $fecha_diagnostico, PDO::PARAM_STR);
            $resultado->bindParam(":detalles_celo", $detalles_celo, PDO::PARAM_STR);
 

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
        $query = "SELECT * FROM celo where celo.id_animal=:id_animal and fecha_celo =:fecha_celo";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $idAnimal = $this->getIdAnimal();
            $fechaDiagnostico = $this->getFechaDiagnostico();
            $resultado->bindParam(":id_animal", $idAnimal, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_celo", $fechaDiagnostico, PDO::PARAM_STR);
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
        $query = "SELECT * FROM celo where id_celo=:id_celo";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $id = (int) substr($this->getIdPrefijo(), 3);
            $resultado->bindParam(":id_celo", $id, PDO::PARAM_STR);
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

    public function eliminar()
    {
        $id_celo = $this->getIdCelo(); 
        $query = "DELETE FROM celo WHERE `celo`.`id_celo` = :id_celo";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":id_celo", $id_celo, PDO::PARAM_STR);
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

    public function listarCelosGrafica()
    {
        $query = "SELECT MONTH(fecha_celo) AS mes, COUNT(*) AS cantidad_celos
        FROM celo
        GROUP BY MONTH(fecha_celo)";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            return $resultado->fetchAll(PDO::FETCH_ASSOC);;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            ;
            return json_encode($error);
        }
    }

    public function listarcelos()
    {
        $query = "SELECT Celo.*, Animal.numero_arete
        FROM Celo
        INNER JOIN Animal ON Celo.id_animal = Animal.id_animal
        WHERE Celo.fecha_celo >= CURDATE() - INTERVAL 1 MONTH";
                $lista = array();
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $celos = new celos();
                $celos->setAreteAnimal($encontrado["numero_arete"]);
                $celos->setFechaDiagnostico($encontrado["fecha_celo"]);
                $celos->setDetallesCelo($encontrado["detalles_celo"]);
                $lista[] = $celos;
            }
            return $lista;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            ;
            return json_encode($error);
        }
    }

    public function obtenerCelos(){
        $query = "SELECT *
                  FROM celo 
                  INNER JOIN Animal ON Celo.id_animal = Animal.id_animal";
 
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

    public function obtenerCantidadCelos() {
        $query = "SELECT COUNT(*) as cantidad FROM celo";

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


    


}


?>