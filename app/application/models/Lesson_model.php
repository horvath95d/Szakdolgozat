<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lesson_model extends CI_Model {
    
    // Get
    public function getNoLessons() {
        $query = $this->db->query("SELECT `lesson`.*, `teacher`.`name`, COUNT(*) AS 'count'
            FROM `lesson` JOIN `teacher` ON `teacher`.`id` = `teacher_id`
            WHERE `lesson`.`school_id` = ".$this->school_id." AND `subject_id` IS NULL
            GROUP BY `teacher`.`name`
            ORDER BY `teacher`.`name` ASC");
        return $query->result_array();
    }

    public function getLessonsByClass($id) {
        $query = $this->db->query("SELECT `lesson`.`id`, `subject_id`, `teacher_id`,
            COUNT(*) AS 'count',
            `subject`.`name` AS 'subject_name',
            `teacher`.`name` AS 'teacher_name'
            FROM `lesson`
            JOIN `subject` ON `subject`.`id` = `subject_id`
            LEFT OUTER JOIN `teacher` ON `teacher`.`id` = `teacher_id`
            WHERE `lesson`.`school_id` = ".$this->school_id." AND `class_id` = ".$id."
            GROUP BY `subject`.`name`, `teacher`.`name`
            ORDER BY `subject`.`name`, `teacher`.`name` ASC");
        return $query->result_array();
    }
    
    public function getYears() {
        $query = $this->db->query("SELECT `year` FROM `class`
            WHERE `school_id` = ".$this->school_id." GROUP BY `year`");
        return $query->result_array();
    }

    public function getLessonsByYear($n) {
        $query = $this->db->query("SELECT `lesson`.`id`, `subject_id`, `teacher_id`,
            COUNT(*) AS 'count',
            `subject`.`name` AS 'subject_name',
            `teacher`.`name` AS 'teacher_name'
            FROM `lesson`
            JOIN `subject` ON `subject`.`id` = `subject_id`
            LEFT OUTER JOIN `teacher` ON `teacher`.`id` = `teacher_id`
            WHERE `lesson`.`school_id` = ".$this->school_id." AND `year` = ".$n."
            GROUP BY `subject`.`name`, `teacher`.`name`
            ORDER BY `subject`.`name`, `teacher`.`name` ASC");
        return $query->result_array();
    }

    // Save
    public function saveLessons() {

        for ($i=0; $i < count($_POST['teacher_id']); $i++) {

            if (!empty($_POST['subject_id'][$i]) || !empty($_POST['teacher_id'])) {
                $record = array(
                    'school_id' => $this->school_id,
                    'subject_id' => empty($_POST['subject_id'][$i]) ? NULL : $_POST['subject_id'][$i],
                    'teacher_id' => empty($_POST['teacher_id'][$i]) ? NULL : $_POST['teacher_id'][$i],
                    'class_id' => empty($_POST['class_id']) ? NULL : $_POST['class_id'],
                    'room_id' => empty($_POST['subject_id'][$i]) ? NULL : $this->getRoomID($_POST['subject_id'][$i]),
                    'year' => empty($_POST['year']) ? NULL : $_POST['year']
                );
    
                if (isset($_POST['id'][$i])) { //update
                    $where = $this->db->query("SELECT `school_id`, `subject_id`, `teacher_id`, `class_id`, `year`
                        FROM `lesson` WHERE `id` =".$_POST['id'][$i])->result_array()[0];
                    
                    $this->db->where($where);
                    $this->db->update('lesson', $record);
                    
                    $this->db->select('COUNT(*)');
                    $this->db->where($record);
                    $this->db->group_by(array('school_id', 'subject_id', 'teacher_id', 'class_id', 'year'));
                    $count = $this->db->get('lesson')->row_array()['COUNT(*)'];
                    
                    if ($count < $_POST['count'][$i]) { //insert more
                        $t = $_POST['count'][$i] - $count;
                        
                        for ($j=0; $j < $t; $j++) {                        
                            $this->db->insert('lesson', $record);
                        }
    
                    } elseif ($count > $_POST['count'][$i]) { //delete if less
                        $t = $count - $_POST['count'][$i];
                        
                        for ($j=0; $j < $t; $j++) {
                            $this->db->select('max(`id`)');
                            $this->db->where($record);
                            $delete_id = $this->db->get('lesson')->row_array()['max(`id`)'];
                            
                            $this->db->delete('lesson', array('id' => $delete_id));
                        }
                    }
    
                } else { //insert
    
                    for ($j=0; $j < $_POST['count'][$i]; $j++) {
                        $this->db->insert('lesson', $record);
                    }
                }
            }
        }
        $this->session->set_flashdata('message', $this->db->error()['message']);
    }

    private function getRoomID($subjectID) {
        $query = $this->db->query("SELECT `room_id` FROM `room_subject`
            WHERE `subject_id`=".$subjectID."
            GROUP BY `subject_id` HAVING COUNT(*) = 1");
        return isset($query->row_array()['room_id']) ? $query->row_array()['room_id'] : NULL;
    }

    // Delete
    public function deleteLessons($id) {
        $where = $this->db->query("SELECT `school_id`, `subject_id`, `teacher_id`, `class_id`, `year`
            FROM `lesson` WHERE `id` =".$id)->result_array()[0];
        
        $this->db->delete('lesson', $where);
    }
}
