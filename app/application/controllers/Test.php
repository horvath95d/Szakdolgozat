<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('unit_test');
        $this->unit->set_test_items(array('test_name', 'result', 'line'));

        $str = '<p>{rows} {result} {/rows}</p>';

        $this->unit->set_template($str);
    }

    public function __destruct()
    {
        echo "<style>body{background: #111; color: #EEE}p{font-size: 32px}</style>";
        echo "<p>Name -  Result - Line</p>";
        echo $this->unit->report();
    }

    public function index() {
        $this->load->model(['home_model']);

        $loginPageData = $this->home_model->getLoginPageData();

        $this->unit->run(count($loginPageData), 4, '4 number on longin page');


    }
}