<?php

require_once '../../model/salud/Enfermedad.php';

switch ($_GET['op']) {
    case 'listar_tabla':
        $enfermedad_db = new Enfermedad();
        $enfermedades = $enfermedad_db->listarDb();
        $datos = array();
        foreach ($enfermedades as $enfermedad) {
            $datos[] = array(
                "0" => $enfermedad->getIdPrefijo(),
                "1" => $enfermedad->getNombreEnfermedad(),
                "2" => $enfermedad->getDescripcion(),
                "3" => $enfermedad->getSintomas(),
                "4" => $enfermedad->getTratamiento(),
                "5" => '<button class="btn btn-success" id="modificarDato">Modificar</button>' . '<button class="btn btn-danger" onclick="eliminar(\'' . $enfermedad->getNombreEnfermedad() . '\')">Eliminar</button>'
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
        $nombreEnfermedad = isset($_POST["nombreEnfermedad"]) ? trim($_POST["nombreEnfermedad"]) : "";
        $descripcion = isset($_POST["descripcion"]) ? trim($_POST["descripcion"]) : "";
        $sintomas = isset($_POST["sintomas"]) ? trim($_POST["sintomas"]) : "";
        $tratamiento = isset($_POST["tratamiento"]) ? trim($_POST["tratamiento"]) : "";

        $enfermedad = new Enfermedad();
        $enfermedad->setNombreEnfermedad($nombreEnfermedad);
        $encontrado = $enfermedad->verificarExistenciaDb();
        if ($encontrado == false) {
            $enfermedad->setDescripcion($descripcion);
            $enfermedad->setSintomas($sintomas);
            $enfermedad->setTratamiento($tratamiento);
            $enfermedad->guardarEnDb();
            if ($enfermedad->verificarExistenciaDb()) {
                echo 1; // se guardo exitosamente
            } else {
                echo 3; //problema con guardar
            }
        } else {

            echo 2; // ya existte
        }
        break;

    case "eliminar":
        $enfermedad = new Enfermedad();
        $enfermedad->setNombreEnfermedad(trim($_POST["nombreEnfermedad"]));
        $respuesta = $enfermedad->eliminar();
        echo $respuesta;
        break;

        case 'modificar':
            $nombreEnfermedad = isset($_POST["nombreEnfermedad"]) ? trim($_POST["nombreEnfermedad"]) : "";
            $descripcion = isset($_POST["descripcion"]) ? trim($_POST["descripcion"]) : "";
            $sintomas = isset($_POST["sintomas"]) ? trim($_POST["sintomas"]) : "";
            $tratamiento = isset($_POST["tratamiento"]) ? trim($_POST["tratamiento"]) : "";
            $enfermedad = new Enfermedad();
            $enfermedad->setNombreEnfermedad($nombreEnfermedad);
            $encontrado = $enfermedad->verificarExistenciaDb();
            if ($encontrado == 1) {
            //$usuario->llenarCampos($id); 
              //$modulo->setNombre($nombreModif);
            $enfermedad->setNombreEnfermedad($nombreEnfermedad);
            $enfermedad->setDescripcion($descripcion);
            $enfermedad->setSintomas($sintomas);
            $enfermedad->setTratamiento($tratamiento);
              $modificados = $enfermedad->actualizarEnfermedad();
              if ($modificados > 0) {
                echo 1;
              } else {
                echo 0;
              }
            }else{
              echo 2;	
            }
      break;

      
    case 'obtener_enfermedades':
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['obtenerEnfermedades'])) {
            $enfermedadModel = new Enfermedad();
            $enfermedades = $enfermedadModel->listarEnfermedades();
            echo json_encode($enfermedades);
        }



}
?>