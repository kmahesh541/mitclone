<?php
/*
 * utility library for ajax calls
 *
 * contains methods for rendering course vise section tables
 *
 * removing a set of students from watchlist
 *
 *
 */




require_once(dirname(__FILE__) . '/../config.php');
require_once($CFG->dirroot.'/blocks/course_overview/locallib.php');
require_once($CFG->dirroot . '/mod/watchlist/lib.php');
require_once($CFG->dirroot.'/teacher/testcenter/testcenterutil.php');
require_once($CFG->libdir.'/gradelib.php');;


// Remove fro Watchlist
$selectedids= optional_param('selected', -1, PARAM_INT); // array od student ids
$couid=optional_param('cid', -1, PARAM_INT);
if($couid!=1)
removeFromWatchlist($selectedids,$couid);



/*
 * removeFromWatchlist(array userids , courseid )
 *
 * to remove a set of users from watchlist
 */

function removeFromWatchlist($selectedids,$couid)
{
    if ($selectedids != -1) {
        foreach ($selectedids as $sid) {
            updateStatus(0, $sid, $couid);  // update watchlist status for each student on course base
        }
    }
}




// Get all courses along with  sections and labs
$cid= optional_param('cid', -1, PARAM_INT);
if($cid != -1) {
    $count=0;

    if($cid !=0) {

        $course = $DB->get_record('course', array('id' => $cid), '*', MUST_EXIST);
        echo get_courselist($course);
    }
    else
        echo  "<div style='height:300px;'><h3> No Records Found</h3></div>";

}


/*
 * get_courselist($course obj)
 *
 * returns a table with section and activities present in each section and no of activies completed
 *
 * information
 *
 */

function get_courselist($course)
{
    global $CFG;
    $html = "<table class='generaltable search-table' id='cours' width='100%'>
            <thead>
            <tr>
               <th style='width: 10%;'>Select</th>
               <th style='width: 40%;'>Topics</th>
               <th style='width: 50%;'>Activities</th>
            </tr>
            </thead>
            <tbody id='cbody'>";

    $ehtml=$html;
    $modinfo = get_fast_modinfo($course);
    $mods = $modinfo->get_cms();
    $sections = $modinfo->get_section_info_all();

    $arr = array();
    $main_array = get_sections($sections);
    // Activity loop
    $arr = get_activities($mods, $main_array);
    //var_dump($arr);
    $ptop = '';
    $com=0;$tot=0;
    $ht='';
    $count=0;
    $che=0;
    foreach ($mods as $mod) {
        $top = $main_array[$mod->section];
        if ($main_array[$mod->section] == "")
            continue;
        if ($ptop != $mod->section) {
            $activitycounter=0;$completioncounter=0;
            foreach ($arr[$mod->section] as $modsec) {
                $activitycounter++;
                $com+=(int)$modsec['completion'];
                $tot+=(int)$modsec['count'];
                $ht .= "<span  >".$modsec['completion'] .' of ' . $modsec['count']."</span>";
                $src=$CFG->wwwroot.'/pix/'.$modsec['modname'].'.jpeg';
                $ht .="&emsp;<img src=$src alt=".$modsec['modname']." title=".$modsec['modname']." />";
                $ht .= "&emsp;&emsp;&emsp;&emsp;&emsp;";
                if($modsec['completion']==$modsec['count'])
                    $completioncounter++;

            }

            if($completioncounter==$activitycounter){
                $classvar='seccompleted';
                $sta='disabled="true"';
                //print_r("completed");
                $sel='';
            }
            else{
                $classvar='';
                $sta='';
                if($che==0)
                {
                 $sel='checked';
                    $che++;
                }
                else{
                    $sel='';
                }
                //print_r("not completed");
            }
            $html .= html_writer::start_tag('tr', array('class' => $course->id.' '.$classvar));
            $html .= html_writer::start_tag('td');
            $html .= "<input type='radio' name='topics'  class='rdo' $sel $sta value ='$course->id-$mod->section'/>";
            $html .= html_writer::end_tag('td');
            $html .= html_writer::start_tag('td');
            $html .= "<span >".$top."</span>";
            $html .= html_writer::end_tag('td');
            $html .= html_writer::start_tag('td');
            $html .=$ht;
            $ht='';
            $html .= html_writer::end_tag('td');
            $html .= html_writer::end_tag('tr');
            $count++;

        }
        $ptop = $mod->section;
    }

    $html.="</tbody></table>";
    $html.="<p class='tabres'>($count) results found</p>";
    $sta=$com.','.$tot;
    if($count==0){
        $html=$ehtml."<tr><td colspan='3' style='text-align:center'><div class='nores'><h4> No Chapters found for this course</h4></div></td></tr><tr><td colspan='3' style='padding: 15px 0px  !important; '></td></tr><tr><td colspan='3' style='padding: 15px 0px  !important; ' ></td></tr><tr><td colspan='3' style='padding: 15px 0px  !important; ' ></td></tr><tr><td colspan='3' style='padding: 15px 0px  !important; '></td></tr></tbody></table>";
    }
    $html.="<input type='hidden' id='cstatus' value='$sta'/>";
    return $html;

}

