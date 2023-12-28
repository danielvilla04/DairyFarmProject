<?php

require_once "../../config/conexion.php";

class Secado extends Conexion
{

    //Atributos de la clase
    protected static $conexion;

    private $idSecado = null;

    private $idPrefijo = null;

    private $idAnimal = null;

    private $areteAnimal = null;

    private $fechaSecado = null;

    private $observaciones = null;



    //metodos de la clase

    public function __construct()
    {
    }

    //getters y setters

    public function getIdSecado()
    {
        return $this->idSecado;
    }

    public function setIdSecado($idSecado)
    {
        $this->idSecado = $idSecado;
    }

    public function getIdAnimal()
    {
        return $this->idAnimal;
    }

    public function setIdAnimal($idAnimal)
    {
        $this->idAnimal = $idAnimal;
    }

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


    public function getFechaSecado()
    {
        return $this->fechaSecado;
    }

    public function setFechaSecado($fechaSecado)
    {
        $this->fechaSecado = $fechaSecado;
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
        $query = "SELECT se.id_secado,se.fecha_secado, se.observaciones, numero_arete
        FROM secado as se
        INNER JOIN animal ON se.id_animal = animal.id_animal";
        $lista = array();
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $Secado = new Secado();
                $prefijo = "SE";
                $Secado->setIdSecado($encontrado["id_secado"]);
                $id_personalizado = $prefijo . str_pad($Secado->getIdSecado(), 2, '0', STR_PAD_LEFT);
                $Secado->setIdPrefijo($id_personalizado);
                $Secado->setAreteAnimal($encontrado["numero_arete"]);
                $Secado->setFechaSecado($encontrado["fecha_secado"]);
                $Secado->setObservaciones($encontrado["observaciones"]);
                $lista[] = $Secado;
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
        $query = "INSERT INTO `secado` (`id_animal`,`fecha_secado`, `observaciones`) VALUES (:id_animal, :fecha_secado, :observaciones)";
        try {
            self::getConexion();
          
            $id_animal = $this->getIdAnimal();
            $fecha_secado = $this->getFechaSecado();
            $observaciones = $this->getObservaciones();

            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":id_animal", $id_animal, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_secado", $fecha_secado, PDO::PARAM_STR);
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
        $query = "SELECT * FROM secado where secado.id_animal=:id_animal  and fecha_secado =:fecha_secado";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $idAnimal = $this->getIdAnimal();
            $fechaSecado = $this->getFechaSecado();
            $resultado->bindParam(":id_animal", $idAnimal, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_secado", $fechaSecado, PDO::PARAM_STR);
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

         $idSecado = $this->getIdSecado();
        $query = "DELETE FROM secado WHERE `secado`.`id_secado` = :id_secado";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":id_secado", $idSecado, PDO::PARAM_STR);
         
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
        $idSecado = $this->getIdSecado();
        $query = "DELETE FROM secado WHERE `secado`.`id_secado` = :id_secado";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":id_secado", $idSecado, PDO::PARAM_STR);
            $resultado->execute();
            self::desconectar();
            if (!(self::verificarExistenciaModificar())) {
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


    public function actualizarSecado()
    {
        $query = "UPDATE secado
        SET sintomas_animal = :sintomas_animal,
            estado_animal = :estado_animal,
            observaciones = :observaciones
        WHERE enfermedad_animal.id_enfermedad = (
                SELECT id_enfermedad 
                FROM enfermedad 
                WHERE nombre_enfermedad = :nombre_enfermedad
            ) 
            AND enfermedad_animal.id_animal = (
                SELECT id_animal 
                FROM animal 
                WHERE numero_arete = :numero_arete
            ) 
            AND fecha_diagnostico = :fecha_diagnostico";
        try {
            self::getConexion();
            $sintomas = $this->getSintomasAnimal();
            $estadoAnimal = $this->getEstadoAnimal();
            $observaciones = $this->getObservaciones();
            $nombreEnfermedad = $this->getNombreEnfermedad();
            $areteAnimal = $this->getAreteAnimal();
            $fechaDiagnostico = $this->getFechaDiagnostico();
            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":estado_animal", $estadoAnimal, PDO::PARAM_STR);
            $resultado->bindParam(":sintomas_animal", $sintomas, PDO::PARAM_STR);
            $resultado->bindParam(":observaciones", $observaciones, PDO::PARAM_STR);
            $resultado->bindParam(":nombre_enfermedad", $nombreEnfermedad, PDO::PARAM_STR);
            $resultado->bindParam(":numero_arete", $areteAnimal, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_diagnostico", $fechaDiagnostico, PDO::PARAM_STR);
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