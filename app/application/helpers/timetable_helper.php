<?php 
/**
 * Timetable helper
 * 
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Timetable Helpers
 *
 * @category	Helpers
 * @author      Horváth Dániel
 */



function lesson_box_sm($lesson): string
{
    $result = '<div id='.$lesson['id'].' class="lesson-box-sm" draggable="true">';
    
    $result .= createLessonBoxSM($lesson);

    $result .= '</div>';

    return $result;
}

function createLessonBoxSM($lesson): string
{

    $timetype = $lesson['fix_time'] == 1 ? ' fix':'';
    $roomtype = $lesson['fix_room'] == 1 ? ' fix':'';
    $class = empty($lesson['class_name']) ? $lesson['year'].'. évfolyam' : $lesson['class_name'];
    $room = $lesson['room_name'] == NULL ? 'Hiányzó terem' : $lesson['room_name'];

    return
        '<div class="short'.$timetype.'">
            <div style="background-image: linear-gradient(whitesmoke,'.$lesson['color'].' 99%)">'.$lesson['short'].'</div>
            <div id='.$lesson['id'].' class="lesson-box'.$timetype.'">
                <div class="subject">'.$lesson['subject_name'].'</div>
                <div class="class">'.$class.'</div>
                <div class="teacher">'.$lesson['teacher_name'].'</div>
                <div class="room'.$roomtype.'">'.$room.'</div>
            </div>
        </div>';
}

function lesson_box($lesson): string
{
    if ($lesson['subject_id'] == NULL) { // no lesson      
        $timetype = $lesson['fix_time'] == 1 ? 'class="fix"':'';  
        $result = '
            <div id='.$lesson['id'].' class="lesson-box" draggable="true">
                <div '.$timetype.'>Lyukas óra</div>
            </div>';
    
    } else {
        $timetype = $lesson['fix_time'] == 1 ? ' fix':'';  
        $roomtype = $lesson['fix_room'] == 1 ? 'fix':'';
        $class = empty($lesson['class_name']) ? $lesson['year'].'. évfolyam' : $lesson['class_name'];
        $room = $lesson['room_name'] == NULL ? 'Hiányzó terem' : $lesson['room_name'];
        
        $result = '
            <div id='.$lesson['id'].' class="lesson-box'.$timetype.'" draggable="true">
                <div class="subject">'.$lesson['subject_name'].'</div>
                <div class="class">'.$class.'</div>
                <div class="teacher">'.$lesson['teacher_name'].'</div>
                <div class="room '.$roomtype.'">'.$room.'</div>';

        $result .= '</div>';
    }

    return $result;
}

// -----------------------------------------------------------------------

if ( ! function_exists('getLesson')) {

    /**
     * @param   string|int id
     * @return  array
     */
    function getLesson($id): array
    {
        return get_instance()->helper_model->getLesson($id);
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('getSubjectName')) {

    /**
     * used in Control_model
     * @param   string|int id
     * @return  string
     */
    function getSubjectName($id): string
    {
        return get_instance()->helper_model->getSubjectName($id);
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('getTeacherName')) {

    /**
     * used in Control_model
     * @param   string|int id
     * @return  string
     */
    function getTeacherName($id): string
    {
        return get_instance()->helper_model->getTeacherName($id);
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('getClassName')) {

    /**
     * used in home_model getLesson()
     * view/home/index.php
     * @param   string|int id
     * @return  string
     */
    function getClassName($id): string
    {
        return get_instance()->helper_model->getClassName($id);
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('getRoomName')) {

    /**
     * Never used, but maybe it will need
     * @param   string|int id
     * @return  string
     */
    function getRoomName($id): string
    {
        return get_instance()->helper_model->getRoomName($id);
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('teacherHaveSubject')) {

    /**
     * called in views/school/teacher
     * @param   string|int id
     * @return  bool
     */
    function teacherHaveSubject($teacher_id): bool
    {
        return get_instance()->helper_model->teacherHaveSubject($teacher_id);
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('roomHaveSubject')) {

    /**
     * called in views/school/room
     * @param   string|int id
     * @return  bool
     */
    function roomHaveSubject($id): bool
    {
        return get_instance()->helper_model->roomHaveSubject($id);
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('teacherHaveSubject2')) {

    /**
     * called in views/lesson/class
     * views/lesson/year
     * @param   string|int teacher_id
     * @param   string|int subject_id
     * @return  bool
     */
    function teacherHaveSubject2($teacher_id, $subject_id): bool
    {
        return get_instance()->helper_model->teacherHaveSubject2($teacher_id, $subject_id);
    }
}

// ------------------------------------------------------------------------



if ( ! function_exists('verify')) {

    /**
     * @param   string method
     * @return  string
     */
    function verify($method): string
    {
        $value = get_instance()->control_model->$method();

        if (empty($value))
            $result = '<img src='.site_url("assets/img/icons/ok.png").' class="float-left mt-1">';

        else {
            $result = '<img src='.site_url("assets/img/icons/no.gif").' class="float-left mt-1">';
            $result .= '<ul>';

            foreach ($value as $list)
                $result .= '<li><a href='.site_url($list[0]).'>'.$list[1].'</a></li>';
            
            $result .= '</ul>';
        }

        return $result;
    }
}
