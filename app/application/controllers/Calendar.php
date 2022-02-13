<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if ($this->ion_auth->logged_in()) {
            
            if (! $this->check_active())
                redirect('inactive', 'refresh');

            $this->load->model('calendar_model');
            $this->lang->load('calendar');
            //$this->load->library('pdf');
            
        } else
            redirect('', 'refresh');
    }

    public function index() {

        if (empty($_POST)) {
            $data['title'] = lang('link_calendar');
            $data['events'] = $this->calendar_model->getEvents();
            $this->render_page('calendar/index', $data);

        } else {
            $this->calendar_model->saveEvents();
            redirect('calendar');
        }
    }

    // send data to javascript
    public function json() {
        $data['events'] = $this->calendar_model->getEvents();
        echo json_encode($data);
    }

    public function pdf() {
        $events = $this->calendar_model->getEvents();
        $pdf_title = $this->school['short_name'].' '.$this->school['year'];

        $pdf_content = '
        <title>'.$pdf_title.'</title>
        
        <h1 style="text-align: center">'.$pdf_title.'</h1>
        <table style="width:100%">';

        foreach ($events as $event) {
            $end = !empty($event['end']) ? ' - '.$event['end'] : '';
            $pdf_content .= '
            <tr>
                <td style="width:33%">'.$event['start'].$end.'</td>
                <td>'.$event['name'].'</td>
            </tr>';
        }

        $pdf_content .= '</table>';    

		$this->pdf->loadHtml($pdf_content);
		$this->pdf->render();
		$this->pdf->stream($pdf_title.'.pdf', array('Attachment' => 0));
    }

    public function delete($id) {
        $this->calendar_model->deleteEvent($id);
        redirect('calendar'); 
    }
}