/*
 * to arrage section names store in the section index
 */
function get_sections($sections)
{
    $main_array = array();
    $arr = array();
    $main_array = array();
    foreach ($sections as $sec) {
        $main_array[$sec->id] = $sec->name;
    }
    return $main_array;
}


/*
 * get module vise activity count along with completed activities count
 * $mods modules list in a couse
 * $main_array is sections array index represents section id and value at index is section name
 */

function get_activities($mods, $main_array)
{
    $arr = array();


    foreach ($mods as $mod) {

        // var_dump($mod);
        if ($main_array[$mod->section] == "")
            continue;
        if (array_key_exists($mod->section, $arr)) {
            $count=$arr[$mod->section][get_string($mod->modname)]['count'];
            $comp=(int)$arr[$mod->section][get_string($mod->modname)]['completion']+(int)getActStatus($mod->id);
            $arr[$mod->section][get_string($mod->modname)] = array("modname"=>get_string($mod->modname),"completion"=>$comp,'count'=>++$count);
        } else {
            $arr[$mod->section][get_string($mod->modname)] =array("modname"=>get_string($mod->modname),"completion"=>getActStatus($mod->id),"count"=>1);
        }

    }

    return $arr;
}


//--------------------------------------------------------------------------------------//




// Get all courses along with  sections and labs
$coursid= optional_param('courseid', -1, PARAM_INT); // getting course id
if($coursid !=-1) {

    echo getWatchlistByCourse($coursid); // to get list of watchlisted people of a course
}





// Get all courses along with  sections and labs
$courid= optional_param('courid', -1, PARAM_INT); // getting course id
if($courid !=-1) {


    echo getWatchlistByCoursePdf($courid); // to get list of watchlisted people of a course




}



/*
 * $cid is course id
 * getWatchedByCourse( $courseid) To Get a table of watchlisted people of given course
 * Outline Report url : $CFG->wwwroot/report/outline/user.php?id=$userid&course=$courseid&mode=outline
 * Profile Url : $CFG->wwwroot . '/teacher/student_profile.php?sid=$userid
 *
 * To get completed activity ids of a course till yesterday
 * $yt=time()-86400;
 * select id from mdl_course_modules where course=$cid and `completionexpected`<= $yt
 *
 */
