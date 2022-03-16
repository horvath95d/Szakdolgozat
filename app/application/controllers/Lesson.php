<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lesson extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if ($this->ion_auth->logged_in()) {
            if (! $this->check_active()) {
                redirect('inactive', 'refresh');
            }
            $this->load->model(['lesson_model', 'school_model']);
            $this->lang->load(['template', 'school']);
        } else {
            redirect('', 'refresh');
        }
    }

    public function no() {
        if (empty($_POST)) {
            $data['title'] = lang('link_no');
            $data['teachers'] = $this->school_model->getTeachers();
            $data['years'] = $this->lesson_model->getYears();
            $data['classes'] = $this->school_model->getClasses();
            $data['lessons'] = $this->lesson_model->getNoLessons();
            $this->render_page('lesson/no', $data);
        } else {
            $this->lesson_model->saveLessons();
            redirect('lesson/no');
        }
    }

    public function year($n = 0) {
        if (empty($_POST)) {
            $data['subjects'] = $this->school_model->getSubjects();
            $data['teachers_subjects'] = $this->school_model->getTeachersSubjects();
            $data['teachers'] = $this->school_model->getTeachers();
            $data['years'] = $this->lesson_model->getYears();
            $data['classes'] = $this->school_model->getClasses();
                    
            if (!in_array($n, array_column($data['years'], 'year'))) {
                redirect('home/error'); //show_404();
            } else {
                $data['id'] = $n;
                $data['title'] = $n.'. évfolyam';
                $data['lessons'] = $this->lesson_model->getLessonsByYear($n);
                $this->render_page('lesson/year', $data);
            }
        } else {
            $this->lesson_model->saveLessons();
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }

    public function class($id = 0) {
        if (empty($_POST)) {
            $data['subjects'] = $this->school_model->getSubjects();
            $data['teachers_subjects'] = $this->school_model->getTeachersSubjects();
            $data['teachers'] = $this->school_model->getTeachers();
            $data['years'] = $this->lesson_model->getYears();
            $data['classes'] = $this->school_model->getClasses();
                    
            if (!in_array($id, array_column($data['classes'], 'id'))) {
                redirect('home/error'); //show_404();
            } else {
                $data['id'] = $id;
                $data['title'] = getClassName($id);
                $data['lessons'] = $this->lesson_model->getLessonsByClass($id);
                $this->render_page('lesson/class', $data);
            }
        } else {
            $this->lesson_model->saveLessons();
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }

    public function delete($id = NULL) {
        if ($id == NULL) {
            show_404();
        }
        $record = $this->lesson_model->get_record('lesson', array('id' => $id));

        if (empty($record) || $record['school_id'] != $this->school['id']) {
            show_404();
        }
        $this->lesson_model->deleteLessons($id);
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    // send data to javascript
    public function json() {
        $data['years'] = $this->lesson_model->getYears();
        $data['classes'] = $this->school_model->getClasses();

        $data['subjects'] = $this->school_model->getSubjects();
        $data['teachers_subjects'] = $this->school_model->getTeachersSubjects();
        $data['teachers'] = $this->school_model->getTeachers();
        echo json_encode($data);
    }
}