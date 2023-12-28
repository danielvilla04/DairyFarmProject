<?php

require_once '../../model/reproduccion_celos/VacaPrenada.php';


switch ($_GET['op']) {
 
    case 'listar_prenos':
        $db = new VacaPrenada();
        $registros = $db->listarPrenos(); 
        $datos = array();
        foreach ($registros as $registro) {
            $datos[] = array(
                "0" => $registro->getAreteAnimal(),
                "1" => $registro->getFechaServicio(),
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

      
}
?>