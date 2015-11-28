<style>
    #current-activity{

    }
    #status-div{
        width: 30%;
        float: left;
        margin-left: 5%;
        text-align: center;
        margin-top: 5px;
        font-weight: normal !important;
    }
    #filterdiv{
        width: 24%;
        float: right;
        text-align: center;
        line-height: 40px;
        vertical-align: middle;
    }
    #fil{
        vertical-align: middle;
        border: 0px none;
        margin-left: 6%;

    }
    #stu-section{
        width: 40% !important;
        height: 25px !important;
        margin-left: 5%;

    }
    #refresh{
        vertical-align: middle;
        border: 0px none;
        margin-left: 6%;
        cursor: pointer;

    }
    #stas td {
        line-height: 18px;
        font-size: 16px !important;
        font-style: normal;
        border-top: 0px solid #DDD;
        padding: 0px;
        color: #655C5C;
        vertical-align: middle !important;
        background-color: #F8F2E5;
    }
    #filter{
        vertical-align: middle;
        border: 0px none;
        margin-left: 6%;
    }
    #log{
        width:40%;
        float:left;
    }


</style>
<?php
/**
 * Created by PhpStorm.
 * User: Mahesh
 * Date: 16/11/15
 * Time: 2:55 PM
 *
 *
 *Functionalities:
    1.display current course and name of the topic
    2.display current activities based on topic(with start button enabled by default)
    3.display activity name which is in progress
    4.display 3 html meters to show logged in,submitted,graded users.
    5.display list of all students
 *
 *
 */

require_once(dirname(__FILE__).'/../../config.php');
require_once($CFG->dirroot.'/mod/vpl/locallib.php');
require_once($CFG->dirroot.'/enrol/locallib.php');
require_once($CFG->dirroot.'/blocks/course_overview/locallib.php');
require_once('sub_list_head.php');
require_once('testcenterutil.php');

//login required to view this page
require_login();


//retriving course id from url


$params = explode("-", $_POST['topics']);
$id=(int)$params[0];
$secid=(int)$params[1];

if(!$id){
$id = optional_param('cid',0, PARAM_INT);
$secid = optional_param('secid',0, PARAM_INT);
}
if($id){
    $course=get_course($id);
}
else{
    redirect($CFG->wwwroot.'/teacher/dashboard.php');
}



/*initializing required parameters*/
$currentActivityId=0;
$currentActivityStatus=0;
$currentModTypeId=0;
$currentActivityName='--';
/*logic to get activities and course name and section name*/

$modinfo = get_fast_modinfo($course);
$mods = $modinfo->get_cms();
$sections = $modinfo->get_section_info_all();
$secname=get_sections_name($secid,$sections);
$topicname=$secname;
///$cm=$modinfo->get_cm($course->id);
$currentgroup =''; //groups_get_activity_group($cm, true);
$context_module=context_course::instance($id);

