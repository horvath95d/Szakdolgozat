<?php defined('BASEPATH') OR exit('No direct script access allowed');

class School_model extends CI_Model {

    // Get

    public function getSubjects() {
        $query = $this->db->query("SELECT * FROM `subject`
            WHERE `school_id`=".$this->school_id."
            ORDER BY `name` ASC");
        return $query->result_array();
    }

    public function getTeachers() {
        $query = $this->db->query("SELECT `teacher`.*, COUNT(*) AS 'lessonNumber'
            FROM `teacher`
            JOIN `lesson` ON `teacher_id` = `teacher`.`id`
            WHERE `teacher`.`school_id`=".$this->school_id."
            GROUP BY `teacher_id`
            ORDER BY `name` ASC");
        return $query->result_array();
    }

    public function getTeachersSubjects() {
        $query = $this->db->query("SELECT `teacher_subject`.*, `subject`.`name` AS 'subject_name', `teacher`.`name` AS 'teacher_name'
            FROM `teacher_subject`
            JOIN `subject` ON `subject_id` = `subject`.`id`
            JOIN `teacher` ON `teacher_id` = `teacher`.`id`
            WHERE `teacher_subject`.`school_id`=".$this->school_id."
            ORDER BY `subject`.`name`, `teacher`.`name` ASC");
        return $query->result_array();
    }

    public function getClasses() {
        $query = $this->db->query("SELECT * FROM `class`
            WHERE `school_id`=".$this->school_id."
            ORDER BY `name` ASC");
        return $query->result_array();
    }

    public function getRooms() {
        $query = $this->db->query("SELECT * FROM `room`
            WHERE `school_id`=".$this->school_id."
            ORDER BY `name` ASC");
        return $query->result_array();
    }

    public function getRoomsSubjects() {
        $query = $this->db->query("SELECT * FROM `room_subject`
            WHERE `school_id`=".$this->school_id);
        return $query->result_array();
    }

    public function getTimes() {
        $query = $this->db->query("SELECT * FROM `time`
            WHERE `school_id`=".$this->school_id."
            ORDER BY `start` ASC");
        return $query->result_array();
    }

    // Save

    public function saveSubjects() {

        for ($i=0; $i < count($_POST['name']); $i++) {

            if (!empty($_POST['name'][$i])) {
                $record = array(
                    'school_id' => $this->school_id,
                    'name' => $_POST['name'][$i],
                    'short' => empty($_POST['short'][$i]) ? substr($_POST['name'][$i], 0, 5) : $_POST['short'][$i],
                    'importance' => $_POST['importance'][$i],
                    'color' => $_POST['color'][$i]
                );
    
                if (isset($_POST['id'][$i])) {
                    $this->db->where(array('id' => $_POST['id'][$i]));
                    $this->db->update('subject', $record);
    
                } else
                    $this->db->insert('subject', $record);
            }
        }
        $this->session->set_flashdata('message', $this->db->error()['message']);
    }

    public function saveTeachers() {

        for ($i=0; $i < count($_POST['name']); $i++) {

            if (!empty($_POST['name'][$i])) {
                $record = array(
                    'school_id' => $this->school_id,
                    'name' => $_POST['name'][$i],
                    'lesson_number' => $_POST['lesson_number'][$i]
                );
    
                if (isset($_POST['id'][$i])) {
                    $this->db->where(array('id' => $_POST['id'][$i]));
                    $this->db->update('teacher', $record);
    
                } else {
                    $this->db->insert('teacher', $record);
    
                    $id = $this->get_record('teacher', $record)['id'];
                    array_push($_POST['teacher_id'], array($id, $id, $id, $id, $id, $id, $id, $id, $id, $id));
                }
    
                for ($j=0; $j < count($_POST['teacher_id'][$i]); $j++) {
    
                    if (!empty($_POST['subject_id'][$i][$j])) {
                        $record = array(
                            'school_id' => $this->school_id,
                            'teacher_id' => $_POST['teacher_id'][$i][$j],
                            'subject_id' => $_POST['subject_id'][$i][$j],
                        );
    
                        if (isset($_POST['teacher_subject_id'][$i][$j])) {
                            $this->db->where(array('id' => $_POST['teacher_subject_id'][$i][$j]));
                            $this->db->update('teacher_subject', $record);
    
                        } else
                            $this->db->insert('teacher_subject', $record);
    
                    } else if (isset($_POST['teacher_subject_id'][$i][$j]))
                        $this->db->delete('teacher_subject', array('id' => $_POST['teacher_subject_id'][$i][$j]));
                }
            }
        }
        $this->session->set_flashdata('message', $this->db->error()['message']);
    }

    public function saveClasses() {

        for ($i=0; $i < count($_POST['name']); $i++) {
            
            if (!empty($_POST['name'][$i])) {
                $teacher_id = empty($_POST['teacher_id'][$i]) ? NULL : $_POST['teacher_id'][$i];
                $room_id = empty($_POST['room_id'][$i]) ? NULL : $_POST['room_id'][$i];

                $record = array(
                    'school_id' => $this->school_id,
                    'name' => $_POST['name'][$i],
                    'year' => (int)$_POST['name'][$i],
                    'teacher_id' => $teacher_id,
                    'room_id' => $room_id,
                    'members' => $_POST['members'][$i]
                );
                
                if (isset($_POST['id'][$i])) {
                    $this->db->where(array('id' => $_POST['id'][$i]));
                    $this->db->update('class', $record);
                    
                } else
                    $this->db->insert('class', $record);
            }
        }
        $this->session->set_flashdata('message', $this->db->error()['message']);
    }

    public function saveRooms() {

        for ($i=0; $i < count($_POST['name']); $i++) {

            if (!empty($_POST['name'][$i])) {
                $record = array(
                    'school_id' => $this->school_id,
                    'name' => $_POST['name'][$i],
                    'members' => $_POST['members'][$i]
                );
    
                if (isset($_POST['id'][$i])) {
                    $this->db->where(array('id' => $_POST['id'][$i]));
                    $this->db->update('room', $record);
    
                } else {
                    $this->db->insert('room', $record);
    
                    $id = $this->get_record('room', $record)['id'];
                    array_push($_POST['room_id'], array($id, $id, $id, $id, $id, $id, $id, $id, $id, $id));
                }
                
                if ($_POST['room_id'][$i] != NULL) {
    
                    for ($j=0; $j < count($_POST['room_id'][$i]); $j++) {
        
                        if (!empty($_POST['subject_id'][$i][$j])) {
                            $record = array(
                                'school_id' => $this->school_id,
                                'room_id' => $_POST['room_id'][$i][$j],
                                'subject_id' => $_POST['subject_id'][$i][$j],
                            );
        
                            if (isset($_POST['room_subject_id'][$i][$j])) {
                                $this->db->where(array('id' => $_POST['room_subject_id'][$i][$j]));
                                $this->db->update('room_subject', $record);
        
                            } else
                                $this->db->insert('room_subject', $record);
        
                        } else if (isset($_POST['room_subject_id'][$i][$j]))
                            $this->db->delete('room_subject', array('id' => $_POST['room_subject_id'][$i][$j]));
                    }
                }
            }
        }
        $this->session->set_flashdata('message', $this->db->error()['message']);
    }

    public function saveTimes() {

        for ($i=0; $i < count($_POST['start']); $i++) {

            if (!empty($_POST['start'][$i] && $_POST['end'][$i])) {
                $record = array(
                    'school_id' => $this->school_id,
                    'start' => $_POST['start'][$i],
                    'end' => $_POST['end'][$i]
                );

                if (isset($_POST['id'][$i])) {
                    $this->db->where(array('id' => $_POST['id'][$i]));
                    $this->db->update('time', $record);

                } else
                    $this->db->insert('time', $record);
            }
        }
        $this->session->set_flashdata('message', $this->db->error()['message']);
    }

    // Delete

    public function deleteSubject($id) {
        $this->db->delete('subject', array('id' => $id));
    }

    public function deleteTeacher($id) {
        $this->db->delete('teacher', array('id' => $id));
        $this->db->delete('lesson', array('teacher_id' => NULL, 'subject_id' => NULL));
    }

    public function deleteClass($id) {
        $this->db->delete('class', array('id' => $id));
    }

    public function deleteRoom($id) {
        $this->db->delete('room', array('id' => $id));
    }
    
    public function deleteTime($id) {
        $this->db->delete('time', array('id' => $id));
    }
}
