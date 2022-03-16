<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

        if ($this->ion_auth->logged_in()) {
            $this->load->model('settings_model');
            $this->lang->load(['template', 'settings']);
            $this->data['title'] = lang('title');
        } else  {
            redirect('');
        }
    }

    public function index() {
        if (empty($_POST)) {
            $this->render_page('settings/index', $this->data);
        } else {
            $this->settings_model->updateIndex();
            redirect('settings');
        }
    }

    public function security() {
        if (empty($_POST)) {
            $this->render_page('settings/security', $this->data);
        } else {
            if ($_POST['new-password'] == $_POST['confirm-password']) {
                $identity = $this->session->userdata('identity');
                $change = $this->ion_auth->change_password($identity, $_POST['current-password'], $_POST['new-password']);

                if ($change) {
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                } else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                }
            } else {
                $this->session->set_flashdata('message', 'Nem egyezik a két új jelszó');
            }
            redirect('settings/security');
        }
    }
    
    public function active() {
        if (empty($_POST)) {
            $this->render_page('settings/active', $this->data);
        } else {
            //TODO: payment system
            $this->settings_model->updateActive();
            redirect('settings/active');            
        }
    }
    
    public function school() {
        if (empty($_POST)) {
            $this->data['users'] = $this->settings_model->getSchoolUsers($this->user->school_id);
            $this->render_page('settings/school', $this->data);
        } else {
            $this->settings_model->updateSchool();
            redirect('settings/school');
        }
    }

    public function time() {
        $this->load->model('school_model');

        if (empty($_POST)) {
            $data['title'] = lang('link_time');
            $data['times'] = $this->school_model->getTimes();
            $this->render_page('settings/time', $data);

        } else {
            $this->school_model->getTimes();
            redirect('settings/time');
        }
    }
}
