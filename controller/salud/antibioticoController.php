<?php

require_once '../../model/salud/Antibiotico.php';

switch ($_GET['op']) {
    case 'listar_tabla':
        $Antibiotico_db = new Antibiotico();
        $Antibioticos = $Antibiotico_db->listarDb();
        $datos = array();
        foreach ($Antibioticos as $Antibiotico) {
            $datos[] = array(
                "0" => $Antibiotico->getIdPrefijo(),
                "1" => $Antibiotico->getNombreAntibiotico(),
                "2" => $Antibiotico->getTipoAntibiotico(),
                "3" => $Antibiotico->getFechaVencimiento(),
                "4" => $Antibiotico->getLote(),
                "5" => $Antibiotico->getDescripcion(),
                "6" => $Antibiotico->getDiasRetiro(),
                "7" => '<button class="btn btn-danger" onclick="eliminarAntibiotico(\'' . $Antibiotico->getIdAntibiotico() . '\')">Eliminar</button>'
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
        $nombreAntibiotico = isset($_POST["nombreAntibiotico"]) ? trim($_POST["nombreAntibiotico"]) : "";
        $descripcion = isset($_POST["descripcion"]) ? trim($_POST["descripcion"]) : "";
        $tipo = isset($_POST["tipoAntibiotico"]) ? trim($_POST["tipoAntibiotico"]) : "";
        $lote = isset($_POST["lote"]) ? trim($_POST["lote"]) : "";
        $fechaVencimiento = isset($_POST["fechaVencimiento"]) ? trim($_POST["fechaVencimiento"]) : "";
        $diasRetiro = isset($_POST["diasRetiro"]) ? trim($_POST["diasRetiro"]) : "";

        $Antibiotico = new Antibiotico();
        $Antibiotico->setNombreAntibiotico($nombreAntibiotico);
        $Antibiotico->setTipoAntibiotico($tipo);
        $encontrado = $Antibiotico->verificarExistenciaDb();
        if ($encontrado == false) {
            $Antibiotico->setDescripcion($descripcion);
            $Antibiotico->setLote($lote);
            $Antibiotico->setFechaVencimiento($fechaVencimiento);
            $Antibiotico->setDiasRetiro($diasRetiro);
            $Antibiotico->guardarEnDb();
            if ($Antibiotico->verificarExistenciaDb()) {
                echo 1; // se guardo exitosamente
            } else {
                echo 3; //problema con guardar
            }
        } else {
            echo 2; // ya existte
        }
        break;

    case "eliminar":
        $Antibiotico = new Antibiotico();
        $Antibiotico->setIdAntibiotico(trim($_POST["idAntibiotico"]));
        $respuesta = $Antibiotico->eliminar();
        echo $respuesta;
        break;


    case 'obtener_antibioticos':

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['obtenerAntibioticos'])) {
            $AntibioticoModel = new Antibiotico();
            $Antibioticos = $AntibioticoModel->listarAntibioticos();
            echo json_encode($Antibioticos);
        }



}
