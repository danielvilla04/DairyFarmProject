<?php

require_once "../../config/conexion.php";

class Mastitis extends Conexion
{

    //Atributos de la clase
    protected static $conexion;

    private $idMastitis = null;

    private $idPrefijo = null;

    private $idAnimal = null;

    private $numeroArete = null;

    private $tipoTratamiento = null;

    private $cuartosAfectados = null;

    private $fechaDiagnostico = null;

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

    public function getIdMastitis()
    {
        return $this->idMastitis;
    }

    public function setIdMastitis($idMastitis)
    {
        $this->idMastitis = $idMastitis;
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

    public function getTipoTratamiento()
    {
        return $this->tipoTratamiento;
    }

    public function setTipoTratamiento($tipoTratamiento)
    {
        $this->tipoTratamiento = $tipoTratamiento;
    }

    public function getCuartosAfectados()
    {
        return $this->cuartosAfectados;
    }

    public function setCuartosAfectados($cuartosAfectados)
    {
        $this->cuartosAfectados = $cuartosAfectados;
    }

    public function getFechaDiagnostico()
    {
        return $this->fechaDiagnostico;
    }

    public function setFechaDiagnostico($fechaDiagnostico)
    {
        $this->fechaDiagnostico = $fechaDiagnostico;
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
        $query = "SELECT * FROM mastitis
        INNER JOIN animal ON mastitis.id_animal = animal.id_animal";
        $lista = array();
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $Mastitis = new Mastitis();
                $prefijo = "MA";
                $Mastitis->setIdMastitis($encontrado["id_mastitis"]);
                $id_personalizado = $prefijo . str_pad($Mastitis->getIdMastitis(), 2, '0', STR_PAD_LEFT);
                $Mastitis->setIdPrefijo($id_personalizado);
                $Mastitis->setIdAnimal($encontrado["id_animal"]);
                $Mastitis->setNumeroArete($encontrado["numero_arete"]);
                $Mastitis->setTipoTratamiento($encontrado["tipo_tratamiento"]);
                $Mastitis->setCuartosAfectados($encontrado["cuartos_afectados"]);
                $Mastitis->setFechaDiagnostico($encontrado["fecha_diagnostico"]);
                $lista[] = $Mastitis;
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
        $query = "INSERT INTO `mastitis` (`id_animal`, `tipo_tratamiento`, `cuartos_afectados`, `fecha_diagnostico`) VALUES (:id_animal, :tipo_tratamiento, :cuartos_afectados,:fecha_diagnostico);";
        try {
            self::getConexion();
            $id_animal = $this->getIdAnimal();
            $tipo_tratamiento = $this->getTipoTratamiento();
            $cuartos_afectados = $this->getCuartosAfectados();
            $fecha_diagnostico = $this->getFechaDiagnostico();


            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":id_animal", $id_animal, PDO::PARAM_STR);
            $resultado->bindParam(":tipo_tratamiento", $tipo_tratamiento, PDO::PARAM_STR);
            $resultado->bindParam(":cuartos_afectados", $cuartos_afectados, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_diagnostico", $fecha_diagnostico, PDO::PARAM_STR);

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
        $query = "SELECT * FROM mastitis where id_animal=:id_animal and fecha_diagnostico=:fecha_diagnostico";

        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $id_animal = $this->getIdAnimal();
            $fecha = $this->getFechaDiagnostico();
            $resultado->bindParam(":id_animal", $id_animal, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_diagnostico", $fecha, PDO::PARAM_STR);
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
        $query = "SELECT * FROM mastitis where mastitis.id_animal = ( SELECT id_animal FROM animal WHERE numero_arete = :id_animal) and fecha_diagnostico=:fecha_diagnostico";

        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $id_animal = $this->getIdAnimal();
            $fecha = $this->getFechaDiagnostico();
            $resultado->bindParam(":id_animal", $id_animal, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_diagnostico", $fecha, PDO::PARAM_STR);
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
        $id_mastitis = $this->getIdMastitis();
        $query = "DELETE FROM mastitis WHERE `mastitis`.`id_mastitis` = :id_mastitis";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":id_mastitis", $id_mastitis, PDO::PARAM_STR);
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


   

    public function listarMastitisGrafica()
    {
        $query = "SELECT YEAR(fecha_diagnostico) AS ano, MONTH(fecha_diagnostico) AS mes, COUNT(*) AS total_mastitis
        FROM Mastitis
        GROUP BY YEAR(fecha_diagnostico), MONTH(fecha_diagnostico)
        ORDER BY YEAR(fecha_diagnostico), MONTH(fecha_diagnostico)";

        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            return $resultado->fetchAll(PDO::FETCH_ASSOC);
            ;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            ;
            return json_encode($error);
        }

    }


    public function listarMastitis()
    {
        $query = "SELECT * FROM mastitis
        INNER JOIN animal ON mastitis.id_animal = animal.id_animal";
        $lista = array();
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $Mastitis = new Mastitis();
                $prefijo = "MA";
                $Mastitis->setIdMastitis($encontrado["id_mastitis"]);
                $id_personalizado = $prefijo . str_pad($Mastitis->getIdMastitis(), 2, '0', STR_PAD_LEFT);
                $Mastitis->setIdPrefijo($id_personalizado);
                $Mastitis->setIdAnimal($encontrado["id_animal"]);
                $Mastitis->setNumeroArete($encontrado["numero_arete"]);
                $Mastitis->setTipoTratamiento($encontrado["tipo_tratamiento"]);
                $Mastitis->setCuartosAfectados($encontrado["cuartos_afectados"]);
                $Mastitis->setFechaDiagnostico($encontrado["fecha_diagnostico"]);
                $lista[] = $Mastitis;
            }
            return $lista;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            ;
            return json_encode($error);
        }
    }

    public function listarMastitisInyeccion()
    {
        $query = "SELECT COUNT(*) AS cantidad_total
        FROM Mastitis
        WHERE tipo_tratamiento = 'inyeccion'";
         try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            $row = $resultado->fetch();
            $totalMastitis = $row['cantidad_total'];
            return $totalMastitis;

            
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            echo $error;
            return json_encode($error);
        }

    }

    public function listarMastitisDirecto()
    {
        $query = "SELECT COUNT(*) AS cantidad_total
        FROM Mastitis
        WHERE tipo_tratamiento = 'antibiotico directo en la teta'";
         try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            $row = $resultado->fetch();
            $totalMastitis = $row['cantidad_total'];
            return $totalMastitis;

            
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            echo $error;
            return json_encode($error);
        }

    }



}


?>