<?php
require_once '../../config/conexion.php';

class Animal extends Conexion
{

    //Atributos
    protected static $conexion;

    private $idAnimal =null;

    private $nombre = null;

    private $images = null;

    private $base64Image = null;

    private $numero_arete = null;

    private $fecha_nacimiento = null;

    private $raza = null;

    private $peso = null;

    private $colores_caracteristicas = null;

    private $observaciones = null;

    private $estado = null;

    //constructores
    public function __construct()
    {
    }

    //Getter y setters

    public function getIdAnimal()
    {
        return $this->idAnimal;
    }
    public function setIdAnimal($idAnimal)
    {
        $this->idAnimal = $idAnimal;
    }

    public function getBase64Image()
    {
        return $this->base64Image;
    }
    public function setBase64Image($base64Image)
    {
        $this->base64Image = $base64Image;
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function getImages()
    {
        return $this->images;
    }
    public function setImages($images)
    {
        $this->images = $images;
    }
    public function getNumero_arete()
    {
        return $this-> numero_arete;
    }
    public function setNumero_arete($numero_arete)
    {
        $this->numero_arete = $numero_arete;
    }
    public function getFecha_nacimiento()
    {
        return $this->fecha_nacimiento;
    }
    public function setFecha_nacimiento($fecha_nacimiento)
    {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }
    public function getRaza()
    {
        return $this->raza;
    }
    public function setRaza($raza)
    {
        $this->raza = $raza;
    }
    public function getPeso()
    {
        return $this->peso;
    }
    public function setPeso($peso)
    {
        $this->peso = $peso;
    }
    public function getColores_caracteristicas()
    {
        return $this->colores_caracteristicas;
    }
    public function setColores_caracteristicas($colores_caracteristicas)
    {
        $this->colores_caracteristicas = $colores_caracteristicas;
    }
    public function getObservaciones()
    {
        return $this->observaciones;
    }
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    }
    
