<?php
/*************** class for student dashboard *********************/

/**
* 
*/

require_once(dirname(__FILE__) . '/../config.php');

require_once($CFG->dirroot.'/grade/querylib.php');
require_once($CFG->dirroot . '/my/lib.php');
require_once($CFG->dirroot . '/grade/lib.php');

class StudentLib
{
	
	function getCourseGrade($studentId,$courseId)
	{
$resultkrb = grade_get_course_grades(4, $userid_or_ids=null);
var_dump($resultkb);
//$grd = $resultkrb->grades[$user->id]; 
//echo $grd->str_grade;
	}
}
echo"HIII";
$courseId=3;

$resultkrb = grade_get_course_grades($courseId, 4);
//var_dump($resultkrb);
$grd = $resultkrb->grades[4]; 
echo $grd->str_grade;
?>
