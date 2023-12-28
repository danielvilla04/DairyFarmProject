<?php

require_once '../../model/salud/Medicamento.php';

switch ($_GET['op']) {
    case 'listar_tabla':
        $medicamento_db = new Medicamento();
        $medicamentos = $medicamento_db->listarDb();
        $datos = array();
        foreach ($medicamentos as $medicamento) {
            $datos[] = array(
                "0" => $medicamento->getIdPrefijo(),
                "1" => $medicamento->getNombreMedicamento(),
                "2" => $medicamento->getTipoMedicamento(),
                "3" => $medicamento->getFechaVencimiento(),
                "4" => $medicamento->getLote(),
                "5" => $medicamento->getDescripcion(),
                "6" => $medicamento->getPresentacion(),
                "7" => '<button class="btn btn-danger" onclick="eliminar(\'' . $medicamento->getIdMedicamento() . '\')">Eliminar</button>'
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
        $nombreMedicamento = isset($_POST["nombreMedicamento"]) ? trim($_POST["nombreMedicamento"]) : "";
        $descripcion = isset($_POST["descripcion"]) ? trim($_POST["descripcion"]) : "";
        $tipo = isset($_POST["tipoMedicamento"]) ? trim($_POST["tipoMedicamento"]) : "";
        $lote = isset($_POST["lote"]) ? trim($_POST["lote"]) : "";
        $fechaVencimiento = isset($_POST["fechaVencimiento"]) ? trim($_POST["fechaVencimiento"]) : "";
        $presentacion = isset($_POST["presentacion"]) ? trim($_POST["presentacion"]) : "";

        $medicamento = new Medicamento();
        $medicamento->setNombreMedicamento($nombreMedicamento);
        $medicamento->setTipoMedicamento($tipo);
        $encontrado = $medicamento->verificarExistenciaDb();
        if ($encontrado == false) {
            $medicamento->setDescripcion($descripcion);
            $medicamento->setLote($lote);
            $medicamento->setFechaVencimiento($fechaVencimiento);
            $medicamento->setPresentacion($presentacion);
            $medicamento->guardarEnDb();
            if ($medicamento->verificarExistenciaDb()) {
                echo 1; // se guardo exitosamente
            } else {
                echo 3; //problema con guardar
            }
        } else {
            echo 2; // ya existte
        }
        break;

    case "eliminar":
        $medicamento = new Medicamento();
        $medicamento->setIdMedicamento(trim($_POST["idMedicamento"]));
        $respuesta = $medicamento->eliminar();
        echo $respuesta;
        break;


    case 'obtener_medicamentos':

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['obtenerMedicamentos'])) {
            $medicamentoModel = new Medicamento();
            $medicamentos = $medicamentoModel->listarMedicamentos();
            echo json_encode($medicamentos);
        }



}
