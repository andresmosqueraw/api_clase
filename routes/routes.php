<?php
// Detect our rutaArray
$rutaArray = explode("/", $_SERVER['REQUEST_URI']);
// var_dump($rutaArray);
$inputs = array();
$inputs['raw_input'] = file_get_contents('php://input');
$_POST = json_decode($inputs['raw_input'], true);

if (count(array_filter($rutaArray)) < 2){
    $json = array(
        "ruta" => "ruta no encontrada"
    );
    // echo json_encode($json, true);
    return;
}
else {
    /**
     * EndPoints correctos
     */
    $endPoint = (array_filter($rutaArray)[2]);
    $complement = (array_key_exists(3, $rutaArray)) ? ($rutaArray)[3] : 0;
    // echo $endPoint;
    $method = $_SERVER['REQUEST_METHOD'];
    //echo $method;

    switch($endPoint){
        case 'courses':
            if (isset($_POST))
            {
                $course = new ControllerCourses($method, $complement, $_POST);                 
            } else {
                $course = new ControllerCourses($method, $complement, 0);
            }
            $course->index();
        break;
    }
}

?>