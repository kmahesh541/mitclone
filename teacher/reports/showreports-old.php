<?php

require_once(dirname(__FILE__) . '/../../config.php');
require_once($CFG->dirroot . '/my/lib.php');
/************* FOR REPORTS ***************/
require_once($CFG->dirroot.'/teacher/reports/reports_db.php');

function reportsBygrade()
{
    

    global $OUTPUT, $PAGE;
        $repObj=new custom_grade_report_db();

//$urlparams     =  required_param('value',0,PARAM_INT);
$processing    =   optional_param('processing',0,PARAM_INT);

$PAGE->set_context(context_system::instance());
$values =$_GET['values'];
 
$selected_values=explode("@",$values);
$dept=$_GET["dept"];
$section=$_GET["section"];
$grade_type=$_GET["gt"];
$watchlist=$_GET["wl"];
$rank=$_GET["rank"];

if($selected_values[3]=="both"&&empty($selected_values[1]))
{
$resultArr=getReports($values,$rank,$grade_type);


}
else if($selected_values[3]=="both"&&$selected_values[1]!="0")//by topic for all
{
$resultArr=getReports($values,$rank,$grade_type);

}

else if($selected_values[3]!="both"&&$selected_values[1]!="0")//activity type per course 
{

$courseId=$selected_values[0];
  $students=$repObj->getStudentsByCourse($courseId);
$resultArr=$repObj->getGradeByCourseActType($students,$courseId,$selected_values[3],$rank);

}

else if($selected_values[3]!="both"&&$selected_values[1]=="0")//activity type per course 
{

$courseId=$selected_values[0];
  $students=$repObj->getStudentsByCourse($courseId);
$resultArr=$repObj->getGradeByCourseActType($students,$courseId,$selected_values[3],$rank);

}
else if($selected_values[3]!="both"&&(!empty($selected_values[1])))
{
$courseId=$selected_values[0];
  $students=$repObj->getStudentsByCourse($courseId);
$resultArr=$repObj->getGradeByCourseSecActType($students,$courseId,$selected_values[1],$selected_values[3],$rank);

}

else{
 $resultArr=getReports($values,$rank,$grade_type);


}






if(strcasecmp($grade_type,"submitted")==0||strcasecmp($grade_type,"notsubmitted")==0)
{
  $grade_type="";
}
      
$total=count($resultArr);
$reultHtml=$repObj->renderOutput($resultArr,$dept
  ,$section,$grade_type,$watchlist);

   
      echo json_encode(array('html' => $reultHtml));
 }

function getReports($values ,$rank,$grade_type)
{
    $repObj=new custom_grade_report_db();

$selected_values = explode("@", $values);
 if($selected_values[0]!='0'&&empty($selected_values[1])&&empty($selected_values[2]) ){// Client Selected only Course
    $courseId=$selected_values[0];
  
      
$students=$repObj->getStudentsByCourse($courseId);
$resultArr=$repObj->getGradeByCourse($students,$courseId,$rank);
 //$report=html_writer::tag("h1","HIII");
}  
elseif ($selected_values[0]!='0'&&$selected_values[1]!='0'&&empty($selected_values[2]) ) {
// client selected course 

$students=$repObj->getStudentsByCourse($selected_values[0]);
$resultArr=$repObj->getGradeBySection($students,$selected_values[0],$selected_values[1],$rank);

  } 

   /*CLIENT SELECTED COURSE<TOPIC AND ACTIVTY*/
  elseif ($selected_values[0]!='0'&&$selected_values[1]!='0'&&$selected_values[2]!='0')
  {

    if(   strcasecmp($grade_type,"submitted")==0||strcasecmp($grade_type,"notsubmitted")==0)
{

  $students=$repObj->getStudentsByCourse($selected_values[0]);
$students=$repObj->studnetsBySubmission($students,$selected_values[0],$selected_values[2],$grade_type);

}
else{
  $students=$repObj->getStudentsByCourse($selected_values[0]);
}
//var_dump($students);

$resultArr=$repObj->getGradeByActivity($students,$selected_values[0],
   $selected_values[1],$selected_values[2],$rank);

  }
  else {
         $resultArr=html_writer::tag("h1","No Results Found");
             }
             return $resultArr;
}
reportsBygrade();