function getWatchlistByCourse($coursid){

    global $DB,$CFG; // Global Variables
    $count=0;

    if($coursid !=0) {
        $context = get_context_instance(CONTEXT_COURSE, $coursid); // Getting Copurse context from courseid

        $students = get_role_users(5, $context); // Getting students of a course

        $course = $DB->get_record('course', array('id' => $coursid), '*', MUST_EXIST); // Getting course record

        $watlist = getAllWatchlistRecordByCourse($coursid, 1); // calling lib method to get records of watchlisted

        $html = '';

        $html .= "<table id='wtab' class='tablesorter generaltable search-table1'><thead><tr>
<th><input type='checkbox' class='checkbox1' id='selectall'/></th><th>Roll NO</th>
<th>Full Name</th><th>Eamcet Rank</th><th>Department</th>
<th>Section</th>
<th>Mean Grade</th><th>Todays Grade</th>
<th>Attendance</th>
<th>Report</th></tr></thead><tbody id='wtbody'>";
        $ehtml = $html;
        $html .= "<input  type='hidden' name='couid' value='$coursid'>";
        $count = 0;

            foreach ($watlist as $wlist) {

                $userobj = get_complete_user_data(id, $wlist->userid); // Getting User Object from userid
                $t = time(); //to get todays date time
                $yt = time() - 86400; // to get yesterdays date
                $attandance = getCntofAbsentActivities($wlist->userid, $coursid);
                /* $sql="SELECT round(avg(finalgrade),2) as cumulativegrade FROM mdl_grade_grades where itemid in( select id from mdl_course_modules where course=$coursid and `completionexpected`<= $yt) and userid=$wlist->userid";
                 $res=$DB->get_record_sql($sql); // to get all activies of a course till yesterday
                 //var_dump($res);
                 $sql1="SELECT  round(avg(finalgrade),2) as currentgrade , count(*) as reccount FROM mdl_grade_grades where itemid in(select id from mdl_course_modules where course=$coursid and `completionexpected`< $t and completionexpected >$yt) and userid=$wlist->userid ";
                 $res1=$DB->get_record_sql($sql1); // todays completion courses*/

                // checking cumulative grade existance

                $pregrade = round(MeanGrade($coursid, $wlist->userid),2) + 0.00;
                //$pregrade='A';


                $pragrade = round(TodaysGrade($coursid, $wlist->userid),2) + 0.00;// checking Todays grade existance
                //$pragrade='B';


               $html .= "<tr>";
                $html .= "<td ><input class='checkbox1' type='checkbox' name='check[]' value='$wlist->userid'></td>
<td> <a href=" . $CFG->wwwroot . '/teacher/student_profile.php?sid=' . $wlist->userid . ">" . $userobj->profile['rollno'] . "</a></td>
<td><a href=" . $CFG->wwwroot . '/teacher/student_profile.php?sid=' . $wlist->userid . ">" . $userobj->firstname . "</a></td>
<td> " . $userobj->profile['eamcetrank'] . " </td><td> " . $userobj->profile['dept'] . " </td><td> " . $userobj->profile['section'] . " </td>
<td>$pregrade</td><td>$pragrade</td><td>" . $attandance . "</td>
<td><a target='_blank' href='$CFG->wwwroot/teacher/useroutline.php?id=$wlist->userid&course=$coursid&mode=complete'>
<img src='https://cdn2.iconfinder.com/data/icons/freecns-cumulus/16/519597-095_Chart-128.png' style='width:20px;height:16px;padding-left:10px;'></a></td></tr>";
                $count++;
            }
            $html .= "</tbody></table>";
            $html .= "<p class='tabres'>($count) results found</p>";


    }
    if($count==0){
        $html=$ehtml."<tr><td colspan='10' style='text-align:center'><div class='nores'><h4> No watchlist Results found for this course</h4></div></td></tr>
        <tr><td colspan='10' style='padding: 15px 0px  !important; '></td></tr>
        <tr><td colspan='10' style='padding: 15px 0px  !important; '></td></tr>
        <tr><td colspan='10' style='padding: 15px 0px  !important; '></td></tr>
        <tr><td colspan='10' style='padding: 15px 0px  !important; '></td></tr></tbody></table>";
        $html.="<input type='hidden' value=$count id='wcount'/>";
    }
    return $html;

}



// watchlist print as pdf


