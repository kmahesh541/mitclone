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


<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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
 ****Start of Todays results page content********************/


/******************************
 ****Start of Tabs********************/
$html=html_writer::start_tag('div');
$html.=html_writer::start_tag('a',array('href'=>$CFG->wwwroot.'/student/todaystests.php',
    'class'=>'link'));
$html.='Todays Tests';
$html.=html_writer::end_tag('a');
$html.=html_writer::start_tag('a',array('href'=>$CFG->wwwroot.'/student/results.php',
    'class'=>'current link'));
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


/******************************************** START OF DATA *****************************************************/

/**************************************************START OF PREVIOUS REVIEW ***************/
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




/********************* GETTING COMPELETE PROFILE OF STUDENT **********/
$userobj=get_complete_user_data(id,$USER->id);
//var_dump($userobj);



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
      
    foreach ($act as $activity => $activitytype) {


     
    
        foreach($activitytype as $key4 => $value4){
            $course=$value4;}
       
       

         $courseid=$DB->get_field_sql("SELECT `id`
FROM `mdl_course`
WHERE `fullname` = '$course'");
          $getvplinstance=$DB->get_field_sql("SELECT `instance`
FROM `mdl_course_modules`
WHERE `id` ='$act2[$activity]'
AND `course` ='$courseid'");

        

      
 

       

      
    



    }


/**************************************************START OF PREVIOUS REVIEW ***************/

print <<<END

<div class='container-fluid'>
<div class='span12 previousreview'>
END;
$data = html_writer::start_tag('h3');
$data.= 'Previous Reviews';
$data.=html_writer::start_tag('i',array('class'=>'fa fa-angle-double-down','style'=>'float:right'));
$data.=html_writer::end_tag('i');
$data.=html_writer::start_tag('i',array('class'=>'fa fa-angle-double-up','style'=>'float:right'));
$data.=html_writer::end_tag('i');

$data.= html_writer::end_tag('h3');
echo $data;
$today = strtotime("now");
$yesterday = strtotime("today");
$pre_result="";
foreach($unavailableactivit as $activitytype => $activityid)
{

    // var_dump($unavailableactivite);

    foreach($activityid as $type => $arid)
    {

        // var_dump($ar);

        foreach($arid as $coursenam => $courseid1)
        {
            $ar = $courseid1;
            $ar1 = $coursenam;
        }

       
        switch ($type)
        {
            case 'quiz':
                $data = "";
                $quizid = $DB->get_field_sql("SELECT `id`
FROM `mdl_quiz`
WHERE `course` ='$ar'
AND `name` = '$activitytype'");
                $maxgrade = $DB->get_field_sql("SELECT `grade`
FROM `mdl_quiz`
WHERE `course` ='$ar'
AND `name` = '$activitytype'");
                $attempts = $DB->get_fieldset_sql("SELECT `timemodified`
FROM `mdl_quiz_attempts`
WHERE `quiz` ='$quizid'
AND `userid` ='$USER->id'");


                if (!empty($attempts))
                {
if(empty($pre_result))
{
 $pre_result = html_writer::start_tag('table');
                            $pre_result.= html_writer::start_tag('tr');
                            $pre_result.= html_writer::start_tag('th');
                           $pre_result.= "Course Name:";
  $pre_result.= html_writer::end_tag('th');
  $pre_result.= html_writer::start_tag('th');
                            $pre_result.= "Activity Name:";
                           $pre_result.= html_writer::end_tag('th');
  $pre_result.= html_writer::start_tag('th');
                            $pre_result.= "Grade:";
                           $pre_result.= html_writer::end_tag('th');

  $pre_result.= html_writer::start_tag('th');
                            $pre_result.= "Submitted:";
                           $pre_result.= html_writer::end_tag('th');

  $pre_result.= html_writer::end_tag('tr');

}
           $check_latest_attemptted_quiz = 0;
                    foreach($attempts as $atmpt)
                    {
                        if ($check_latest_attemptted_quiz < $atmpt)
                            $check_latest_attemptted_quiz = $atmpt;
                    }

$ab=explode(" ",date('m/d/Y h:i:s', $check_latest_attemptted_quiz));


	 $a1 =strtotime($ab[0]) ;          

$at= strtotime(date("m/d/Y"));




                    if ( $a1==$at)
{

 

                     
                        $grade = $DB->get_field_sql("SELECT `grade`
FROM `mdl_quiz_grades`
WHERE `quiz` ='$quizid'
AND `userid` ='$USER->id'");

                       
                        if ($grade >=0)
                    {
   


                           
                             $pre_result.= html_writer::start_tag('tr');
                            $pre_result.= html_writer::start_tag('td');
                            $pre_result.= $ar1;
                             $pre_result.= html_writer::end_tag('td');
                          
                          
                           
                             $pre_result.= html_writer::start_tag('td');
                            $pre_result.= $activitytype;
                            $pre_result.= html_writer::end_tag('td');
                          
                          
                            $pre_result.= html_writer::start_tag('td');
                       
                          
                            $pre_result.= $grade+0;
                            $pre_result.= html_writer::end_tag('td');
                          
                         $pre_result.= html_writer::start_tag('td');
                          
                            $time = date('m/d/Y h:i:s', $check_latest_attemptted_quiz);
                            $pre_result.= $time;
                           $pre_result.= html_writer::end_tag('td');
                             $pre_result.= html_writer::end_tag('tr');
                          

                        }
                        elseif ($attempts == '')
                        {
                            /*
                            $data .=html_writer::start_tag('tr');
                            $data .=html_writer::start_tag('td',array('colspan'=>'2','align'=>'center'));
                            $data.="Not Started";
                            $data .=html_writer::end_tag('td');
                            $data .=html_writer::end_tag('tr');
                            */
                        }
                    }
                }
                else
                {
                    $data = "";
                }


                break;

            case 'vpl':
                $data = "";
                $getvplinstance = $DB->get_field_sql("SELECT `instance`
FROM `mdl_course_modules`
WHERE `id` ='$act123[$activitytype]'
AND `course` ='$ar'");
		
                 //var_dump($act123[$activitytype]);

                $submissions = $DB->get_fieldset_sql("SELECT  `datesubmitted`
FROM `mdl_vpl_submissions`
WHERE `vpl` ='$getvplinstance'
AND `userid` ='$USER->id'");

                if (is_array($submissions))
                {
                    $check_latest_submitted_lab = 0;
if(empty($pre_result))
{
 $pre_result = html_writer::start_tag('table');
                            $pre_result.= html_writer::start_tag('tr');
                            $pre_result.= html_writer::start_tag('th');
                           $pre_result.= "Course Name:";
  $pre_result.= html_writer::end_tag('th');
  $pre_result.= html_writer::start_tag('th');
                            $pre_result.= "Activity Name:";
                           $pre_result.= html_writer::end_tag('th');
  $pre_result.= html_writer::start_tag('th');
                            $pre_result.= "Grade:";
                           $pre_result.= html_writer::end_tag('th');

  $pre_result.= html_writer::start_tag('th');
                            $pre_result.= "Submitted:";
                           $pre_result.= html_writer::end_tag('th');

  $pre_result.= html_writer::end_tag('tr');

}
                    foreach($submissions as $atmpt)
                    {
                        if ($check_latest_submitted_lab < $atmpt)
                            $check_latest_submitted_lab = $atmpt;
                    
}
            $ab=explode(" ",date('m/d/Y h:i:s', $check_latest_submitted_lab));
//var_dump( $ab);

	 $a1 =strtotime($ab[0]) ;          

$at= strtotime(date("m/d/Y"));




                    $usergrade = $DB->get_fieldset_sql("SELECT `grade`
FROM `mdl_vpl_submissions`
WHERE `vpl` ='$getvplinstance'
AND `userid` ='$USER->id'
ORDER BY `grade` DESC ");
                   if ( $a1==$at)
                    {
                       
                        $pre_result.= html_writer::start_tag('tr');
                       
                        $pre_result.= html_writer::start_tag('td');
                        $pre_result.= $ar1;
                        $pre_result.= html_writer::end_tag('td');
                     
                       $pre_result.= html_writer::start_tag('td');
                       $pre_result.= $activitytype;
                       $pre_result.= html_writer::end_tag('td');

                       /*
 $pre_result.= html_writer::start_tag('td');
                       $pre_result.= sizeof($submissions);
                     $pre_result.= html_writer::end_tag('td');*/
                      
                        if (is_array($usergrade))
                        {
                            $usergrade = $usergrade[0];
                            
                            $pre_result .= html_writer::start_tag('td');
                            $pre_result.= $usergrade+0;
                          $pre_result.= html_writer::end_tag('td');
                            
                        }
                        elseif ($usergrade == false)
                        {
                            $usergrade = "Not graded";
                           
                             $pre_result.= html_writer::start_tag('td');
                           $pre_result.= $usergrade+0;
                            $pre_result.= html_writer::end_tag('td');
                           
                        }
$pre_result.= html_writer::start_tag('td');
                       $pre_result.= date('m/d/Y h:i:s', $check_latest_submitted_lab);
                       $pre_result.= html_writer::end_tag('td');
                       
                        $data.= html_writer::start_tag('tbody');
                        $data.= html_writer::end_tag('table');
                    }
                }

}

               

                break;
        }
    }

 echo  $pre_result; 
echo $data;
print <<<END
</div>
</div>



END;






//var_dump(grade_report_user_profilereport());
//var_dump($unavailableactivites);
echo $OUTPUT->footer();


?>
print <<<END
</div>
</div>
END;


/********************* END OF PREVIOUS REVIEW *********************/

