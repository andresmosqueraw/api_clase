<?php

require_once "model/coursesModel.php";

class ControllerCourses{
    private $_method;
    private $_complement;
    private $_data;
 
    function __construct($method, $complement, $data){
        $this->_method = $method;
        $this->_complement = $complement ==null ? 0: $complement;
        $this->_data = $data !=0 ? $data : "";
    }

    public function index(){
        switch ($this->_method){
            case 'GET':
                switch ($this->_complement) {
                    case 0:
                        $courses= ModelCourses::getCourses('courses',0);
                        $json=$courses;
                        echo json_encode($json,true);
                        return;
                    default:
                    $courses= ModelCourses::getCourses('courses',$this->_complement);
                    $json=$courses;
                        echo json_encode($json,true);
                        return;
                }

        case 'POST':
            if($this->validCourses($this->_data)){
                $num = ModelCourses::searchCourses($this->_data['nameCourse']);
                if ($num <= 0){
                    $response =ModelCourses::postCourses($this->_data);
                }else{
                    $response=array(
                        "status"=>404,
                        "message"=>"Ya existe el curso"
                    );
                }
                echo json_encode($response,true);
                return;
            }else{
                $json = array(
                    "status"=>404,
                    "message"=>"Datos incorrectos"
                );
                echo json_encode($json,true);
                return;
            }
       
        case 'PUT':
            $json =array(
                "ruta"=>"PUT Course");
                echo json_encode($json,true);
            return;

        case 'DELETE':
            $json =array(
                "ruta"=>"DELETE Course");
                echo json_encode($json,true);
            return;

        default:
            $json =array(
                "ruta"=>"Not found");
                echo json_encode($json,true);
            return;
    }
}

private function validCourses($data){
    $trimmed_data = "";
    $nameCourse = "";
    $durationCourse = 0;
    $response = false;

    if(!empty($data)){
        $trimmed_data = array_map('trim', $data);
        
        $matchName = preg_match('/^([\w\s]{3,50})$/', $trimmed_data['nameCourse']);
        $matchDuration = preg_match('/^(?:(?:[1-9]\d?)|100)$/', $trimmed_data['durationCourse']);
        
        if(!empty($trimmed_data['nameCourse']) && ($matchName > 0) && ($matchDuration > 0)){
            $response = true;
        }
    }
    return $response;
}


}

?>