function getWatchlistByCoursePdf($coursid){

    global $DB,$CFG; // Global Variables

    $context = get_context_instance(CONTEXT_COURSE, $coursid); // Getting Copurse context from courseid

    $students = get_role_users(5, $context); // Getting students of a course

    $course = $DB->get_record('course', array('id' => $coursid), '*', MUST_EXIST); // Getting course record

    $watlist= getAllWatchlistRecordByCourse($coursid,1); // calling lib method to get records of watchlisted



    $html='';

    $html .= "<table  class='watchlist-table1'><thead>
<tr><th>Roll No</th><th>Full Name</th><th>Rank</th><th>Department</th>
<th>Mean Grade</th><th>Todays Grade</th><th>Attendance</th></tr></thead><tbody id='wtbody'>";

    $html.= "<input  type='hidden' name='couid' value='$coursid'>";
    foreach ($watlist as $wlist) {

        $userobj = get_complete_user_data(id, $wlist->userid); // Getting User Object from userid
        $t=time(); //to get todays date time
        $yt=time()-86400; // to get yesterdays date
        $attandance=getCntofAbsentActivities($wlist->userid,$coursid);
        $sql="SELECT round(avg(finalgrade),2) as cumulativegrade FROM mdl_grade_grades where itemid in( select id from mdl_course_modules where course=$coursid and `completionexpected`<= $yt) and userid=$wlist->userid";
        $res=$DB->get_record_sql($sql); // to get all activies of a course till yesterday
        //var_dump($res);
        $sql1="SELECT  round(avg(finalgrade),2) as currentgrade , count(*) as reccount FROM mdl_grade_grades where itemid in(select id from mdl_course_modules where course=$coursid and `completionexpected`< $t and completionexpected >$yt) and userid=$wlist->userid ";
        $res1=$DB->get_record_sql($sql1); // todays completion courses

        // checking cumulative grade existance

            $pregrade=round(MeanGrade($coursid,$wlist->userid),2)+0.00;
        //$pregrade='A';


            $pragrade=round(TodaysGrade($coursid,$wlist->userid),2)+0.00;// checking Todays grade existance
        //$pragrade='B';

        $html.= "<tr>";
        $html.= "<td> <a href=" . $CFG->wwwroot . '/teacher/student_profile.php?sid=' . $wlist->userid . ">" . $userobj->profile['rollno'] . "</a></td><td><a href=" . $CFG->wwwroot . '/teacher/student_profile.php?sid=' . $wlist->userid . ">" . $userobj->firstname . "</a></td><td> " . $userobj->profile['eamcetrank'] . " </td><td> " . $userobj->profile['dept'] . " </td><td>$pregrade</td><td>$pragrade</td><td>".$attandance."</td></tr>";
    }
    $html .= "</tbody></table>";
    return $html;

}

/*******************************************************************************************/

function TodaysGrade($courseid,$studentId)
{
    global $DB;
    $at= strtotime(date("m/d/Y"));
// $sql="Select completionexpected from mdl_course_modules where course='".$courseid ."' and completionexpected> 0";
    $sql="SELECT *
FROM mdl_course_modules
WHERE course = '".$courseid."'
AND completionexpected >'".$at."'";
//echo $sql;
    $res=$DB->get_records_sql($sql);
    $items_completed_today=count($res);
    $totalgrade=0;
    $meangrade=0;
    foreach ($res as $item )
    {
        $module=$item->module;

        $instance=$item->instance;

        /**************GETTING ITEM NAME **********/
        $sql_item="SELECT name
FROM mdl_modules
WHERE id ='".$module."'";

        $item_res=$DB->get_record_sql($sql_item);
        $itemname= $item_res->name;

        $grading_info=grade_get_grades($courseid, 'mod', $itemname,$instance, $studentId);
//var_dump($grading_info);
        $item = $grading_info->items[0];
        $gradeI= $item->grades[$studentId];
        $grade = $gradeI->grade ;
        $totalgrade=$totalgrade+$grade;
    }
    if($totalgrade>0)
    {
        $meangrade=$totalgrade/$items_completed_today;
    }

    return $meangrade;

}
function MeanGrade($courseid,$studentId)
{
    global $DB;
    $at= strtotime(date("m/d/Y"));
// $sql="Select completionexpected from mdl_course_modules where course='".$courseid ."' and completionexpected> 0";
    $sql="SELECT *
FROM mdl_course_modules
WHERE course = '".$courseid."'
AND completionexpected <'".$at."'AND  completionexpected >0";
//echo $sql;
    $res=$DB->get_records_sql($sql);
    $items_completed_today=count($res);
    $totalgrade=0;
    $meangrade=0;
    foreach ($res as $item )
    {
        $module=$item->module;

        $instance=$item->instance;

        /**************GETTING ITEM NAME **********/
        $sql_item="SELECT name
FROM mdl_modules
WHERE id ='".$module."'";

        $item_res=$DB->get_record_sql($sql_item);
        $itemname= $item_res->name;

        $grading_info=grade_get_grades($courseid, 'mod', $itemname,$instance, $studentId);
//var_dump($grading_info);
        $item = $grading_info->items[0];
        $gradeI= $item->grades[$studentId];
        $grade = $gradeI->grade ;
        $totalgrade=$totalgrade+$grade;
    }
    if($totalgrade>0)
    {
        $meangrade=$totalgrade/$items_completed_today;
    }

    return $meangrade;

}
