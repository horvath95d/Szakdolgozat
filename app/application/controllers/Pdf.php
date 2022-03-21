<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('Ci_dompdf');
        $this->load->model(['home_model', 'school_model', 'calendar_model']);
    }

    public function index() {

        $title = $this->school['short_name'];
        $title .= empty($_GET['teacher']) ? '' : ' - '.getTeacherName($_GET['teacher']);
        $title .= empty($_GET['class']) ? '' : ' - '.getClassName($_GET['class']);
        $title .= empty($_GET['room']) ? '' : ' - '.getRoomName($_GET['room']);

        $content =
        '<title>'.$title.'</title>
        <style>
        table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            border-radius: 5px;
            page-break-after: always;
            text-align: center;
        }
        table, th, td {border: 1px solid rgba(0, 0, 0, .125)}
        th:first-child {width: 10%}
        </style>
        ';

        if (empty($_GET['teacher']) && empty($_GET['class']) && empty($_GET['room'])) {
            $teachers = $this->school_model->getTeachers();
            $classes = $this->school_model->getClasses();
            $rooms = $this->school_model->getRooms();

            foreach($teachers as $teacher) {
                $lessons = $this->home_model->getLessons($teacher['id'], '', '');
                $content .= $this->createTablePDF($teacher['name'], $lessons);
            }

            foreach($classes as $class) {
                $lessons = $this->home_model->getLessons('', $class['id'], '');
                $content .= $this->createTablePDF($class['name'], $lessons);
            }

            foreach($rooms as $room) {
                $lessons = $this->home_model->getLessons('', '', $room['id']);
                $content .= $this->createTablePDF($room['name'], $lessons);
            }

        } else {
            $teacher = empty($_GET['teacher']) ? '' : $_GET['teacher'];
            $class = empty($_GET['class']) ? '' : $_GET['class'];
            $room = empty($_GET['room']) ? '' : $_GET['room'];

            $lessons = $this->home_model->getLessons($teacher, $class, $room);
            $content .= $this->createTablePDF($title, $lessons);
        }

        $this->ci_dompdf->loadHtml($content);
        $this->ci_dompdf->setPaper('a4', 'landscape');
        $this->ci_dompdf->render();
        $this->ci_dompdf->stream($title.'.pdf', array('Attachment'=>0));
    }

    private function createTablePDF($title, $lessons): string
    {
        $times = $this->school_model->getTimes();

        $content = '
        <h3>'.$this->school['short_name'].' - '.$title.'</h3>
        <table class="timetable">
            <tr>
                <th></th>
                <th>'.lang('monday').'</th>
                <th>'.lang('tuesday').'</th>
                <th>'.lang('wednesday').'</th>
                <th>'.lang('thursday').'</th>
                <th>'.lang('friday').'</th>
            </tr>';

        for ($i=0; $i < count($times); $i++) {

            $content .=
                '<tr>
                <th>'.$times[$i]['start'].' - '.$times[$i]['end'].'</th>';

            for ($d=1; $d<$this->school['days']+1; $d++) {
                $content .= '<td>';

                foreach ($lessons as $lesson) {

                    if ($lesson['time'] == $i+1 && $lesson['day'] == $d) {
                        if ($lesson['subject_id'] == NULL) { // no lesson
                            $content .= '<div>Lyukas óra</div>';

                        } else {
                            if (!empty($lesson['merge']))
                                $lesson = get_lesson($lesson['merge']);

                            $class = empty($lesson['class_name']) ? $lesson['year'].'. évfolyam' : $lesson['class_name'];
                            $room = empty($lesson['room_name']) ? 'Hiányzó terem' : $lesson['room_name'];

                            $content .= '<div>'.$lesson['subject_name'].'</div>';

                            if ($title != $class)
                                $content .= '<div>'.$class.'</div>';

                            if ($title != $lesson['teacher_name'])
                                $content .= '<div>'.$lesson['teacher_name'].'</div>';

                            if ($title != $room)
                                $content .= '<div>'.$room.'</div>';
                        }
                    }
                }
                $content .= '</td>';
            }
            $content .= '</tr>';
        }
        $content .= '</table>';

        return $content;
    }

    public function calendar() {
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

        $this->ci_dompdf->loadHtml($pdf_content);
        $this->ci_dompdf->render();
        $this->ci_dompdf->stream($pdf_title.'.pdf', array('Attachment' => 0));
    }
}