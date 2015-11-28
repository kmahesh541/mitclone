<?php
require_once(dirname(__FILE__) . '/../config.php');
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

global $OUTPUT, $PAGE;

$processing    =   optional_param('processing',0,PARAM_INT);

$new_output = "";

$PAGE->set_context(context_system::instance());
//get student enrolled courses
//checking if the user is a student,then getting enrolled courses
if(user_has_role_assignment($USER->id, 5)){

    $enrolledcourses =enrol_get_users_courses($USER->id);

  
    foreach($enrolledcourses as $key => $value){
        if(is_object($value)){
            $studentenrolledcourses[$value->id]=$value->fullname;

        }
    }

}

//
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
   // var_dump($activities);

    foreach($activities as $key1 => $value1){

        if(is_object($value1)){
            if($value1->visible==true){
                if (($value1->mod == 'vpl') || ($value1->mod == 'quiz'))
                    $act[$value1->name]=array($value1->mod => $coursename.":".$value1->id);

                    $desc[$value1->mod]=array($value1->name => $value1->cm);
            }


        }
    }

}




if($_GET['id']) {

    $data = "";
    foreach ($act as $activity => $activitytype) {


        $data .= html_writer::start_tag('h3');
        $data .= $activity;
        $data .= html_writer::end_tag('h3');
        $data .= html_writer::start_tag('div');
        $data .=html_writer::start_tag('table');
        $data .=html_writer::start_tag('thead');
        $data .=html_writer::start_tag('tr');
        $data .=html_writer::start_tag('th',array('align'=>'center'));
        $data .="Course Name";
        $data .=html_writer::end_tag('th');
        $data .=html_writer::start_tag('th',array('align'=>'center'));
        $data .="Activity Name";
        $data .=html_writer::end_tag('th');
        $data .=html_writer::start_tag('th',array('align'=>'center'));
        $data .="Grade";
        $data .=html_writer::end_tag('th');
        $data .=html_writer::start_tag('th',array('align'=>'center'));
        $data .="Submissions";
        $data .=html_writer::end_tag('th');
        $data .=html_writer::end_tag('tr');
        $data .=html_writer::end_tag('thead');
        $data .=html_writer::start_tag('tbody');
        $data .=html_writer::start_tag('tr');
        $data .=html_writer::start_tag('td',array('align'=>'center'));
        foreach($activitytype as $key4 => $value4){
$actval=explode(":",$value4);
$course=$actval[0];
$act_id=$actval[1];
}
        $data .= $course;
        $data .=html_writer::end_tag('td');
        $data .=html_writer::start_tag('td',array('align'=>'center'));

        $data .= $activity;
        $data .=html_writer::end_tag('td');
        $data .=html_writer::start_tag('td',array('align'=>'center'));
        foreach($activitytype as $key4 => $value4){
$activityname=$key4;
}
 /************** GETTING GARDE *************************/
     $grading_info=grade_get_grades( $courseid, 'mod', $activityname,  $getvplinstance,$USER->id);

 $item = $grading_info->items[0];
 //var_dump($item);
$gradeobj= $item->grades[$USER->id];
$grade = $gradeobj->grade + 0; 
$gardemax=$item->grademax+0;
        $data.=$activityname;
        $data .=html_writer::end_tag('td');
        $data .=html_writer::start_tag('td',array('align'=>'center'));

        $data .=html_writer::end_tag('td');
        $data .=html_writer::end_tag('tr');
        $data .=html_writer::start_tag('tr');
        $data .=html_writer::start_tag('td',array('colspan'=>'3'));
        $data .= "<b>Description:</b><br>";
        $x=$activity.'';
        if($activityname=='vpl'){
            $descact=$DB->get_field_sql("SELECT  `intro`
FROM `mdl_vpl`
WHERE `name` = '$activity'");
            if($descact==''){
                $descact=$DB->get_field_sql("SELECT  `shortdescription`
FROM `mdl_vpl`
WHERE `name` = '$activity'");
            }

        }
        else if($activityname=='quiz'){
            $descact=$DB->get_field_sql("SELECT `intro`
FROM `mdl_quiz`
WHERE `name` = '$activity'");


        }

 if(strcasecmp($activityname ,"vpl")==0)
 {
$reflink=$CFG->wwwroot."/mod/".$activityname."/forms/edit.php?id=".$act_id."&userid=".$USER->id;
 }else {
     # code...
    $reflink=$CFG->wwwroot."/mod/".$activityname."/view.php?id=".$act_id;
 }
        $data.=$descact;
        $data .=html_writer::end_tag('td');
        $data .=html_writer::start_tag('td',array('align'=>'center'));
$data .=html_writer::start_tag('a',array('class'=>'taketest','value'=>'submit',
        'href'=> $reflink));
        $data .="Take Test";
        $data .=html_writer::end_tag('button');

      
        $data .=html_writer::end_tag('td');
        $data .=html_writer::end_tag('tr');
        $data .=html_writer::end_tag('tbody');
        $data .=html_writer::end_tag('table');

        $data .= html_writer::end_tag('div');

    }


}


//get course id and display topics in that course

if (!$processing) {
    echo json_encode(array('html' => $data));
} else {
    echo json_encode(array('new_output'=>$new_output));
}
