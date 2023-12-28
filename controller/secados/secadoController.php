<?php

require_once '../../model/secados/secado.php';

switch ($_GET['op']) {
    case 'listar_tabla':
        $secado_db = new Secado();
        $registros = $secado_db->listarDb(); 
        $datos = array();
        foreach ($registros as $registro) {
            $datos[] = array(
                "0" => $registro->getIdPrefijo(),
                "1" => $registro->getAreteAnimal(),
                "2" => $registro->getFechaSecado(),
                "3" => $registro->getObservaciones(),
                "4" =>'<button class="btn btn-danger" onclick="eliminar(\'' . $registro->getIdSecado() . '\')">Eliminar</button>'
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

        $idAnimal = isset($_POST["idAnimal"]) ? trim($_POST["idAnimal"]) : "";
        $fechaSecado = isset($_POST["fechaSecado"]) ? trim($_POST["fechaSecado"]) : "";
        $observaciones = isset($_POST["observaciones"]) ? trim($_POST["observaciones"]) : "";

        $secado = new Secado();
        $secado->setIdAnimal($idAnimal);
        $secado->setFechaSecado($fechaSecado);
        $encontrado = $secado->verificarExistenciaDb();
        if ($encontrado == false) {
            $secado->setObservaciones($observaciones);
            $secado->guardarEnDb();
            if ($secado->verificarExistenciaDb()) {
                echo 1; // se guardo exitosamente
            } else {
                echo 3; //problema con guardar
            }
        } else {

            echo 2; // ya existe
        }
        break;

    case "eliminar":
        $secado = new Secado();
        $secado -> setIdsecado(trim($_POST["idRegistro"]));
        $respuesta = $secado->eliminar();
        echo $respuesta;
        break;
    

}
?>