$cid=$id;

            //preparing an array which contains sections and activities
            foreach ($mods as $mod) {

                $gradeitemid=get_itemid_from_grade_table($mod->instance,$mod->modname,$cid);
                //print_r($mod->id);print_r($gradeitemid);print_r($mod->modname);
                $modstatus=$DB->get_field('activity_status', 'status', array('activityid' => $mod->id));

                $arr[$cnt++]=array('secid'=>$mod->section,'modid'=>$mod->id,'modname'=>$mod->name,'modcontent'=>$mod->content,'modtypeid'=>$mod->module,'itemid'=>$gradeitemid,'modstatus'=>$modstatus);
                //print_r($mod->name);
            }
            $activities=get_activities($secid,$arr);

            //get activities of a section
            function get_activities($sectionid,$arr)
            {
                // print_r($arr);
                $cnt=0;$sec_activity_array = array();
                foreach($arr as $a){
                    //print_r($a);
                    if($a['secid']==$sectionid){

                        $sec_activity_array[$cnt] = array('modid'=>$a['modid'],'modname'=>$a['modname'],'modcontent'=>$a['modcontent'],'modtypeid'=>$a['modtypeid'],'modstatus'=>$a['modstatus'],'itemid'=>$a['itemid']);
                        $cnt++;
                    }
                }

                return $sec_activity_array;
            }

            //get current section name among all sections in the course
            function get_sections_name($sectionid,$sections)
            {

                foreach ($sections as $sec) {
                    if($sec->id==$sectionid){
                        return $sec->name;}
                }

            }



	    /*logic to get current logged in users */

	    $loggedinusers=get_loggedin_users_by_section('All');
	    $studentSections=get_student_sections($cid);


            /*logic to get total number of participants in course*/

		$totalenrolled=array_sum(array_column($studentSections, 'seccount'));
		$baseUrl=$CFG->wwwroot;
            /*page content display start*/
            echo $OUTPUT->header();
            //starting of page container div
            echo '<div class="container container-demo" >

                                <div class="report">';



	  /*  //code to display loading image
		echo '<div  class="pagecover">
		    
		    <div style="width: 600px; height: 45px; text-align: center; margin: 180px auto 0px;">        
			<div>LOADING</div><div><img src="'.$baseUrl.'/teacher/testcenter/images/loader.gif"></div>
		   </div>
		    <div style="width: 600px; margin: 10px auto; text-align: center; color: rgb(100, 100, 100);">Please wait...</div>
		</div>';*/

            echo '<div id="flip" >
                                <p id="fl"  >
                                        <i class="fa fa-angle-double-up" ></i>
                                        <span  id="titile-sta">Test Control Panel</span>
                                        <span id="titile-status">
                                         <span  id="ccourse">Course : '.$course->fullname.' </span>
                                        <span id="ctopic" > Topic : '.$secname.'</span>
                                        <span  id="cactivity">Activity : '.$currentActivityName.'</span>
                                        <i style="float:right" class="fa fa-angle-double-down" ></i>
                                        </span>
                                </p></div>';//end of flip div

            echo '<div id="panel">';?>
<div style="background-color: rgb(204, 204, 204); padding: 10px;" class="tleft">
    <div style="" id="coursename"><?php echo $course->fullname?></div>
    <div style="" id="topicname"><?php echo $secname?></div>
</div><!-- table left end -->

<?php

echo '<div class="tright" >
                            <table id="t01" class=" topics-div">';


            for($i=0;$i<count($activities);$i++) {

                if($DB->get_field('course_modules', 'completionexpected', array('id' => $activities[$i]['modid']))){

                    $completiondate=userdate($DB->get_field('course_modules', 'completionexpected', array('id' => $activities[$i]['modid'])));
                    $completedactivity="markascomplete";
                }
                else{
                    $completedactivity="";$completiondate='';
                }
                if($activities[$i]['modstatus']){
                    $currentActivityId=$activities[$i]['modid'];
                    $currentActivityStatus=$activities[$i]['modstatus'];
                    $currentModTypeId=$activities[$i]['modtypeid'];
                    $currentActivityName=$activities[$i]['modname'];
                }


                echo '<tr data-status="'.$activities[$i]['modstatus'].'" class="row' . $activities[$i]['modid'] . ' '.$completedactivity.'">
                                <td ><span class="mod' . $activities[$i]['modid'] . ' '.$completedactivity.'">' . ($i + 1) . '</span></td>
                                <td style="width:50%;" ><span class="mod' . $activities[$i]['modid'] . ' activitymod' . $activities[$i]['modid'] . ' '.$completedactivity.'">' . $activities[$i]['modname'];



                echo '</span></td>';
                if($completiondate) {
                    if($completiondate){
                        echo '<td style="width:18%"><span class="status-text closed actstatus' . $activities[$i]['modid'] . '"><b>CLOSED</b><BR/><span style="line-height: 12px;"> on '.$completiondate .'</span></span></td>';
                    }
                }
                else{
                    echo '<td style="width:18%"><span   class="status-text actstatus' . $activities[$i]['modid'] . '"><b>NOT STARTED</b></span></td>';
                }
                /*echo '<td ><span class="mod' . $activities[$i]['modid'] . '">' . $activities[$i]['modcontent'] .. '</span></td>*/

                echo '<td style="vertical-align: middle;" >
                <button data-mid="' . $activities[$i]['modtypeid'] . '" class="showhide show show' . $activities[$i]['modid'] . '" id="show" value=' . $activities[$i]['modid'];

                if($completiondate){
                    echo ' disabled="true" style="cursor:not-allowed" ';
                }
                echo '>
                    Start</button>

                                <button data-mid="' . $activities[$i]['modtypeid'] . '" class="showhide stop hide' . $activities[$i]['modid'] . '" id="hide" value=' . $activities[$i]['modid'];
                if($completiondate){
                    echo ' disabled="true" style="cursor:not-allowed" ';
                }
                echo '>
                                Stop</button>
                                <button data-itemid="'.$activities[$i]['itemid'].'" data-mid="' . $activities[$i]['modtypeid'] . '" id="complete" class="stopclose  complete complete' . $activities[$i]['modid'] . '" value="' . $activities[$i]['modid'].'"';
                if($completiondate){
                    echo ' disabled="true" style="cursor:not-allowed" ';
                }
                                echo '>
                                Close</button>
                                </td>

                            </tr>';
            }
            echo'</table>

                        </div>';
