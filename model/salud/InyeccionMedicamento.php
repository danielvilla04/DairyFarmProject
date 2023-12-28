<?php

require_once "../../config/conexion.php";

class InyeccionMedicamento extends Conexion
{

    //Atributos de la clase
    protected static $conexion;

    private $idInyeccionMedicamento = null;

    private $idPrefijo = null;

    private $idAnimal = null;

    private $numeroArete = null;

    private $idMedicamento = null;

    private $nombreMedicamento = null;

    private $lugarAplicacion = null;

    private $fechaAplicacion = null;

    private $dosisAplicada = null;



    //metodos de la clase

    public function __construct()
    {
    }

    //getters y setters

    public function getIdInyeccionMedicamento()
    {
        return $this->idInyeccionMedicamento;
    }

    public function setIdInyeccionMedicamento($idInyeccionMedicamento)
    {
        $this->idInyeccionMedicamento = $idInyeccionMedicamento;
    }

    public function getIdMedicamento()
    {
        return $this->idMedicamento;
    }

    public function setIdMedicamento($idMedicamento)
    {
        $this->idMedicamento = $idMedicamento;
    }

    public function getNombreMedicamento()
    {
        return $this->nombreMedicamento;
    }

    public function setNombreMedicamento($nombreMedicamento)
    {
        $this->nombreMedicamento = $nombreMedicamento;
    }

    public function getIdAnimal()
    {
        return $this->idAnimal;
    }

    public function setIdAnimal($idAnimal)
    {
        $this->idAnimal = $idAnimal;
    }

    public function getNumeroArete()
    {
        return $this->numeroArete;
    }

    public function setNumeroArete($numeroArete)
    {
        $this->numeroArete = $numeroArete;
    }

    public function getIdPrefijo()
    {
        return $this->idPrefijo;
    }

    public function setIdPrefijo($idPrefijo)
    {
        $this->idPrefijo = $idPrefijo;
    }

    public function getFechaAplicacion()
    {
        return $this->fechaAplicacion;
    }

    public function setFechaAplicacion($fechaAplicacion)
    {
        $this->fechaAplicacion = $fechaAplicacion;
    }

    public function getLugarAplicacion()
    {
        return $this->lugarAplicacion;
    }

    public function setLugarAplicacion($lugarAplicacion)
    {
        $this->lugarAplicacion = $lugarAplicacion;
    }


    public function getDosisAplicada()
    {
        return $this->dosisAplicada;
    }

    public function setDosisAplicada($dosisAplicada)
    {
        $this->dosisAplicada = $dosisAplicada;
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
        $query = "SELECT * FROM inyeccion_medicamento
        INNER JOIN animal ON inyeccion_medicamento.id_animal = animal.id_animal
        INNER JOIN medicamento ON inyeccion_medicamento.id_medicamento = medicamento.id_medicamento";
        $lista = array();
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $InyeccionMedicamento = new InyeccionMedicamento();
                $prefijo = "IM";
                $InyeccionMedicamento->setIdInyeccionMedicamento($encontrado["id_inyeccion_medicamento"]);
                $id_personalizado = $prefijo . str_pad($InyeccionMedicamento->getIdInyeccionMedicamento(), 2, '0', STR_PAD_LEFT);
                $InyeccionMedicamento->setIdPrefijo($id_personalizado);

                $InyeccionMedicamento->setIdMedicamento($encontrado["id_medicamento"]);
                $InyeccionMedicamento->setNombreMedicamento($encontrado["nombre_medicamento"]);
                $InyeccionMedicamento->setIdAnimal($encontrado["id_animal"]);
                $InyeccionMedicamento->setNumeroArete($encontrado["numero_arete"]);
                $InyeccionMedicamento->setLugarAplicacion($encontrado["lugar_aplicacion"]);
                $InyeccionMedicamento->setDosisAplicada($encontrado["dosis_aplicada"]);
                $InyeccionMedicamento->setFechaAplicacion($encontrado["fecha_inyeccion"]);


                $lista[] = $InyeccionMedicamento;
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
        $query = "INSERT INTO `inyeccion_medicamento` (`id_medicamento`, `id_animal`, `lugar_aplicacion`, `dosis_aplicada`, `fecha_inyeccion`) VALUES (:id_medicamento, :id_animal, :lugar_aplicacion, :dosis_aplicada,:fecha_inyeccion);";
        try {
            self::getConexion();
            $id_medicamento = $this->getIdMedicamento();
            $id_animal = $this->getIdAnimal();
            $lugar_aplicacion = $this->getLugarAplicacion();
            $dosis_aplicada = $this->getDosisAplicada();
            $fecha_inyeccion = $this->getFechaAplicacion();
   

            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":id_medicamento", $id_medicamento, PDO::PARAM_STR);
            $resultado->bindParam(":id_animal", $id_animal, PDO::PARAM_STR);
            $resultado->bindParam(":lugar_aplicacion", $lugar_aplicacion, PDO::PARAM_STR);
            $resultado->bindParam(":dosis_aplicada", $dosis_aplicada, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_inyeccion", $fecha_inyeccion, PDO::PARAM_STR);

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
        $query = "SELECT * FROM inyeccion_medicamento where inyeccion_medicamento.id_medicamento=:id_medicamento and inyeccion_medicamento.id_animal=:id_animal and fecha_inyeccion =:fecha_inyeccion";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $idMedicamento = $this->getIdMedicamento();
            $idAnimal = $this->getIdAnimal();
            $fechaInyeccion = $this->getFechaAplicacion();
            $resultado->bindParam(":id_medicamento", $idMedicamento, PDO::PARAM_STR);
            $resultado->bindParam(":id_animal", $idAnimal, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_inyeccion", $fechaInyeccion, PDO::PARAM_STR);
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
        $query = "SELECT * FROM inyeccion_medicamento where inyeccion_medicamento.id_inyeccion_medicamento=:id_inyeccion_medicamento ";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $idInyeccionMedicamento = $this->getIdInyeccionMedicamento();
            $resultado->bindParam(":id_inyeccion_medicamento", $idInyeccionMedicamento, PDO::PARAM_STR);
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
        $idInyeccionMedicamento = $this->getIdInyeccionMedicamento();
        $query = "DELETE FROM inyeccion_medicamento WHERE `inyeccion_medicamento`.`id_inyeccion_medicamento` = :id_inyeccion_medicamento";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":id_inyeccion_medicamento", $idInyeccionMedicamento, PDO::PARAM_STR);
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


}


?>