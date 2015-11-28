
<?php

require_once(dirname(__FILE__) . '/../../config.php');
require_once($CFG->dirroot . '/my/lib.php');

require_once($CFG->dirroot.'/user/profile/lib.php');
require_once($CFG->libdir.'/gradelib.php');
require_once($CFG->dirroot.'/grade/querylib.php');
require_once($CFG->dirroot.'/mod/watchlist/lib.php');
//public class custom_reports 
 class custom_grade_report_db{
function renderOutput($resultObj,$dept,$section,$grade_type,$watchlist)
{
  //echo "Grade Type ".$grade_type;
  //echo "section ".$section;
 global $CFG;
$reult_html="";
foreach($resultObj as $student)
{
  //Client didnt select anything
  if(empty($dept)&&empty($grade_type)&&empty($section)&&$watchlist=='undefined'){

   
    $reult_html.="<tr><td> " . $student['rollno'] . "</td>
 <td> " . $student['firstname']. "</td>
 <td>".round($student['grade'],2)."</td>
<td> " . $student['rank'] . " </td>
<td> " . $student['dept'] . " </td>
<td> " . $student['section'] . " </td>

<td><img style='width:15px;' src='".$CFG->wwwroot."/teacher/testcenter/images/".$student['watchlist'].".png'/> </td></tr>";
   
  }

  // client selected only department

  if($dept!=''&&empty($grade_type)&&empty($section)&&$watchlist=='undefined'){

   if(strcasecmp($student['dept'] ,$dept)==0)
   {

    $reult_html.="<tr><td> " . $student['rollno'] . "</td>
 <td> " . $student['firstname']. "</td>
 <td>".$student['grade']."</td>
<td> " . $student['rank'] . " </td>
<td> " . $student['dept'] . " </td>
<td> " . $student['section'] . " </td>

<td><img style='width:15px;' src='".$CFG->wwwroot."/teacher/testcenter/images/".$student['watchlist'].".png'/> </td></tr>";
   }
  }
  if(empty($dept)&&(!empty($grade_type))&&empty($section)&&$watchlist=='undefined'){
if( strcasecmp($student['gt'] ,$grade_type)==0)
{
  
    $reult_html.="<tr><td> " . $student['rollno'] . "</td>

 <td> " . $student['firstname']. "</td>
 <td>".$student['grade']."</td>
<td> " . $student['rank'] . " </td>
<td> " . $student['dept'] . " </td>
<td> " . $student['section'] . " </td>

<td><img style='width:15px;' src='".$CFG->wwwroot."/teacher/testcenter/images/".$student['watchlist'].".png'/> </td></tr>";
   }
  }
// SELECTED ONLY WATCHLIST

  if(empty($dept)&&(empty($grade_type))&&empty($section)&&$watchlist!='undefined'){
   if($student['watchlist']==$watchlist)
   {

    $reult_html.="<tr><td> " . $student['rollno'] . "</td>
 <td> " . $student['firstname']. "</td>
 <td>".$student['grade']."</td>
<td> " . $student['rank'] . " </td>
<td> " . $student['dept'] . " </td>
<td> " . $student['section'] . " </td>

<td><img style='width:15px;' src='".$CFG->wwwroot."/teacher/testcenter/images/".$student['watchlist'].".png'/> </td></tr>";
   }
  }

// SELECTED ONLY section

  if(empty($dept)&&(empty($grade_type))&&!empty($section)&&$watchlist=='undefined'){
     if(strcasecmp($student['section'] ,$section)==0)

   {

    $reult_html.="<tr><td> " . $student['rollno'] . "</td>
 <td> " . $student['firstname']. "</td>
 <td>".$student['grade']."</td>
<td> " . $student['rank'] . " </td>
<td> " . $student['dept'] . " </td>
<td> " . $student['section'] . " </td>
<td> " . $student['section'] . " </td>

<td><img style='width:15px;' src='".$CFG->wwwroot."/teacher/testcenter/images/".$student['watchlist'].".png'/> </td></tr>";
   }
  }


/**************** IF HE SELECTS DEPT,GRADE TYPE,section AND WATCHLIST
************************************/
  if((!empty($dept))&&(!(empty($grade_type)))&&(!empty($section))&&$watchlist!='undefined'){
    
    if(
     strcasecmp($student['dept'] ,$dept)==0&&
     ($student['watchlist']==$watchlist)&&(
      strcasecmp($student['section'] ,$section)==0)&&
     strcasecmp($student['gt'] ,$grade_type)==0)

   {

    $reult_html.="<tr><td> " . $student['rollno'] . "</td>
 <td> " . $student['firstname']. "</td>
 <td>".$student['grade']."</td>
<td> " . $student['rank'] . " </td>
<td> " . $student['dept'] . " </td>
<td> " . $student['section'] . " </td>

<td><img style='width:15px;' src='".$CFG->wwwroot."/teacher/testcenter/images/".$student['watchlist'].".png'/> </td></tr>";
   }
  }
  /**************** IF HE SELECTS DEPT,GRADE TYPE
************************************/
  if((!empty($dept))&&(!(empty($grade_type)))&&(empty($section))&&$watchlist=='undefined'){
    
    if(
     strcasecmp($student['dept'] ,$dept)==0&&

     strcasecmp($student['gt'] ,$grade_type)==0)

   {

    $reult_html.="<tr><td> " . $student['rollno'] . "</td>
 <td> " . $student['firstname']. "</td>
 <td>".$student['grade']."</td>
<td> " . $student['rank'] . " </td>
<td> " . $student['dept'] . " </td>
<td> " . $student['section'] . " </td>

<td><img style='width:15px;' src='".$CFG->wwwroot."/teacher/testcenter/images/".$student['watchlist'].".png'/> </td></tr>";
   }
  }
  /**************** IF HE SELECTS DEPT,GRADE TYPE,section 
************************************/
  if((!empty($dept))&&(!(empty($grade_type)))&&(!empty($section))&&$watchlist=='undefined'){
    
    if(
     strcasecmp($student['dept'] ,$dept)==0&&(
      strcasecmp($student['section'] ,$section)==0)&&
     strcasecmp($student['gt'] ,$grade_type)==0)

   {

    $reult_html.="<tr><td> " . $student['rollno'] . "</td>
 <td> " . $student['firstname']. "</td>
 <td>".$student['grade']."</td>
<td> " . $student['rank'] . " </td>
<td> " . $student['dept'] . " </td>
<td> " . $student['section'] . " </td>

<td><img style='width:15px;' src='".$CFG->wwwroot."/teacher/testcenter/images/".$student['watchlist'].".png'/> </td></tr>";
   }
  }
/**************** IF HE SELECTS DEPT AND section 
************************************/
  if((!empty($dept))&&(empty($grade_type))&&(!empty($section))&&$watchlist=='undefined'){
    
    if(
     strcasecmp($student['dept'] ,$dept)==0&&
     
      (strcasecmp($student['section'] ,$section)==0))

   {

    $reult_html.="<tr><td> " . $student['rollno'] . "</td>
 <td> " . $student['firstname']. "</td>
 <td>".$student['grade']."</td>
<td> " . $student['rank'] . " </td>
<td> " . $student['dept'] . " </td>
<td> " . $student['section'] . " </td>

<td><img style='width:15px;' src='".$CFG->wwwroot."/teacher/testcenter/images/".$student['watchlist'].".png'/> </td></tr>";
   }
  }
/**************** IF HE SELECTS DEPT AND WATCHLIST
************************************/
  if((!empty($dept))&&(empty($grade_type))&&empty($section)&&$watchlist!='undefined'){
    
    if(
     strcasecmp($student['dept'] ,$dept)==0&&(
    $watchlist==$student['watchlist']))

   {

    $reult_html.="<tr><td> " . $student['rollno'] . "</td>
 <td> " . $student['firstname']. "</td>
 <td>".$student['grade']."</td>
<td> " . $student['rank'] . " </td>
<td> " . $student['dept'] . " </td>
<td> " . $student['section'] . " </td>

<td><img style='width:15px;' src='".$CFG->wwwroot."/teacher/testcenter/images/".$student['watchlist'].".png'/> </td></tr>";
   }
  }
/**************** IF HE SELECTS DEPT,GRADE TYPE AND WATCHLIST
************************************/
  if((!empty($dept))&&(!(empty($grade_type)))&&empty($section)&&$watchlist!='undefined'){
    
    if(
     strcasecmp($student['dept'] ,$dept)==0&&
     ($student['watchlist']==$watchlist)&&
     strcasecmp($student['gt'] ,$grade_type)==0)

   {

    $reult_html.="<tr><td> " . $student['rollno'] . "</td>
 <td> " . $student['firstname']. "</td>
 <td>".$student['grade']."</td>
<td> " . $student['rank'] . " </td>
<td> " . $student['dept'] . " </td>
<td> " . $student['section'] . " </td>

<td><img style='width:15px;' src='".$CFG->wwwroot."/teacher/testcenter/images/".$student['watchlist'].".png'/> </td></tr>";
   }
  }
/**************** IF HE SELECTS GRADE TYPE,section AND WATCHLIST
************************************/
  if((empty($dept))&&(!(empty($grade_type)))&&(!empty($section))&&$watchlist!='undefined'){
    
    if(
          ($student['watchlist']==$watchlist)&&(
      strcasecmp($student['section'] ,$section)==0)&&
     strcasecmp($student['gt'] ,$grade_type)==0)

   {

    $reult_html.="<tr><td> " . $student['rollno'] . "</td>
 <td> " . $student['firstname']. "</td>
 <td>".$student['grade']."</td>
<td> " . $student['rank'] . " </td>
<td> " . $student['dept'] . " </td>
<td> " . $student['section'] . " </td>

<td><img style='width:15px;' src='".$CFG->wwwroot."/teacher/testcenter/images/".$student['watchlist'].".png'/> </td></tr>";
   }
  }

/**************** IF HE SELECTS GRADE TYPE AND WATCHLIST
************************************/
  if((empty($dept))&&(!(empty($grade_type)))&&(empty($section))&&$watchlist!='undefined'){
    
    if(
          ($student['watchlist']==$watchlist)&&
     strcasecmp($student['gt'] ,$grade_type)==0)

   {

    $reult_html.="<tr><td> " . $student['rollno'] . "</td>
 <td> " . $student['firstname']. "</td>
 <td>".$student['grade']."</td>
<td> " . $student['rank'] . " </td>
<td> " . $student['dept'] . " </td>
<td> " . $student['section'] . " </td>

<td><img style='width:15px;' src='".$CFG->wwwroot."/teacher/testcenter/images/".$student['watchlist'].".png'/> </td></tr>";
   }
  }
/**************** IF HE SELECTS section AND WATCHLIST
************************************/
  if((empty($dept))&&(empty($grade_type))&&(!empty($section))&&$watchlist!='undefined'){
    
    if(
      $student['watchlist']==$watchlist&&(
      strcasecmp($student['section'] ,$section)==0))

   {

    $reult_html.="<tr><td> " . $student['rollno'] . "</td>
 <td> " . $student['firstname']. "</td>
 <td>".$student['grade']."</td>
<td> " . $student['rank'] . " </td>
<td> " . $student['dept'] . " </td>
<td> " . $student['section'] . " </td>

<td><img style='width:15px;' src='".$CFG->wwwroot."/teacher/testcenter/images/".$student['watchlist'].".png'/> </td></tr>";
   }
  }
/**************** IF HE SELECTS DEPT,section AND WATCHLIST
************************************/
  if((!empty($dept))&&(empty($grade_type))&&(!empty($section))&&$watchlist!='undefined'){
    
    if(
     strcasecmp($student['dept'] ,$dept)==0&&
     ($student['watchlist']==$watchlist)&&(
      strcasecmp($student['section'] ,$section)==0))

   {

    $reult_html.="<tr><td> " . $student['rollno'] . "</td>
 <td> " . $student['firstname']. "</td>
 <td>".$student['grade']."</td>
<td> " . $student['rank'] . " </td>
<td> " . $student['dept'] . " </td>
<td> " . $student['dept'] . " </td>
<td> " . $student['section'] . " </td>

<td><img style='width:15px;' src='".$CFG->wwwroot."/teacher/testcenter/images/".$student['watchlist'].".png'/> </td></tr>";
   }
  }
}
return $reult_html;
}
/*----------------------------------------------------------------------------render end--------------------------------*/
function getStudentsByCourse($courseId)
{
           
           //$courses = get_courses();
           //$context = get_context_instance(CONTEXT_COURSE, 3);//course id

                            $courses = get_courses();
                            $context = context_course::instance($courseId);//course id
                            $students = get_role_users(5, $context); //student context
            return   $students;
}
function getStudentsInfo($courseId)
{
  global $DB;  
               
$query="SELECT u.id AS userid,
        MAX(CASE WHEN f.shortname = 'dept' THEN d.data ELSE '' END) AS dept,
        MAX(CASE WHEN f.shortname = 'rank' THEN d.data ELSE '' END) AS rank,
MAX(CASE WHEN f.shortname = 'watchlist' THEN d.data ELSE '' END) AS watchlist,
MAX(CASE WHEN f.shortname = 'section' THEN d.data ELSE '' END) AS section

FROM mdl_user u
JOIN mdl_role_assignments ra ON ra.userid = u.id
JOIN mdl_role r ON r.id = ra.roleid AND r.shortname =  'student'
JOIN mdl_user_info_data d ON d.userid = u.id
JOIN mdl_user_info_field f ON d.fieldid = f.id
GROUP BY u.id";
$results= $DB->get_records_sql($query);
return $results;
}

/*************************************************GET GRADE FOR  ACIVITY TYPE  UNDER COURSES ****************************/



function getGradeByCourseActType($students,$courseId,$acttype,$rank)
 {
 global $DB,$CFG;  
               
 
$mods=$DB->get_records_sql("SELECT *
   FROM `mdl_course_modules`
   WHERE `course` = $courseId" );



 $result=array();
                                 //    var_dump($students);
                        foreach ($students as $student) 
                        {


$watchlist=getStatus($student->id,$courseId);
if(empty($watchlist)){
$watchlist=0;
}
                    
$grade="";
$i=0;
foreach ($mods as $act) 
                        {

$module= $act->module;
$instance= $act->instance;

$modname= $DB->get_field_sql("SELECT `name`
   FROM `mdl_modules`
   WHERE `id`=$module");

 if(strcasecmp($acttype,$modname)==0)
{

$i=$i+1;
$grading_info=grade_get_grades($courseId, 'mod', $modname,$instance, $student->id);
//var_dump($grading_info);
 $item = $grading_info->items[0];
$gradeI= $item->grades[$student->id];

     
      $grade1 = $gradeI->grade ;
$grade =$grade +$grade1;

}

} 

if($grade>=0&&$i>0)
{
$grade=$grade/$i;
}   
//echo "gr".$grade;




                      
                   
                                            $userobj = get_complete_user_data(id, $student->id);

                                                          /*******************geting students only based on rank
      **************************************************/
if(empty($userobj->profile['rollno']))
$userobj->profile['rollno']="--";
else
$userobj->profile['rollno']="<a href=" . $CFG->wwwroot . '/teacher/student_profile.php?sid=' . $student->id . ">" . $userobj->profile['rollno'] . "</a>";
if(empty($userobj->firstname))
$userobj->firstname="--";
else
$userobj->firstname="<a href=" . $CFG->wwwroot . '/teacher/student_profile.php?sid=' . $student->id . ">" .$userobj->firstname . "</a>";

if(empty($userobj->profile['eamcetrank']))
$userobj->profile['eamcetrank']="--";
if(empty($userobj->profile['dept']))
$userobj->profile['dept']="--";
if(empty($userobj->profile['section']))
$userobj->profile['section']="--";




                                            if($rank==""){//if he didnt select rank
                                                                    if ($grade=="0"||$grade=="") {

                                                            // $result['a']="hii";



$result[$student->id]=array( 'rollno'=>

$userobj->profile['rollno'],

'firstname'=> $userobj->firstname,
'grade'=>"No grade",
'gt'=>"notgraded",

'rank'=>$userobj->profile['eamcetrank'],
'dept'=>$userobj->profile['dept'] ,
'section'=>$userobj->profile['section'] ,

'watchlist'=>$watchlist );

                                 }                    
 else
                                                      {
//$result['b']="hii";

$result[$student->id]=array( 'rollno'=>$userobj->profile['rollno'],
'firstname'=> $userobj->firstname,
'grade'=>  $grade ,
'gt'=>"graded",
'rank'=>$userobj->profile['eamcetrank'],

'dept'=>$userobj->profile['dept'] ,
'section'=>$userobj->profile['section'] ,

'watchlist'=>$watchlist);

                                                      }
                                                                                             
                        
                                                        
                                     
                        
                                            }
                                            else
                                              //selects a rank range
                                            {
                                            $rankArr= explode(":", $rank);
                                       //     echo "1".$rankArr[0];
for ($i=1;$i<count($rankArr);$i++)
{
  //echo "Range".$rankArr[$i];
 $rankRange=explode("-", $rankArr[$i]);
  $r=$userobj->profile['eamcetrank'];
if($rankRange[1]=='above')
{
$con=$r>=$rankRange[0];
}
else
{
$con=($r>=$rankRange[0])&&($r<=$rankRange[1]);
}
  if($con) // true
  {
                                                if (  $grade ==null||$grade=="") {

                                                            // $result['a']="hii";


$result[$student->id]=array( 'rollno'=>$userobj->profile['rollno'],

'firstname'=> $userobj->firstname,
'grade'=>"No grade",
'gt'=>"notgraded",

'rank'=>$userobj->profile['eamcetrank'],
'dept'=>$userobj->profile['dept'] ,
'section'=>$userobj->profile['section'] ,

'watchlist'=>$watchlist );

                                 }                    
 else
                                                      {
//$result['b']="hii";

$result[$student->id]=array( 'rollno'=>$userobj->profile['rollno'],
'firstname'=> $userobj->firstname,
'grade'=>  $grade ,
'gt'=>"graded",
'rank'=>$userobj->profile['eamcetrank'],

'dept'=>$userobj->profile['dept'] ,
'section'=>$userobj->profile['section'] ,

'watchlist'=>$watchlist );

                                                      }
                                                                                             
                        
                                                        
                                     
                        }
                        }}
                        }



return $result;
}

/*************************************************GET GRADE FOR  ACTIVITY TYPE UNDER TOPIC ****************************/

function getGradeByCourseSecActType($students,$courseId,$topic,$acttype,$rank)
 {
 global $DB,$CFG;  
               
    
   $query=  "SELECT *
   FROM `mdl_course_modules`
   WHERE `course` = $courseId AND `section` = $topic";          
 
$mods=$DB->get_records_sql( $query);



 $result=array();
                               
                        foreach ($students as $student) 
                        {


$watchlist=getStatus($student->id,$courseId);
if(empty($watchlist)){
$watchlist=0;
}
  $i=0;                  
$grade="";
foreach ($mods as $act) 
                        {

$module= $act->module;
$instance= $act->instance;

$modname= $DB->get_field_sql("SELECT `name`
   FROM `mdl_modules`
   WHERE `id`=$module");
if($acttype==$modname)
{
$i=$i+1;
$grading_info=grade_get_grades($courseId, 'mod', $modname,$instance, $student->id);
//var_dump($grading_info);
 $item = $grading_info->items[0];
$gradeI= $item->grades[$student->id];
$grade1 = $gradeI->grade ;
$grade =$grade +$grade1;

}

}      
if($grade>0)
{
$grade=$grade/$i;
}   


                      
                   
                                            $userobj = get_complete_user_data(id, $student->id);


if(empty($userobj->profile['rollno']))
$userobj->profile['rollno']="--";
else
$userobj->profile['rollno']="<a href=" . $CFG->wwwroot . '/teacher/student_profile.php?sid=' . $student->id . ">" . $userobj->profile['rollno'] . "</a>";
if(empty($userobj->firstname))
$userobj->firstname="--";
else
$userobj->firstname="<a href=" . $CFG->wwwroot . '/teacher/student_profile.php?sid=' . $student->id . ">" .$userobj->firstname . "</a>";

if(empty($userobj->profile['eamcetrank']))
$userobj->profile['eamcetrank']="--";
if(empty($userobj->profile['dept']))
$userobj->profile['dept']="--";
if(empty($userobj->profile['section']))
$userobj->profile['section']="--";

                                                          /*******************geting students only based on rank
      **************************************************/

                                            if($rank==""){//if he didnt select rank
                                                                    if ($grade=="") {

                                                            // $result['a']="hii";


$result[$student->id]=array( 'rollno'=>$userobj->profile['rollno'],

'firstname'=> $userobj->firstname,
'grade'=>"No grade",
'gt'=>"notgraded",

'rank'=>$userobj->profile['eamcetrank'],
'dept'=>$userobj->profile['dept'] ,
'section'=>$userobj->profile['section'] ,

'watchlist'=>$watchlist );

                                 }                    
 else
                                                      {
//$result['b']="hii";

$result[$student->id]=array( 'rollno'=>$userobj->profile['rollno'],
'firstname'=> $userobj->firstname,
'grade'=>  $grade ,
'gt'=>"graded",
'rank'=>$userobj->profile['eamcetrank'],

'dept'=>$userobj->profile['dept'] ,
'section'=>$userobj->profile['section'] ,

'watchlist'=>$watchlist);

                                                      }
                                                                                             
                        
                                                        
                                     
                        
                                            }
                                            else
                                              //selects a rank range
                                            {
                                            $rankArr= explode(":", $rank);
                                       //     echo "1".$rankArr[0];
for ($i=1;$i<count($rankArr);$i++)
{
  //echo "Range".$rankArr[$i];
 $rankRange=explode("-", $rankArr[$i]);
  $r=$userobj->profile['eamcetrank'];
if($rankRange[1]=='above')
{
$con=$r>=$rankRange[0];
}
else
{
$con=($r>=$rankRange[0])&&($r<=$rankRange[1]);
}
  if($con) // true
  {
                                                if (  $grade ==null||$grade=="") {

                                                            // $result['a']="hii";


$result[$student->id]=array( 'rollno'=>$userobj->profile['rollno'],

'firstname'=> $userobj->firstname,
'grade'=>"No grade",
'gt'=>"notgraded",

'rank'=>$userobj->profile['eamcetrank'],
'dept'=>$userobj->profile['dept'] ,
'section'=>$userobj->profile['section'] ,

'watchlist'=>$watchlist );

                                 }                    
 else
                                                      {
//$result['b']="hii";

$result[$student->id]=array( 'rollno'=>$userobj->profile['rollno'],
'firstname'=> $userobj->firstname,
'grade'=>  $grade ,
'gt'=>"graded",
'rank'=>$userobj->profile['eamcetrank'],

'dept'=>$userobj->profile['dept'] ,
'section'=>$userobj->profile['section'] ,

'watchlist'=>$watchlist );

                                                      }
                                                                                             
                        
                                                        
                                     
                        }
                        }}
                        }



return $result;
}


function getGradeByCourse($students,$courseId,$rank)
 {

           global $DB,$CFG;  
               
             
                        $result= array( );
                                 //    var_dump($students);
                        foreach ($students as $student) 
                        {
                            
                      

$grade_r = grade_get_course_grades($courseId, $student->id);
//var_dump($resultkrb);
$grd = $grade_r->grades[$student->id]; 
$grd=$grd->grade;

$watchlist=getStatus($student->id,$courseId);
if(empty($watchlist)){
$watchlist=0;
}
                                          
                                            $userobj = get_complete_user_data(id, $student->id);

if(empty($userobj->profile['rollno']))
$userobj->profile['rollno']="--";
else
$userobj->profile['rollno']="<a href=" . $CFG->wwwroot . '/teacher/student_profile.php?sid=' . $student->id . ">" . $userobj->profile['rollno'] . "</a>";
if(empty($userobj->firstname))
$userobj->firstname="--";
else
$userobj->firstname="<a href=" . $CFG->wwwroot . '/teacher/student_profile.php?sid=' . $student->id . ">" .$userobj->firstname . "</a>";

if(empty($userobj->profile['eamcetrank']))
$userobj->profile['eamcetrank']="--";
if(empty($userobj->profile['dept']))
$userobj->profile['dept']="--";
if(empty($userobj->profile['section']))
$userobj->profile['section']="--";


      /*******************geting students only based on rank
      **************************************************/

                                            if(empty($rank)){//if he didnt select rank
                                                if ($grd==null||$grd=="") {

                                                            // $result['a']="hii";

$result[$student->id]=array( 'rollno'=>$userobj->profile['rollno'],

'firstname'=> $userobj->firstname,
'grade'=>"No grade",
'gt'=>"notgraded",

'rank'=>$userobj->profile['eamcetrank'],
'dept'=>$userobj->profile['dept'] ,
'section'=>$userobj->profile['section'] ,

'watchlist'=>$watchlist );

                                 }                    
 else
                                                      {
//$result['b']="hii";

$result[$student->id]=array( 'rollno'=>$userobj->profile['rollno'],
'firstname'=> $userobj->firstname,
'grade'=>$grd+0,
'gt'=>"graded",
'rank'=>$userobj->profile['eamcetrank'],

'dept'=>$userobj->profile['dept'] ,
'section'=>$userobj->profile['section'] ,

'watchlist'=>$watchlist);

                                                      }
                                                                                             
                        
                                                        
                                     
                        
                                            }
                                            else
                                              //selects a rank range
                                            {
                                            $rankArr= explode(":", $rank);
for ($i=1;$i<count($rankArr);$i++)
{
 $rankRange=explode("-", $rankArr[$i]);
  $r=$userobj->profile['eamcetrank'];
if($rankRange[1]=='above')
{
$con=$r>=$rankRange[0];
}
else
{
$con=($r>=$rankRange[0])&&($r<=$rankRange[1]);
}
  if($con) // true
  {
                                                if ($grd==null||$grd=="") {

                                                            // $result['a']="hii";


$result[$student->id]=array( 'rollno'=>$userobj->profile['rollno'],

'firstname'=> $userobj->firstname,
'grade'=>"No grade",
'gt'=>"notgraded",

'rank'=>$userobj->profile['eamcetrank'],
'dept'=>$userobj->profile['dept'] ,
'section'=>$userobj->profile['section'] ,

'watchlist'=>$watchlist );

                                 }                    
 else
                                                      {
//$result['b']="hii";

$result[$student->id]=array( 'rollno'=>$userobj->profile['rollno'],
'firstname'=> $userobj->firstname,
'grade'=>$grd+0,
'gt'=>"graded",
'rank'=>$userobj->profile['eamcetrank'],

'dept'=>$userobj->profile['dept'] ,
'section'=>$userobj->profile['section'] ,

'watchlist'=>$watchlist );

                                                      }
                                                                                             
                        
                                                        
                                     
                        }
                        }}
                        }
                         return $result;
}
function getGradeByActivity($students,$courseId,$sectionId,$actvalues,$rank)
 {

           $actValues=explode("-", $actvalues);
           global $DB,$CFG;  
               
                                     $result=array();
                                 //    var_dump($students);
                        foreach ($students as $student) 
                        {


$watchlist=getStatus($student->id,$courseId);
if(empty($watchlist)){
$watchlist=0;
}
                          $grading_info=grade_get_grades($courseId, 'mod', $actValues[1],$actValues[0], $student->id);
//var_dump($grading_info);
 $item = $grading_info->items[0];
$gradeI= $item->grades[$student->id];

      $grade = $gradeI->grade ;
                      
                   
                                            $userobj = get_complete_user_data(id, $student->id);
if(empty($userobj->profile['rollno']))
$userobj->profile['rollno']="--";
else
$userobj->profile['rollno']="<a href=" . $CFG->wwwroot . '/teacher/student_profile.php?sid=' . $student->id . ">" . $userobj->profile['rollno'] . "</a>";
if(empty($userobj->firstname))
$userobj->firstname="--";
else
$userobj->firstname="<a href=" . $CFG->wwwroot . '/teacher/student_profile.php?sid=' . $student->id . ">" .$userobj->firstname . "</a>";

if(empty($userobj->profile['eamcetrank']))
$userobj->profile['eamcetrank']="--";
if(empty($userobj->profile['dept']))
$userobj->profile['dept']="--";
if(empty($userobj->profile['section']))
$userobj->profile['section']="--";
                                                          /*******************geting students only based on rank
      **************************************************/

                                            if($rank==""){//if he didnt select rank
                                                                    if ($grade=="0"||$grade=="") {

                                                            // $result['a']="hii";


$result[$student->id]=array( 'rollno'=>$userobj->profile['rollno'],

'firstname'=> $userobj->firstname,
'grade'=>"No grade",
'gt'=>"notgraded",

'rank'=>$userobj->profile['eamcetrank'],
'dept'=>$userobj->profile['dept'] ,
'section'=>$userobj->profile['section'] ,

'watchlist'=>$watchlist );

                                 }                    
 else
                                                      {
//$result['b']="hii";

$result[$student->id]=array( 'rollno'=>$userobj->profile['rollno'],
'firstname'=> $userobj->firstname,
'grade'=>  $grade ,
'gt'=>"graded",
'rank'=>$userobj->profile['eamcetrank'],

'dept'=>$userobj->profile['dept'] ,
'section'=>$userobj->profile['section'] ,

'watchlist'=>$watchlist);

                                                      }
                                                                                             
                        
                                                        
                                     
                        
                                            }
                                            else
                                              //selects a rank range
                                            {
                                            $rankArr= explode(":", $rank);
                                       //     echo "1".$rankArr[0];
for ($i=1;$i<count($rankArr);$i++)
{
  //echo "Range".$rankArr[$i];
 $rankRange=explode("-", $rankArr[$i]);
  $r=$userobj->profile['eamcetrank'];
if($rankRange[1]=='above')
{
$con=$r>=$rankRange[0];
}
else
{
$con=($r>=$rankRange[0])&&($r<=$rankRange[1]);
}
  if($con) // true
  {
                                                if (  $grade ==null||$grade=="") {

                                                            // $result['a']="hii";


$result[$student->id]=array( 'rollno'=>$userobj->profile['rollno'],

'firstname'=> $userobj->firstname,
'grade'=>"No grade",
'gt'=>"notgraded",

'rank'=>$userobj->profile['eamcetrank'],
'dept'=>$userobj->profile['dept'] ,
'section'=>$userobj->profile['section'] ,

'watchlist'=>$watchlist );

                                 }                    
 else
                                                      {
//$result['b']="hii";

$result[$student->id]=array( 'rollno'=>$userobj->profile['rollno'],
'firstname'=> $userobj->firstname,
'grade'=>  $grade ,
'gt'=>"graded",
'rank'=>$userobj->profile['eamcetrank'],

'dept'=>$userobj->profile['dept'] ,
'section'=>$userobj->profile['section'] ,

'watchlist'=>$watchlist );

                                                      }
                                                                                             
                        
                                                        
                                     
                        }
                        }}
                        }
                                                        
                                     
                        
                        
                         return $result;
}
/************************************************************************************************
************GARDE BY section *******************************************************************/
function getGradeBySection($students,$courseId,$sectionId,$rank)
 {
          
           global $DB,$CFG;  

             
                                     $result=array();


/*$query="SELECT sequence
FROM mdl_course_sections WHERE course='".$courseId."' AND section ='".$sectionId."'";*/
$query="SELECT *
FROM mdl_course_modules WHERE course='".$courseId."' AND section ='".$sectionId."'";
 $persection=$DB->get_records_sql($query);

    

foreach ($students as $student) 
                        {
$grade=0;
$i=0;
    foreach($persection as $item){
$i=$i+1;

$instance=$item->instance;
 $moduleId=$item->module;
        
        
        $modname= $DB->get_field_sql("SELECT `name`
   FROM `mdl_modules`
   WHERE `id`=$moduleId");
     $q1="SELECT name
FROM mdl_modules WHERE id='".$moduleId."'"; 

 $modname= $DB->get_field_sql($q1);


$grading_info=grade_get_grades($courseId, 'mod',  $modname, $instance,$student->id);


//var_dump($grading_info);
 $item1 = $grading_info->items[0];
//var_dump($item1);
$grade1= $item1->grades[$student->id];

$stug=$grade1->grade+0;
//echo $stug;
      $grade =$grade+ $stug ;

}
$watchlist=getStatus($student->id,$courseId);
if(empty($watchlist)){
$watchlist=0;
}  

if($grade>0)
{
$grade=$grade/$i;
}                           
  $grade=$grade+0.00;


  $userobj = get_complete_user_data(id, $student->id);
if(empty($userobj->profile['rollno']))
$userobj->profile['rollno']="--";
else
$userobj->profile['rollno']="<a href=" . $CFG->wwwroot . '/teacher/student_profile.php?sid=' . $student->id . ">" . $userobj->profile['rollno'] . "</a>";
if(empty($userobj->firstname))
$userobj->firstname="--";
else
$userobj->firstname="<a href=" . $CFG->wwwroot . '/teacher/student_profile.php?sid=' . $student->id . ">" .$userobj->firstname . "</a>";

if(empty($userobj->profile['eamcetrank']))
$userobj->profile['eamcetrank']="--";
if(empty($userobj->profile['dept']))
$userobj->profile['dept']="--";
if(empty($userobj->profile['section']))
$userobj->profile['section']="--";                                        /*******************geting students only based on rank
      **************************************************/

                                            if($rank==""){//if he didnt select rank
                                                                    if ($grade=="0"||$grade=="") {

                                                            // $result['a']="hii";


$result[$student->id]=array( 'rollno'=>$userobj->profile['rollno'],

'firstname'=> $userobj->firstname,
'grade'=>"No grade",
'gt'=>"notgraded",

'rank'=>$userobj->profile['eamcetrank'],
'dept'=>$userobj->profile['dept'] ,
'section'=>$userobj->profile['section'] ,

'watchlist'=>$watchlist );

                                 }                    
 else
                                                      {
//$result['b']="hii";

$result[$student->id]=array( 'rollno'=>$userobj->profile['rollno'],
'firstname'=> $userobj->firstname,
'grade'=>  $grade ,
'gt'=>"graded",
'rank'=>$userobj->profile['eamcetrank'],

'dept'=>$userobj->profile['dept'] ,
'section'=>$userobj->profile['section'] ,

'watchlist'=>$watchlist);

                                                      }
                                                                                             
                        
                                                        
                                     
                        
                                            }
                                            else
                                              //selects a rank range
                                            {
                                            $rankArr= explode(":", $rank);
                                       //     echo "1".$rankArr[0];
for ($i=1;$i<count($rankArr);$i++)
{
  //echo "Range".$rankArr[$i];
 $rankRange=explode("-", $rankArr[$i]);
  $r=$userobj->profile['eamcetrank'];
if($rankRange[1]=='above')
{
$con=$r>=$rankRange[0];
}
else
{
$con=($r>=$rankRange[0])&&($r<=$rankRange[1]);
}
  if($con) // true
  {
                                                if (  $grade ==null||$grade=="") {

                                                            // $result['a']="hii";


$result[$student->id]=array( 'rollno'=>$userobj->profile['rollno'],

'firstname'=> $userobj->firstname,
'grade'=>"No grade",
'gt'=>"notgraded",

'rank'=>$userobj->profile['eamcetrank'],
'dept'=>$userobj->profile['dept'] ,
'section'=>$userobj->profile['section'] ,

'watchlist'=>$watchlist );

                                 }                    
 else
                                                      {
//$result['b']="hii";

$result[$student->id]=array( 'rollno'=>$userobj->profile['rollno'],
'firstname'=> $userobj->firstname,
'grade'=>  $grade ,
'gt'=>"graded",
'rank'=>$userobj->profile['eamcetrank'],

'dept'=>$userobj->profile['dept'] ,
'section'=>$userobj->profile['section'] ,

'watchlist'=>$watchlist );

                                                      }
                                                                                             
                        
                                                        
                                     
                        }
                        }}
               
    }                                                 
                                     
                        
                        
                         return $result;
}
function studnetsBySubmission($students,$courseid,$activityId,$submissionType)
{
global $DB;
$ss=array();

 foreach ($students as $student) 
      
       {
$sub="notsubmitted";
 $getvplinstance=$DB->get_field_sql("SELECT `instance`
FROM `mdl_course_modules`
WHERE `id` ='$activityId'
AND `course` ='$courseid'");
 // echo  "Co".$courseid;
    //   echo  "ACT".$getvplinstance;
//echo "ID".$activityId;
  $submissions=$DB->get_fieldset_sql("SELECT  `datesubmitted`
FROM `mdl_vpl_submissions`
WHERE `vpl` ='$activityId'
AND `userid` ='$student->id'");
//var_dump($submissions);
if(!empty( $submissions))
{
$sub="submitted";
}
if(strcasecmp($submissionType,$sub)==0)
{
$std= new stdClass;
$std->id=$student->id;

$ss[$student->id]=$std;
}


}

return $ss;
}

}
//$repObj=new custom_grade_report_db();

//$students=$repObj->getStudentsByCourse("3");
//var_dump($students);

//$res=$repObj->getGradeByCourseActType($students,"3","quiz","1000");
//getGradeByCourseSecActType($students,$courseId,$selected_values[1],$selected_values[3],$rank)
//$res=$repObj->getGradeByCourse($studentsIds,"22","");
   // var_dump($res);
?>

