<?php

require_once "../../config/conexion.php";

class Parto extends Conexion
{

    //Atributos de la clase
    protected static $conexion;

    private $idVaca = null;
    private $idParto = null;
    private $idPrefijo = null;
    private $numeroArete = null;

    private $fechaParto = null;

    private $tipoParto = null;

    private $observaciones = null;

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
    public function getIdParto()
    {
        return $this->idParto;
    }

    public function setIdParto($idParto)
    {
        $this->idParto = $idParto;
    }
    public function getNumeroArete()
    {
        return $this->numeroArete;
    }

    public function setNumeroArete($numeroArete)
    {
        $this->numeroArete = $numeroArete;
    }

    public function getIdVaca()
    {
        return $this->idVaca;
    }

    public function setIdVaca($idVaca)
    {
        $this->idVaca = $idVaca;
    }

    public function getFechaParto()
    {
        return $this->fechaParto;
    }

    public function setFechaParto($fechaParto)
    {
        $this->fechaParto = $fechaParto;
    }

    public function getTipoParto()
    {
        return $this->tipoParto;
    }

    public function setTipoParto($tipoParto)
    {
        $this->tipoParto = $tipoParto;
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

    public function concatenarID()
    {

    }


    public function listarDB()
    {
        $query = "SELECT * FROM parto
        INNER JOIN animal ON parto.id_vaca = animal.id_animal";
        $lista = array();
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $parto = new Parto();
                $prefijo = "PA";
                $parto->setIdParto($encontrado["id_parto"]);
                $id_personalizado = $prefijo . str_pad($parto->getIdParto(), 2, '0', STR_PAD_LEFT);
                $parto->setIdPrefijo($id_personalizado);
                $parto->setNumeroArete($encontrado["numero_arete"]);
                $parto->setfechaParto($encontrado["fecha_parto"]);
                $parto->setTipoParto($encontrado["tipo_parto"]);
                $parto->setObservaciones($encontrado["observaciones"]);

                $lista[] = $parto;
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
        $query = "INSERT INTO `parto` (`id_vaca`, `fecha_parto`, `tipo_parto`, `observaciones`) VALUES (:id_vaca, :fecha_parto, :tipo_parto, :observaciones)";
        try {
            self::getConexion();
            $id_animal = $this->getIdVaca();
            $fecha_parto = $this->getfechaParto();
            $tipoParto = $this->getTipoParto();
            $observaciones = $this->getObservaciones();


            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":id_vaca", $id_animal, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_parto", $fecha_parto, PDO::PARAM_STR);
            $resultado->bindParam(":tipo_parto", $tipoParto, PDO::PARAM_STR);
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
        $query = "SELECT * FROM parto where id_vaca = :id_vaca and fecha_parto=:fecha_parto";

        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $id_animal = $this->getIdVaca();
            $fechaParto = $this->getfechaParto();
            $resultado->bindParam(":id_vaca", $id_animal, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_parto", $fechaParto, PDO::PARAM_STR);
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
        $query = "SELECT * FROM parto where id_parto = :id_parto";

        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $id = $this->getIdParto();
            $resultado->bindParam(":id_parto", $id, PDO::PARAM_STR);

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
        $id = $this->getIdParto();
        $query = "DELETE FROM parto WHERE `parto`.`id_parto` = :id_parto";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":id_parto", $id, PDO::PARAM_STR);
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


    public function actualizarparto()
    {
        $query = "update parto set tipoParto=:tipoParto,observaciones=:observaciones, wherefecha_parto=:fecha_parto";
        try {
            self::getConexion();
            $fechaParto = $this->getFechaParto();
            $tipoParto = $this->getTipoParto();
            $observaciones = $this->getObservaciones();

            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":fecha_parto", $fechaParto, PDO::PARAM_STR);
            $resultado->bindParam(":tipo_parto", $tipoParto, PDO::PARAM_STR);
            $resultado->bindParam(":observaciones", $observaciones, PDO::PARAM_STR);

            self::$conexion->beginTransaction(); //desactiva el autocommit
            $resultado->execute();
            self::$conexion->commit(); //realiza el commit y vuelve al modo autocommit
            self::desconectar();
            return $resultado->rowCount();
        } catch (PDOException $Exception) {
            self::$conexion->rollBack();
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            echo $error;
        }
    }

    public function listarparto()
    {
        $query = "SELECT id_parto, fecha_parto FROM parto";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            ;
            return json_encode($error);
        }
    }

    public function listarPartosGrafica()
    {
        $query = "SELECT MONTH(fecha_parto) AS mes, COUNT(*) AS cantidad_partos
        FROM parto
        GROUP BY MONTH(fecha_parto)";
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

    public function obtenerPartos()
    {
        $query = "SELECT *
                  FROM parto 
                  INNER JOIN Animal ON parto.id_vaca = Animal.id_animal";

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