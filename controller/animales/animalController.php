<?php

require_once '../../model/animales/Animal.php';

switch ($_GET['op']) {
    case 'listar_tabla':
        $animal = new Animal();
        $registros = $animal->listarDb();
        $datos = array();
        foreach ($registros as $registro) {
            $imagenHTML = '';
            // Verificar si hay datos de imagen antes de intentar mostrarla
            if (!empty($registro->getBase64Image())) {
                $imagenHTML = '<img src="data:image/jpeg;base64,' . $registro->getBase64Image() . '" alt="Imagen" style="max-width: 50px; max-height: 50px;">';
            } else {
                $imagenHTML = 'Sin imagen';
            }
            $datos[] = array(
                "0" => $registro->getIdAnimal(),
                "1" => $registro->getNumero_arete(),
                "2" => $registro->getNombre(),
                "3" => $registro->getFecha_nacimiento(),
                "4" => $registro->getRaza(),
                "5" => $registro->getPeso(),
                "6" => $registro->getColores_caracteristicas(),
                "7" => $registro->getObservaciones(),
                "8" => $imagenHTML,
                "9" => '<button class="btn btn-success" id="modificarDato">Modificar</button>' . '<button class="btn btn-danger" onclick="eliminar(\'' . $registro->getIdAnimal() . '\')">Eliminar</button>'
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

    case 'listar_animales':
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['obtenerAnimales'])) {
            $animalModel = new Animal();
            $animales = $animalModel->listarAnimales();
            echo json_encode($animales);
        }
        break;
    case 'insert':
        $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
        $imagen = isset($_FILES["images"]) ? $_FILES["images"] : null; // Asegúrate de que el formulario tenga un campo de tipo 'file' llamado 'imagen'
        $fecha_nacimiento = isset($_POST["fecha_nacimiento"]) ? trim($_POST["fecha_nacimiento"]) : "";
        $raza = isset($_POST["raza"]) ? trim($_POST["raza"]) : "";
        $peso = isset($_POST["peso"]) ? trim($_POST["peso"]) : "";
        $numero_arete = isset($_POST["numero_arete"]) ? trim($_POST["numero_arete"]) : "";
        $colores_caracteristicas = isset($_POST["colores_caracteristicas"]) ? trim($_POST["colores_caracteristicas"]) : "";
        $observaciones = isset($_POST["observaciones"]) ? trim($_POST["observaciones"]) : "";

        $ingresarAnimal = new Animal();

        $ingresarAnimal->setNombre($nombre);
        $ingresarAnimal->setFecha_nacimiento($fecha_nacimiento);
        $ingresarAnimal->setRaza($raza);
        $ingresarAnimal->setPeso($peso);
        $ingresarAnimal->setNumero_arete($numero_arete);
        $ingresarAnimal->setColores_caracteristicas($colores_caracteristicas);
        $ingresarAnimal->setObservaciones($observaciones);
        if ($imagen) {
            $imagenContenido = file_get_contents($imagen["tmp_name"]);
            $ingresarAnimal->setImages($imagenContenido);
        }
        $encontrado = $ingresarAnimal->verificarExistenciaDb();
        if ($encontrado == false) {

            $ingresarAnimal->setNombre($nombre);
            $ingresarAnimal->setFecha_nacimiento($fecha_nacimiento);
            $ingresarAnimal->setRaza($raza);
            $ingresarAnimal->setPeso($peso);
            $ingresarAnimal->setNumero_arete($numero_arete);
            $ingresarAnimal->setColores_caracteristicas($colores_caracteristicas);
            $ingresarAnimal->setObservaciones($observaciones);
            if ($imagen) {
                $imagenContenido = file_get_contents($imagen["tmp_name"]);
                $ingresarAnimal->setImages($imagenContenido);
            }
            $ingresarAnimal->guardarEnDb();
            if ($ingresarAnimal->verificarExistenciaDb()) {
                echo 1; // se guardo exitosamente
            } else {
                echo 3; //problema con guardar
            }
        } else {

            echo 2; // ya existte
        }
        break;

    case "eliminar":
        $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
        $image = isset($_POST["images"]) ? trim($_POST["images"]) : "";
        $fecha_nacimiento = isset($_POST["fecha_nacimiento"]) ? trim($_POST["fecha_nacimiento"]) : "";
        $raza = isset($_POST["raza"]) ? trim($_POST["raza"]) : "";
        $peso = isset($_POST["peso"]) ? trim($_POST["peso"]) : "";
        $numero_arete = isset($_POST["numero_arete"]) ? trim($_POST["numero_arete"]) : "";
        $colores_caracteristicas = isset($_POST["colores_caracteristicas"]) ? trim($_POST["colores_caracteristicas"]) : "";
        $observaciones = isset($_POST["observaciones"]) ? trim($_POST["observaciones"]) : "";

        $animal = new Animal();
        $animal->setNombre($nombre);
        $animal->setImages($image);
        $animal->setFecha_nacimiento($fecha_nacimiento);
        $animal->setRaza($raza);
        $animal->setPeso($peso);
        $animal->setNumero_arete($numero_arete);
        $animal->setColores_caracteristicas($observaciones);
        $animal->setIdAnimal(trim($_POST["idRegistro"]));
        $respuesta = $animal->eliminar();
        echo $respuesta;
        break;

    case 'modificar':
        $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
        $fecha_nacimiento = isset($_POST["fecha_nacimiento"]) ? trim($_POST["fecha_nacimiento"]) : "";
        $raza = isset($_POST["raza"]) ? trim($_POST["raza"]) : "";
        $peso = isset($_POST["peso"]) ? trim($_POST["peso"]) : "";
        $numero_arete = isset($_POST["numero_arete"]) ? trim($_POST["numero_arete"]) : "";
        $colores_caracteristicas = isset($_POST["colores_caracteristicas"]) ? trim($_POST["colores_caracteristicas"]) : "";
        $observaciones = isset($_POST["observaciones"]) ? trim($_POST["observaciones"]) : "";

        $ingresarAnimal = new Animal();

        $ingresarAnimal->setNombre($nombre);
        $ingresarAnimal->setFecha_nacimiento($fecha_nacimiento);
        $ingresarAnimal->setRaza($raza);
        $ingresarAnimal->setPeso($peso);
        $ingresarAnimal->setNumero_arete($numero_arete);
        $ingresarAnimal->setColores_caracteristicas($colores_caracteristicas);
        $ingresarAnimal->setObservaciones($observaciones);
        $encontrado = $ingresarAnimal->verificarExistenciaDb();
        if ($encontrado == 1) {

            //$usuario->llenarCampos($id); 
            //$modulo->setNombre($nombreModif);
            $ingresarAnimal->setNumero_arete($numero_arete);
            $ingresarAnimal->setColores_caracteristicas($colores_caracteristicas);
            $ingresarAnimal->setObservaciones($observaciones);
            $modificados = $ingresarAnimal->actualizarAnimal();
            if ($modificados > 0) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 2;
        }
        break;

    case 'listar_animales_grafica':
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['obtenerAnimalesGrafica'])) {
            $animalModel = new Animal();
            $animales = $animalModel->listarAnimalesGrafica();

            $meses = [];
            $cantidadanimales = [];
            $data = null;
            foreach ($animales as $row) {
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
                $cantidadanimales[] = $row['cantidad_animales'];
            }
            $data_json = json_encode(
                array(
                    'meses' => $meses,
                    'cantidadAnimales' => $cantidadanimales
                )
            );

            echo ($data_json);
        }
        break;
    case 'listarAnimales':
        $animal_me_db = new Animal();
        $registros = $animal_me_db->listarDb();
        $datos = array();
        foreach ($registros as $registro) {
            $datos[] = array(
                "0" => $registro->getNumeroArete(),
                "1" => $registro->getNumero_arete(),
                "2" => $registro->getNombre(),
                "3" => $registro->getFecha_nacimiento(),
                "4" => $registro->getRaza(),
                "5" => $registro->getPeso(),
                "6" => $registro->getColores_caracteristicas(),
                "7" => $registro->getObservaciones(),
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


    case 'listarImagen':
        $animalModel = new Animal();
        $registros = $animalModel->listarImagenes();

        $datos = array();

        foreach ($registros as $registro) {
            $imagenHTML = '';

            if (!empty($registro->getImages())) {
                $base64Image = base64_encode($registro->getImages());
                $imagenHTML = '<div class="carousel-item">' .
                    '<img class="d-block w-100" src="data:image/jpeg;base64,' . $base64Image . '" alt="' . $registro->getNombre() . '">' .
                    '</div>';
            }

            $datos[] = $imagenHTML;
        }

        echo json_encode($datos);
        break;
    case 'obtenerCantidadAnimales':
        $animal = new Animal();
        $cantidadAnimales = $animal->obtenerCantidadAnimales();

        if (!is_string($cantidadAnimales)) {
            echo $cantidadAnimales; // Devuelve la cantidad como respuesta
        } else {
            echo $cantidadAnimales; // Maneja el error si es una cadena JSON de error
        }
        break;


    case 'listar_vacas_vacias':
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['obtenerVacasVacias'])) {
            $animalModel = new Animal();
            $animales = $animalModel->listarVacias();

            echo ($animales);
        }
        break;


    case 'listar_vacas_prenadas':
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['obtenerVacasPrenadas'])) {
            $animalModel = new Animal();
            $animales = $animalModel->listarPrenadas();

            echo ($animales);
        }
        break;

}

?>