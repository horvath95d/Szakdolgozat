<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Helper_model extends CI_Model {

    function getLesson($id) {
        $query = $this->db->query("SELECT `lesson`.*,`short`,`color`,
        `subject`.`name` AS 'subject_name',
        `class`.`name` AS 'class_name',
        `teacher`.`name` AS 'teacher_name',
        `room`.`name` AS 'room_name'
        FROM `lesson`
        JOIN `subject` ON `lesson`.`subject_id` = `subject`.`id`
        LEFT JOIN `class` ON `lesson`.`class_id` = `class`.`id`
        LEFT JOIN `teacher` ON `lesson`.`teacher_id` = `teacher`.`id`
        LEFT JOIN `room` ON `lesson`.`room_id` = `room`.`id`
        WHERE `lesson`.`id` = ".$id);
        return $query->row_array();
    }

    function getSubjectName($id) {
        $query = $this->db->query("SELECT `name` FROM `subject` WHERE `id`=".$id);
        return $query->row_array()['name'];
    }

    function getTeacherName($id) {
        $query = $this->db->query("SELECT `name` FROM `teacher` WHERE `id`=".$id);
        return $query->row_array()['name'];
    }

    function getClassName($id) {
        $query = $this->db->query("SELECT `name` FROM `class` WHERE `id`=".$id);
        return $query->row_array()['name'];
    }

    function getRoomName($id) {
        $query = $this->db->query("SELECT `name` FROM `room` WHERE `id`=".$id);
        return $query->row_array()['name'];
    }

    function teacherHaveSubject($teacher_id) {
        $query = $this->db->query("SELECT `id` FROM `teacher_subject`
            WHERE `teacher_id` = ".$teacher_id);
        return !empty($query->result_array());
    }
    
    function roomHaveSubject($id) {
        $query = $this->db->query("SELECT `id` FROM `room_subject`
            WHERE `room_id`=".$id);
        return !empty($query->result_array());
    }

    function teacherHaveSubject2($teacher_id, $subject_id) {
        $query = $this->db->query("SELECT `id` FROM `teacher_subject`
            WHERE `teacher_id`=".$teacher_id." AND `subject_id`=".$subject_id);
        return !empty($query->result_array());
    }
}