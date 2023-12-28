<?php 
require_once '../../config/conexion.php';

class Aborto extends Conexion
{

    //Atributos
    protected static $conexion;

    private $idVaca =null;

    private $fechaAborto = null;

    private $estadoVaca = null;

    private $observaciones = null;


    //constructores
    public function __construct()
    {
    }

    //Getter y setters

    public function getIdVaca()
    {
        return $this->idVaca;
    }
    public function setIdVaca($idVaca)
    {
        $this->idVaca = $idVaca;
    }

    public function getFechaAborto()
    {
        return $this->fechaAborto;
    }
    public function setFechaAborto($fechaAborto)
    {
        $this->fechaAborto = $fechaAborto;
    }
    public function getEstadoVaca()
    {
        return $this-> estadoVaca;
    }
    public function setEstadoVaca($estadoVaca)
    {
        $this->estadoVaca = $estadoVaca;
    }
    public function getObservaciones()
    {
        return $this->observaciones;
    }
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    }

    //Metodos de la clase

    //conexion a base de datos
    public function getConexion()
    {
        self::$conexion = Conexion::conectar();
    }
    //desconexion con base de datos
    public function desconectar()
    {
        self::$conexion = null;
    }


    //funcion para sacar a todos los de la db
    public function listarDB(){
        $query = "SELECT * FROM aborto";
        $lista = array();
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $aborto = new aborto();

                $aborto ->setEstadoVaca($encontrado["estado_vaca"]);
                $aborto ->setFechaAborto($encontrado["fecha_aborto"]);
                $aborto ->setObservaciones($encontrado["observaciones"]);
                $lista[] = $aborto;
            }
            return $lista;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error ".$Exception->getCode( ).": ".$Exception->getMessage( );;
            return json_encode($error);
        }
    }
    public function listarAbortos(){
        $query = "SELECT id_vaca, estado_vaca FROM aborto";
        try {
            self::getConexion(); 
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error ".$Exception->getCode( ).": ".$Exception->getMessage( );;
            return json_encode($error);
        }
    }

    public function listarAbortosGrafica()
    {
        $query = "SELECT MONTH(fecha_aborto) AS mes, COUNT(*) AS cantidad_abortos
        FROM aborto
        GROUP BY MONTH(fecha_aborto)";
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

    public function obtenerAbortos()
    {
        $query = "SELECT *
                  FROM aborto 
                  INNER JOIN Animal ON aborto.id_vaca = Animal.id_animal";

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