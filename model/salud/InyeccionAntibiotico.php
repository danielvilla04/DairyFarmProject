<?php

require_once "../../config/conexion.php";

class InyeccionAntibiotico extends Conexion
{

    //Atributos de la clase
    protected static $conexion;

    private $idInyeccionAntibiotico = null;

    private $idPrefijo = null;

    private $idAnimal = null;

    private $numeroArete = null;

    private $idAntibiotico = null;

    private $nombreAntibiotico = null;

    private $lugarAplicacion = null;

    private $fechaAplicacion = null;

    private $dosisAplicada = null;

    private $diasRetiro = null;


    //metodos de la clase

    public function __construct()
    {
    }

    //getters y setters

    public function getIdInyeccionAntibiotico()
    {
        return $this->idInyeccionAntibiotico;
    }

    public function setIdInyeccionAntibiotico($idInyeccionAntibiotico)
    {
        $this->idInyeccionAntibiotico = $idInyeccionAntibiotico;
    }

    public function getIdAntibiotico()
    {
        return $this->idAntibiotico;
    }

    public function setIdAntibiotico($idAntibiotico)
    {
        $this->idAntibiotico = $idAntibiotico;
    }

    public function getNombreAntibiotico()
    {
        return $this->nombreAntibiotico;
    }

    public function setNombreAntibiotico($nombreAntibiotico)
    {
        $this->nombreAntibiotico = $nombreAntibiotico;
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
        $query = "SELECT * FROM inyeccion_antibiotico
        INNER JOIN animal ON inyeccion_antibiotico.id_animal = animal.id_animal
        INNER JOIN antibiotico ON inyeccion_antibiotico.id_antibiotico = antibiotico.id_antibiotico";
        $lista = array();
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $InyeccionAntibiotico = new InyeccionAntibiotico();
                $prefijo = "IA";
                $InyeccionAntibiotico->setIdInyeccionAntibiotico($encontrado["id_inyeccion_antibiotico"]);
                $id_personalizado = $prefijo . str_pad($InyeccionAntibiotico->getIdInyeccionAntibiotico(), 2, '0', STR_PAD_LEFT);
                $InyeccionAntibiotico->setIdPrefijo($id_personalizado);

                $InyeccionAntibiotico->setIdAntibiotico($encontrado["id_antibiotico"]);
                $InyeccionAntibiotico->setNombreAntibiotico($encontrado["nombre_antibiotico"]);
                $InyeccionAntibiotico->setIdAnimal($encontrado["id_animal"]);
                $InyeccionAntibiotico->setNumeroArete($encontrado["numero_arete"]);
                $InyeccionAntibiotico->setLugarAplicacion($encontrado["lugar_aplicacion"]);
                $InyeccionAntibiotico->setDosisAplicada($encontrado["dosis_aplicada"]);
                $InyeccionAntibiotico->setFechaAplicacion($encontrado["fecha_inyeccion"]);
                $InyeccionAntibiotico->setDiasRetiro($encontrado["dias_retiro_leche"]);


                $lista[] = $InyeccionAntibiotico;
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
        $query = "INSERT INTO `inyeccion_antibiotico` (`id_antibiotico`, `id_animal`, `lugar_aplicacion`, `dosis_aplicada`, `fecha_inyeccion`) VALUES (:id_antibiotico, :id_animal, :lugar_aplicacion, :dosis_aplicada,:fecha_inyeccion);";
        try {
            self::getConexion();
            $id_antibiotico = $this->getIdAntibiotico();
            $id_animal = $this->getIdAnimal();
            $lugar_aplicacion = $this->getLugarAplicacion();
            $dosis_aplicada = $this->getDosisAplicada();
            $fecha_inyeccion = $this->getFechaAplicacion();
   

            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":id_antibiotico", $id_antibiotico, PDO::PARAM_STR);
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
        $query = "SELECT * FROM inyeccion_antibiotico where inyeccion_antibiotico.id_antibiotico=:id_antibiotico and inyeccion_antibiotico.id_animal=:id_animal and fecha_inyeccion =:fecha_inyeccion";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $idAntibiotico = $this->getIdAntibiotico();
            $idAnimal = $this->getIdAnimal();
            $fechaInyeccion = $this->getFechaAplicacion();
            $resultado->bindParam(":id_antibiotico", $idAntibiotico, PDO::PARAM_STR);
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
        $query = "SELECT * FROM inyeccion_antibiotico where inyeccion_antibiotico.id_inyeccion_antibiotico=:id_inyeccion_antibiotico ";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $idInyeccionAntibiotico = $this->getIdInyeccionAntibiotico();
            $resultado->bindParam(":id_inyeccion_antibiotico", $idInyeccionAntibiotico, PDO::PARAM_STR);
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
        $idInyeccionAntibiotico = $this->getIdInyeccionAntibiotico();
        $query = "DELETE FROM inyeccion_antibiotico WHERE `inyeccion_antibiotico`.`id_inyeccion_antibiotico` = :id_inyeccion_antibiotico";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":id_inyeccion_antibiotico", $idInyeccionAntibiotico, PDO::PARAM_STR);
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

    public function listarRetiro()
    {
        $query = "    SELECT *
        FROM Inyeccion_Antibiotico
        WHERE fecha_inyeccion >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH);";
        $lista = array();
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $InyeccionAntibiotico = new InyeccionAntibiotico();

                $InyeccionAntibiotico->setNombreAntibiotico($encontrado["nombre_antibiotico"]);

                $InyeccionAntibiotico->setNumeroArete($encontrado["numero_arete"]);
        
                $InyeccionAntibiotico->setFechaAplicacion($encontrado["fecha_inyeccion"]);
                $InyeccionAntibiotico->setDiasRetiro($encontrado["dias_retiro_leche"]);


                $lista[] = $InyeccionAntibiotico;
            }
            return $lista;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            ;
            return json_encode($error);
        }
    }



}


?>