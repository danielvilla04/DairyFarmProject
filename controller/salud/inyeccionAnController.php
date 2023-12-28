<?php

require_once '../../model/salud/InyeccionAntibiotico.php';

switch ($_GET['op']) {
    case 'listar_tabla':
        $inyeccion_an_db = new InyeccionAntibiotico();
        $registros = $inyeccion_an_db->listarDb();
        $datos = array();
        foreach ($registros as $registro) {
            $datos[] = array(
                "0" => $registro->getIdPrefijo(),
                "1" => $registro->getNombreAntibiotico(),
                "2" => $registro->getNumeroArete(),
                "3" => $registro->getLugarAplicacion(),
                "4" => $registro->getDosisAplicada(),
                "5" => $registro->getFechaAplicacion(),
                "6" => $registro->getDiasRetiro(),
                "7" => '<button class="btn btn-danger" onclick="eliminarAn(\'' . $registro->getIdInyeccionAntibiotico() . '\')">Eliminar</button>'
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

    case 'insert':

        $idAnimal = isset($_POST["idAnimal"]) ? trim($_POST["idAnimal"]) : "";
        $fechaAplicacion = isset($_POST["fechaAplicacion"]) ? trim($_POST["fechaAplicacion"]) : "";
        $lugarAplicacion = isset($_POST["lugarAplicacion"]) ? trim($_POST["lugarAplicacion"]) : "";
        $idAntibiotico = isset($_POST["idAntibiotico"]) ? trim($_POST["idAntibiotico"]) : "";
        $dosisAplicada = isset($_POST["dosisAplicada"]) ? trim($_POST["dosisAplicada"]) : "";



        $inyeccionAntibiotico = new InyeccionAntibiotico();
        $inyeccionAntibiotico->setIdAntibiotico($idAntibiotico);
        $inyeccionAntibiotico->setIdAnimal($idAnimal);
        $inyeccionAntibiotico->setFechaAplicacion($fechaAplicacion);
        $encontrado = $inyeccionAntibiotico->verificarExistenciaDb();
        if ($encontrado == false) {
            $inyeccionAntibiotico->setLugarAplicacion($lugarAplicacion);
            $inyeccionAntibiotico->setDosisAplicada($dosisAplicada);
            $inyeccionAntibiotico->guardarEnDb();
            if ($inyeccionAntibiotico->verificarExistenciaDb()) {
                echo 1; // se guardo exitosamente
            } else {
                echo 3; //problema con guardar
            }
        } else {

            echo 2; // ya existte
        }
        break;

    case "eliminar":
        $inyeccionAntibiotico = new InyeccionAntibiotico();
        $inyeccionAntibiotico->setIdInyeccionAntibiotico(trim($_POST["idRegistro"]));
        $respuesta = $inyeccionAntibiotico->eliminar();
        echo $respuesta;
        break;

    case 'listar_animales_antibiotico':
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['obtenerAnimalesAntibiotico'])) {
            $inyeccionAnModel = new InyeccionAntibiotico();
            $inyeccionAn = $inyeccionAnModel->listarDB();
            $contador = 0;
            $datos = array();
            foreach ($inyeccionAn as $registro) {
                $contador += 1;
            }
            echo ($contador);
        }
        break;

    case 'listar_retiro':
        $inyeccion_an_db = new InyeccionAntibiotico();
        $registros = $inyeccion_an_db->listarRetiro();
        $datos = array();
        foreach ($registros as $registro) {
            $datos[] = array(
                "0" => $registro->getNumeroArete(),
                "1" => $registro->getFechaAplicacion(),
                "2" => $registro->getDiasRetiro(),
                "3" => $registro->getNombreAntibiotico(),
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





}
?>