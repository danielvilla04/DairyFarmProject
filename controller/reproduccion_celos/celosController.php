<?php

require_once '../../model/reproduccion_celos/celos.php';

switch ($_GET['op']) {
    case 'listar_tabla':
        $celosdb = new celos();
        $registros = $celosdb->listarDb();
        $datos = array();
        foreach ($registros as $registro) {
            $datos[] = array(
                "0" => $registro->getIdPrefijo(),
                "1" => $registro->getAreteAnimal(),
                "2" => $registro->getFechaDiagnostico(),
                "3" => $registro->getDetallesCelos(),
                "4" => '<button class="btn btn-danger" onclick="eliminar(\'' . $registro->getIdCelo() . '\')">Eliminar</button>'
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
        $idAnimal = isset($_POST["id_animal"]) ? trim($_POST["id_animal"]) : "";
        $fechaDiagnostico = isset($_POST["fecha_celo"]) ? trim($_POST["fecha_celo"]) : "";
        $detalles = isset($_POST["detalles_celos"]) ? trim($_POST["detalles_celos"]) : "";
     

        $celo = new celos();
        $celo->setIdAnimal($idAnimal);
        $celo->setFechaDiagnostico($fechaDiagnostico);
        $encontrado = $celo->verificarExistenciaDb();
        if ($encontrado == false) {
            $celo->setDetallesCelo($detalles);

            $celo->guardarEnDb();
            if ($celo->verificarExistenciaDb()) {
                echo 1; // se guardo exitosamente
            } else {
                echo 3; //problema con guardar
            }
        } else {

            echo 2; // ya existte
        }
        break;

    case "eliminar":
        $celo = new celos();
        $celo->setIdCelo(trim($_POST["id_celo"]));
        $respuesta = $celo->eliminar();
        echo $respuesta;
        break;

    case 'listar_celos_grafica':
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['obtenerGrafica'])) {
            $celoModel = new celos();
            $celos = $celoModel->listarCelosGrafica();

            $meses = [];
            $cantidadCelos = [];
            $data = null;
            foreach ($celos as $row) {
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
                        $mes = '';
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
                $cantidadCelos[] = $row['cantidad_celos'];
            }
            $data_json = json_encode(
                array(
                    'meses' => $meses,
                    'cantidadCelos' => $cantidadCelos
                )
            );

            echo ($data_json);
        }
        break;

    case 'listar_celos':
        $celosdb = new celos();
        $celos = $celosdb->listarcelos();
        $datos = array();
        foreach ($celos as $registro) {
            $datos[] = array(
                "0" => $registro->getAreteAnimal(),
                "1" => $registro->getFechaDiagnostico(),
                "2" => $registro->getDetallesCelos(), );
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
    
     case 'obtenerCantidadCelo':
                    $celo = new celos();
                    $cantidadCelo = $celo->obtenerCantidadCelos();
                        
                        if (!is_string($cantidadCelo)) {
                            echo $cantidadCelo; // Devuelve la cantidad como respuesta
                        } else {
                            echo $cantidadCelo; // Maneja el error si es una cadena JSON de error
                        }
                    break;
}
?>