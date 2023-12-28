<?php

require_once "../../config/conexion.php";

class produccionSem extends Conexion
{

    //Atributos de la clase 



    protected static $conexion;

    private $idProduccionSemanal = null;

    private $fechaSemana = null;


    private $kilosProducidos = null;

    private $calidadBacteriologica = null;

    private $celulasSomaticas = null;

    private $porcentajeGrasa = null;

    private $porcentajeProteina = null;

    private $puntoCrioscopico = null;

    private $presenciaInhibidores = null;

    private $idPrefijo = null;

    //metodos de la clase

    public function __construct()
    {

    }

    //getters y setters

    public function getIdProduccionSemanal()
    {
        return $this->idProduccionSemanal;
    }

    public function setIdProduccionSemanal($idProduccionSemanal)
    {
        $this->idProduccionSemanal = $idProduccionSemanal;
    }

    public function getIdPrefijo()
    {
        return $this->idPrefijo;
    }

    public function setIdPrefijo($idPrefijo)
    {
        $this->idPrefijo = $idPrefijo;
    }

    public function getFechaSemana()
    {
        return $this->fechaSemana;
    }

    public function setFechaSemana($fechaSemana)
    {
        $this->fechaSemana = $fechaSemana;
    }

    public function getKilosProducidos()
    {
        return $this->kilosProducidos;
    }

    public function setKilosProducidos($kilosProducidos)
    {
        $this->kilosProducidos = $kilosProducidos;
    }


    public function getCalidadBacteriologica()
    {
        return $this->calidadBacteriologica;
    }

    public function setCalidadBacteriologica($calidadBacteriologica)
    {
        $this->calidadBacteriologica = $calidadBacteriologica;
    }


    public function getCelulasSomaticas()
    {
        return $this->celulasSomaticas;
    }

    public function setCelulasSomaticas($celulasSomaticas)
    {
        $this->celulasSomaticas = $celulasSomaticas;
    }

    public function getPorcentajeGrasa()
    {
        return $this->porcentajeGrasa;
    }

    public function setPorcentajeGrasa($porcentajeGrasa)
    {
        $this->porcentajeGrasa = $porcentajeGrasa;
    }

    public function getPorcentajeProteina()
    {
        return $this->porcentajeProteina;
    }

    public function setPorcentajeProteina($porcentajeProteina)
    {
        $this->porcentajeProteina = $porcentajeProteina;
    }

    public function getPuntoCrioscopico()
    {
        return $this->puntoCrioscopico;
    }

    public function setPuntoCrioscopico($puntoCrioscopico)
    {
        $this->puntoCrioscopico = $puntoCrioscopico;
    }

    public function getPresenciaInhibidores()
    {
        return $this->presenciaInhibidores;
    }

    public function setPresenciaInhibidores($presenciaInhibidores)
    {
        $this->presenciaInhibidores = $presenciaInhibidores;
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
        $query = "SELECT * FROM produccion_semanal";
        $lista = array();
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $Produccion = new produccionSem();
                $prefijo = "PRSEM";
                $Produccion->setIdProduccionSemanal($encontrado["id_produccion_semanal"]);
                $id_personalizado = $prefijo . str_pad($Produccion->getIdProduccionSemanal(), 4, '0', STR_PAD_LEFT);
                $Produccion->setIdPrefijo($id_personalizado);
                $Produccion->setKilosProducidos($encontrado["litros"]);
                $Produccion->setFechaSemana($encontrado["fechaSemana"]);
                $Produccion->setCalidadBacteriologica($encontrado["calidad_bacteriologica"]);
                $Produccion->setCelulasSomaticas($encontrado["celulas_somaticas"]);
                $Produccion->setPorcentajeGrasa($encontrado["porcentaje_grasa"]);
                $Produccion->setPorcentajeProteina($encontrado["porcentaje_proteina"]);
                $Produccion->setPuntoCrioscopico($encontrado["punto_crioscopico"]);
                $Produccion->setPresenciaInhibidores($encontrado["presencia_inhibidores"]);
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
        $query = "INSERT INTO `produccion_semanal` (`fechaSemana`, `litros`, `calidad_bacteriologica`, `celulas_somaticas`, `porcentaje_grasa`, `porcentaje_proteina`, `punto_crioscopico`, `presencia_inhibidores`) 
        VALUES (:fechaSemana, :litros, :calidad_bacteriologica, :celulas_somaticas, :porcentaje_grasa, :porcentaje_proteina, :punto_crioscopico, :presencia_inhibidores);";
        try {
            self::getConexion();

            $fechaSemana = $this->getFechaSemana();
            $kilosProducidos = $this->getKilosProducidos();
            $calidad_Bacteriologica = $this->getCalidadBacteriologica();
            $celulas_Somaticas = $this->getCelulasSomaticas();
            $porcentaje_Grasa = $this->getPorcentajeGrasa();
            $porcentaje_Proteina = $this->getPorcentajeProteina();
            $punto_Crioscopico = $this->getPuntoCrioscopico();
            $presencia_Inhibidores = $this->getPresenciaInhibidores();
            $celulas_Somaticas = $this->getCelulasSomaticas();



            $resultado = self::$conexion->prepare($query);

            $resultado->bindParam(":fechaSemana", $fechaSemana, PDO::PARAM_STR);
            $resultado->bindParam(":litros", $kilosProducidos, PDO::PARAM_STR);
            $resultado->bindParam(":calidad_bacteriologica", $calidad_Bacteriologica, PDO::PARAM_STR);
            $resultado->bindParam(":celulas_somaticas", $celulas_Somaticas, PDO::PARAM_STR);
            $resultado->bindParam(":porcentaje_grasa", $porcentaje_Grasa, PDO::PARAM_STR);
            $resultado->bindParam(":porcentaje_proteina", $porcentaje_Proteina, PDO::PARAM_STR);
            $resultado->bindParam(":punto_crioscopico", $punto_Crioscopico, PDO::PARAM_STR);
            $resultado->bindParam(":presencia_inhibidores", $presencia_Inhibidores, PDO::PARAM_STR);





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
        $query = "SELECT * FROM produccion_semanal where fechaSemana=:fechaSemana";
        
        try {
         self::getConexion();
            $resultado = self::$conexion->prepare($query);		
            $fecha= $this->getFechaSemana();	
            $resultado->bindParam(":fechaSemana",$fecha,PDO::PARAM_STR);
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

    public function listarGrafica()
    {
        $query = "SELECT WEEK(fechaSemana) AS numero_semana, SUM(litros) AS total_litros_semana
        FROM Produccion_semanal
        GROUP BY WEEK(fechaSemana)
        ORDER BY WEEK(fechaSemana)";
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