<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Control extends CI_Controller {
    
    private $data;

    public function __construct() {
        parent::__construct();

        $this->checkLoggedIn();
        $this->checkActiveAccount();

        $this->load->model('control_model');
        $this->lang->load(['template', 'control'], $this->session->userdata('language'));
        $this->data['title'] = lang('title');
    }

    public function school() {
        $this->render_page('control/school', $this->data);
    }

    public function lesson() {
        $this->render_page('control/lesson', $this->data);
    }

    public function timetable() {
        $this->render_page('control/timetable', $this->data);
    }
}
