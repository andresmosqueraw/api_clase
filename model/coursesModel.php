<?php
require_once 'conDB.php';

class ModelCourses {
    static public function getCourses($table, $param) {
        $param = is_numeric($param) ? $param : 0;
        $query = "";
        $query = $param == 0 ? "SELECT * FROM $table" : "SELECT * FROM $table WHERE idCourse = $param";
        $statement = Connection::connect()->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    static public function postCourses(array $data){
        $query = "INSERT INTO courses VALUES ('', ?, ?); ";
        $statement = Connection::connect()->prepare($query);

        if ($statement->execute([
            $data['nameCourse'],
            $data['durationCourse']
        ]))
        {
            return "ok";
        } else {
            return Connection::connect()->errorInfo();
        }
    }

    static public function searchCourses($course){
        if (($course != null) || (!empty($course))) {
            $query = "SELECT * FROM courses WHERE nameCourse = '$course'; ";
            $statement = Connection::connect()->prepare($query);
            $statement->execute();
            // $count = $statement->fetchAll(PDO::FETCH_ASSOC);
            $count = $statement->rowCount();
            return $count;
        } else {
            return "error";
        }
    }

    // Hacer el put y el crud para los estudiantes

    static public function putCourses(array $data){
        $query = "UPDATE courses SET nameCourse = ?, durationCourse = ? WHERE idCourse = ?; ";
        $statement = Connection::connect()->prepare($query);

        if ($statement->execute([
            $data['nameCourse'],
            $data['durationCourse'],
            $data['idCourse']
        ]))
        {
            return "ok";
        } else {
            return Connection::connect()->errorInfo();
        }
    }

    static public function deleteCourses($table, $param){
        $query = "DELETE FROM $table WHERE idCourse = ?; ";
        $statement = Connection::connect()->prepare($query);

        if ($statement->execute([$param]))
        {
            return "ok";
        } else {
            return Connection::connect()->errorInfo();
        }
    }


}
?>