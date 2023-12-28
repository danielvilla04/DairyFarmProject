<?php

require_once '../../model/partos/Parto.php';

switch ($_GET['op']) {
    case 'listar_tabla':
        $parto_db = new Parto();
        $partos = $parto_db->listarDb();
        $datos = array();
        foreach ($partos as $parto) {
            $datos[] = array(
                "0" => $parto->getIdPrefijo(),
                "1" => $parto->getNumeroArete(),
                "2" => $parto->getFechaParto(),
                "3" => $parto->getTipoParto(),
                "4" => $parto->getObservaciones(),
                "5" => '<button class="btn btn-danger" onclick="eliminar(\'' . $parto->getIdParto() . '\')">Eliminar</button>'
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
        $idAnimal = isset($_POST["idAnimal"]) ? trim($_POST["idAnimal"]) : "";
        $fecha_parto = isset($_POST["fechaParto"]) ? trim($_POST["fechaParto"]) : "";
        $tipo_parto = isset($_POST["tipoParto"]) ? trim($_POST["tipoParto"]) : "";
        $observaciones = isset($_POST["observaciones"]) ? trim($_POST["observaciones"]) : "";


        $parto = new Parto();
        $parto->setIdVaca($idAnimal);
        $parto->setFechaParto($fecha_parto);
        $encontrado = $parto->verificarExistenciaDb();
        if ($encontrado == false) {
            $parto->setTipoParto($tipo_parto);
            $parto->setObservaciones($observaciones);
            $parto->guardarEnDb();
            if ($parto->verificarExistenciaDb()) {
                echo 1; // se guardo exitosamente
            } else {
                echo 3; //problema con guardar
            }
        } else {

            echo 2; // ya existte
        }
        break;

    case "eliminar":
        $parto = new Parto();
        $parto->setIdParto(trim($_POST["idRegistro"]));
        $respuesta = $parto->eliminar();
        echo $respuesta;
        break;

    

    case 'obtener_parto':
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['obtenerParto'])) {
            $partoModel = new Parto();
            $partos = $partoModel->listarparto();
            echo json_encode($partos);
        }
        break;

    case 'listar_partos_grafica':
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['obtenerPartosGrafica'])) {
            $partosModel = new Parto();
            $partos = $partosModel->listarPartosGrafica();

            $meses = [];
            $cantidadpartos = [];
            $data = null;
            foreach ($partos as $row) {
                $mes = '';
                switch ($row['mes']) {
                    case 1:
                        $mes = 'Enero';
                        break;
                    case 2:
                        $mes = 'Febrero';
                        break;
                    case 3:
                        $mes = 'Marzo';
                        break;
                    case 4:
                        $mes = 'Abril';
                        break;
                    case 5:
                        $mes = 'Mayo';
                        break;
                    case 6:
                        $mes = 'Junio';
                        break;
                    case 7:
                        $mes = 'Julio';
                        break;
                    case 8:
                        $mes = 'Agosto';
                        break;
                    case 9:
                        $mes = 'Septiembre';
                        break;
                    case 10:
                        $mes = 'Octubre';
                        break;
                    case 11:
                        $mes = 'Noviembre';
                        break;
                    case 12:
                        $mes = 'Diciembre';
                        break;
                }

                $meses[] = $mes;
                $cantidadpartos[] = $row['cantidad_partos'];
            }
            $data_json = json_encode(
                array(
                    'meses' => $meses,
                    'cantidadPartos' => $cantidadpartos
                )
            );

            echo ($data_json);
        }
        break;

    case 'obtener_partos':

        $partoModel = new Parto();
        $partos = $partoModel->obtenerPartos();
        $eventos = array();
        foreach ($partos as $row) {
            $arete = $row['numero_arete'];
            $servicio = [
                "title" => "Parto de $arete",
                "start" => $row["fecha_parto"],
                "end" => $row["fecha_parto"],

            ];
            $eventos[] = $servicio;
        }

        echo json_encode($eventos);

        break;
}
?>