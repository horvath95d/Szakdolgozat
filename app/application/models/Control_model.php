<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Control_model extends CI_Model {

    // ---------------
    // Subject
    // ---------------

    public function subjectUniqueName(): array
    {
        $result = array();
        $query = $this->db->query("SELECT `name` FROM `subject`
            WHERE `school_id`=".$this->school_id."
            GROUP BY `name` HAVING COUNT(*) > 1")->result_array();
        
        if (!empty($query))
            foreach ($query as $record)
                array_push($result, array('edit/subject', $record['name']));
        
        return $result;
    }

    public function subjectHaveTeacher(): array
    {
        $result = array();
        $query = $this->db->query("SELECT `name` FROM `subject` 
            WHERE `school_id`=".$this->school_id." AND `id` NOT IN
            (SELECT `subject_id` FROM `teacher_subject`)")->result_array();

        if (!empty($query))
            foreach ($query as $record)
                array_push($result, array('edit/subject', $record['name']));
        
        return $result;

    }

    public function subjectHaveLesson(): array
    {
        $result = array();
        $query = $this->db->query("SELECT `name` FROM `subject`
            WHERE `id` NOT IN (SELECT `subject_id` FROM `lesson` WHERE `subject_id` IS NOT NULL)
            AND `school_id`=".$this->school_id)->result_array();

        if (!empty($query))
            foreach ($query as $record)
                array_push($result, array('lesson/fakt', $record['name']));
        
        return $result;
    }

    // ---------------
    // Teacher
    // ---------------

    public function teacherUniqueName(): array
    {
        $result = array();
        $query = $this->db->query("SELECT `name` FROM `teacher`
            WHERE `school_id`=".$this->school_id."
            GROUP BY `name` HAVING COUNT(*) > 1")->result_array();
        
        if (!empty($query))
            foreach ($query as $record)
                array_push($result, array('edit/teacher', $record['name']));
        
        return $result;
    }

    public function teacherHaveSubject(): array
    {
        $result = array();
        $query = $this->db->query("SELECT `name` FROM `teacher` 
            WHERE `school_id`=".$this->school_id." AND `id` NOT IN
            (SELECT `teacher_id` FROM `teacher_subject`)")->result_array();

        if (!empty($query))
            foreach ($query as $record)
                array_push($result, array('edit/teacher', $record['name']));
        
        return $result;
    }

    public function teacherHaveLesson(): array
    {
        $result = array();
        $query = $this->db->query("SELECT `id`, `name` FROM `teacher`
            WHERE `school_id`=".$this->school_id." AND `id` NOT IN
            (SELECT `teacher_id` FROM `lesson` WHERE `subject_id` IS NOT NULL)")->result_array();

        if (!empty($query))
            foreach ($query as $record)
                array_push($result, array('?teacher='.$record['id'].'&class=&room=', $record['name']));
        
        return $result;
    }

    public function teacherMaxLesson(): array
    {
        $result = array();
        $query = $this->db->query("SELECT `id`, `name` FROM `teacher` 
            WHERE `school_id`=".$this->school_id." AND `lesson_number` <
            (SELECT COUNT(*) FROM `lesson` WHERE `subject_id` IS NOT NULL AND `teacher_id` = `teacher`.`id`)")->result_array();

        if (!empty($query))
            foreach ($query as $record)
                array_push($result, array('?teacher='.$record['id'].'&class=&room=', $record['name']));
        
        return $result;
    }

    // ---------------
    // Room
    // ---------------

    public function roomUniqueName(): array
    {
        $result = array();
        $query = $this->db->query("SELECT `name` FROM `room`
            WHERE `school_id`=".$this->school_id."
            GROUP BY `name` HAVING COUNT(`name`) > 1")->result_array();
        
        if (!empty($query))
            foreach ($query as $record)
                array_push($result, array('edit/room', $record['name']));
        
        return $result;
    }

    public function roomHaveLesson(): array
    {
        $result = array();
        $query = $this->db->query("SELECT `id`, `name` FROM `room` 
            WHERE `id` NOT IN (SELECT `room_id` FROM `lesson` WHERE `room_id` IS NOT NULL)
            AND `school_id`=".$this->school_id)->result_array();

        if (!empty($query))
            foreach ($query as $record)
                array_push($result, array('?teacher=&class=&room='.$record['id'], $record['name']));
        
        return $result;
    }

    // ---------------
    // Class
    // ---------------

    public function classUniqueName(): array
    {
        $result = array();
        $query = $this->db->query("SELECT `name` FROM `class`
            WHERE `school_id`=".$this->school_id."
            GROUP BY `name` HAVING COUNT(`name`) > 1")->result_array();
        
        if (!empty($query))
            foreach ($query as $record)
                array_push($result, array('edit/class', $record['name']));
        
        return $result;
    }

    public function classMissingData(): array
    {
        $result = array();
        $query = $this->db->query("SELECT `name` FROM `class`
            WHERE `school_id`=".$this->school_id." AND `teacher_id` IS NULL OR `room_id` IS NULL")->result_array();

        if (!empty($query))
            foreach ($query as $record)
                array_push($result, array('/edit/class', $record['name']));
        
        return $result;
    }

    // ---------------
    // Lesson
    // ---------------
    
    public function classHaveLesson(): array
    {
        $result = array();
        $query = $this->db->query("SELECT `id`, `name` FROM `class`
            WHERE `id` NOT IN
            (SELECT `class`.`id`
            FROM `class` JOIN `lesson` ON `class`.`id`=`class_id` OR `lesson`.`year` = `class`.`year`
            GROUP BY `name`)")->result_array(); //nem vagyok benne biztos, h ez helyesen működik

        //SELECT `id`,`name` FROM `class` WHERE `id` NOT IN (SELECT `class_id` FROM `lesson` WHERE `class_id` IS NOT NULL AND `school_id` = 1);
    
        if (!empty($query))
            foreach ($query as $record)
                array_push($result, array('lesson/'.$record['id'], $record['name']));
        
        return $result;
    }

    public function lessonHaveTeacher(): array
    {
        $result = array();
        $query = $this->db->query("SELECT `subject_id`, `class_id` FROM `lesson`
            WHERE `school_id`=".$this->school_id." AND `teacher_id` IS NULL
            GROUP BY `class_id`")->result_array();

        if (!empty($query))
            foreach ($query as $record)
                array_push($result, array('lesson/'.$record['class_id'], getSubjectName($record['subject_id'])));
        
        return $result;
    }

    public function lessonTeacherSubject(): array
    {
        $result = array();
        $query1 = $this->db->query("SELECT `subject_id`, `teacher_id` FROM `lesson`
            WHERE `school_id`=".$this->school_id." AND `subject_id` IS NOT NULL
            GROUP BY `subject_id`, `teacher_id`")->result_array();

        $query2 = $this->db->query("SELECT `subject_id`, `teacher_id` FROM `teacher_subject`
            WHERE `school_id`=".$this->school_id)->result_array();

        if (!empty($query1) && !empty($query2)) {
            $query = array_diff($query1[0],$query2[0]);
        }

        if (isset($query)) {
            foreach ($query as $record) {
                //array_push($result, array('?teacher='.$record['teacher_id'].'&class=&room=',  getTeacherName($record['teacher_id']).' - '.getSubjectName($record['subject_id'])));
            }
        }

        return $result;
    }

    // ---------------
    // Timetable
    // ---------------

    public function noLessonHaveTime(): array
    {
        $result = array();
        $query = $this->db->query("SELECT `teacher_id` FROM `lesson` 
            WHERE `school_id`=".$this->school_id." AND `subject_id` IS NULL
            AND `day` = 0 AND `time` = 0
            GROUP BY `teacher_id`")->result_array();

        if (!empty($query))
            foreach ($query as $record)
                array_push($result, array('?teacher='.$record['teacher_id'].'&class=&room=', getTeacherName($record['teacher_id'])));
        
        return $result;
    }

    public function lessonHaveTime(): array
    {
        $result = array();
        $query = $this->db->query("SELECT `subject_id`, `class_id`, `year` FROM `lesson`
            WHERE `school_id`=".$this->school_id." AND
            (`class_id` IS NOT NULL OR `year` IS NOT NULL)
            AND `day` = 0 AND `time` = 0
            GROUP BY `subject_id`")->result_array();

        if (!empty($query))
            foreach ($query as $record)
                array_push($result, array('?teacher=&class='.$record['class_id'].'&room=', getSubjectName($record['subject_id'])));

        return $result;
    }

    public function lessonHaveRoom(): array
    {
        $result = array();
        $query = $this->db->query("SELECT `subject_id`, `class_id` FROM `lesson`
            WHERE `school_id`=".$this->school_id." AND `subject_id` IS NOT NULL AND `room_id` IS NULL
            GROUP BY `class_id`")->result_array();

        if (!empty($query))
            foreach ($query as $record)
                array_push($result, array('?teacher=&class='.$record['class_id'].'&room=', getSubjectName($record['subject_id'])));
        
        return $result;
    }
    
    public function lessonMember(): array
    {
        $result = array();
        $query = $this->db->query("SELECT `subject_id`, `class_id` FROM `lesson`
            WHERE (SELECT `members` FROM `class` WHERE `id`=`class_id`) > 
            (SELECT `members` FROM `room` WHERE `id`=`room_id`)
            GROUP BY `subject_id`")->result_array();

        if (!empty($query))
            foreach ($query as $record)
                array_push($result, array('?teacher=&class='.$record['class_id'].'&room=', getSubjectName($record['subject_id'])));
        
        return $result;
    }

    public function teacherOneLesson(): array
    {
        $result = array();
        $query = $this->db->query("SELECT `teacher_id`, `subject_id` FROM `lesson`
            WHERE `school_id` = ".$this->school_id." AND `day` > 0 AND `time` > 0
            GROUP BY `teacher_id`, `day`, `time`
            HAVING COUNT(*) > 1")->result_array();

        if (!empty($query))
            foreach ($query as $record)
                array_push($result, array('?teacher='.$record['teacher_id'].'&class=&room=', getSubjectName($record['subject_id'])));
        
        return $result;
    }
    
    public function classOneLesson(): array
    {
        $result = array();
        $query = $this->db->query("SELECT `class_id`, `subject_id`, `year` FROM `lesson`
            WHERE `school_id`=".$this->school_id." AND `subject_id` IS NOT NULL
            AND `day` > 0 AND `time` > 0
            GROUP BY `class_id`, `day`, `time`, `year`
            HAVING COUNT(*) > 1")->result_array();

        if (!empty($query))
            foreach ($query as $record)
                if (!empty($record['class_id'])) {
                    array_push($result, array('?teacher=&class='.$record['class_id'].'&room=', getSubjectName($record['subject_id'])));
                }
                else {
                    $id = $this->db->query("SELECT `id` FROM `class`WHERE `year` = ".$record['year'])->result_array()[0]['id'];
                    array_push($result, array('?teacher=&class='.$id.'&room=', getSubjectName($record['subject_id'])));
                }
        return $result;
    }

    public function roomOneLesson(): array
    {
        $result = array();
        $query = $this->db->query("SELECT `room_id`, `subject_id` FROM `lesson`
            WHERE `school_id`=".$this->school_id." AND `subject_id` IS NOT NULL AND `day` > 0 AND `time` > 0
            GROUP BY `room_id`, `day`, `time`
            HAVING COUNT(*) > 1")->result_array();

        if (!empty($query))
            foreach ($query as $record)
                array_push($result, array('?teacher=&class=&room='.$record['room_id'], getSubjectName($record['subject_id'])));
        
        return $result;
    }
    
    public function classMissingLesson(): array
    {
        $result = array();
        /*
        $query = $this->db->query("SELECT `class_id`, `yearr`, `day`  FROM `lesson`
            JOIN `class` ON `class_id` = `class`.`id`
            WHERE `lesson`.`school_id`= ".$this->school_id." AND (`class_id` IS NOT NULL OR `year` IS NOT NULL AND `special` > 0)
            GROUP BY `day`, `class_id` , `year`
        
            HAVING COUNT(*) < MAX(`time`)")->result_array();
        */
        if (!empty($query))
            foreach ($query as $record) {

                if (!empty($record['class_id']))
                    array_push($result, array('?teacher=&class='.$record['class_id'].'&room=', $record['day'].'. nap'));
                else
                    array_push($result, array('?teacher=&class='.$record['class_id'].'&room=', $record['day'].'. nap'));

            }
        return $result;
    }

    public function oneSubjectPerDay(): array
    {
        $result = array();

        $query = $this->db->query("SELECT `subject_id`, `class_id`, `year` FROM `lesson`
            WHERE `school_id`= ".$this->school_id." AND `day` > 0 AND `fix_time` = 0
            GROUP BY `subject_id`, `class_id`, `day`, `year`
            HAVING COUNT(*) > 1")->result_array();

        if (!empty($query))
            foreach ($query as $record)
                if (!empty($record['class_id']))
                    array_push($result, array('?teacher=&class='.$record['class_id'].'&room=', getSubjectName($record['subject_id'])));
                else {
                    $id = $this->db->query("SELECT `id` FROM `class`
                        WHERE `year` = ".$record['year'])->result_array()[0]['id'];
                    array_push($result, array('?teacher=&class='.$id.'&room=', getSubjectName($record['subject_id'])));
                }

        return $result;
    }
}