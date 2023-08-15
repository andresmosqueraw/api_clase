<?php
// Detect our uri
$uri = explode("/", $_SERVER['REQUEST_URI']);
var_dump($uri);
$inputs = array();
$inputs['raw_input'] = file_get_contents('php://input');
$_POST = json_decode($inputs['raw_input'], true);

if (count(array_filter($uri)) < 2){
    $json = array(
        "ruta" => "ruta no encontrada"
    );
    echo json_encode($json, true);
    return;
}
else {
    /**
     * EndPoints correctos
     */
    $endPoint = (array_filter($uri)[2]);
    echo $endPoint;
    $method = $_SERVER['REQUEST_METHOD'];
    echo $method;
}

?>