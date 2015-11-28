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

print <<<END
<div class="container-fluid">
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
$grd = $grade_r->grades[$USER->id]; 
$grd=$grd->str_grade;

   // var_dump($activities);
    foreach($activities as $key1 => $value1){
        if(is_object($value1)){
            //if($value1->visible==true)
            $act[$value1->name]=$value1->mod;

        }
    }
   // var_dump($act);
    $countlabs=0;
    foreach($act as $key2 => $value2){
        if($value2=='vpl'){
            $countlabs=$countlabs+1;
        }
    }
    $html.=$countlabs;
    $html.=html_writer::end_tag('td');
    $html.=html_writer::start_tag('td',array('align'=>'center'));
    $countquiz=0;
    foreach($act as $key3 => $value3){
        if($value3=='quiz'){
            $countquiz=$countquiz+1;
        }
    }
    $html.=$countquiz;
    $html.=html_writer::end_tag('td');
    $html.=html_writer::start_tag('td');
    $html.=$grd;
    $html.=html_writer::end_tag('td');
    $html.=html_writer::end_tag('tr');
    $act=null;
}

echo $html;
print <<<END
  </tbody>

</table>
</div>
<div class="span4">


<div class="inner" >

				<div class="profile">

					<div class="rollno" style="width:65%;float: left;">

						<p>Roll Number: <b style="text-transform:Uppercase;">
END;
echo get_complete_user_data(id,$USER->id)->profile['rollno'];
print <<<END
						</b> </p>


						<p>Watchlisted: <b style="text-transform:Uppercase;">5</b> Times</p>
						<p>Overall Grade: <b style="text-transform:Uppercase;">A</b></p>


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
<div class="container-fluid">
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
                }

            }
            elseif($value1->visible==false){
                if (($value1->mod == 'vpl') || ($value1->mod == 'quiz')){
                    $unavailableactivites[$value1->name]=array($value1->mod => $value1->cm,$coursename
                    =>$courseid);
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
        foreach($activitytype as $key4 => $value4){$course=$value4;}
        $data .= $course;
        $data .=html_writer::end_tag('td');
        $data .=html_writer::start_tag('td',array('align'=>'center'));

        $data .= $activity;
        $data .=html_writer::end_tag('td');
        $data .=html_writer::start_tag('td',array('align'=>'center'));
        foreach($activitytype as $key4 => $value4){$activityname=$key4;}
        $data.=$activityname;
        $data .=html_writer::end_tag('td');
        $data .=html_writer::start_tag('td',array('align'=>'center'));

        $data .=html_writer::end_tag('td');
        $data .=html_writer::end_tag('tr');
        $data .=html_writer::start_tag('tr');
        $data .=html_writer::start_tag('td',array('colspan'=>'3'));
        $data .= "<b>Description:</b><br>";

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
        $data.=$descact;
        $data .=html_writer::end_tag('td');
        $data .=html_writer::start_tag('td');
        $data .=html_writer::start_tag('a',array('class'=>'taketest','value'=>'submit',
        'href'=>$CFG->wwwroot."/mod/".$activityname."/view.php?id=".$desc[$activity][$activityname]));
        $data .="Take Test";
        $data .=html_writer::end_tag('button');
        $data .=html_writer::end_tag('td');
        $data .=html_writer::end_tag('tr');
        $data .=html_writer::end_tag('tbody');
        $data .=html_writer::end_tag('table');
        $data .= html_writer::end_tag('div');


    }

echo $data;



//var_dump(grade_report_user_profilereport());
//var_dump($unavailableactivites);
echo $OUTPUT->footer();



