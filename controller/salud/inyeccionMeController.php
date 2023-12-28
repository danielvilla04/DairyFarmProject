<?php

require_once '../../model/salud/InyeccionMedicamento.php';

switch ($_GET['op']) {
    case 'listar_tabla':
        $inyeccion_me_db = new InyeccionMedicamento();
        $registros = $inyeccion_me_db->listarDb();
        $datos = array();
        foreach ($registros as $registro) {
            $datos[] = array(
                "0" => $registro->getIdPrefijo(),
                "1" => $registro->getNombreMedicamento(),
                "2" => $registro->getNumeroArete(),
                "3" => $registro->getLugarAplicacion(),
                "4" => $registro->getDosisAplicada(),
                "5" => $registro->getFechaAplicacion(),
                "6" => '<button class="btn btn-danger" onclick="eliminarMe(\'' . $registro->getIdInyeccionMedicamento() . '\')">Eliminar</button>'
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
        $fechaAplicacion = isset($_POST["fechaAplicacion"]) ? trim($_POST["fechaAplicacion"]) : "";
        $lugarAplicacion = isset($_POST["lugarAplicacion"]) ? trim($_POST["lugarAplicacion"]) : "";
        $idMedicamento = isset($_POST["idMedicamento"]) ? trim($_POST["idMedicamento"]) : "";
        $dosisAplicada = isset($_POST["dosisAplicada"]) ? trim($_POST["dosisAplicada"]) : "";



        $inyeccionMedicamento = new InyeccionMedicamento();
        $inyeccionMedicamento->setIdMedicamento($idMedicamento);
        $inyeccionMedicamento->setIdAnimal($idAnimal);
        $inyeccionMedicamento->setFechaAplicacion($fechaAplicacion);
        $encontrado = $inyeccionMedicamento->verificarExistenciaDb();
        if ($encontrado == false) {
            $inyeccionMedicamento->setLugarAplicacion($lugarAplicacion);
            $inyeccionMedicamento->setDosisAplicada($dosisAplicada);
            $inyeccionMedicamento->guardarEnDb();
            if ($inyeccionMedicamento->verificarExistenciaDb()) {
                echo 1; // se guardo exitosamente
            } else {
                echo 3; //problema con guardar
            }
        } else {

            echo 2; // ya existte
        }
        break;

    case "eliminar":
        $inyeccionMedicamento = new InyeccionMedicamento();
        $inyeccionMedicamento->setIdInyeccionMedicamento(trim($_POST["idRegistro"]));
        $respuesta = $inyeccionMedicamento->eliminar();
        echo $respuesta;
        break;

    case 'listar_inyecciones':
        $inyeccion_me_db = new InyeccionMedicamento();
        $registros = $inyeccion_me_db->listarDb();
        $datos = array();
        foreach ($registros as $registro) {
            $datos[] = array(
                "0" => $registro->getNumeroArete(),
                "1" => $registro->getFechaAplicacion(),
                "2" => $registro->getNombreMedicamento()
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





}
?>