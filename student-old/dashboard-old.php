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


$PAGE->set_url('/student/index.php');
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
/************************/
$jsarguments = array();

$jsmodule = array(
    'name'     	=> 'ilp_ajax_addnew',
    'fullpath' 	=> '/student/simpleajax_form.js',
    'requires'  	=> array('io','io-form', 'json-parse', 'json-stringify', 'json', 'base', 'node')
);

$PAGE->requires->js_init_call('M.simpleajax_form.init', $jsarguments, true, $jsmodule);
$PAGE->requires->css('/student/student-dashboard.css');
require_login();
echo $OUTPUT->header();
$meangrade=0;
//get student enrolled courses

//checking if the user is a student,then getting enrolled courses
if(user_has_role_assignment($USER->id, 5)){

    $enrolledcourses =enrol_get_users_courses($USER->id);
$no_courses=count($enrolledcourses);

$totalgrade=0;
    //var_dump($enrolledcourses);
    foreach($enrolledcourses as $key => $value){
        if(is_object($value)){
            $studentenrolledcourses[$value->id]=$value->fullname;
$c_grade = grade_get_course_grades($value->id, $USER->id);
//var_dump($resultkrb);
$grd = $c_grade->grades[$USER->id]; 
$grd=$grd->grade;
$totalgrade=$totalgrade+$grd;
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

print <<<END
<div class="container-fluid performance">
<div class="span12">
    <div class="span8">
    <h3 style="text-align:center;">Performance Snapshot</h3>
<table class="tbl">
    <thead>

        <tr>



            <th style='width: 5%;'>Course Name</th>
            <th style='width: 20%;'>Labs</th>
            <th style='width: 10%;'>Quiz</th>
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
   // var_dump($act);

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
    $html.="<a href='#'  class='tooltip'>
   
    <b>".$submittedlab."/".$countlabs."</b><span>Submitted(".$submittedlab."),Graded(".$gradedlabs."),Not Attempted(".$notattemptedlabs.")</span></a>";

    $html.=html_writer::end_tag('td');
    $html.=html_writer::start_tag('td',array('align'=>'center'));
    $countquiz=0;
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
    $html.="<a href='#'  class='tooltip'><b>".$submittedquiz."/".$countquiz."</b><span>Submitted(".$submittedquiz."),Graded(".$gradedquiz."),Not Attempted(".$notattemptedquiz."))</span></a>";

    $html.=html_writer::end_tag('td');
    $html.=html_writer::start_tag('td');
    $html.=$coursegrd;
    $html.=html_writer::end_tag('td');
    $html.=html_writer::end_tag('tr');
    $act=null;
}

echo $html;
/********************* GETTING COMPELETE PROFILE OF STUDENT **********/
$userobj=get_complete_user_data(id,$USER->id);
//var_dump($userobj);
print <<<END
  </tbody>

</table>
</div>
<div class="span4 student-left">


<div class="inner" >

				<div class="profile">
<h3 style="text-align: center;">
END;
echo $userobj->firstname ." " .$userobj->lastname;
print <<<END
</h3>

					<div class="rollno" style="width:65%;float: left;">


						<p>Roll Number: <b style="text-transform:Uppercase;">
END;
echo $userobj->profile['rollno'];
print <<<END
						</b> </p>


						<p>Watchlisted: <b style="text-transform:Uppercase;">5</b> Times</p>
						<p>Overall Grade: <b style="text-transform:Uppercase;">
END;
echo $meangrade;
print <<<END
                        </b></p>


					</div>
					<div class="details" style="width:35%;float: left;">
					<div class="propic">

END;
//loading User image
$imgsrc=$CFG->wwwroot."/user/pix.php/".$USER->id."/f1.jpg";
$html=html_writer::start_tag('img' ,array('src'=>$imgsrc,'class'=>'img-responsive',
'style'=>'height: 124px;width: 99px'
));
$html.=html_writer::end_tag('img');
echo $html;
print <<< END
</div>

					</div>

				</div>
			</div>
</div>
</div>
</div>
<div class="container-fluid todays-tests">
<div class="span12">
<h3>Today's Tests</h3>
END;
$html=html_writer::start_tag('input',array('type'=>'button','class'=>'click','value'=>'Refresh',
'data-url'=> $CFG->wwwroot . '/student/getactivetests.php'));
echo $html;
print <<<END
      <div id="accordion" style="width:100%">
END;

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


    }

echo $data;
/**************************************************START OF PREVIOUS REVIEW ***************/

print <<<END
<button class='showoldact'>Previous review</button>
<div class='container-fluid'>
<div class='span12 previousreview'>
END;

$data=html_writer::start_tag('h3');
$data.='Previous Reviews';
$data.=html_writer::end_tag('h3');
echo $data;
$today=strtotime("today");
$yesterday=strtotime("yesterday");
foreach($unavailableactivite as $activitytype => $activityid){

    foreach($activityid as $type => $arid){
        //var_dump($ar);
        foreach($arid as $coursenam => $courseid1){
            $ar=$courseid1;
            $ar1=$coursenam;
        }
        /* $data .=html_writer::start_tag('tr');
         $data .=html_writer::start_tag('th');
         $data .="Course Name:";
         $data .=html_writer::end_tag('th');
         $data .=html_writer::start_tag('th');
         $data .=$ar1;
         $data .=html_writer::end_tag('th');
         $data .=html_writer::end_tag('tr');
         $data .=html_writer::start_tag('tr');
         $data .=html_writer::start_tag('td');
         $data .="Activity Name:";
         $data .=html_writer::end_tag('td');
         $data .=html_writer::start_tag('td');
         $data .=$activitytype;
         $data .=html_writer::end_tag('td');
         $data .=html_writer::end_tag('tr');
        */
        switch($type){
            case 'quiz':
                $quizid=$DB->get_field_sql("SELECT `id`
FROM `mdl_quiz`
WHERE `course` ='$ar'
AND `name` = '$activitytype'");
                $maxgrade=$DB->get_field_sql("SELECT `grade`
FROM `mdl_quiz`
WHERE `course` ='$ar'
AND `name` = '$activitytype'");

                $attempts=$DB->get_fieldset_sql("SELECT `attempt`
FROM `mdl_quiz_attempts`
WHERE `quiz` ='$quizid'
AND `userid` ='$USER->id'");

                if(is_array($attempts))
                {
                    $check_latest_attemptted_quiz=0;
                    foreach($attempts as $atmpt){
                        if($check_latest_attemptted_quiz<$atmpt)
                            $check_latest_attemptted_quiz=$atmpt;

                    }
                    $check_quiz_date=$DB->get_field_sql("SELECT `timemodified`
FROM `mdl_quiz_attempts`
WHERE `quiz` ='$quizid'
AND `userid` ='$USER->id'
AND `attempt` ='$check_latest_attemptted_quiz'");
                    if($check_quiz_date <= $today  && $check_quiz_date >= $yesterday)
                        $valid=1;
                    if($valid==1){
                        $data="";
                        $grade=$DB->get_field_sql("SELECT `grade`
FROM `mdl_quiz_grades`
WHERE `quiz` ='$quizid'
AND `userid` ='$USER->id'");

                        if($grade!=''){
                            $data  =html_writer::start_tag('table');
                            $data .=html_writer::start_tag('tr');
                            $data .=html_writer::start_tag('th');
                            $data .="Course Name:";
                            $data .=html_writer::end_tag('th');
                            $data .=html_writer::start_tag('th');
                            $data .=$ar1;
                            $data .=html_writer::end_tag('th');
                            $data .=html_writer::end_tag('tr');
                            $data .=html_writer::start_tag('tr');
                            $data .=html_writer::start_tag('td');
                            $data .="Activity Name:";
                            $data .=html_writer::end_tag('td');
                            $data .=html_writer::start_tag('td');
                            $data .=$activitytype;
                            $data .=html_writer::end_tag('td');
                            $data .=html_writer::end_tag('tr');
                            $data .=html_writer::start_tag('tr');
                            $data .=html_writer::start_tag('td');
                            $data .="Grade:";
                            $data .=html_writer::end_tag('td');
                            $data .=html_writer::start_tag('td');
                            $data.=$grade." of ".$maxgrade;
                            $data .=html_writer::end_tag('td');
                            $data .=html_writer::end_tag('tr');
                            $data .=html_writer::start_tag('tr');
                            $data .=html_writer::start_tag('td');
                            $data .="Attempts:";
                            $data .=html_writer::end_tag('td');
                            $data .=html_writer::start_tag('td');
                            $data .=$attempts[0];
                            $data .=html_writer::end_tag('td');
                            $data .=html_writer::end_tag('tr');
                            $data.=html_writer::end_tag('table');
                            // var_dump($attempts);

                        }

                        elseif($attempts==''){
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
                else{
                    $data="";
                }


                break;
            case 'vpl':

                $getvplinstance=$DB->get_field_sql("SELECT `instance`
FROM `mdl_course_modules`
WHERE `id` ='$act1[$activitytype]'
AND `course` ='$ar'");
                //var_dump($ar);
                $submissions=$DB->get_fieldset_sql("SELECT  `datesubmitted`
FROM `mdl_vpl_submissions`
WHERE `vpl` ='$getvplinstance'
AND `userid` ='$USER->id'");
                if(is_array($submissions)){
                    $check_latest_submitted_lab=0;
                    foreach($submissions as $atmpt){
                        if($check_latest_submitted_lab<$atmpt)
                            $check_latest_submitted_lab=$atmpt;

                    }
                    if($check_latest_submitted_lab <= $today  && $check_latest_submitted_lab >= $yesterday)
                        $valid=1;
                    $usergrade=$DB->get_fieldset_sql("SELECT `grade`
FROM `mdl_vpl_submissions`
WHERE `vpl` ='$getvplinstance'
AND `userid` ='$USER->id'
ORDER BY `grade` DESC ");

                    if($valid==1){
                        $data =html_writer::start_tag('table');
                        $data .=html_writer::start_tag('tbody');
                        $data .=html_writer::start_tag('tr');
                        $data .=html_writer::start_tag('td');
                        $data .="Course name:";
                        $data .=html_writer::end_tag('td');
                        $data .=html_writer::start_tag('td');
                        $data .=$ar1;
                        $data .=html_writer::end_tag('td');
                        $data .=html_writer::end_tag('tr');
                        $data .=html_writer::start_tag('tr');
                        $data .=html_writer::start_tag('td');
                        $data .="Activity name:";
                        $data .=html_writer::end_tag('td');
                        $data .=html_writer::start_tag('td');
                        $data .=$activitytype;
                        $data .=html_writer::end_tag('td');
                        $data .=html_writer::end_tag('tr');
                        $data .=html_writer::start_tag('tr');
                        $data .=html_writer::start_tag('td');
                        $data .="Submissions:";
                        $data .=html_writer::end_tag('td');
                        $data .=html_writer::start_tag('td');
                        $data .=sizeof($submissions);
                        $data .=html_writer::end_tag('td');
                        $data .=html_writer::end_tag('tr');
                        if(is_array($usergrade)){
                            $usergrade=$usergrade[0];
                            //$data .=html_writer;
                            $data .=html_writer::start_tag('tr');
                            $data .=html_writer::start_tag('td');
                            $data .="Grade:";
                            $data .=html_writer::end_tag('td');
                            $data .=html_writer::start_tag('td');
                            $data .=$usergrade;
                            $data .=html_writer::end_tag('td');
                            $data .=html_writer::end_tag('tr');

                        }

                        elseif($usergrade==false){
                            $usergrade="Not graded";
                            $data .=html_writer::start_tag('tr');
                            $data .=html_writer::start_tag('td');
                            $data .="Grade:";
                            $data .=html_writer::end_tag('td');
                            $data .=html_writer::start_tag('td');
                            $data .=$usergrade;
                            $data .=html_writer::end_tag('td');
                            $data .=html_writer::end_tag('tr');

                        }


                        $data .=html_writer::start_tag('tbody');
                        $data.=html_writer::end_tag('table');

                    }

                }


               break;
        }




    }


}

echo $data;
print <<<END
</div>
</div>
END;


/********************* END OF PREVIOUS REVIEW *********************/


//var_dump(grade_report_user_profilereport());
//var_dump($unavailableactivites);
echo $OUTPUT->footer();


?>
<script>
 $( document ).ready(function() {
    
    $( ".showoldact" ).click(function() {
        $( ".previousreview" ).toggle();
    });
});
</script>
