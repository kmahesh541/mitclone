<?php
require_once(dirname(__FILE__) . '/../../config.php');
require_once($CFG->libdir.'/phpmailer/class.phpmailer.php');
require_once($CFG->libdir.'/phpmailer/class.smtp.php');
require_once($CFG->libdir.'/gradelib.php');
require_once($CFG->dirroot.'/grade/querylib.php');
function getCompletedCourses()
{
global $DB;
$at= strtotime(date("m/d/Y"));

$sql="SELECT  DISTINCT(course)
FROM mdl_course_modules
WHERE  completionexpected <'".$at."'AND  completionexpected >0";
//echo $sql;
 $res=$DB->get_records_sql($sql);
return $res;
}
function getTeachersByCourse($courseId)
{
  $courses = get_courses();
                            $context = context_course::instance($courseId);//course id
   
                        $teachers = get_role_users(3, $context); //student context


foreach ($teachers as $teacher )
{
 $userobj = get_complete_user_data(id,  $teacher->id);
$teacher_email=  $userobj->email;

}

return $teacher_email;
}
function getStudentsByCourse($courseId)
{

$courses = get_courses();
            $context = context_course::instance($courseId);//course id
   
            $students = get_role_users(5, $context); //student context
                  return   $students ;

}
function getGrades($students,$courseId)
{
global $DB;
$at= strtotime(date("m/d/Y"));

$sql="SELECT  *
FROM mdl_course_modules
WHERE  course='".$courseId."' AND completionexpected >'".$at."'AND  completionexpected >0";
//echo $sql;
 $activities=$DB->get_records_sql($sql);
//var_dump($activities);
/*********************GETTING NAME OF COURSE ****************/
$course_sql="SELECT fullname
FROM mdl_course
WHERE  id='".$courseId."'";

$course_name=$DB->get_field_sql($course_sql);
$result="";
 foreach ($students as $student)
{



$totalgrade=0;
$coursegrade=0;

$userobj = get_complete_user_data(id,  $student->id);

$stuArr=array( 
'id'=>$student->id,
'rollno'=>$userobj->profile['rollno'],

'firstname'=> $userobj->firstname,


'rank'=>$userobj->profile['eamcetrank'],
'dept'=>$userobj->profile['dept'] ,
'section'=>$userobj->profile['section']
 );

 foreach ($activities as $act )
    {
        $module=$act->module;

        $instance=$act->instance;

        /**************GETTING act TYPE **********/
      $sql_act="SELECT name
FROM mdl_modules
WHERE id ='".$module."'";
 $act_res=$DB->get_record_sql($sql_act);
        $acttype= $act_res->name;

/********* GETTING act NAME************/

$act_name_sql="SELECT name
FROM mdl_".$acttype."
WHERE id ='". $instance."'AND course='".$courseId."'";

 $act_name=$DB->get_field_sql($act_name_sql);

        $grading_info=grade_get_grades($courseId, 'mod', $acttype,$instance, $student->id);
   
        $item = $grading_info->items[0];
        $gradeI= $item->grades[$student->id];
        $grade = $gradeI->grade ;

$stuArr['activityname']=$act_name;
$stuArr['activitygrade']=$grade;



        $totalgrade=$totalgrade+$grade;

}
if($totalgrade>0)
{
$coursegrade=$totalgrade/count($activities);
$coursegrade=$coursegrade+0.00;
}
$stuArr['coursename']=$course_name;
$stuArr['coursegrade']=$coursegrade;

$result[$student->id]=$stuArr;


    }
return $result;
}
function sendCustomMail($to ,$data)
{
$mail = new PHPMailer;

//$mail->SMTPDebug = 1;                               // Enable verbose debug output

$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'anusha.e@genesissol.in';                 // SMTP username
$mail->Password = 'srinivas@123';                           // SMTP password
$mail->SMTPAuth   = true;
$mail->SMTPSecure = "ssl";                          // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->From = 'anusha.e@genesissol.in';
$mail->FromName = 'ISEET';
$mail->addAddress($to, 'Joe User');     // Add a recipient
$mail->addAddress('anusha.e@genesissol.in');               // Name is optional
$mail->addReplyTo('admin@teleparadigm.com', 'Information');
$mail->addCC('eanusha@teleparadigm.com');
//$mail->addBCC('bcc@example.com');

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = date("m/d/Y").'    Report';
$mail->Body    = $data;
$mail->AltBody = 'Telepradigm Networks Pvt Ltd';


if(!$mail->send()) {
echo "hii";
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

}
function render($result)
{

$data="";
foreach ($result as $student)
{
$x=$student['activityname'];
echo "IMMM".$x;
//var_dump($student);
$data.="<tr><td>".$student['rollno']."</td>";

$data.= "<td>".$student['firstname'];

$data.="</td><td>".$student['rank'];
$data.="</td><td>".$student['dept'];
$data.="</td><td>".$student['section'];
$data.="</td><td>".$student['activityname'];
$data.="</td><td>".$student['activitygrade'];
$data.="</td><td>".$student['coursename']."</td><td>".$student['coursegrade']."</td></tr>";


}
return $data;
}
function getResults()
{



$result="<table><thead><tr>

<th>RollNo</th>
<th>FirstName</th>
<th>Rank</th>
<th>Dept</th>
<th>Section</th>
<th>ActivityName</th>
<th>ActivityGrade</th>
<th>Course Name</th>
<th>Course Grade</th></thead><tbody>";













$completed_courses=getCompletedCourses();
//$students=getStudentsByCourse("3");
//$grades=getGrades($students,"3");
//$data= render($grades);
//var_dump($data);
//$result.=$data;
//$result.="</tbody></table>";
//sendCustomMail($teacher_email ,$result);

foreach($completed_courses as $course)
{
$course_id= $course->course;

$teacher_email= getTeachersByCourse($course_id);
$students=getStudentsByCourse($course_id);
$grades=getGrades($students,$courseId);
$data= render($grades);
//var_dump($data);
$result.=$data;
$result.="</tbody></table>";
sendCustomMail($teacher_email ,$result);

}
}

getResults();
?>
