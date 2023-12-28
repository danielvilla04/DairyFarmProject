<?php

require_once '../../model/produccion/produccionSem.php';

switch ($_GET['op']) {
    case 'listar_tabla':
        $produccion_db = new produccionSem();
        $registros = $produccion_db->listarDb();
        $datos = array();
        foreach ($registros as $registro) {
            $datos[] = array(
                "0" => $registro->getIdPrefijo(),  
                "1" => $registro->getFechaSemana(),
                "2" => $registro->getKilosProducidos(),
                "3" => $registro->getCalidadBacteriologica(),
                "4" => $registro->getCelulasSomaticas(),
                "5" => $registro->getPorcentajeGrasa(),
                "6" => $registro->getPorcentajeProteina(),
                "7" => $registro->getPuntoCrioscopico(),
                "8" => $registro->getPresenciaInhibidores(),
                "9" => '<button class="btn btn-danger" onclick="eliminar(\'' . $registro->getIdProduccionSemanal() . '\')">Eliminar</button>'
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

        
        $fechaSemana = isset($_POST["Fecha"]) ? trim($_POST["Fecha"]) : "";
         $litros = isset($_POST["litros"]) ? trim($_POST["litros"]) : "";
        $calidad_bacteriologica = isset($_POST["calidadbacteriologica"]) ? trim($_POST["calidadbacteriologica"]) : "";
        $porcentaje_grasa = isset($_POST["porcentajegrasa"]) ? trim($_POST["porcentajegrasa"]) : "";
        $porcentaje_proteina = isset($_POST["porcentajeproteina"]) ? trim($_POST["porcentajeproteina"]) : "";
        $punto_crioscopico = isset($_POST["puntocrioscopico"]) ? trim($_POST["puntocrioscopico"]) : "";
        $presencia_inhibidores = isset($_POST["presenciainhibidores"]) ? trim($_POST["presenciainhibidores"]) : "";
        $celulas_somaticas = isset($_POST["celulassomaticas"]) ? trim($_POST["celulassomaticas"]) : "";

       

        $produccion = new ProduccionSem(); 
        $produccion->setFechaSemana($fechaSemana);
        $encontrado = $produccion->verificarExistenciaDb();
        if ($encontrado == false) {
            $produccion->setFechaSemana($fechaSemana);
            $produccion->setKilosProducidos($litros);
            $produccion->setCalidadBacteriologica($calidad_bacteriologica);
            $produccion->setPorcentajeGrasa($porcentaje_grasa);
            $produccion->setPorcentajeProteina($porcentaje_proteina);
            $produccion->setPuntoCrioscopico($punto_crioscopico);
            $produccion->setPresenciaInhibidores($presencia_inhibidores);
            $produccion->setCelulasSomaticas($celulas_somaticas);
            $produccion->guardarEnDb();
            if ($produccion->verificarExistenciaDb()) {
                echo 1; // se guardo exitosamente
            } else {
                echo 3; //problema con guardar
            }
        } else {

            echo 2; // ya existe
        }
        break;

        case 'listar_produccion_grafica':
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['obtenerGrafica'])) {
                $Model = new produccionSem();
                $enfermedades = $Model->listarGrafica();
    
                $semanas = [];
                $kilos = [];
                $data = null;
                foreach ($enfermedades as $row) {
    
                    $semanas[] = 'Semana '.$row['numero_semana'];
                    $kilos[] = $row['total_litros_semana'];
                }
                $data_json = json_encode(
                    array(
                        'semanas' => $semanas,
                        'kilos' => $kilos
                    )
                );
    
                echo ($data_json);
            }


}
?>