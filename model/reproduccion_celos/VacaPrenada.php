<?php

require_once "../../config/conexion.php";

class VacaPrenada extends Conexion
{

    //Atributos de la clase
    protected static $conexion;
    private $idServicio = null;
    private $idAnimalVaca = null;

    private $areteAnimal = null;

    private $fechaServicio = null;
    private $tipoServicio = null;


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

    public function setFechaServicio($fechaServicio)
    {
        $this->fechaServicio = $fechaServicio;
    }

    public function getFechaServicio()
    {
        return $this->fechaServicio;
    }

    public function setTipoServicio($tipoServicio)
    {
        $this->tipoServicio = $tipoServicio;
    }

    public function getTipoServicio()
    {
        return $this->tipoServicio;
    }

    public function setAreteAnimal($areteAnimal)
    {
        $this->areteAnimal = $areteAnimal;
    }

    public function getAreteAnimal()
    {
        return $this->areteAnimal;
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


    public function listarPrenos(){
        $query ='SELECT A.numero_arete, S.fecha_servicio, S.tipo_servicio
        FROM Vaca_Prenada
        INNER JOIN Servicio AS S ON Vaca_Prenada.id_servicio = S.id_servicio
        INNER JOIN Animal AS A ON S.id_animal = A.id_animal';

        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            $lista=array();
            foreach ($resultado->fetchAll() as $encontrado) {
                $vaca = new VacaPrenada();
                $vaca->setAreteAnimal($encontrado["numero_arete"]);
                $vaca->setFechaServicio($encontrado["fecha_servicio"]);
                $vaca->setTipoServicio($encontrado["tipo_servicio"]);
                $lista[] = $vaca;
            }
            return $lista;
            
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            
            return json_encode($error);
        }
    }





}


?>