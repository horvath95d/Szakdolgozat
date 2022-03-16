<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

    public function getLoginPageData(): array
    {
        $result[0] = $this->db->query("SELECT COUNT(*) FROM `school`")->row_array()['COUNT(*)'];
        $result[1] = $this->db->query("SELECT COUNT(*) FROM `teacher`")->row_array()['COUNT(*)'];
        $result[2] = $this->db->query("SELECT COUNT(*) FROM `lesson` WHERE `year` > 0 OR `year` IS NULL")->row_array()['COUNT(*)'];
        $result[3] = $this->db->query("SELECT SUM(`members`) FROM `class`")->row_array()['SUM(`members`)'];

        return $result;
    }

    public function getLessons($teacherID = '', $classID = '', $roomID = '') {

        if (!empty($classID))
            $year = (int)$this->helper_model->getClassName($classID);

        if (empty($teacherID) && empty($classID) && empty($roomID)) {
            $where = "AND `subject_id` IS NOT NULL";
        
        } elseif (empty($teacherID) && empty($classID) && ! empty($roomID)) {
            $where = "AND `lesson`.`room_id` = ".$roomID;
        
        } elseif (empty($teacherID) && ! empty($classID) && empty($roomID)) {
            $where = "AND (`lesson`.`class_id` = ".$classID." OR `lesson`.`year` = ".$year.")";
        
        } elseif (empty($teacherID) && ! empty($classID) && ! empty($roomID)) {
            $where = "AND (`lesson`.`class_id` = ".$classID." OR `lesson`.`year` = ".$year.")
                AND `lesson`.`room_id` = ".$roomID;

        } elseif ( ! empty($teacherID) && empty($classID) && empty($roomID)) {
            $where = "AND `lesson`.`teacher_id` = ".$teacherID;

        } elseif ( ! empty($teacherID) && empty($classID) && ! empty($roomID)) {
            $where = "AND `lesson`.`teacher_id` = ".$teacherID."
                AND `lesson`.`room_id` = ".$roomID;

        } elseif ( ! empty($teacherID) && ! empty($classID) && empty($roomID)) {
            $where = "AND `lesson`.`teacher_id` = ".$teacherID."
                AND (`lesson`.`class_id` = ".$classID." OR `lesson`.`year` = ".$year.")";

        } elseif ( ! empty($teacherID) && ! empty($classID) && ! empty($roomID)) {
            $where = "AND `lesson`.`teacher_id` = ".$teacherID."
                AND (`lesson`.`class_id` = ".$classID." OR `lesson`.`year` = ".$year.")
                AND `lesson`.`room_id` = ".$roomID;
        }
        //`id`, `fix_room`, `fix_time`, `day`, `time`, `lesson`.`year`,
        $query = $this->db->query("SELECT `lesson`.*,
            `short`, `color`, `subject`.`name` AS 'subject_name',
            `class`.`name` AS 'class_name',
            `teacher`.`name` AS 'teacher_name',
            `room`.`name` AS 'room_name'
            FROM `lesson`
            LEFT JOIN `subject` ON `lesson`.`subject_id` = `subject`.`id`
            LEFT JOIN `class` ON `lesson`.`class_id` = `class`.`id`
            LEFT JOIN `teacher` ON `lesson`.`teacher_id` = `teacher`.`id`
            LEFT JOIN `room` ON `lesson`.`room_id` = `room`.`id`
            WHERE `lesson`.`school_id` = ".$this->school_id."
            ".$where."
            ORDER BY `class_id`, `year`, `subject`.`name`");

        return $query->result_array();
    }

    // Operations
    public function setTime($id, $day, $time, $manual = false) {
        $fixTime = $manual && $day != 0 && $time != 0 ? 1 : 0;

        $this->db->query("UPDATE `lesson` SET `fix_time`=".$fixTime.", `day`=".$day.", `time`=".$time." WHERE `id` = ".$id);
    }

    public function setRoom($id, $roomID, $manual = false) {
        $fixRoom = $manual && $roomID != 'NULL' ? 1 : 0;

        $this->db->query("UPDATE `lesson` SET `room_id` = ".$roomID.", `fix_room` = ".$fixRoom." WHERE `id` = ".$id);
    }

    public function validate(): bool
    {
        
        $teacher = $this->db->query("SELECT `teacher_id` FROM `lesson`
            WHERE `school_id` = ".$this->school_id." AND `day` != 0 AND `time` != 0
            GROUP BY `day`, `time`, `teacher_id`
            HAVING COUNT(*) > 1")->row_array();
        
        if (!empty($teacher)) {
            $this->session->set_flashdata('message', getTeacherName($teacher['teacher_id']).' órarendjében 2 óra van egy időpontra beállítva!');
            return false;
        }

        $class = $this->db->query("SELECT `class_id` FROM `lesson`
            WHERE `school_id` = ".$this->school_id." AND `day` != 0 AND `time` != 0
            AND `class_id` IS NOT NULL
            GROUP BY `day`, `time`, `class_id`
            HAVING COUNT(*) > 1")->row_array();
        
        if (!empty($class)) {
            $this->session->set_flashdata('message', get_class_name($class['class_id']).' órarendjében 2 óra van egy időpontra beállítva!');
            return false;
        }

        $year = $this->db->query("SELECT `year` FROM `lesson`
            WHERE `school_id` = ".$this->school_id." AND `day` != 0 AND `time` != 0
            AND `subject_id` IS NOT NULL AND `year` IS NOT NULL
            GROUP BY `day`, `time`, `year`
            HAVING COUNT(*) > 1")->row_array();
        
        if (!empty($year)) {
            $this->session->set_flashdata('message', $year['special'].'.évfolyam órarendjében 2 óra van egy időpontra beállítva!');
            return false;
        }

        $room = $this->db->query("SELECT `room_id` FROM `lesson`
            WHERE `school_id` = ".$this->school_id." AND `day` != 0 AND `time` != 0
            AND `room_id` IS NOT NULL
            GROUP BY `day`, `time`, `room_id`
            HAVING COUNT(*) > 1")->row_array();
        
        if (!empty($room)) {
            $this->session->set_flashdata('message', get_room_name($room['room_id']).' órarendjében 2 óra van egy időpontra beállítva!');
            return false;
        }

        return true;
    }

    public function getFixedLesson($time, $day, $classID, $year) {
        $query = $this->db->query("SELECT * FROM `lesson`
            WHERE `day` = ".$day." AND `time` = ".$time."
            AND (`class_id` = ".$classID." OR `year` = ".$year.")");
        return  $query->row_array();
    }

    public function selectLesson($time, $day ,$classID, $year) {
        // ha évfolyamra vonatkozó órát választ ki, akkor le kell ellenőrizni h az egész évfolyamnak szabad-e az az időpont

        // SELECT azt az órát, aminek a fontossága a legnagyobb
        // nincs még időpontja
        // szabad a tanárja
        // szabad a terme, ha van beállítva
        // ha kevesebb v egyenlő az óraszám mint a napok száma, akkor az nap még nem volt ilyen óra

        // Válasszuk ki az az órát
        $query = $this->db->query("SELECT * FROM `lesson`
            WHERE `school_id`=".$this->school_id."
            AND (`class_id`=".$classID." OR `year`=".$year.") AND `day` = 0 AND `time` = 0
            AND `teacher_id` NOT IN (SELECT `teacher_id` FROM `lesson` WHERE `school_id`=".$this->school_id." AND `day`=".$day." AND `time`=".$time.")
            AND `room_id` NOT IN (SELECT `room_id` FROM `lesson` WHERE `school_id`=".$this->school_id." AND `day`=".$day." AND `time`=".$time.")
            AND `subject_id` NOT IN (SELECT `subject_id` FROM `lesson` WHERE `school_id`=".$this->school_id." AND (`class_id`=".$classID." OR `year`=".$year.") AND `day`=".$day.")");
        $lessons = $query->result_array();

        if (!empty($lessons))
            return $lessons[rand(0,count($lessons)-1)];
    }

    public function selectRoom($subjectID, $day, $time) {
        // ha csak egy terem van megadva, az legyen
        // ha az foglalt és más teremben is tartható az óra, keressen mást
        // má keresésékor elsőnek ellenőrizze le, h lehetséges-e az osztályteremben tartani
        // amennyiben nem, azok közül válasszon ahol nincs megadva tantárgy
        // ha ilyen sincs a maradékból válasszon
        // olyan osztány ne kerüljön olyan terembe ahol a látszám nagyobb mint a teremben a férőhelyek
        $query = $this->db->query("SELECT `room_id` FROM `room_subject`
            WHERE `subject_id`=".$subjectID."
            GROUP BY `subject_id` HAVING COUNT(*) = 1");
        return $query->row_array()['room_id'];


    }

    public function getPlace($lesson): array
    {
        // keressünk helyet a kimaradt órának, lehetőleg úgy, h másikan nem kell kivenni a helyéről
        // keresem azt az időpontot ahol az osztály és a tarnár is szabad
        //$query = $this->db->query("SELECT");

        // ha nem létezik ilyen, keresem azt az időpontot ahol a tanár szabad

        // beteszem ezt az órát oda, az előző órát kiveszem



        // vegyük ki az összes órát ami ennek az osztálynak van, hol van lyuk az órarendjében?
        //$query = $this->db->query("SELECT `day`, `time` FROM");

        return [5, 7];
    }

    public function getPossibleLessons($time, $day ,$classID, $year) {
        $query = $this->db->query("SELECT * FROM `lesson`
            WHERE `school_id`=".$this->school_id."
            AND (`class_id`=".$classID." OR `year`=".$year.") AND `day` = 0 AND `time` = 0
            AND `teacher_id` NOT IN (SELECT `teacher_id` FROM `lesson` WHERE `school_id`=".$this->school_id." AND `day`=".$day." AND `time`=".$time.")
            AND `room_id` NOT IN (SELECT `room_id` FROM `lesson` WHERE `school_id`=".$this->school_id." AND `day`=".$day." AND `time`=".$time.")
            AND `subject_id` NOT IN (SELECT `subject_id` FROM `lesson` WHERE `school_id`=".$this->school_id." AND (`class_id`=".$classID." OR `year`=".$year.") AND `day`=".$day.")");
        return $query->result_array();
    }
    
    public function getTimelessLessons() {
        $query = $this->db->get_where('lesson', ['day' => 0, 'time' => 0]);
        return $query->result_array();
    }
    
    public function fixRoomsRemove() {
        $this->db->where(['school_id' => $this->school_id, 'fix_room' => 1]);
        $this->db->update('lesson', ['room_id' => NULL, 'fix_room' => 0]);
    }

    public function fixTimeRemove() {
        $this->db->where(['school_id' => $this->school_id, 'fix_time' => 1]);
        $this->db->update('lesson', ['day' => 0, 'time' => 0]);
    }

    public function emptying() {
        $this->db->where(['school_id' => $this->school_id, 'fix_room' => 0]);
        $this->db->update('lesson', ['room_id' => NULL]);

        $this->db->where(['school_id' => $this->school_id, 'fix_time' => 0]);
        $this->db->update('lesson', ['day' => 0, 'time' => 0]);
    }
}
