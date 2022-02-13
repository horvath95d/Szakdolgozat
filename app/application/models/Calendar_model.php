<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar_model extends CI_Model {

    public function getEvents() {
        $query = $this->db->query("SELECT `id`, `name`,
            REPLACE(`start`, '-', '.') AS 'start',
            REPLACE(`end`, '-', '.') AS 'end' FROM `event`
            WHERE `school_id`=".$this->school_id."
            ORDER BY `start` ASC")->result_array();

        return $query;
    }

    public function saveEvents() {
        $_POST['end'] = empty($_POST['end']) ? NULL : $_POST['end'];
        $record = array(
            'school_id' => $this->school_id,
            'name' => $_POST['name'],
            'start' => $_POST['start'],
            'end' => $_POST['end']
        );

        $this->db->insert('event', $record);
        $this->session->set_flashdata('message', $this->db->error()['message']);
    }

    public function deleteEvent($id) {
        $this->db->delete('event', array('id' => $id));
    }
}