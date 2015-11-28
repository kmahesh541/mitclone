<?php
/**
 * Created by PhpStorm.
 * User: Mahesh
 * Date: 16/11/15
 * Time: 4:44 PM
 *
 *
 * this is the file contains  the methods where we can perform all ajax calls from test center.
 *
 *
 */

require_once dirname(__FILE__).'/../../config.php';
require_once($CFG->dirroot.'/blocks/course_overview/locallib.php');
require_once("$CFG->dirroot/enrol/locallib.php");
require_once("$CFG->dirroot/mod/watchlist/lib.php");

$secid = optional_param('secid','-1', PARAM_INT);
$cid = optional_param('cid', '-1',PARAM_INT);
$uid=optional_param('uid', '-1',PARAM_INT);//retrieve user id
$mid=optional_param('mid', '-1',PARAM_INT);//retrieve method id
$aid=optional_param('aid', '-1',PARAM_INT);//retrieve method id
$sid=optional_param('sid', '-1',PARAM_INT);//retrieve student id
$section=optional_param('stusec', 'All',PARAM_TEXT);//retrieve secname
$am_type_name=optional_param('mname', 'x',PARAM_TEXT);
//retriving sections and activities based on course

//print_r($aid);
//print_r($am_type_name);

            switch($mid){
                case 1: section_activities($secid,$cid);break;
                case 2: set_activity_status($aid);break;
                case 3: set_activity_completiondate($aid);break;
                case 4: get_activity_status();break;
				case 5: get_student_sections($cid);break;
				case 6: add_student_to_watchlist($cid,$uid);break;
				case 7: get_loggedin_users_by_section($section);break;
				case 8: get_user_quiz_grade($aid,$uid);break;
				case 9: get_user_quiz_instance($aid);break;
				case 10: get_itemid_from_grade_table($aid,$am_type_name,$cid);break;
				case 11: get_course_absenties($cid);
				case 12: set_course_absenties($cid,$aid);
				case 13: getCntofAbsentActivities($sid,$cid);
				case 14:getStudentAttandanceofActivity($sid,$aid,$cid);
            }

            function section_activities($secid,$cid){
                $course=get_course($cid);
                $modinfo = get_fast_modinfo($course);
                $mods = $modinfo->get_cms();
                $sections = $modinfo->get_section_info_all();
                $sec_array = get_sections($sections);
                $arr = array();
                $cnt=0;

            //preparing an array which contains sections and activities
                foreach ($mods as $mod) {
                    $arr[$cnt++]=array('secid'=>$mod->section,'modid'=>$mod->id,'modname'=>$mod->name,'modcontent'=>$mod->content);
                    //print_r($mod->name);
                }

            //returns the all activities associated to perticular section in a course
                function get_activities($sectionid,$arr)
                {
                    $cnt=0;
                    $sec_activity_array = array();
                    for($i=0;$i<count($arr);$i++) {
                        if($arr[$i]['secid']==$sectionid){
                            $sec_activity_array[$cnt] = array('modid'=>$arr[$i]['modid'],'modname'=>$arr[$i]['modname'],'modcontent'=>$arr[$i]['modcontent']);
                            $cnt++;
                        }

                    }
                    return $sec_activity_array;
                }

            // Get all course sections in a array
                function get_sections($sections)
                {   $cnt=0;
                    $sec_array = array();
                    foreach ($sections as $sec) {
                        $sec_array[$cnt++] = array('secid'=>$sec->id,'secname'=>$sec->name);
                    }
                    return $sec_array;
                }


                $activities=get_activities($secid,$arr);
                $html='';global $CFG;
                for($i=0;$i<count($activities);$i++) {
                    $html .= '<tr >
                                <td ><span class="mod' . $activities[$i]['modid'] . '">' . ($i + 1) . '</span></td>
                                <td ><span class="mod' . $activities[$i]['modid'] . '">' . $activities[$i]['modname'] . '</span></td>
                                <td ><span class="mod' . $activities[$i]['modid'] . '">' . $activities[$i]['modcontent'] . '</span></td>
                                <td >
                                <button class="showhide" id="show" value=' . $activities[$i]['modid'] . '>
                                <img  alt="start" src="'.$CFG->wwwroot.'/teacher/testcenter/images/start.png" width="16px"/></button>
                                <button class="showhide" id="hide" value=' . $activities[$i]['modid'] . '>
                                <img  alt="stop" src="'.$CFG->wwwroot.'/teacher/testcenter/images/stop.png" width="16px"/></button>
                                </td>
                            </tr>';
                }
                echo $html;
            }//end of section_activities() function



            function set_activity_status($id){
                global $DB;
                $timenow = time();
                $activity_status = new stdClass();
                $activity_status->activityid     = $id;

				$activity_status->status=1;
                //print_r($activity_status);
                try {
                    if($DB->get_field('activity_status', 'id', array('activityid' => $id))){
					$activity_status->id=$DB->get_field('activity_status', 'id', array('activityid' => $id));
                        $status=$DB->get_field('activity_status', 'status', array('activityid' => $id));
						if($status)
							$status=0;
						else
							$status=1;

						if($status){
							$activity_status->activity_start_time   =$timenow;
						}
						$activity_status->status=$status;
						$DB->update_record_raw('activity_status', $activity_status, false);
		     		}
					else{

                         $DB->insert_record_raw('activity_status', $activity_status, false);
                        
                    }
                    //echo 'executed';

                } catch (dml_write_exception $e) {
                    // During a race condition we can fail to find the data, then it appears.
                    // If we still can't find it, rethrow the exception.
                    $activity_status_time = $DB->get_field('activity_status', 'activity_start_time', array('activityid' => $id));
                    if ($activity_status_time === false) {
                        //throw $e;
                        return 0;
                    }

                }
            }//end of set activity status


            function get_activity_status(){
                global $DB;
                $timenow = time();
                
                //echo $DB->get_field('activity_status','status',  array('activityid' => 5));
                try {
                    if(count($DB->get_records('activity_status', array('status' => 1)))){
                        $result=$DB->get_records('activity_status', array('status' => 1));
						$idstring='';
						foreach($result as $res){
							$idstring.=$res->activityid.',';
						}
						echo rtrim($idstring, ",");
					}
					else{
					echo '';
					}
                    //echo 'executed';

                } catch (dml_write_exception $e) {
                    
				echo 0;

                }
            }//end of get activity status

            function set_activity_completiondate($aid){
                global $DB;
                $timenow = time();
                $activity_status_completiondate = new stdClass();
                $activity_status_completiondate->id     = $aid;
                $activity_status_completiondate->completionexpected =$timenow;
                //print_r($activity_status);
                try {
                    if($DB->get_field('course_modules', 'id', array('id' => $aid))){
                        echo $DB->update_record_raw('course_modules', $activity_status_completiondate, false);
						$DB->delete_records('activity_status', array('activityid'=>$aid));
                    }

                    //echo 'executed';

                } catch (dml_write_exception $e) {
                    // During a race condition we can fail to find the data, then it appears.
                    // If we still can't find it, rethrow the exception.
                    $activity_status_time = $DB->get_field('course_modules', 'completionexpected', array('id' => $aid));
                    if ($activity_status_time === false) {
                        //throw $e;
                        return 0;
                    }

                }
            }//end of set activity status

		//get students section information based on course
		function get_student_sections($cid){
		$context = context_course::instance($cid);
		$students = get_role_users(5 , $context);//getting all the students from a course level


		$stuarr=array();$stcnt=0;
		foreach($students as $student){
		if(get_complete_user_data(id,$student->id)->profile['section']){
		$stu_section=get_complete_user_data(id,$student->id)->profile['section'];
		$stuarr[$stcnt++]=array('stusec'=>$stu_section,'stid'=>$student->id);
		}
		}

		$ss=array_count_values(array_column($stuarr, 'stusec'));
		ksort($ss);

		$stu_sec_info=array();$seccount=0;
		foreach( $ss as $key => $value)
		{
		$stu_sec_info[$seccount++]=array("secname"=>$key,"seccount"=>$value);
		}
		return $stu_sec_info;//json_encode($stu_sec_info);

		}

		function add_student_to_watchlist($cid,$uid)
		{
			$status=getStatus($uid,$cid);
				if($status)
				$status=0;
				else
				$status=1;
			echo updateStatus($status,$uid,$cid);
		}


		function get_loggedin_users_by_section($section)
		{
		global $DB;
		$params = array();
		$params['loginstatus'] = 1;
		//$section="C";
		if($section=='All'){
		//echo "section=".$section;
		$csql = "SELECT count(*)  FROM {userinfo_tsl} u WHERE u.loginstatus = :loginstatus";
		}
		else{
			$params['studentsection'] = $section;
			$csql = "SELECT count(*)  FROM {userinfo_tsl} u WHERE u.loginstatus = :loginstatus AND u.studentsection = :studentsection";
		}

			    
			   
		 $usercount = $DB->count_records_sql($csql,$params);
			
		return $usercount;
		}


		function get_user_quiz_grade($qid,$uid)
		{
				global $DB;
				$params = array();$result=array();
				$quizinstance=get_user_quiz_instance($qid);

				if($quizinstance['instance']){
				$params['quizid'] = $quizinstance['instance'];$params['userid'] = $uid;
				$qsql = "SELECT q.grade,q.timemodified FROM {quiz_grades} q WHERE q.quiz = :quizid AND q.userid = :userid";
				$userquizgrade = $DB->get_record_sql($qsql,$params);
				if($userquizgrade){
				$result['grade']=$userquizgrade->grade;
				$result['timemodified']=$userquizgrade->timemodified;
				return $result;
				}
				else{
				$result['grade']='--';
				$result['timemodified']='--';
				return $result;
				}
				}//if quiz instance is available
				else
				{
				$result['grade']='--';
				$result['timemodified']='--';
				return $result;//no instance
				}
										
		}
		function get_user_quiz_instance($qid)
		{
				global $DB;
				$params = array();$result=array();
				$params['quizid'] = $qid;
				$qsql = "SELECT cm.instance FROM {course_modules} cm WHERE cm.id = :quizid";
				$userquizgrade = $DB->get_record_sql($qsql,$params);
				if($userquizgrade){
				$result['instance']=$userquizgrade->instance;
				
				return $result;
				}
				else{
				$result['instance']=0;
				return $result;
				}
										
		}

		function get_itemid_from_grade_table($aid,$am_type_name,$cid)
		{
				global $DB;
				$params = array();$result=array();
				$params['iteminstance'] = $aid;
				$params['itemmodule'] = $am_type_name;
				$params['courseid'] = $cid;
				$qsql = 
		"SELECT g.id FROM {grade_items} g WHERE g.iteminstance=:iteminstance AND g.itemmodule=:itemmodule AND g.courseid=:courseid";
				$grade_itemid = $DB->get_record_sql($qsql,$params);
				//var_dump($grade_itemid);
				if($grade_itemid){
				$result['id']=$grade_itemid->id;
				//print_r($result['id']);
				return $result['id'];
				}
				else{
				$result['id']=0;
				//print_r($result['0']);
				
				return $result['id'];
				}
										
		}


			function get_all_loggedin_users($section)
			{
				global $DB;
				$params = array();
				$params['loginstatus'] = 1;
				//$section="C";
				if($section=='All'){
			//echo "section=".$section;
					$csql = "SELECT u.userid  FROM {userinfo_tsl} u WHERE u.loginstatus = :loginstatus";
				}
				else{
					$params['studentsection'] = $section;
					$csql = "SELECT u.userid  FROM {userinfo_tsl} u WHERE u.loginstatus = :loginstatus AND u.studentsection = :studentsection";
				}



				$usercount = $DB->get_records_sql($csql,$params);

				return $usercount;
			}


			function get_course_absenties($cid){

				$context = context_course::instance($cid);
				$enrolledStudents = get_role_users(5 , $context);//getting all the students from a course level
				$loggedinusers=get_all_loggedin_users('All');


				$logstuarr=array();$cnt=0;
				foreach($loggedinusers as $logstudent){

					$logstuarr[$cnt++]=array('stid'=>$logstudent->userid);

				}
				$lgss=array_column($logstuarr, 'stid');
				//print_r($lgss);

				$absented_Students=array();$stcnt=0;
				foreach($enrolledStudents as $student){
					if(in_array($student->id, $lgss)){}
					else{
						$absented_Students[$stcnt++]=array('stid'=>$student->id);
					}
				}
				$absented_Students=array_column($absented_Students,'stid');
				return $absented_Students;

			}

			function set_course_absenties($cid,$aid){
				global $USER,$DB;
				$absenties=get_course_absenties($cid);

				$timenow = time();
				$student_attendance = new stdClass();
				$student_attendance->aid     = $aid;
				$student_attendance->cid     = $cid;
				$student_attendance->teacherid=$USER->id;
				$student_attendance->datecreatedat=$timenow;
				$student_attendance->studentid=0;

				for($i=0;$i<count($absenties);$i++){
					$student_attendance->studentid=$absenties[$i];
					//print_r($student_attendance);
					try {

							$DB->insert_record_raw('student_activity_attendance_tsl', $student_attendance, false);


					} catch (dml_write_exception $e) {
						// During a race condition we can fail to find the data, then it appears.
						// If we still can't find it, rethrow the exception.
							print_r($e);
					}
				}//end of for loop
			}//end of set course absenties


			function getCntofAbsentActivities($sid,$cid){
				global $DB;
				$date=strtotime('today');
				$datenow=strtotime('now');

				$sql= 'SELECT id FROM `mdl_student_activity_attendance_tsl`
				WHERE `cid` ='.$cid.'	AND `studentid` ='.$sid.'
				AND `datecreatedat` BETWEEN '.$date.' AND '.$datenow;

				$csql= 'SELECT id FROM mdl_course_modules
				WHERE course ='.$cid.'
				AND completionexpected BETWEEN '.$date.' AND '.$datenow;
				//$DB->get_records_sql($csql,$params);
				$absent_activities=count($DB->get_records_sql($sql, null));
				$completed_activities=count($DB->get_records_sql($csql, null));

				if($completed_activities){
					if($absent_activities==$completed_activities){
						return  'ABSENT';
					}
					else{
						return  'PRESENT';
					}
				}
				else{
					return '--';
				}
			}

			function getStudentAttandanceofActivity($sid,$aid,$cid)
			{
				global $DB;

				$completedstatus=$DB->get_field('course_modules', 'completionexpected', array('course' => $cid,'id'=>$aid));


				if($completedstatus){
					$sql = 'SELECT id FROM `mdl_student_activity_attendance_tsl`
							WHERE `cid` =' . $cid . '	AND `studentid` =' . $sid . '
							AND `aid` =' . $aid;

					if (count($DB->get_records_sql($sql, null))) {
						return 'ABSENT';
					} else {
						return 'PRESENT';
					}
				}
				else{
						return 'NOT STARTED';
				}


			}

?>


