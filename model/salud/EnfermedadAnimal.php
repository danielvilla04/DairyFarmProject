<?php

require_once "../../config/conexion.php";

class EnfermedadAnimal extends Conexion
{

    //Atributos de la clase
    protected static $conexion;

    private $idEnfermedadAnimal = null;

    private $idPrefijo = null;

    private $idEnfermedad = null;

    private $nombreEnfermedad = null;

    private $idAnimal = null;

    private $nombreAnimal = null;

    private $areteAnimal = null;

    private $estadoAnimal = null;

    private $sintomasAnimal = null;

    private $fechaDiagnostico = null;

    private $observaciones = null;

    private $tratamiento = null;


    //metodos de la clase

    public function __construct()
    {
    }

    //getters y setters

    public function getIdEnfermedadAnimal()
    {
        return $this->idEnfermedadAnimal;
    }

    public function setIdEnfermedadAnimal($idEnfermedadAnimal)
    {
        $this->idEnfermedadAnimal = $idEnfermedadAnimal;
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

    public function getIdAnimal()
    {
        return $this->idAnimal;
    }

    public function setIdAnimal($idAnimal)
    {
        $this->idAnimal = $idAnimal;
    }

    public function getNombreAnimal()
    {
        return $this->nombreAnimal;
    }

    public function setNombreAnimal($nombreAnimal)
    {
        $this->nombreAnimal = $nombreAnimal;
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

    public function getEstadoAnimal()
    {
        return $this->estadoAnimal;
    }

    public function setEstadoAnimal($estadoAnimal)
    {
        $this->estadoAnimal = $estadoAnimal;
    }

    public function getSintomasAnimal()
    {
        return $this->sintomasAnimal;
    }

    public function setSintomasAnimal($sintomasAnimal)
    {
        $this->sintomasAnimal = $sintomasAnimal;
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

    public function listarDB()
    {
        $query = "SELECT * FROM enfermedad_animal 
        INNER JOIN animal ON enfermedad_animal.id_animal = animal.id_animal
        INNER JOIN enfermedad ON enfermedad_animal.id_enfermedad = enfermedad.id_enfermedad";
        $lista = array();
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $enfermedadAnimal = new EnfermedadAnimal();
                $prefijo = "EA";
                $enfermedadAnimal->setIdEnfermedadAnimal($encontrado["id_enfermedad_animal"]);
                $id_personalizado = $prefijo . str_pad($enfermedadAnimal->getIdEnfermedadAnimal(), 2, '0', STR_PAD_LEFT);
                $enfermedadAnimal->setIdPrefijo($id_personalizado);
                $enfermedadAnimal->setNombreEnfermedad($encontrado["nombre_enfermedad"]);
                $enfermedadAnimal->setNombreAnimal($encontrado["nombre"]);
                $enfermedadAnimal->setAreteAnimal($encontrado["numero_arete"]);
                $enfermedadAnimal->setEstadoAnimal($encontrado["estado_animal"]);
                $enfermedadAnimal->setSintomasAnimal($encontrado["sintomas_animal"]);
                $enfermedadAnimal->setFechaDiagnostico($encontrado["fecha_diagnostico"]);
                $enfermedadAnimal->setTratamiento($encontrado["tratamiento"]);
                $enfermedadAnimal->setObservaciones($encontrado["observaciones"]);
                $lista[] = $enfermedadAnimal;
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
        $query = "INSERT INTO `enfermedad_animal` (`id_enfermedad`, `id_animal`, `estado_animal`, `sintomas_animal`, `fecha_diagnostico`, `observaciones`) VALUES (:id_enfermedad, :id_animal, :estado_animal, :sintomas_animal, :fecha_diagnostico, :observaciones)";
        try {
            self::getConexion();
            $id_enfermedad = $this->getIdEnfermedad();
            $id_animal = $this->getIdAnimal();
            $estado_animal = $this->getEstadoAnimal();
            $sintomas_animal = $this->getSintomasAnimal();
            $fecha_diagnostico = $this->getFechaDiagnostico();
            $observaciones = $this->getObservaciones();


            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":id_enfermedad", $id_enfermedad, PDO::PARAM_STR);
            $resultado->bindParam(":id_animal", $id_animal, PDO::PARAM_STR);
            $resultado->bindParam(":estado_animal", $estado_animal, PDO::PARAM_STR);
            $resultado->bindParam(":sintomas_animal", $sintomas_animal, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_diagnostico", $fecha_diagnostico, PDO::PARAM_STR);
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
        $query = "SELECT * FROM enfermedad_animal where enfermedad_animal.id_enfermedad=:id_enfermedad and enfermedad_animal.id_animal=:id_animal and fecha_diagnostico =:fecha_diagnostico";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $idEnfermedad = $this->getIdEnfermedad();
            $idAnimal = $this->getIdAnimal();
            $fechaDiagnostico = $this->getFechaDiagnostico();
            $resultado->bindParam(":id_enfermedad", $idEnfermedad, PDO::PARAM_STR);
            $resultado->bindParam(":id_animal", $idAnimal, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_diagnostico", $fechaDiagnostico, PDO::PARAM_STR);
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
        $query = "SELECT * FROM enfermedad_animal WHERE enfermedad_animal.id_enfermedad = ( SELECT id_enfermedad FROM enfermedad WHERE nombre_enfermedad = :nombre_enfermedad) AND enfermedad_animal.id_animal = ( SELECT id_animal FROM animal WHERE numero_arete = :numero_arete ) AND fecha_diagnostico = :fecha_diagnostico";
        try {
            self::getConexion(); 
            $resultado = self::$conexion->prepare($query);
            $nombreEnfermedad = $this->getNombreEnfermedad();
            $areteAnimal = $this->getAreteAnimal();
            $fechaDiagnostico = $this->getFechaDiagnostico();
            $resultado->bindParam(":nombre_enfermedad", $nombreEnfermedad, PDO::PARAM_STR);
            $resultado->bindParam(":numero_arete", $areteAnimal, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_diagnostico", $fechaDiagnostico, PDO::PARAM_STR);
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
        $idEnfermedadAnimal = $this->getIdEnfermedadAnimal();
        $query = "DELETE FROM enfermedad_animal WHERE `enfermedad_animal`.`id_enfermedad_animal` = :id_enfermedad_animal";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":id_enfermedad_animal", $idEnfermedadAnimal, PDO::PARAM_STR);
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


    public function actualizarEnfermedadAnimal()
    {
        $query = "UPDATE enfermedad_animal 
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


    public function listarEnfermedadesGrafica()
    {
        $query = "SELECT MONTH(fecha_diagnostico) AS mes, COUNT(*) AS cantidad_enfermedades
        FROM Enfermedad_Animal
        GROUP BY MONTH(fecha_diagnostico)";
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