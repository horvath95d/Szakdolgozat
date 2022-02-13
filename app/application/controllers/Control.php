<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Control extends CI_Controller {
    
    private $data;

    public function __construct() {
        parent::__construct();

        if ($this->ion_auth->logged_in()) {
            
            if (! $this->check_active())
                redirect('inactive', 'refresh');

            $this->load->model('control_model');
            $this->lang->load(['template', 'control']);

            $this->data['title'] = lang('title');
            
        } else {
            redirect('', 'refresh');
        }
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
