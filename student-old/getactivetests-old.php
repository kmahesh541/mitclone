<?php
require_once(dirname(__FILE__) . '/../config.php');
//$PAGE->set_context(get_context_instance(CONTEXT_SYSTEM));


$PAGE->set_url('/student/index.php');
$PAGE->requires->js('/student/jquery-ui.js',true);
$PAGE->requires->js('/student/main.js',true);
$PAGE->requires->css('/student/jquery-ui.css');
//block courseoverview
require_once($CFG->dirroot.'/blocks/course_overview/locallib.php');
$context = context_user::instance($USER->id);
$PAGE->set_context($context);

//course lib for getting activites
require_once($CFG->dirroot.'/course/lib.php');



//get student enrolled courses

//checking if the user is a student,then getting enrolled courses
if(user_has_role_assignment($USER->id, 5)){

    $enrolledcourses =enrol_get_users_courses($USER->id);

    //var_dump($enrolledcourses);
    foreach($enrolledcourses as $key => $value){
        if(is_object($value)){

            $studentenrolledcourses[$value->id]=$value->fullname;

        }
    }
    //var_dump($studentenrolledcourses);
    // var_dump($USER->profile->rollno);
    //var_dump($USER);

}


foreach($studentenrolledcourses as $courseid => $coursename)
{
    $html.=html_writer::start_tag('tr');
    $html.=html_writer::start_tag('td',array('align'=>'left'));
    $html.=$coursename;
    $html.=html_writer::end_tag('td');
    $html.=html_writer::start_tag('td',array('align'=>'center'));
    //
    $countlabs=0;
    $countquiz=0;
    $activities=get_array_of_activities($courseid) ;
    //var_dump($activities);
    foreach($activities as $key1 => $value1){
        if(is_object($value1)){
            if($value1->visible==true){
                if (($value1->mod == 'vpl') || ($value1->mod == 'quiz')){
                $act[$value1->name]=array($value1->mod => $coursename);
                $desc[$value1->name]=array($value1->mod => $value1->cm);
                }
            }


        }
    }
    //var_dump($act);

    foreach($act as $key2 => $value2){
        if($value2=='vpl'){
            $countlabs=$countlabs+1;
        }
    }
    $html.=$countlabs;
    $html.=html_writer::end_tag('td');
    $html.=html_writer::start_tag('td',array('align'=>'center'));

    foreach($act as $key3 => $value3){
        if($value3=='quiz'){
            $countquiz=$countquiz+1;
        }
    }
    $html.=$countquiz;
    $html.=html_writer::end_tag('td');
    $html.=html_writer::start_tag('td');
    $html.=html_writer::end_tag('td');
    $html.=html_writer::end_tag('tr');

    //var_dump($act);
    $act=null;

}



require_once('../config.php');

global $OUTPUT, $PAGE;

$processing    =   optional_param('processing',0,PARAM_INT);

$new_output = "";

$PAGE->set_context(context_system::instance());
if($_GET['id']||true) {
    $data = "";
    foreach ($act as $activity => $activitytype) {

        if (($activitytype[0] == 'vpl') || ($activitytype[0] == 'quiz')){
            $data .= html_writer::start_tag('h3');
        $data .= $activity;
        $data .= html_writer::end_tag('h3');
        $data .= html_writer::start_tag('div');

        $data .= '';
        $data .= html_writer::end_tag('div');
       // var_dump($activitytype);
    }
}

}

var_dump($desc);

//$desc=new mod_vpl($);
//get course id and display topics in that course
/*
if (!$processing) {
    echo json_encode(array('html' => $data));
} else {
    echo json_encode(array('new_output'=>$new_output));
}
*/