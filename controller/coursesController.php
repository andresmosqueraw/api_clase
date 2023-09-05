<?php

require_once "model/coursesModel.php";

class ControllerCourses{

    private $_method; //propiedad o atributo

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

 

}

?>