<?php

require_once '../../model/salud/Vacunacion.php';

switch ($_GET['op']) {
    case 'listar_tabla':
        $vacunacion_db = new Vacunacion();
        $vacunaciones = $vacunacion_db->listarDb();
        $datos = array();

        foreach ($vacunaciones as $vacunacion) {
            $datos[] = array(
                "0" => $vacunacion->getIdPrefijo(),
                "1" => $vacunacion->getNombreVacuna(),
                "2" => $vacunacion->getLugarAplicacion(),
                "3" => $vacunacion->getFechaVacunacion(),
                "4" => $vacunacion->getDosisAplicada(),
                "5" => $vacunacion->getCantidadAnimales(),

            );
        }
        $resultados = array(
            "sEcho" => 1,
            ##informacion para datatables
            "iTotalRecords" => count($datos),
            ## total de registros al datatable
            "iTotalDisplayRecords" => count($datos),
            ## enviamos el total de registros a visualizar
            "aaData" => $datos
        );
        echo json_encode($resultados);
        break;

    case 'insertar':

        $idVacuna = isset($_POST["idVacuna"]) ? trim($_POST["idVacuna"]) : "";
        $lugarAplicacion = isset($_POST["lugarAplicacion"]) ? trim($_POST["lugarAplicacion"]) : "";
        $fechaAplicacion = isset($_POST["fechaAplicacion"]) ? trim($_POST["fechaAplicacion"]) : "";
        $dosis = isset($_POST["dosis"]) ? trim($_POST["dosis"]) : "";
        $animalesVacunados = isset($_POST["animalesVacunados"]) ? $_POST["animalesVacunados"] : "";

        //obtenemos la cantidad de animales
        $contador = 0;
        foreach ($animalesVacunados as $animal) {

            $contador++;
        }

        $cantidadAnimales = $contador;


        $vacunacion = new Vacunacion();
        $vacunacion->setIdVacuna($idVacuna);
        $vacunacion->setLugarAplicacion($lugarAplicacion);
        $vacunacion->setFechaVacunacion($fechaAplicacion);
        $vacunacion->setDosisAplicada($dosis);
        $vacunacion->setFechaVacunacion($fechaAplicacion);
        $vacunacion->setCantidadAnimales($cantidadAnimales);
        $vacunacion->guardarEnDb();
        if ($vacunacion->verificarExistenciaDb()) {
            //obtener id de lo que acabamos de insertar en al db
            $idVacunacion = $vacunacion->obtenerId();
            $vacunacion->setIdVacunacion($idVacunacion);
            foreach ($animalesVacunados as $animal) {
                $vacunacion->guardarVacunacionAnimal($animal);
            }


            echo 1; // se guardo exitosamente
        } else {
            echo 2; //problema con guardar
        }

        break;

    case 'listar_animales_vacunados':
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['obtenerAnimalesVacunados'])) {
            $vacunacion = new Vacunacion();
            $vacunaciones = $vacunacion->listarDB();
            $contador = 0;
            $datos = array();
            foreach ($vacunaciones as $registro) {
                $contador += 1;
            }
            echo ($contador);
            break;
        }

    case 'obtener_vacunas_puestas':
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['obtenerVacunasPuestas'])) {
            $vacunacion = new Vacunacion();
            $vacunaciones = $vacunacion->listarVacunasPuestas();
           
          
            echo ($vacunaciones);
        }
        break;
    
    
}
