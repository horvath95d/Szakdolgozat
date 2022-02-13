<?php defined('BASEPATH') OR exit('No direct script access allowed');

class School extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if ($this->ion_auth->logged_in()) {
            
            if (! $this->check_active())
                redirect('inactive', 'refresh');

            $this->load->model('school_model');
            $this->lang->load(['template', 'school']);

        } else
            redirect('', 'refresh');
    }

    public function subject() {

        if (empty($_POST)) {
            $data['title'] = lang('link_subject');
            $data['subjects'] = $this->school_model->getSubjects();
            $this->render_page('school/subject', $data);

        } else {
            $this->school_model->saveSubjects();
            redirect('school/subject');
        }
    }

    public function teacher() {

        if (empty($_POST)) {
            $data['title'] = lang('link_teacher');
            $data['teachers'] = $this->school_model->getTeachers();
            $data['subjects'] = $this->school_model->getSubjects();
            $data['teachers_subjects'] = $this->school_model->getTeachersSubjects();
            $this->render_page('school/teacher', $data);

        } else {
            $this->school_model->saveTeachers();
            redirect('school/teacher');
        }
    }

    public function class() {

        if (empty($_POST)) {
            $data['title'] = lang('link_class');
            $data['classes'] = $this->school_model->getClasses();
            $data['teachers'] = $this->school_model->getTeachers();
            $data['rooms'] = $this->school_model->getRooms(); 
            $this->render_page('school/class', $data);

        } else {
            $this->school_model->saveClasses();
            redirect('school/class');
        }
    }

    public function room() {
        
        if (empty($_POST)) {
            $data['title'] = lang('link_room');
            $data['rooms'] = $this->school_model->getRooms();
            $data['subjects'] = $this->school_model->getSubjects();
            $data['rooms_subjects'] = $this->school_model->getRoomsSubjects();
            $this->render_page('school/room', $data);

        } else {
            $this->school_model->saveRooms();
            redirect('school/room');
        }
    }

    public function delete($table = NULL, $id = NULL) {

        if ($table == NULL || $id == NULL)
           show_404();

        $record = $this->school_model->get_record($table, array('id' => $id));
        
        if (empty($record) || $record['school_id'] != $this->school['id'])
            show_404();

        switch ($table) {
            case 'subject':
                $this->school_model->deleteSubject($id);
                redirect('school/subject');
                break;

            case 'teacher':
                $this->school_model->deleteTeacher($id);
                redirect('school/teacher');
                break;
            
            case 'class':
                $this->school_model->deleteClass($id);
                redirect('school/class');
                break;
        
            case 'room':
                $this->school_model->deleteRoom($id);
                redirect('school/room');
                break;
                
            case 'time':
                $this->school_model->deleteTime($id);
                redirect('settings/time');
                break;
        }
    }

    public function json() {
        $data['subjects'] = $this->school_model->getSubjects();
        $data['teachers'] = $this->school_model->getTeachers();
        $data['rooms'] = $this->school_model->getRooms();
        echo json_encode($data);
    }
}