    public function getEstado()
    {
        return $this->estado;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;
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
    public function concatenarID(){
     
    }

    //funcion para sacar a todos los de la db
    public function listarDB(){
        $query = "SELECT * FROM animal";
        $lista = array();
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $animal = new Animal();
                $animal ->setIdAnimal($encontrado["id_animal"]);
                $animal ->setNumero_arete($encontrado["numero_arete"]);
                $animal ->setNombre($encontrado["nombre"]);
                $animal ->setFecha_nacimiento($encontrado["fecha_nacimiento"]);
                $animal ->setRaza($encontrado["raza"]);
                $animal ->setPeso($encontrado["peso"]);
                $animal ->setColores_caracteristicas($encontrado["colores_caracteristicas"]);
                $animal ->setObservaciones($encontrado["observaciones"]);
                if (!empty($encontrado['images'])) {
                    $base64Image = base64_encode($encontrado['images']);
                    $animal->setBase64Image($base64Image);
                } else {
                    $animal->setBase64Image(null);
                }
                $lista[] = $animal;
            }
            return $lista;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error ".$Exception->getCode( ).": ".$Exception->getMessage( );;
            return json_encode($error);
        }
    }
    
    public function guardarEnDb() {
            $query = "INSERT INTO `animal` ( `nombre`, `fecha_nacimiento`, `raza`, `peso`, `numero_arete`, `colores_caracteristicas`, `observaciones`,`images`) VALUES (:nombre,:fecha_nacimiento,:raza,:peso,:numero_arete, :colores_caracteristicas, :observaciones,:images)";
            try {
                self::getConexion();
                $nombre = $this->getNombre();
                $image = $this->getImages();
                $fechaNacimiento = $this->getFecha_nacimiento();
                $raza = $this->getRaza();
                $peso = $this->getPeso();
                $numeroArete = $this->getNumero_arete();
                $coloresCaracteristicas = $this->getColores_caracteristicas();
                $observaciones = $this->getObservaciones();

                $resultado = self::$conexion->prepare($query);
                $resultado->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $resultado->bindParam(':fecha_nacimiento', $fechaNacimiento, PDO::PARAM_STR);
                $resultado->bindParam(':raza', $raza, PDO::PARAM_STR);
                $resultado->bindParam(':peso', $peso, PDO::PARAM_STR);
                $resultado->bindParam(':numero_arete', $numeroArete, PDO::PARAM_STR);
                $resultado->bindParam(':colores_caracteristicas', $coloresCaracteristicas, PDO::PARAM_STR);
                $resultado->bindParam(':observaciones', $observaciones, PDO::PARAM_STR);
                $resultado->bindParam(':images', $image, PDO::PARAM_LOB);
                
            $resultado->execute();
            self::desconectar();
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode($error);
        }
    }

    public function verificarExistenciaDb(){
        $query = "SELECT * FROM animal where numero_arete=:numero_arete";
        
        try {
         self::getConexion();
            $resultado = self::$conexion->prepare($query);		
            $numero= $this->getNumero_arete();
            $resultado->bindParam(":numero_arete",$numero,PDO::PARAM_STR);
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
    public function listarAnimales(){
        $query = "SELECT id_animal, numero_arete FROM animal";
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
    public function eliminar()
    {
        $id_animal = $this->getIdAnimal();
        $query = "DELETE FROM animal WHERE `animal`.`id_animal` = :id_animal";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->bindParam(":id_animal", $id_animal, PDO::PARAM_STR);
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

    public function actualizarAnimal()
    {
        $query = "UPDATE animal SET 
            nombre = :nombre,
            fecha_nacimiento = :fecha_nacimiento,
            raza = :raza,
            peso = :peso,
            numero_arete = :numero_arete,
            colores_caracteristicas = :colores_caracteristicas,
            observaciones = :observaciones
        WHERE id_animal = :id_animal";

        try {
            self::getConexion(); // Assuming you have a method to establish a database connection
            $nombre = $this->getNombre();
            $fecha_nacimiento = $this->getFecha_nacimiento();
            $raza = $this->getRaza();
            $peso = $this->getPeso();
            $numero_arete = $this->getNumero_arete();
            $colores_caracteristicas = $this->getColores_caracteristicas();
            $observaciones = $this->getObservaciones();
            
            
            $resultado = $this->conexion->prepare($query);
            $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_nacimiento", $fecha_nacimiento, PDO::PARAM_STR);
            $resultado->bindParam(":raza", $raza, PDO::PARAM_STR);
            $resultado->bindParam(":peso", $peso, PDO::PARAM_STR);
            $resultado->bindParam(":numero_arete", $numero_arete, PDO::PARAM_STR);
            $resultado->bindParam(":colores_caracteristicas", $colores_caracteristicas, PDO::PARAM_STR);
            $resultado->bindParam(":observaciones", $observaciones, PDO::PARAM_STR);

            $this->conexion->beginTransaction();
            $resultado->execute();
            $this->conexion->commit();
            $this->desconectar();
            
            return $resultado->rowCount(); // Return the number of affected rows
        } catch (PDOException $Exception) {
            $this->conexion->rollBack();
            $this->desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            echo $error;
            return false; // Return false to indicate an error
        }
    }

    public function listarAnimalesGrafica()
    {
        $query = "SELECT MONTH(fecha_nacimiento) AS mes, COUNT(*) AS cantidad_animales
        FROM animal
        GROUP BY MONTH(fecha_nacimiento)";
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

    public function listarImagenes() {
        $query = "SELECT nombre, images FROM animal";
        $lista = array();

        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            self::desconectar();

            foreach ($resultado->fetchAll() as $encontrado) {
                $animal = new Animal();
                $animal->setNombre($encontrado['nombre']);
                $animal->setImages($encontrado['images']);
                $lista[] = $animal;
            }

            return $lista;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return json_encode(['error' => $error]);
        }
    }

    public function obtenerCantidadAnimales() {
        $query = "SELECT COUNT(*) as cantidad FROM animal";

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
        $query = "SELECT SUM() as suma FROM animal";

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

    public function listarVacias(){
        $query = "SELECT COUNT(*) as cantidad_vacas_vacias
        FROM Animal
        WHERE NOT EXISTS (
            SELECT 1
            FROM Vaca_Prenada
            WHERE Vaca_Prenada.id_servicio = Animal.id_animal
        )";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
             return $resultado->fetchColumn();
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error ".$Exception->getCode( ).": ".$Exception->getMessage( );;
            return json_encode($error);
        }
    }
    public function listarPrenadas(){
        $query = "SELECT COUNT(DISTINCT Vaca_Prenada.id_servicio) as cantidad_vacas_prenadas
        FROM Vaca_Prenada
        INNER JOIN Servicio ON Vaca_Prenada.id_servicio = Servicio.id_servicio
        INNER JOIN Animal ON Servicio.id_animal = Animal.id_animal";
        try {
            self::getConexion();
            $resultado = self::$conexion->prepare($query);
            $resultado->execute();
            return $resultado->fetchColumn();
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error ".$Exception->getCode( ).": ".$Exception->getMessage( );;
            return json_encode($error);
        }
    }

    

}



?>