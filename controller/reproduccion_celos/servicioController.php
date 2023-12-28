<?php

require_once '../../model/reproduccion_celos/servicio.php';
require_once '../../model/reproduccion_celos/celos.php';

switch ($_GET['op']) {
    case 'listar_tabla':
        $serviciodb = new servicio();
        $registros = $serviciodb->listarDB();
        $datos = array();
        foreach ($registros as $registro) {
            $datos[] = array(
                "0" => $registro->getIdPrefijo(),
                "1" => $registro->getAreteAnimal(),
                "2" => $registro->getFechaDiagnostico(),
                "3" => $registro->getTipoServicio(),
                "4" => $registro->getObservaciones(),
               
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
        $idAnimalVaca = isset($_POST["id_animal"]) ? trim($_POST["id_animal"]) : "";
        $fechaDiagnostico = isset($_POST["fecha_servicio"]) ? trim($_POST["fecha_servicio"]) : "";
        $tipoServicio = isset($_POST["tipo_servicio"]) ? trim($_POST["tipo_servicio"]) : "";
        $observaciones = isset($_POST["observaciones"]) ? trim($_POST["observaciones"]) : "";

        $servicio = new servicio();
        $servicio->setIdAnimalVaca($idAnimalVaca);
        $servicio->setFechaDiagnostico($fechaDiagnostico);
        $encontrado = $servicio->verificarExistenciaDb();
        if ($encontrado == false) {
            $servicio->setTipoServicio($tipoServicio);
            $servicio->setObservaciones($observaciones);
            $servicio->guardarEnDb();
            if ($servicio->verificarExistenciaDb()) {
                echo 1; // se guardo exitosamente
            } else {
                echo 3; //problema con guardar  
            }
        } else {

            echo 2; // ya existte
        }
        break;



    case 'listar_servicios':
        $serviciodb = new servicio();
        $registros = $serviciodb->listarServicios(); 
        $datos = array();
        foreach ($registros as $registro) {
            $datos[] = array(
                "0" => $registro->getAreteAnimal(),
                "1" => $registro->getFechaDiagnostico(),
                "2" => $registro->getTipoServicio(),);
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

      

    case 'obtener_servicios':
        $servicioModel = new servicio();
        $servicios = $servicioModel->obtenerServicios();

        $celoModel = new celos();
        $celos = $celoModel->obtenerCelos();


        $eventos = array();
        $lista1 = array();
        $lista2 = array();

        foreach($servicios as $row){
            $arete = $row['numero_arete'];
            $servicio=[
                "title" =>  "Servicio de $arete",
                "start" =>  $row["fecha_servicio"],
                "end" =>  $row["fecha_servicio"],
                "tipo" => 'servicio'

            ];
            $lista1[] = $servicio;
        }
        foreach($celos as $row){
            $arete = $row['numero_arete'];
            $servicio=[
                "title" =>  "Celo de $arete",
                "start" =>  $row["fecha_celo"],
                "end" =>  $row["fecha_celo"],
                "tipo" => 'celo'

            ];
            $lista1[] = $servicio;
        }

        $eventos = array_merge($lista1,$lista2);

        echo json_encode($eventos);
        
        break; 
    case 'obtenerCantidadServicio':
                    $servicio = new servicio();
                    $cantidadServicio = $servicio->obtenerCantidadServicio();
                        
                        if (!is_string($cantidadServicio)) {
                            echo $cantidadServicio; // Devuelve la cantidad como respuesta
                        } else {
                            echo $cantidadServicio; // Maneja el error si es una cadena JSON de error
                        }
                    break;
}
?>