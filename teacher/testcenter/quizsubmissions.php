<?php
/**
 * Created by PhpStorm.
 * User: Mahesh
 * Date: 16/11/15
 * Time: 4:31 PM
 *
 * this will display all participants of a quiz with submissions
 *
 */

require_once dirname(__FILE__).'/../../config.php';
require_once("$CFG->dirroot/enrol/locallib.php");
require_once("$CFG->dirroot/mod/watchlist/lib.php");
require_once('testcenterutil.php');

$params = explode("-", $_POST['topics']);
$id=(int)$params[0];
$cid=$id;
//retriving course id from url

if(!$cid){
$cid = required_param('cid', PARAM_INT);
$qid = required_param('id', PARAM_INT);
}
$secname = optional_param('secname', 'All',PARAM_TEXT);
//$course=get_course($cid);
$subcount=0;
$loggedinstudents=0;
$context = context_course::instance($cid);
$students = get_role_users(5 , $context);//getting all the students from a course level
$loggedinusers=get_loggedin_users_by_section($secname);

	if($secname=='All'||$secnmae=='0')
	{
	$section_flag=0;
	}
	else{
	$section_flag=1;
	}
	$display_flag=1;



                //displaying enrolled students
                echo '<div class="repo" >
                    <div id="container" style="overflow-y: scroll; height:480px;padding-bottom:30px;" >


                        <table id="myTable"  class="CSSTableGenerator" >
                            <thead>
                            <tr>
                                <th style="text-align:center">Status</th>
                                <th>Roll No</th>
                                <th>Full Name</th>
                                <th style="text-align:center">Grade</th>
                                <th>Last Submission</th>
                                <th style="text-align:center">Section</th>
                                <th style="text-align:center">Watch</th>
                            </tr>
                            </thead>
                            <tbody >';

                            $statusImag='flag-red-icon.png';//not submitted and not graded
                            $grade='--';
                            $subtime='--';
			    


                        foreach($students as $student){
                            if(get_complete_user_data(id,$student->id)->profile['rollno']){
                                $rollnumber=get_complete_user_data(id,$student->id)->profile['rollno'];
                            }
                            else{
                                $rollnumber='';
                            }
                            if(get_complete_user_data(id,$student->id)->profile['section']){
                                $stu_section=get_complete_user_data(id,$student->id)->profile['section'];
                            }
                            else{
                                $stu_section='';
                            }

				if($section_flag){
	
				if(($secname==$stu_section))
				{
				$display_flag=1;
				}
				else{
				$display_flag=0;
				}
				}
			//code to check whether the student is watchlisted or not
				$watchliststatus=getStatus($student->id,$cid);
				if($watchliststatus){
				$watchlist_icon='eye-24-512.png';
				}
				else{
				$watchlist_icon='unwatch-512.png';
				}
				
				$result=get_user_quiz_grade($qid,$student->id);


   	if($display_flag){
        if($DB->get_field('userinfo_tsl', 'loginstatus', array('userid' => $student->id))) {

            $loggedinstudents++;
            if ($result['grade'] == '--') {
                $statusImag = 'flag-red-icon.png';$statusNum=0;

                echo '<tr>
                                <td><span  style="display:none">'.$statusNum.'</span>
                                <img src="' . $CFG->wwwroot . '/teacher/testcenter/images/' . $statusImag . '" width="  16px" /></td>
                                <td><a target="_blank" href=" ' . $CFG->wwwroot . '/teacher/student_profile.php?sid=' . $student->id . '">' . $rollnumber . '</a></td>
                                <td><a target="_blank" href=" ' . $CFG->wwwroot . '/teacher/student_profile.php?sid=' . $student->id . '">' . $student->firstname . ' ' . $student->lastname . '</a></td>
                                <td style="text-align:center">' . $result['grade'] . '</td>
                                <td> -- </td>
                                <td style="text-align:center">' . $stu_section . '</td>
				<td><img data-ref="' . $watchliststatus . '" id="' . $student->id . '" class="watchlist" src=" ' . $CFG->wwwroot . '/teacher/testcenter/images/' . $watchlist_icon . '" width="  16px"/></td>

                            </tr>';

            } else {
                $subcount++;
                $statusImag = 'flag-green-icon.png';$statusNum=2;
                echo '<tr>
                                <td><span  style="display:none">'.$statusNum.'</span>
                                <img src="' . $CFG->wwwroot . '/teacher/testcenter/images/' . $statusImag . '" width="  16px" /></td>
                                <td><a href=" ' . $CFG->wwwroot . '/teacher/student_profile.php?sid=' . $student->id . '">' . $rollnumber . '</a></td>
                                <td><a href=" ' . $CFG->wwwroot . '/teacher/student_profile.php?sid=' . $student->id . '">' . $student->firstname . ' ' . $student->lastname . '</a></td>
                                <td style="text-align:center">' . $result['grade'] . '</td>
                                <td>' . userdate($result['timemodified']) . '</td>
                                <td style="text-align:center">' . $stu_section . '</td>
				<td>
				<span class="watchlist-status'.$student->id.'" style="display:none">'.$watchliststatus.'</span>
				<img data-ref="' . $watchliststatus . '" id="' . $student->id . '" class="watchlist" src=" ' . $CFG->wwwroot . '/teacher/testcenter/images/' . $watchlist_icon . '" width="  16px"/></td>

                            </tr>';
            }//if grade is available
        }//end logged or not checking if
    }//end of display flag

                        }

                        echo '</tbody>
                                </table>
				
                            </div>
                                <div id="scrollable"></div>
                            </div>';
echo '<span style="display:none" id="subCount">'.$subcount.'</span>';
echo '<span style="display:none" id="gradeCount">'.$subcount.'</span>';

echo '<span style="display:none" id="acivitystatus">'.$acivitystatus.'</span>';
echo '<span style="display:none" id="loggedinusers">'.$loggedinstudents.'</span>';
?>
