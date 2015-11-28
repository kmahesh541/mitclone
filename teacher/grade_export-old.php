<?php
require_once(dirname(__FILE__) . '/../config.php');
require_once($CFG->libdir.'/export_reports.php');
  require_once($CFG->dirroot . '/my/lib.php');
require_once($CFG->dirroot.'/teacher/reports/reports_db.php');

function reportsBygrade()
{
    

    global $OUTPUT, $PAGE, $DB;
        $repObj=new custom_grade_report_db();

//$urlparams     =  required_param('value',0,PARAM_INT);
$processing    =   optional_param('processing',0,PARAM_INT);

$PAGE->set_context(context_system::instance());
 $values =$_GET['values'];
 
$selected_values = explode("@", $values);

$dept=$_GET["dept"];
$section=$_GET["section"];
$grade_type=$_GET["gt"];
$watchlist=$_GET["wl"];
$rank=$_GET["rank"];

  $course_name=$DB->get_field_sql("SELECT `fullname`
FROM `mdl_course`
WHERE `id` ='$selected_values[0]'");
$values_for_export="<b>Course    ".  $course_name."</b><br/><br/>";

if(!empty($selected_values[1]))
{

   $topic_name=$DB->get_field_sql("SELECT `name`
FROM `mdl_course_sections`
WHERE `section` ='$selected_values[1]' AND `course` ='$selected_values[0]' ");
$values_for_export.="<b>Topic  ".$topic_name."</b><br/><br/>";
}
if(!empty($selected_values[2]))
{
 $act= explode("-", $selected_values[2]);
 $tabl_name="mdl_". $act[1];
 $act_name=$DB->get_field_sql("SELECT `name`
FROM `$tabl_name`
WHERE `id` = '$act[0]'");
$values_for_export.=" <b>Acivity ".$act_name."</b><br/><br/>";
}
if(!empty($grade_type))
{
$values_for_export.="<b>Grade Type".$grade_type."</b><br/>";
}
if($watchlist!='undefined')
{
$values_for_export.="<b>WatchList".$watchlist."</b><br/>";
}
if(!empty($rank))
{
//$values_for_export.="<b>Rank".$rank."</b>br/>";
}
if(!empty($dept))
{
$values_for_export.="<b>Department".$dept."</b><br/>";
}

if($selected_values[2]!=""||$selected_values[2]!="0")
{


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

}



else{
$resultArr=getReports($values,$rank,$grade_type);
}

if(strcasecmp($grade_type,"submitted")==0||strcasecmp($grade_type,"notsubmitted")==0)
{
  $grade_type="";
}
      

      

$reultHtml=$repObj->renderOutput($resultArr,$dept
  ,$section,$grade_type,$watchlist);
   
      return $values_for_export."#".$reultHtml;
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
//echo "con true";
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
$resultArr=$repObj->getGradeByActivity($students,$selected_values[0],
   $selected_values[1],$selected_values[2],$rank);

  }
  else {
         $resultArr=html_writer::tag("h1","No Results Found");
             }
             return $resultArr;
}

$res=reportsBygrade();

$export_data= explode("#", $res);
$data='<style>table {
    margin: 0px;
    padding: 0px;
    width: 100%;
    border: 1px solid #C4BABA;
} 
table tr{
     border-bottom: 2px solid #048AC2;
}
.head {
    background-color: #049CDB;
  
    color: #FFF;
}</style>';
$data.=$export_data[0];
$data.="<br/><br/><table   class=' generaltable resulttbl' id='tableData'><thead class='head'><tr>
                                   <th>Roll NO</th>
                                   <th>Full Name</th>
                                  <th>Grade</th>
                                   <th>Rank</th><th>Department</th><th>Section</th><th>Watchlist</th></tr></thead><tbody>";
$data.=$export_data[1];
//var_dump($export_data[1]);
$data.="</tbody></table>";
//echo $data;
$exportresult=new Export_Reports();
	$html =$data;
	$exportresult->report_download_pdf($html);

//echo json_encode(array('pdf' => $xx));
//echo "HIII";

?>
