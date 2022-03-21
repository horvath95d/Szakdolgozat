<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Help extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->lang->load(['template', 'help'], $this->session->userdata('language'));
    }

    public function index($cat = '', $page = '') {

        if (empty($cat) && empty($page))
            $this->_render_page('help/index');
            
        else
            $this->_render_page('help/'.$cat.'/'.$page);
    }

    public function about() {
        $this->_render_page('help/about');
    }

    public function news() {
        $this->_render_page('help/news');
    }

    public function contact() {
        $this->_render_page('help/contact');
    }

    public function email() {
        $header = $_POST['email']." / ".$_POST['name'];
        mail('horvath95d@gmail.com', $_POST['subject'], $_POST['message'], $header);
        // visszajelzés, hogy üzenet elküldve
        redirect('help/contact');
    }

    private function _render_page($page) {
        $this->load->view('help/header');
        $this->load->view($page);
        $this->load->view('help/footer');
    }
}