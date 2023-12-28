<?php

require_once '../../model/salud/Mastitis.php';

switch ($_GET['op']) {
    case 'listar_tabla':
        $Mastitis_db = new Mastitis();
        $Mastitis = $Mastitis_db->listarDb();
        $datos = array();
        foreach ($Mastitis as $fila) {
            $datos[] = array(
                "0" => $fila->getIdPrefijo(),
                "1" => $fila->getNumeroArete(),
                "2" => $fila->getTipoTratamiento(),
                "3" => $fila->getCuartosAfectados(),
                "4" => $fila->getFechaDiagnostico(),
                "5" => '<button class="btn btn-danger" onclick="eliminar(\'' . $fila->getIdMastitis() . '\')">Eliminar</button>'
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
        $tipoTratamiento = isset($_POST["tipoTratamiento"]) ? trim($_POST["tipoTratamiento"]) : "";
        $cuartosAfectados = isset($_POST["cuartosAfectados"]) ? trim($_POST["cuartosAfectados"]) : "";
        $fechaDiagnostico = isset($_POST["fechaDiagnostico"]) ? trim($_POST["fechaDiagnostico"]) : "";

        $Mastitis = new Mastitis();
        $Mastitis->setIdAnimal($idAnimal);
        $Mastitis->setFechaDiagnostico($fechaDiagnostico);
        $encontrado = $Mastitis->verificarExistenciaDb();
        if ($encontrado == false) {
            $Mastitis->setTipoTratamiento($tipoTratamiento);
            $Mastitis->setCuartosAfectados($cuartosAfectados);
            $Mastitis->guardarEnDb();
            if ($Mastitis->verificarExistenciaDb()) {
                echo 1; // se guardo exitosamente
            } else {
                echo 3; //problema con guardar
            }
        } else {

            echo 2; // ya existte
        }
        break;

    case "eliminar":
        $Mastitis = new Mastitis();
        $Mastitis->setIdMastitis(trim($_POST["idMastitis"]));
        $respuesta = $Mastitis->eliminar();
        echo $respuesta;
        break;

 

    case 'listar_vacas_mastitis':
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['obtenerVacasMastitis'])) {
            $mastitisModel = new Mastitis();
            $mastitis = $mastitisModel->listarDB();
            $contador = 0;
            $datos = array();
            foreach ($mastitis as $registro) {
                $contador += 1;
            }
            echo ($contador);
        }
        break;

    case 'listar_mastitis_grafica':
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['obtenerMastitisGrafica'])) {
            $mastitisModel = new Mastitis();
            $mastitis = $mastitisModel->listarMastitisGrafica(); 

            $year = [];
            $meses = [];
            $cantidadMastitis = [];
            $data = null;
            foreach ($mastitis as $row) {
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
                $years[] = $row['ano'];
                $meses[] = $mes;
                $cantidadmastitis[] = $row['total_mastitis'];
            }
            $data_json = json_encode(
                array(
                    'years' => $years,
                    'meses' => $meses,
                    'cantidadmastitis' => $cantidadmastitis
                )
            );

            echo ($data_json);
        }

        break;

    case 'listar_mastitis':

        $Mastitis_db = new Mastitis();
        $Mastitis = $Mastitis_db->listarMastitis();
        $datos = array();
        foreach ($Mastitis as $fila) {
            $datos[] = array(
                "0" => $fila->getNumeroArete(),
                "1" => $fila->getFechaDiagnostico(),
                "2" => $fila->getTipoTratamiento()
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

    case 'listar_mastitis_inyeccion':
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['obtenerMastitisInyeccion'])) {
            $mastitisModel = new Mastitis();
            $mastitis = $mastitisModel->listarMastitisInyeccion();
            echo ($mastitis);
        }
        break;

    case 'listar_mastitis_directo':
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['obtenerMastitisDirecto'])) {
            $mastitisModel = new Mastitis();
            $mastitis = $mastitisModel->listarMastitisDirecto();
            echo ($mastitis);
        }
        break;






}
?>