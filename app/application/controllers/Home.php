<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->lang->load(['template', 'auth', 'home']);
        
		if ($this->ion_auth->logged_in()) {

            $this->load->model(['home_model', 'school_model']);
            //$this->load->library('pdf');
        }
    }
    
    public function index() {

        if ($this->ion_auth->logged_in()) {
            $teacherID = empty($_GET['teacher']) ? '' : $_GET['teacher'];
            $classID = empty($_GET['class']) ? '' : $_GET['class'];
            $roomID = empty($_GET['room']) ? '' : $_GET['room'];

            $data['title'] = 'Órarend';
            $data['teachers'] = $this->school_model->getTeachers();
            $data['classes'] = $this->school_model->getClasses();
            $data['rooms'] = $this->school_model->getRooms();
            $data['times'] = $this->school_model->getTimes();
            $data['lessons'] = $this->home_model->getLessons($teacherID, $classID, $roomID);
            
            $this->render_page('home/index', $data);
        
        } else {
            $this->load->model('home_model');
            $data['number'] = $this->home_model->getLoginPageData();
            $this->load->view('auth/login', $data);
            $this->load->view('template/footer');
        }
    }

    public function inactive() {

        if ($this->ion_auth->logged_in()) {
            $data['title'] = 'Inactive';
            $this->render_page('errors/inactive', $data);
        } else
            redirect('');
    }

    public function error() {

        if ($this->ion_auth->logged_in()) {
            $data['title'] = 'Hiba történt';
            $data['user'] = $this->ion_auth->user()->row();
    
            $this->render_page('errors/error', $data);
        } else {
            $data['title'] = 'Hiba történt';
            $this->load->view('template/header', $data);
            $this->load->view('errors/error');
        }
    }

    public function lang($lang) {
        $_SESSION['lang'] = $lang;
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    public function json() {
        $data['rooms'] = $this->school_model->getRooms();
        echo json_encode($data);
    }

    // Operations

    public function setTime() {
        $this->home_model->setTime($_POST['id'], $_POST['day'], $_POST['time'], true);
    }
   
    public function setRoom() {
        $this->home_model->setRoom($_POST['id'], $_POST['room_id'], true);
    }

    public $classes;
    public $countTimes;

    public function generate() {
        // TODO: megcsinálni
        //$this->classes = $this->school_model->getClasses();
        //$this->countTimes = count($this->school_model->getTimes());
        //$this->backTrack(1,1,0);

        if ($this->home_model->validate()) {
            $countTimes = count($this->school_model->getTimes())+1;
            $classes = $this->school_model->getClasses();
            
            for ($t=1; $t < $countTimes; $t++) { // óra ciklus
                for ($d=1; $d < $this->school['days']+1; $d++) { // nap ciklus
                    foreach ($classes as $class) { // osztály ciklus
                        $fixedLesson = $this->home_model->getFixedLesson($t, $d, $class['id'], $class['year']);

                        if (empty($fixedLesson)) { // ha nincs beállítva óra arra az időpontra
                            $lesson = $this->home_model->selectLesson($t, $d, $class['id'], $class['year']); // kiválasztunk egy órát
                            
                            if ($lesson) { // ha létezik kiválasztott óra
                                $this->home_model->setTime($lesson['id'], $d, $t); //beállítjuk az idejét
    
                                if ($lesson['room_id'] == NULL) { // ha nincs ennek az órának terme
                                    $roomID = $this->home_model->selectRoom($lesson['subject_id'], $d, $t); // keresünk neki egy termet a tantárgy függvényében
                                    $this->home_model->setRoom($lesson['id'], $roomID); // beállítjuk ezt a termet
                                }
                            }
                        }
                    }
                }
            }

            /*
            $timelessLessons = $this->home_model->getTimelessLessons(); // meg keressük az első körben kimaradt órákat

            while (!empty($timelessLessons)) {

                foreach ($timelessLessons as $lesson) {
                    $place = $this->home_model->getPlace($lesson);
                    $this->home_model->setTime($lesson['id'], $place[0], $place[1]);
                    // tegyük be valahova az órarendbe
                    // módosítsuk azokat az órákat amikkel ütközik
                    // állítsuk be a termet ha kell
                    // az ütköző óráknak állítsuk át a termét ha lehet és ha kell
                }
                $timelessLessons = $this->home_model->getTimelessLessons();
            }

            $this->session->set_flashdata('message', '');
            */
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function probal() {
        
    }

    public $OK = false;

    public function backTrack($time, $day, $classIndex) {
        // echo $time.' '.$day.' '.$classIndex;
        // echo ' '.$this->classes[$classIndex]['name'];
        // echo "<br>";


        if ($classIndex < 27 || $day < 5 || $time < 7) {
        //if (!empty($this->home_model->getTimelessLessons())) {

            $fixedLesson = $this->home_model->getFixedLesson($time, $day, $this->classes[$classIndex]['id'], $this->classes[$classIndex]['year']);

            if (empty($fixedLesson)) {
                $possibleLessons = $this->home_model->getPossibleLessons($time, $day, $this->classes[$classIndex]['id'], $this->classes[$classIndex]['year']);
                
                if (!empty($possibleLessons)) {
                    $testedOptions = array();

                    while (!$this->OK && count($testedOptions) < count($possibleLessons)) {                    
                        $option = rand(0, count($possibleLessons)-1);

                        if (!in_array($option, $testedOptions)) {
                            array_push($testedOptions, $option);

                            $this->home_model->setTime($possibleLessons[$option]['id'], $day, $time);
                            // echo "berak: ".$possibleLessons[$option]['id'];
                            // echo "<br>";

                            if ($classIndex++ < count($this->classes)-1)
                                $this->backTrack($time, $day, $classIndex++);
                            elseif ($day++ < $this->school['days'])
                                $this->backTrack($time, $day++, 0);
                            elseif ($time++ < $this->countTimes)
                                $this->backTrack($time++, 1, 0);

                            if (!$this->OK) {
                                $this->home_model->setTime($possibleLessons[$option]['id'], 0, 0);
                                // echo "ki vesz: ".$possibleLessons[$option]['id'];
                                // echo "<br>";
                            }
                        }
                    }
                }
            }
            
            if (!$this->OK) {
                // léptetem
                if ($classIndex++ < count($this->classes)-1)
                    $this->backTrack($time, $day, $classIndex++);
                elseif ($day++ < $this->school['days'])
                    $this->backTrack($time, $day++, 0);
                elseif ($time++ < $this->countTimes)
                    $this->backTrack($time++, 1, 0);
            }
        } else
            $this->OK = true;
    }
    
    public function fixRoomsRemove() {
        $this->home_model->fixRoomsRemove();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function fixTimeRemove() {
        $this->home_model->fixTimeRemove();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function emptying() {
        $this->home_model->emptying();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function pdf() {
        $title = $this->school['short_name'];
        $title .= empty($_GET['teacher']) ? '' : ' - '.getTeacherName($_GET['teacher']);
        $title .= empty($_GET['class']) ? '' : ' - '.getClassName($_GET['class']);
        $title .= empty($_GET['room']) ? '' : ' - '.getRoomName($_GET['room']);
    }
}