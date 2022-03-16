<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

    public function updateIndex() {
        if (password_verify($_POST['current-password'], $this->user->password)) {
            $this->db->set(array(
                'username' => $_POST['username'],
                'email' => $_POST['email']
            ));
            $this->db->where('id', $this->user->id);
            $this->db->update('users');

            if (!empty($this->db->error()['message'])) {
                $this->session->set_flashdata('message', $this->db->error()['message']);
            } else {
                $this->session->set_flashdata('message', 'Sikeres mentés');
            }

        } else {
            $this->session->set_flashdata('message', 'Hibás jelszó');
        }
    }

    public function updateActive() {
        $query = $this->db->query("UPDATE `users`
            SET `active_end` = DATE_ADD(`active_end`,INTERVAL ".$_POST['active']." month)
            WHERE `id` = ".$this->user->id);
    }

    // School

    public function getSchoolUsers($id) {
        $query = $this->db->query("SELECT * FROM `users`
            WHERE `school_id`=".$id." AND `id` != ".$this->user->id);
        return $query->result_array();
    }

    public function updateSchool() {
        
        if (password_verify($_POST['current-password'], $this->user->password)) {
            $this->db->set(array(
                'full_name' => $_POST['full_name'],
                'short_name' => $_POST['short_name'],
                'year' => $_POST['year1'].'/'.$_POST['year2'],
                'days' => $_POST['days'],
                'code' => $_POST['code']
            ));
            $this->db->where('owner_id', $this->user->id);
            $this->db->update('school');

            if (!empty($this->db->error()['message']))
                $this->session->set_flashdata('message', $this->db->error()['message']);
            else
                $this->session->set_flashdata('message', 'Sikeres mentés');

        } else
            $this->session->set_flashdata('message', 'Hibás jelszó');    
    }
}