?>


<?php
                        echo '</div>';//end of panel div



            echo '<div id="log"><table id="stas"><tbody><tr style="font-weight: bold; text-align: center;" id="head">

            <tr><td title="Logged In"><img class="activity-status-img" title="Logged In" src="'.$CFG->wwwroot.'/teacher/testcenter/images/flag-red-icon.png">
            <span class="loggedinCount">'.$loggedinusers.'</span> of <span class="studentCount">'.$totalenrolled.'</span></td>
            <td title="Submited" ><img class="activity-status-img" title="Submited"  src="'.$CFG->wwwroot.'/teacher/testcenter/images/flag-orange-icon.png">
            <span id="csubCount">0</span> of <span class="loggedinCount">'.$loggedinusers.'</span></td>
            <td title="Graded"><img class="activity-status-img" title="Graded"  src="'.$CFG->wwwroot.'/teacher/testcenter/images/flag-green-icon.png">
            <span id="cgradeCount">0</span> of <span class="loggedinCount">'.$loggedinusers.'</span></td>

            </tr></tbody></table></div>


    
	<div id="status-div">
            <div style="float: left; width: 80%;">
            <span id="current-activity">NOT STARTED</span>
            <span id="warn-msg">Test results REFRESHED every 60 secs</span>
            </div>
            <div class="loading-img pagecover">
            <img src="'.$CFG->wwwroot.'/pix/loading.gif" style="margin-left:6%" title="filter">
            </div>
        </div>';
            

echo '<div id="filterdiv"><img title="filter" style="margin-left:6%" src="'.$CFG->wwwroot.'/pix/i/filter.png"/> <select id="stu-section" style="width: 40% ! important;height:25px !important;margin-left:5%;">';
			echo '<option value="All" id="'.$totalenrolled.'">All</option>';
			for($i=0;$i<count($studentSections);$i++){
			echo '<option id="'.$studentSections[$i]['seccount'].'" value="'.$studentSections[$i]['secname'].'">'.$studentSections[$i]['secname'].'</option>';}
			echo '</select>';

            echo '<img id="refresh" title="REFRESH (Test results REFRESHED every 60 secs)"  src="'.$CFG->wwwroot.'/pix/a/refresh.png"/><br/>
            </div>';

            echo '<div id="sub_list">';
            require_once('enrolledstudents.php');

            echo '</div>';
            echo '</div></div>';//end of report and container-demo divs
            /*page content display end*/

            //all hidden fields to store dynamic information for the page
            //hc in each id name represents hiddencurrent
            echo '<input type="hidden" id="current-lab" value="0" />';
            echo '<input type="hidden" id="hctopic" value="'.$topicname.'" />';
            echo '<input type="hidden" id="hccourse" value="'.$course->fullname.'" />';
            echo '<input type="hidden" id="hcactivity" value="'.$currentActivityName.'" />';
            echo '<input type="hidden" id="hcactivity-id" value="'.$currentActivityId.'" />';
            echo '<input type="hidden" id="hcactivity-status" value="'.$currentActivityStatus.'" />';
            echo '<input type="hidden" id="setinterval-id" value="0" />';
            echo '<input type="hidden" id="hcstu-section" value="All" />';
            echo '<input type="hidden" id="studentCount" value="'.$totalenrolled.'" />';
            echo '<input type="hidden" id="modtypeid" value="'.$currentModTypeId.'" />';

            echo $OUTPUT->footer();


?>




