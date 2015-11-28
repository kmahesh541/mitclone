<style>
/* Color fix */
a.current:link, a.current:visited {
    background: #E5B467 !important;
    color: #FFF;
    font-weight: bold;
}
.nav-tabs li .link {
     
    color:#E5B467 !important ;
     
}
.nav-tabs .active >.current{
     
    color:#555 !important ;
background:#fff !important;
     
}
.nav-tabs .current{
background:#fff !important;
}
.span2 .btn-primary {
    text-transform: uppercase;
    font-weight: bold;
    border-radius: 0px;
    text-shadow: none;
    padding: 6px 0px !important;
width:100% !important;
margin-top: 5px !important;
}
.btn-primary {
     
    background-image:none;
    background: #E5B467 !important;
}
 
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
    .nav-tabs > li > a {

        border-bottom: 1px solid #eee !important;

    }
    .perfsnap{
        margin-left: 0px !important;
    }
    .nav-tabs > li > a {
        margin-right: 2px;
        line-height: 1.42857;
        border: 1px solid transparent;
        border-radius: 4px 4px 0px 0px;
        margin-bottom: 0px !important;
    }
    .profile .span12{
    margin-left :0px !important;
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
    .jumbotron {
        padding-top: 4px !important;
        padding-bottom: 4px !important;
        background-color: #fff;
        padding-left: 4px !important;
        padding-right: 4px !important;
        margin-bottom: 6px !important;
        margin-top: 4px !important;
    }
    .jumbotron p{
        font-size: 15px !important;
    }
    table  tr td {
        border: 0px none;
        padding: 2px 8px !important;
        vertical-align: middle;
    }
    table td {
        font-size: 12px !important;
    }
    table td a{
        font-size: 12px !important;

    }
    table thead tr th, table thead tr td {
        font-size: 13px !important;
        font-style: normal;
        padding: 5px;
    }
    table tr td {
        border: 0px none;
        vertical-align: middle;
        padding: 5px !important;
    }
    table tbody tr:hover td{
        background-color:white !important;
    }
</style>


<?php

require_once(dirname(__FILE__) . '/../config.php');
//$PAGE->set_context(get_context_instance(CONTEXT_SYSTEM));


$PAGE->set_url('/student/dashboard.php');
require_login();
$PAGE->requires->js('/student/jquery-latest.min.js',true);

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
/*************Bootstrap css***********/
$PAGE->requires->css('/student/bootstrap.min.css');
$PAGE->requires->css('/student/custom.css');
echo "<input id='baseurl' type='hidden' value=".$CFG->wwwroot ."/>";

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
 ****Start of Performance Snapshot page content********************/


/******************************
 ****Start of Tabs********************/
$html=html_writer::start_tag('div');
$html.=html_writer::start_tag('ul',array('class'=>'nav nav-tabs','role'=>'presentation'));
$html.=html_writer::start_tag('li',array('role'=>'presentation'));
$html.=html_writer::start_tag('a',array('href'=>$CFG->wwwroot.'/student/dashboard.php',
    'class'=>'link'));
$html.='Current Tests';
$html.=html_writer::end_tag('a');
$html.=html_writer::start_tag('li',array('class'=>'','role'=>'presentation'));
$html.=html_writer::start_tag('a',array('href'=>$CFG->wwwroot.'/student/results.php',
    'class'=>'link'));
$html.='Completed Tests';
$html.=html_writer::end_tag('a');
$html.=html_writer::end_tag('li');
$html.=html_writer::start_tag('li',array('class'=>'active','role'=>'presentation'));
$html.=html_writer::start_tag('a',array('href'=>$CFG->wwwroot.'/student/performancesnapshot.php',
    'class'=>'current link'));
$html.='Performance Snapshot';
$html.=html_writer::end_tag('a');
$html.=html_writer::end_tag('li');

$html.=html_writer::end_tag('ul');



$html.=html_writer::end_tag('div');

//printing the tabs
echo $html;

/******************************
 ****End of Tabs********************/
/**************************************************START OF DATA POLLING *************************/
/**
 *
 *
 *
 *
 *
 *
 *
 *
 * Start Performance
 *
 *
 *
 */

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
/********************* GETTING COMPELETE PROFILE OF STUDENT **********/
$userobj=get_complete_user_data(id,$USER->id);
print <<<END
<div class="container-fluid">

<div class="span12 jumbotron">


<div class="inner" >

				<div class="profile span12">
<h3 style="text-align: center;">
END;
echo $userobj->firstname ." " .$userobj->lastname;
print <<<END
</h3>

					<div class="rollno span8" style="">


						<p>Roll Number: <b style="text-transform:Uppercase;">
END;
echo $userobj->profile['rollno'];
print <<<END
						</b> </p>


						<p>Watchlisted: <b style="text-transform:Uppercase;">




END;
echo   $total_watchlisted;
print <<<END

						 </b> Times</p><p>Overall Grade: <b style="text-transform:Uppercase;">
END;
echo $meangrade;
print <<<END
                        </b></p>


					</div>
					<div class="details span2" style="">
					<div class="">

END;
//loading User image
$imgsrc=$CFG->wwwroot."/user/pix.php/".$USER->id."/f1.jpg";
$html=html_writer::start_tag('img' ,array('src'=>$imgsrc,'class'=>'img-responsive',
'style'=>''
));
$html.=html_writer::end_tag('img');
echo $html;
print <<< END
</div></div></div></div>

					</div>
					<div class="span12 perfsnap">
    <h3 style="text-align:center;">Performance Snapshot</h3>
<table>
    <thead>

        <tr>



            <th style='width: 5%;'>Course Name</th>
            <th style='width: 20%;'>Total Labs</th>
<th style='width: 20%;'>Completed Labs</th>
<th style='width: 20%;'>Attempted  Labs</th>
<th style='width: 20%;'>Notattempted  Labs</th>

 <th style='width: 20%;'>Total Quizs</th>
<th style='width: 20%;'>Completed Quizs</th>
<th style='width: 20%;'>Attempted  Quizs</th>

<th style='width: 20%;'>Notattempted  Quizs</th>
            <th style='width: 10%;'>Grade</th>
        </tr>
    </thead>

    <tbody>
END;
$html='';
//summary report
foreach($studentenrolledcourses as $courseid => $coursename)
{
    $html.=html_writer::start_tag('tr');
    $html.=html_writer::start_tag('td',array('align'=>'left'));
    $html.=$coursename;
    $html.=html_writer::end_tag('td');
    $html.=html_writer::start_tag('td',array('align'=>'center'));
    //


/***************GETTING ALL ACTIVITIES**************************/

$sql="SELECT *
FROM mdl_course_modules
WHERE course = '".$courseid."'";
$total_labs=0;
$total_quizs=0;
 
//echo $sql;
    $res=$DB->get_records_sql($sql);
    $items_completed_today=count($res);
    $totalgrade=0;
    $meangrade=0;
    foreach ($res as $item )
    {
        $module=$item->module;

        $instance=$item->instance;


 $sql_item="SELECT name
FROM mdl_modules
WHERE id ='".$module."'";

        $item_res=$DB->get_record_sql($sql_item);
        $itemtype= $item_res->name;


if($itemtype=='quiz')
{
$total_quizs=$total_quizs+1;

}
if($itemtype=='vpl')
{
$total_labs=$total_labs+1;

}
}



    $activities=get_array_of_activities($courseid) ;

    /***** GETTING GRADE OF STUDENT BASED **/
    $grade_r = grade_get_course_grades($courseid, $USER->id);
//var_dump($resultkrb);
    $grdc = $grade_r->grades[$USER->id];
    $coursegrd=$grdc->grade+0.00;

    // var_dump($activities);
    foreach($activities as $key1 => $value1){
        if(is_object($value1)){

            if (($value1->mod == 'vpl') || ($value1->mod == 'quiz')) {
                $act[$value1->name] = $value1->mod;
                $actid[$value1->name] = $value1->cm;
            }
        }
    }
     

    $countlabs=0;
    $countquiz=0;
    $submittedlab=0;
    $gradedlabs=0;
    $notattemptedlabs=0;
    $submittedquiz=0;
    $gradedquiz=0;
    $notattemptedquiz=0;
    foreach($act as $key2 => $value2){
        if($value2=='vpl'){
            $countlabs=$countlabs+1;
            $getvplinstance=$DB->get_field_sql("SELECT `instance`
FROM `mdl_course_modules`
WHERE `id` ='$actid[$key2]'
AND `course` ='$courseid'");

            $submissions=$DB->get_fieldset_sql("SELECT  `datesubmitted`
FROM `mdl_vpl_submissions`
WHERE `vpl` ='$getvplinstance'
AND `userid` ='$USER->id'");

            // var_dump($getvplinstance);
            if(is_array($submissions))
            {
                if(sizeof($submissions)>0)
                {
                    $submissions=1;
                }

                else
                {
                    $submissions=0;
                    $notattemptedlabs=$notattemptedlabs+1;
                }

            }
            else{
                $submissions=0;
                $notattemptedlabs=$notattemptedlabs+1;
            }
            $grades=$DB->get_fieldset_sql("SELECT   `dategraded`
FROM `mdl_vpl_submissions`
WHERE `vpl` ='$getvplinstance'
AND `userid` ='$USER->id'");
            if(is_array($grades))
            {   $num=0;
                foreach($grades as $grd){
                    if($num<$grd)
                        $num=$grd;
                }
                if($num>0)
                    $grades=1;
                else
                    $grades=0;
            }
            else{
                $grades=0;
            }
            $submittedlab=$submittedlab+$submissions;
            $gradedlabs=$gradedlabs+$grades;
        }
    }
$html.=$total_labs;
 $html.=html_writer::end_tag('td');
    $html.=html_writer::start_tag('td',array('align'=>'center'));
$html.=$countlabs;
 $html.=html_writer::end_tag('td');
    $html.=html_writer::start_tag('td',array('align'=>'center'));
$html.=$submittedlab;

 $html.=html_writer::end_tag('td');
    $html.=html_writer::start_tag('td',array('align'=>'center'));

$html.=$notattemptedlabs;

 /*$html.=html_writer::end_tag('td');

    $html.="<p href='#'  class='abc'>

    <b>".$submittedlab." of ".$countlabs. " </b><span>Submitted(".$submittedlab."),Graded(".$gradedlabs."),Not Attempted(".$notattemptedlabs.")</span></p>";*/

    $html.=html_writer::end_tag('td');
    $html.=html_writer::start_tag('td',array('align'=>'center'));
  
    foreach($act as $key3 => $value3){
        if($value3=='quiz'){

            $countquiz=$countquiz+1;

            $quizid=$DB->get_field_sql("SELECT `id`
FROM `mdl_quiz`
WHERE `course` ='$courseid'
AND `name` = '$key3'");

            $attempts=$DB->get_fieldset_sql("SELECT `attempt`
FROM `mdl_quiz_attempts`
WHERE `quiz` ='$quizid'
AND `userid` ='$USER->id'");
            //var_dump($attempts);
            if(is_array($attempts)){
                $attempts=sizeof($attempts);
                if($attempts>0){
                    $submissions=1;
                    $graded=$DB->get_field_sql("SELECT `grade`
FROM `mdl_quiz_grades`
WHERE `quiz` ='$quizid'
AND `userid` ='$USER->id'");
                    if($graded==''){
                        $grades=0;
                    }
                    else{
                        $grades=1;
                    }
                }
                else{
                    $submissions=0;
                    $grades=0;
                }
            }

            else{
                $submissions=0;
                $grades=0;
            }

            $submittedquiz=$submittedquiz+$submissions;
            $gradedquiz=$gradedquiz+$grades;
        }


    }

$html.=$total_quizs;
 $html.=html_writer::end_tag('td');
    $html.=html_writer::start_tag('td',array('align'=>'center'));
$html.=$countquiz;
 $html.=html_writer::end_tag('td');
    $html.=html_writer::start_tag('td',array('align'=>'center'));
$html.=$submittedquiz;

 $html.=html_writer::end_tag('td');
    $html.=html_writer::start_tag('td',array('align'=>'center'));

$html.=$notattemptedquiz;


/*
    $html.="<p href='#'  class='abc'><b>".$submittedquiz." of ".$countquiz. " </b><span>Submitted(".$submittedquiz."),Graded(".$gradedquiz."),Not Attempted(".$notattemptedquiz."))</span></p>";*/

    $html.=html_writer::end_tag('td');
    $html.=html_writer::start_tag('td');
    $html.=$coursegrd;
    $html.=html_writer::end_tag('td');
    $html.=html_writer::end_tag('tr');
    $act=null;
}

echo $html;

//var_dump($userobj);
print <<<END
  </tbody>

</table>
</div>



END;
echo $OUTPUT->footer();

?>
<script>
    $( document ).ready(function() {
        var baseUrl=$('#baseurl').val();
        var url=baseUrl+'student/dashboard.php';
        $('#page-navbar').append("<div style='padding: 6px 6px 6px 2%;'> <a id='dlink'>Dashboard</a> <span>/</span> <b>Performance Snapshot</b></div>");
        $('#dlink').attr("href",url);

    });
</script>
