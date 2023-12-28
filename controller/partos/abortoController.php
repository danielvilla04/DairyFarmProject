<?php

require_once '../../model/abortos/Aborto.php';

switch ($_GET['op']) {
    case 'listar_tabla':
        $aborto_db = new Aborto();
        $Aborto = $aborto_db->listarDb();
        $datos = array();
        foreach ($Aborto as $aborto) {
            $datos[] = array(
                "0" => $aborto->getIdVaca(),
                "1" => $aborto->getFechaAborto(),
                "2" => $aborto->getEstadoVaca(),
                "3" => $aborto->getObservaciones()
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

    case 'listar_abortos':
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['obtenerAbortos'])) {
            $abortoModel = new aborto();
            $aborto = $abortoModel->listarAbortos();
            echo json_encode($Aborto);
        }
        break;
    case 'listar_abortos_grafica':
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['obtenerAbortosGrafica'])) {
            $AbortoModel = new Aborto();
            $Aborto = $AbortoModel->listarAbortosGrafica();

            $meses = [];
            $cantidadAbortos = [];
            $data = null;
            foreach ($Aborto as $row) {
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
                $cantidadAbortos[] = $row['cantidad_abortos'];
            }
            $data_json = json_encode(
                array(
                    'meses' => $meses,
                    'cantidadAbortos' => $cantidadAbortos
                )
            );

            echo ($data_json);
        }
        break;

    case 'obtener_abortos':

        $abortoModel = new Aborto();
        $aborto = $abortoModel->obtenerAbortos();
        $eventos = array();
        foreach ($aborto as $row) {
            $arete = $row['numero_arete'];
            $aborto = [
                "title" => "Aborto de $arete",
                "start" => $row["fecha_aborto"],
                "end" => $row["fecha_aborto"],

            ];
            $eventos[] = $aborto;
        }

        echo json_encode($eventos);

        break;

}

?>