
<style>

</style>
<?php
/**
 * Created by PhpStorm.
 * User: tele
 * Date: 18/11/15
 * Time: 11:29 AM
 */

require_once(dirname(__FILE__) . '/../config.php');
require_once($CFG->dirroot . '/my/lib.php');
require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot.'/blocks/course_overview/locallib.php');
require_once($CFG->dirroot.'/grade/querylib.php');
require_once($CFG->dirroot.'/grade/lib.php');
require_once($CFG->dirroot.'/mod/watchlist/lib.php');
require_once($CFG->dirroot.'/teacher/testcenter/testcenterutil.php');
require_once($CFG->libdir.'/gradelib.php');

$studentid= optional_param('sid', -1, PARAM_INT); // array od student ids
$courseid=optional_param('cid', -1, PARAM_INT);
if($studentid!=-1){

   echo getStudentReportbyCourse($studentid,$courseid);
}

function getStudentReportbyCourse($studentid,$courseid){
global $DB;
    $course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);
    $modinfo = get_fast_modinfo($course);
    $mods = $modinfo->get_cms();
    $sections = $modinfo->get_section_info_all();

    $html=" <h4 style='text-align:center;'>$course->fullname Report</h4>";
    $html .= "<table class='generaltable reporttab' id='cours' width='100%'>
            <thead>
            <tr>
                <!--<th style='width: 10%;'>Select</th>-->
                <th >Topics</th>
                <th >Activity</th>
                <th >Completed On</th>
                <th >Grade</th>
                <th >Submissions</th>
                <th >Attendance</th>
            </tr>
            </thead>
            <tbody id='cbody'>";

    $arr = array();
    $main_array = array();
    $arr = array();
    $main_array = array();
    foreach ($sections as $sec) {
        $main_array[$sec->id] = $sec->name;
    }
    $arr = array();


    foreach ($mods as $mod) {

        // var_dump($mod);
        //$attandance=getStudentAttandanceofActivity($studentid,$aid,$courseid)
        if ($main_array[$mod->section] == "")
            continue;
        $arr1[$mod->section][$mod->id] =array("actid"=>$mod->id,"name"=>$mod->modname,"modname"=>get_string($mod->modname),"actname"=>$mod->name);
        if (array_key_exists($mod->section, $arr)) {
            $count=$arr[$mod->section][get_string($mod->modname)]['count'];
            $comp=(int)$arr[$mod->section][get_string($mod->modname)]['completion']+(int)getActStatus($mod->id);
            $arr[$mod->section][get_string($mod->modname)] = array("actid"=>$mod->id,"name"=>$mod->modname,"modname"=>get_string($mod->modname),"actname"=>$mod->name,"completion"=>$comp,'count'=>++$count);
        } else {
            $arr[$mod->section][get_string($mod->modname)] =array("actid"=>$mod->id,"name"=>$mod->modname,"modname"=>get_string($mod->modname),"actname"=>$mod->name,"completion"=>getActStatus($mod->id),"count"=>1);
        }

    }
    //var_dump($arr);
    $ptop = '';
    $com=0;$tot=0;
    $ht='';$ht1='';$ht2='';$ht3='';$ht4='';
    foreach ($mods as $mod) {

        $top = $main_array[$mod->section];
        if ($main_array[$mod->section] == "")
            continue;
        if ($ptop != $mod->section) {
            $activitycounter=0;$completioncounter=0;
            foreach ($arr1[$mod->section] as $modsec) {
                // var_dump($modsec);
                $activitycounter++;
                $com+=(int)$modsec['completion'];
                $tot+=(int)$modsec['count'];
                $ht.=$modsec['actname']."<hr/>";
                if($modsec['completion']==$modsec['count'])
                    $completioncounter++;
            }

            foreach ($arr1[$mod->section] as $modsec) {
                //var_dump($modsec);

                $actid= $modsec['actid'];
                $modname=$modsec['name'];
		if($DB->get_field('course_modules', 'completionexpected', array('course' => $courseid,'id'=>$modsec['actid']))){
                    $date=$DB->get_field('course_modules', 'completionexpected', array('course' => $courseid,'id'=>$modsec['actid']));
                    $completionDate=date("d-m-Y",$date);//userdate();
                }
                else{
                    $completionDate='--';
                }

                $ht4.=$completionDate."<hr/>";
                // activity grade
                $instace= $DB->get_field_sql("SELECT  `instance`FROM `mdl_course_modules`
                    WHERE id=$actid");
                $grading_info=grade_get_grades($course->id, 'mod', $modname, $instace , $studentid ); // course mod name instance sid
                $item = $grading_info->items[0];
                $grade= $item->grades[$studentid];
                $mygrade =round($grade->grade+0,2); // Convert to number.
                $ht1.=$mygrade."<hr/>";

            }

            foreach ($arr1[$mod->section] as $modsec) {
                $actid= $modsec['actid'];
                $modname=$modsec['name'];
                // activity grade
                $insid= $DB->get_field_sql("SELECT  `instance`FROM `mdl_course_modules`
                    WHERE id=$actid");
                if($modname=$modsec['name']=='vpl')
                $submissions= $DB->get_field_sql("SELECT count(*) as submissions FROM `mdl_vpl_submissions`
                    WHERE vpl=$insid and userid=$studentid" );
                if($modname=$modsec['name']=='quiz')
                    $submissions= $DB->get_field_sql("SELECT count(*) as submissions FROM `mdl_quiz_attempts`
                    WHERE quiz=$insid and userid=$studentid" );

                $ht2.=$submissions."<hr/>";

            }
            foreach ($arr1[$mod->section] as $modsec) {
                $actid= $modsec['actid'];
               $ht3.=getStudentAttandanceofActivity($studentid,$actid,$courseid)."<hr/>";

            }


            $html .= html_writer::start_tag('tr', array('class' => $course->id));
            $html .= "<td style='vertical-align: middle;'>";
            $html .= "<span style='color:dimgray;font-weight: bold;'>".$top."</span>";
            $html .= html_writer::end_tag('td');
            $html .= html_writer::start_tag('td');
            $html .=$ht;
            $ht='';
            $html .= html_writer::end_tag('td');
	    $html .= html_writer::start_tag('td');
            $html .=$ht4;
            $ht4='';
            $html .= html_writer::end_tag('td');
            $html .= html_writer::start_tag('td');
            $html .=$ht1;
            $ht1='';
            $html .= html_writer::end_tag('td');
            $html .= html_writer::start_tag('td');
            $html .=$ht2;
            $ht2='';
            $html .= html_writer::end_tag('td');
            $html .= html_writer::start_tag('td');
            $html.=$ht3;
            $ht3='';
            $html .= html_writer::end_tag('td');
            $html .= html_writer::end_tag('tr');
        }
        $ptop = $mod->section;
    }
global $CFG;
    $html.="</tbody></table>";
    $sta=$com.','.$tot;

       
    $html.="<input type='hidden' id='cstatus' value='$sta'/>";
    return $html;


}




function getStudentReportbyCoursePdf($studentid,$courseid){
    global $DB,$USER;
    $course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);
    $modinfo = get_fast_modinfo($course);
    $mods = $modinfo->get_cms();
    $sections = $modinfo->get_section_info_all();
    $student= get_complete_user_data(id,$studentid);
    $stuname=ucfirst($student->firstname);
    $html=" <h3 >$stuname $course->fullname Report</h3>";
    $pdfcreator='<h6 >Created by '.$USER->firstname.' on '.userdate(time()).'</h6>';
    $html.=$pdfcreator;
    $html .= "<table class='generaltable reporttab' id='cours' width='100%'>
            <thead>
            <tr>
                <!--<th style='width: 10%;'>Select</th>-->
                <th style='width: 20%;'>Topics</th>
                <th style='width: 20%;'>Completed On</th>
                <th style='width: 30%;'>Activity</th>
                <th style='width: 30%;'>Grade</th>
                <th style='width: 20%;'>Submissions</th>
            </tr>
            </thead>
            <tbody id='cbody'>";

    $arr = array();
    $main_array = array();
    $arr = array();
    $main_array = array();
    foreach ($sections as $sec) {
        $main_array[$sec->id] = $sec->name;
    }
    $arr = array();
    $arr1=array();

    foreach ($mods as $mod) {

        // var_dump($mod);
        if ($main_array[$mod->section] == "")
            continue;
        $arr1[$mod->section][$mod->id] =array("actid"=>$mod->id,"name"=>$mod->modname,"modname"=>get_string($mod->modname),"actname"=>$mod->name);
        if (array_key_exists($mod->section, $arr)) {
            $count=$arr[$mod->section][get_string($mod->modname)]['count'];
            $comp=(int)$arr[$mod->section][get_string($mod->modname)]['completion']+(int)getActStatus($mod->id);
            $arr[$mod->section][get_string($mod->modname)] = array("actid"=>$mod->id,"name"=>$mod->modname,"modname"=>get_string($mod->modname),"actname"=>$mod->name,"completion"=>$comp,'count'=>++$count);
        } else {
            $arr[$mod->section][get_string($mod->modname)] =array("actid"=>$mod->id,"name"=>$mod->modname,"modname"=>get_string($mod->modname),"actname"=>$mod->name,"completion"=>getActStatus($mod->id),"count"=>1);
        }

    }
   // var_dump($arr1);
    $ptop = '';
    $com=0;$tot=0;
    $ht='';$ht1='';$ht2='';$ht4='';
    foreach ($mods as $mod) {

        $top = $main_array[$mod->section];
        if ($main_array[$mod->section] == "")
            continue;
        if ($ptop != $mod->section) {
            $activitycounter=0;$completioncounter=0;
            foreach ($arr[$mod->section] as $modsec) {
                // var_dump($modsec);
                $activitycounter++;
                $com+=(int)$modsec['completion'];
                $tot+=(int)$modsec['count'];
               // $ht.=$modsec['actname']."<hr/>";
                if($modsec['completion']==$modsec['count'])
                    $completioncounter++;
            }

            foreach ($arr1[$mod->section] as $modsec) {
                // var_dump($modsec);

                $ht.=$modsec['actname']."<hr/>";

            }
            foreach ($arr1[$mod->section] as $modsec) {
                //var_dump($modsec);

                $actid= $modsec['actid'];
                $modname=$modsec['name'];
		if($DB->get_field('course_modules', 'completionexpected', array('course' => $courseid,'id'=>$modsec['actid']))){
                    $date=$DB->get_field('course_modules', 'completionexpected', array('course' => $courseid,'id'=>$modsec['actid']));
                    $completionDate=date("d-m-Y",$date);//userdate();
                }
                else{
                    $completionDate='--';
                }
		$ht4.=$completionDate."<hr/>";
                // activity grade
                $instace= $DB->get_field_sql("SELECT  `instance`FROM `mdl_course_modules`
                    WHERE id=$actid");
                $grading_info=grade_get_grades($course->id, 'mod', $modname, $instace , $studentid ); // course mod name instance sid
                $item = $grading_info->items[0];
                $grade= $item->grades[$studentid];
                $mygrade =round($grade->grade+0,2); // Convert to number.
                $ht1.=$mygrade."<hr/>";

            }

            foreach ($arr1[$mod->section] as $modsec) {
                $actid= $modsec['actid'];
                $modname=$modsec['name'];
                // activity grade
                $insid= $DB->get_field_sql("SELECT  `instance`FROM `mdl_course_modules`
                    WHERE id=$actid");
                if($modname=$modsec['name']=='vpl')
                    $submissions= $DB->get_field_sql("SELECT count(*) as submissions FROM `mdl_vpl_submissions`
                    WHERE vpl=$insid and userid=$studentid" );
                if($modname=$modsec['name']=='quiz')
                    $submissions= $DB->get_field_sql("SELECT count(*) as submissions FROM `mdl_quiz_attempts`
                    WHERE quiz=$insid and userid=$studentid" );


                $ht2.=$submissions."<hr/>";

            }


            $html .= html_writer::start_tag('tr', array('class' => $course->id));
            $html .= "<td style='vertical-align: middle;'>";
            $html .= "<span style='color:dimgray;font-weight: bold;'>".$top."</span>";
            $html .= html_writer::end_tag('td');
            $html .= html_writer::start_tag('td');
            $html .=$ht;
            $ht='';
            $html .= html_writer::end_tag('td');
            $html .= html_writer::start_tag('td');
            $html .=$ht4;
            $ht4='';
            $html .= html_writer::end_tag('td');
            $html .= html_writer::start_tag('td');
            $html .=$ht1;
            $ht1='';
            $html .= html_writer::end_tag('td');
            $html .= html_writer::start_tag('td');
            $html .=$ht2;
            $ht2='';
            $html .= html_writer::end_tag('td');
            $html .= html_writer::end_tag('tr');
        }
        $ptop = $mod->section;
    }

    $html.="</tbody></table>";
    //$sta=$com.','.$tot;
    //$html.="<input type='hidden' id='cstatus' value='$sta'/>";
    return $html;


}

