<?php

require_once '../../model/salud/EnfermedadAnimal.php';

switch ($_GET['op']) {
    case 'listar_tabla':
        $enfermedad_animal_db = new EnfermedadAnimal();
        $registros = $enfermedad_animal_db->listarDb();
        $datos = array();
        foreach ($registros as $registro) {
            $datos[] = array(
                "0" => $registro->getIdPrefijo(),
                "1" => $registro->getAreteAnimal(),
                "2" => $registro->getNombreAnimal(),
                "3" => $registro->getNombreEnfermedad(),
                "4" => $registro->getFechaDiagnostico(),
                "5" => $registro->getSintomasAnimal(),
                "6" => $registro->getEstadoAnimal(),
                "7" => $registro->getTratamiento(),
                "8" => $registro->getObservaciones(),
                "9" => '<button class="btn btn-success" id="modificarDato">Modificar</button>' . '<button class="btn btn-danger" onclick="eliminar(\'' . $registro->getIdEnfermedadAnimal() . '\')">Eliminar</button>'
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

        $fechaDiagnostico = isset($_POST["fechaDiagnostico"]) ? trim($_POST["fechaDiagnostico"]) : "";
        $sintomas = isset($_POST["sintomas"]) ? trim($_POST["sintomas"]) : "";
        $idEnfermedad = isset($_POST["idEnfermedad"]) ? trim($_POST["idEnfermedad"]) : "";
        $estadoEnfermedad = isset($_POST["estadoEnfermedad"]) ? trim($_POST["estadoEnfermedad"]) : "";
        $observaciones = isset($_POST["observaciones"]) ? trim($_POST["observaciones"]) : "";

        $enfermedadAnimal = new EnfermedadAnimal();
        $enfermedadAnimal->setIdEnfermedad($idEnfermedad);
        $enfermedadAnimal->setIdAnimal($idAnimal);
        $enfermedadAnimal->setFechaDiagnostico($fechaDiagnostico);
        $encontrado = $enfermedadAnimal->verificarExistenciaDb();
        if ($encontrado == false) {
            $enfermedadAnimal->setSintomasAnimal($sintomas);
            $enfermedadAnimal->setEstadoAnimal($estadoEnfermedad);
            $enfermedadAnimal->setObservaciones($observaciones);
            $enfermedadAnimal->guardarEnDb();
            if ($enfermedadAnimal->verificarExistenciaDb()) {
                echo 1; // se guardo exitosamente
            } else {
                echo 3; //problema con guardar
            }
        } else {

            echo 2; // ya existte
        }
        break;

    case "eliminar":
        $enfermedadAnimal = new EnfermedadAnimal();
        $nombreEnfermedad = isset($_POST["nombreEnfermedad"]) ? trim($_POST["nombreEnfermedad"]) : "";
        $areteAnimal = isset($_POST["areteAnimal"]) ? trim($_POST["areteAnimal"]) : "";
        $fechaDiagnostico = isset($_POST["fechaDiagnostico"]) ? trim($_POST["fechaDiagnostico"]) : "";

        $enfermedadAnimal->setAreteAnimal($areteAnimal);
        $enfermedadAnimal->setNombreEnfermedad($nombreEnfermedad);
        $enfermedadAnimal->setFechaDiagnostico($fechaDiagnostico);
        $enfermedadAnimal->setIdEnfermedadAnimal(trim($_POST["idRegistro"]));
        $respuesta = $enfermedadAnimal->eliminar();
        echo $respuesta;
        break;

    case 'modificar':
        $nombreEnfermedad = isset($_POST["nombreEnfermedad"]) ? trim($_POST["nombreEnfermedad"]) : "";
        $areteAnimal = isset($_POST["areteAnimal"]) ? trim($_POST["areteAnimal"]) : "";
        $fechaDiagnostico = isset($_POST["fechaDiagnostico"]) ? trim($_POST["fechaDiagnostico"]) : "";
        $sintomas = isset($_POST["sintomas"]) ? trim($_POST["sintomas"]) : "";
        $estadoEnfermedad = isset($_POST["estadoEnfermedad"]) ? trim($_POST["estadoEnfermedad"]) : "";
        $observaciones = isset($_POST["observaciones"]) ? trim($_POST["observaciones"]) : "";


        $enfermedadAnimal = new EnfermedadAnimal();
        $enfermedadAnimal->setNombreEnfermedad($nombreEnfermedad);
        $enfermedadAnimal->setAreteAnimal($areteAnimal);
        $enfermedadAnimal->setFechaDiagnostico($fechaDiagnostico);
        $encontrado = $enfermedadAnimal->verificarExistenciaModificar();
        if ($encontrado == 1) {

            //$usuario->llenarCampos($id); 
            //$modulo->setNombre($nombreModif);
            $enfermedadAnimal->setSintomasAnimal($sintomas);
            $enfermedadAnimal->setEstadoAnimal($estadoEnfermedad);
            $enfermedadAnimal->setObservaciones($observaciones);
            $modificados = $enfermedadAnimal->actualizarEnfermedadAnimal();
            if ($modificados > 0) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 2;
        }
        break;

    case 'listar_animales_enfermos':
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['obtenerAnimalesEnfermos'])) {
            $enfermedadesModel = new EnfermedadAnimal();
            $enfermedades = $enfermedadesModel->listarDB();
            $contador = 0;
            $datos = array();
            foreach ($enfermedades as $registro) {
                $contador += 1;
            }
            echo ($contador);
        }

    case 'listar_enfermedades_grafica':
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['obtenerEnfermedadesGrafica'])) {
            $enfermedadesModel = new EnfermedadAnimal();
            $enfermedades = $enfermedadesModel->listarEnfermedadesGrafica();

            $meses = [];
            $cantidadEnfermedades = [];
            $data = null;
            foreach ($enfermedades as $row) {
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
                $cantidadEnfermedades[] = $row['cantidad_enfermedades'];
            }
            $data_json = json_encode(
                array(
                    'meses' => $meses,
                    'cantidadEnfermedades' => $cantidadEnfermedades
                )
            );

            echo ($data_json);
        }



}
?>