<?php

require_once '../../model/salud/Vacuna.php';

switch ($_GET['op']) {
    case 'listar_tabla':
        $vacuna_db = new Vacuna();
        $vacunas = $vacuna_db->listarDb();
        $datos = array();
        foreach ($vacunas as $vacuna) {
            $datos[] = array(
                "0" => $vacuna->getIdPrefijo(),
                "1" => $vacuna->getNombrevacuna(),
                "2" => $vacuna->getCasaDistribuidora(),
                "3" => $vacuna->getDescripcion(),
                "4" => $vacuna->getLote(),
                "5" => $vacuna->getFechaVencimiento(),
                "6" => $vacuna->getObservaciones(),
                "7" => '<button class="btn btn-danger" onclick="eliminar(\'' . $vacuna->getIdVacuna() . '\')">Eliminar</button>'
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
        $nombreVacuna = isset($_POST["nombreVacuna"]) ? trim($_POST["nombreVacuna"]) : "";
        $descripcion = isset($_POST["descripcion"]) ? trim($_POST["descripcion"]) : "";
        $casaDistruidora = isset($_POST["casaDistribuidora"]) ? trim($_POST["casaDistribuidora"]) : "";
        $lote = isset($_POST["lote"]) ? trim($_POST["lote"]) : "";
        $fechaVencimiento = isset($_POST["fechaVencimiento"]) ? trim($_POST["fechaVencimiento"]) : "";
        $observaciones = isset($_POST["observaciones"]) ? trim($_POST["observaciones"]) : "";

        $vacuna = new Vacuna();
        $vacuna->setNombreVacuna($nombreVacuna);
        $vacuna->setCasaDistribuidora($casaDistruidora);
        $encontrado = $vacuna->verificarExistenciaDb();
        if ($encontrado == false) {
            $vacuna->setDescripcion($descripcion);
            $vacuna->setLote($lote);
            $vacuna->setFechaVencimiento($fechaVencimiento);
            $vacuna->setObservaciones($observaciones);
            $vacuna->guardarEnDb();
            if ($vacuna->verificarExistenciaDb()) {
                echo 1; // se guardo exitosamente
            } else {
                echo 3; //problema con guardar
            }
        } else {
            echo 2; // ya existte
        }
        break;

    case "eliminar":
        $vacuna = new Vacuna();
        $vacuna->setIdVacuna(trim($_POST["idVacuna"]));
        $respuesta = $vacuna->eliminar();
        echo $respuesta;
        break;



    case 'obtener_vacunas':
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['obtenerVacunas'])) {
            $Model = new Vacuna();
            $vacunas = $Model->listarVacunas();
            $data = array();
            foreach ($vacunas as $row) {
                $data[]=[
                    'id' => $row['id_vacuna'],
                    'nombre' => $row['nombre_vacuna']
                ];
            }

            echo json_encode($data);
        }
        break;

    case 'listar_vacunas':
        $vacuna_db = new Vacuna();
        $vacunas = $vacuna_db->listarDb();
        $datos = array();
        foreach ($vacunas as $vacuna) {
            $datos[] = array(
                "0" => $vacuna->getLote(),
                "1" => $vacuna->getNombrevacuna(),
                "2" => $vacuna->getDescripcion(),
                "3" => $vacuna->getFechaVencimiento(),
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
