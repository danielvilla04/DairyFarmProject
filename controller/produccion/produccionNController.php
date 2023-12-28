<?php

require_once '../../model/produccion/produccion.php';

switch ($_GET['op']) {
    case 'listar_tabla':
        $produccion_db = new produccion();
        $registros = $produccion_db->listarDb();
        $datos = array();
        foreach ($registros as $registro) {
            $datos[] = array(
                "0" => $registro->getIdPrefijo(),  
                "1" => $registro->getAreteAnimal(),
                "2" => $registro->getFechaProduccion(),
                "3" => $registro->getKilosProducidos(),
                "4" => $registro->getObservaciones(),  
                "5" => '<button class="btn btn-danger" onclick="eliminar(\'' . $registro->getIdProduccion() . '\')">Eliminar</button>'
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

        $idAnimal = isset($_POST["IdAnimal"]) ? trim($_POST["IdAnimal"]) : "";
        $fechaproduccion = isset($_POST["Fecha"]) ? trim($_POST["Fecha"]) : "";
        $observaciones = isset($_POST["observaciones"]) ? trim($_POST["observaciones"]) : "";
        $kilosProducidos = isset($_POST["Litros"]) ? trim($_POST["Litros"]) : "";

        $produccion = new produccion();
        $produccion->setIdAnimal($idAnimal);
        $produccion->setFechaProduccion($fechaproduccion);
        $encontrado = $produccion->verificarExistenciaDb();
        if ($encontrado == false) {
            $produccion->setObservaciones($observaciones);
            $produccion->setKilosProducidos($kilosProducidos);
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

    case "eliminar":
        $produccion = new produccion();
        $produccion -> setIdProduccion(trim($_POST["idRegistro"]));
        $respuesta = $produccion->eliminar();
        echo $respuesta;
        break;

    case 'obtenerCantidadProduccion':
            $produccion = new produccion();
            $cantidadProduccion = $produccion->obtenerCantidadProduccion();
                       
                if (!is_string($cantidadProduccion)) {
                    echo $cantidadProduccion; // Devuelve la cantidad como respuesta
                } else {
                    echo $cantidadProduccion; // Maneja el error si es una cadena JSON de error
                    }
                    break;
    case 'obtenerPromedioProduccion':
                $produccion = new produccion();
                $cantidadProduccion = $produccion->obtenerCantidadProduccion();
                $sumaProduccion = $produccion->obtenerSumaIngresos();
                if ($cantidadProduccion > 0) {
                        $promedio =  $sumaProduccion / $cantidadProduccion;
                        echo $promedio; // Devuelve la cantidad como respuesta
                    } else {
                        echo $promedio; // Maneja el error si es una cadena JSON de error
                    }
                    break;
}
?>