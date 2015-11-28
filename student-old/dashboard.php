<style>
    .path-student #page{


        padding: 0px;
        border: 0px;
        border-width: 0px 1px 1px;
        border-style: none solid solid;
        border-color: -moz-use-text-color #CDCDCD #CDCDCD;
        -moz-border-top-colors: none;
        -moz-border-right-colors: none;
        -moz-border-bottom-colors: none;
        -moz-border-left-colors: none;
        border-image: none;
        background-color: #FFF;
        border-radius: 0px 0px 5px 5px;
        box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.25);

    }
    *{
        font-family: "Open Sans","Trebuchet MS", "Helvetica", "Arial",  "Verdana", "sans-serif";

    }
    .path-student{
        background-color: #F3F3F3;
        color: #333;
        font-family: "Open Sans","Trebuchet MS",arial,verdana,sans-serif;
        font-size: 13px;
        font-weight: normal;
        line-height: 20px;
        font-style: normal;
    }
    table{
        width: 100%;
        margin-bottom: 18px;
        max-width: 100%;
        background-color: transparent;
        border-collapse: collapse !important;
        border-spacing: 0px;

    }
    thead tr{
        background-color: #049CDB;
        border-bottom: 2px solid #048AC2;
        color: #FFF;
    }
    tbody tr td, tbody tr:nth-child(2n+1) th {
        background-color: #FFF;
        border-bottom: 1px solid #E6E6E6;
    }
    #page-content{
        background: #fff;
    }
    #accordion .ui-accordian-header{
        background-color: #048AC2;
        color: #FFF;
        border-radius: 5px;
        display: block;
        padding: 3px;
        margin-bottom: 5px;
        margin-top: 10px;
        cursor: pointer;
        font-weight: bold ;
    }
    /********** TOOLTIP***********/
    a.tooltip {outline:none; }
    a.tooltip strong {line-height:30px;}
    a.tooltip:hover {text-decoration:none;}
    a.tooltip span {
        z-index:10;display:none; padding:14px 20px;
        margin-top:-30px; margin-left:28px;
        width:300px; line-height:16px;
    }
    a.tooltip:hover span{
        display:inline; position:absolute; color:#111;
        border:1px solid #DCA; background:#fffAF0;}
    .callout {z-index:20;position:absolute;top:30px;border:0;left:-12px;}

    /*CSS3 extras*/
    a.tooltip span
    {
        border-radius:4px;
        box-shadow: 5px 5px 8px #CCC;
    }
</style>



<?php

require_once(dirname(__FILE__) . '/../config.php');
//$PAGE->set_context(get_context_instance(CONTEXT_SYSTEM));


$PAGE->set_url('/student/dashboard.php');
require_login();
$PAGE->requires->js('/student/jquery-ui.js',true);
$PAGE->requires->js('/student/main.js',true);
$PAGE->requires->css('/student/jquery-ui.css');
$PAGE->requires->css('/student/student.css');

require_once($CFG->dirroot . '/my/lib.php');

//block courseoverview
require_once($CFG->dirroot.'/blocks/course_overview/locallib.php');
$context = context_user::instance($USER->id);
$PAGE->set_context($context);
require_once($CFG->dirroot.'/lib/gradelib.php');
//course lib for getting activites
require_once($CFG->dirroot.'/course/lib.php');
/*********************GRADES *************************/
require_once($CFG->dirroot.'/grade/querylib.php');
require_once($CFG->dirroot . '/grade/lib.php');
require_once($CFG->dirroot.'/mod/watchlist/lib.php');
/************************/
$PAGE->requires->css('/student/custom.css');
$jsarguments = array();

$jsmodule = array(
    'name'     	=> 'ilp_ajax_addnew',
    'fullpath' 	=> '/student/simpleajax_form.js',
    'requires'  	=> array('io','io-form', 'json-parse', 'json-stringify', 'json', 'base', 'node')
);

$PAGE->requires->js_init_call('M.simpleajax_form.init', $jsarguments, true, $jsmodule);
$PAGE->requires->css('/student/student-dashboard.css');

echo $OUTPUT->header();

/******************************
 ****Start of Todays Test page content********************/


/******************************
 ****Start of Tabs********************/
$html=html_writer::start_tag('div');
$html.=html_writer::start_tag('a',array('href'=>$CFG->wwwroot.'/student/dashboard.php',
    'class'=>'current link'));
$html.='Todays Tests';
$html.=html_writer::end_tag('a');
$html.=html_writer::start_tag('a',array('href'=>$CFG->wwwroot.'/student/results.php',
    'class'=>'link'));
$html.='Previous Review';
$html.=html_writer::end_tag('a');
$html.=html_writer::start_tag('a',array('href'=>$CFG->wwwroot.'/student/performancesnapshot.php',
    'class'=>'link'));
$html.='Performance Snapshot';
$html.=html_writer::end_tag('a');

$html.=html_writer::end_tag('div');
//printing the tabs
echo $html;

/******************************
 ****End of Tabs********************/
/**
 *
 *
 *
 *
 * Start of Today's tests Content
 *
 *
 *
 *
 */

$meangrade=0;
//get student enrolled courses

//checking if the user is a student,then getting enrolled courses
if(user_has_role_assignment($USER->id, 5)){

    $enrolledcourses =enrol_get_users_courses($USER->id);
    $no_courses=count($enrolledcourses);

    $totalgrade=0;
    $total_watchlisted=getAllWatchlistCountByUser($USER->id);

    //var_dump($enrolledcourses);
    foreach($enrolledcourses as $key => $value){
        if(is_object($value)){
            $studentenrolledcourses[$value->id]=$value->fullname;
            $c_grade = grade_get_course_grades($value->id, $USER->id);
//var_dump($resultkrb);
            $grd = $c_grade->grades[$USER->id];
            $grd=$grd->grade;
            $totalgrade=$totalgrade+$grd;
//Watchlist
//$watchlist=getStatus($USER->id,$value->id);
//$total_watchlisted=$total_watchlisted+$watchlist;
        }
    }
    /************* FINDING MEAN GRADE ****************/
    if($totalgrade!=0)
    {
        $meangrade= $totalgrade/$no_courses;
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
    // Filtering activities (only Labs And Quizes)
    //var_dump($activities);
    foreach($activities as $key1 => $value1){
        if(is_object($value1)){
            if($value1->visible==true){
                if (($value1->mod == 'vpl') || ($value1->mod == 'quiz')){
                    $act[$value1->name]=array($value1->mod => $coursename);
                    $desc[$value1->name]=array($value1->mod => $value1->cm);
                    $act2[$value1->name]=$value1->cm;
                }

            }
            elseif($value1->visible==false){
                if (($value1->mod == 'vpl') || ($value1->mod == 'quiz')){
                    $unavailableactivites[$value1->name]=array($value1->mod => $value1->cm,$coursename
                    =>$courseid);
                    $unavailableactivite[$value1->name]=array($value1->mod => array($coursename
                    =>$courseid));
                    $act1[$value1->name]=$value1->cm;
                }
            }
            $n='';
            if (($value1->mod == 'vpl') || ($value1->mod == 'quiz')){
                $unavailableactivit[$value1->name] = array(
                    $value1->mod => array(
                        $coursename => $courseid
                    )
                );
                $act123[$value1->name]=$value1->cm;
            }

        }
    }

}
$data = "";
foreach ($act as $activity => $activitytype) {


    $data .= html_writer::start_tag('h3');
    $data .= $activity;
    $data .= html_writer::end_tag('h3');
    $data .= html_writer::start_tag('div');
    $data .=html_writer::start_tag('table',array('class'=>'tbla'));
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
    $data .=html_writer::start_tag('td');
    foreach($activitytype as $key4 => $value4){
        $course=$value4;}
    $data .= $course;
    $data .=html_writer::end_tag('td');
    $data .=html_writer::start_tag('td',array('align'=>'center'));

    $data .= $activity;
    $data .=html_writer::end_tag('td');
    $data .=html_writer::start_tag('td',array('align'=>'center'));
    foreach($activitytype as $key4 => $value4){$activityname=$key4;}

    $courseid=$DB->get_field_sql("SELECT `id`
FROM `mdl_course`
WHERE `fullname` = '$course'");
    $getvplinstance=$DB->get_field_sql("SELECT `instance`
FROM `mdl_course_modules`
WHERE `id` ='$act2[$activity]'
AND `course` ='$courseid'");

    /************** GETTING GARDE *************************/
    $grading_info=grade_get_grades( $courseid, 'mod', $activityname,  $getvplinstance,$USER->id);

    $item = $grading_info->items[0];
    //var_dump($item);
    $gradeobj= $item->grades[$USER->id];
    $grade = $gradeobj->grade + 0;
    $gardemax=$item->grademax+0;
    /******************** GARDE END ***********************/
    $data.=$grade." of ".$gardemax;
    $data .=html_writer::end_tag('td');
    $data .=html_writer::start_tag('td',array('align'=>'center'));
//getting number of submissions

    if($activityname=='vpl'){


        //var_dump($getvplinstance);
        $submissions=$DB->get_fieldset_sql("SELECT  `datesubmitted`
FROM `mdl_vpl_submissions`
WHERE `vpl` ='$getvplinstance'
AND `userid` ='$USER->id'");
        if(is_array($submissions))
            $submissions=sizeof($submissions);
        $data.=$submissions;
    }
    else if($activityname=='quiz'){

        $quizid=$DB->get_field_sql("SELECT `id`
FROM `mdl_quiz`
WHERE `course` ='$courseid'
AND `name` = '$activity'");


        $submissions=$DB->get_fieldset_sql("SELECT `attempt`
FROM `mdl_quiz_attempts`
WHERE `quiz` ='$quizid'
AND `userid` ='$USER->id'");
        if(is_array($submissions))
            $submissions=sizeof($submissions);
        $data .=$submissions;

    }
    //getting number of submissions end
    $data .=html_writer::end_tag('td');
    $data .=html_writer::end_tag('tr');
    $data .=html_writer::start_tag('tr');
    $data .=html_writer::start_tag('td',array('colspan'=>'3'));
    $data .=html_writer::start_tag('h4');
    $data .= "Description:";
    $data .=html_writer::end_tag('h4');
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
    $reflink="";
    /********** GIVING TEST LINK BASED ON ACTIVITY ******************/

    if(strcasecmp($activityname ,"vpl")==0)
    {
        $reflink=$CFG->wwwroot."/mod/".$activityname."/forms/edit.php?id=".$desc[$activity][$activityname]."&userid=".$USER->id;
    }else {
        # code...
        $reflink=$CFG->wwwroot."/mod/".$activityname."/view.php?id=".$desc[$activity][$activityname];
    }

    $data .=html_writer::start_tag('p');
    $data.=$descact;
    $data .=html_writer::end_tag('p');
    $data .=html_writer::end_tag('td');
    $data .=html_writer::start_tag('td');
    $data .=html_writer::start_tag('a',array('class'=>'taketest','value'=>'submit',
        'href'=> $reflink));
    $data .="Take Test";
    $data .=html_writer::end_tag('button');
    $data .=html_writer::end_tag('td');
    $data .=html_writer::end_tag('tr');
    /************* STATUS RO START *******************/
    //Status
    $data .=html_writer::start_tag('tr');
    $data .=html_writer::start_tag('td');
    $data .="Status:";
    $data .=html_writer::end_tag('td');
    $data .=html_writer::start_tag('td' ,array('colspan'=>'3'));
    if($submissions==''){
        $data .="Not Attempted";
    }
    else{
        $data .="Attempted ".$submissions." time(s)";
    }
    $data .=html_writer::end_tag('td');
    $data .=html_writer::end_tag('tr');

    /*****************STATUS ROW END **************/
    $data .=html_writer::end_tag('tbody');
    $data .=html_writer::end_tag('table');
    $data .= html_writer::end_tag('div');
    $data .= html_writer::end_tag('div');


}

echo $data;

/**
 *
 *
 *
 *
 * End of Today's tests Content
 *
 *
 *
 *
 */



/*
<div id="courss">
<a href="<?php echo $CFG->wwwroot?>/teacher/dashboard.php" class='current link'>Courses</a>
<a href="<?php echo $CFG->wwwroot?>/teacher/reports.php" class='link'>Reports</a>
   <a href="<?php echo $CFG->wwwroot?>/teacher/watchlist.php" class='link' >Watchlist</a>
<br/>
