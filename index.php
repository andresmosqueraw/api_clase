 <?php
    require_once "model/conDB.php";
    require_once "controller/routesController.php";
    $con = Connection::connect();
    var_dump($con);

    $routes = new RoutesController();
    $routes->index();
 ?>