

<style>
    #course-sel {
        width:40% !important;
        margin-top:5px;
        display: inline-block !important;
    }
    #course-sel label{
        margin: 0px !important;
        padding: 0px !important;
        vertical-align: middle;
    }
    #notify{
        width:30%;
        display: inline-block !important;

    }
    #wtbody  tr td {
        border: 0px none;
        padding: 2px 8px !important;
        vertical-align: middle;
    }
    #wtbody td {
        font-size: 12px !important;
    }
    #wtbody td a{
        font-size: 12px !important;

    }
#rmv {
    float: left !important;
    margin-left: 3%;
}
#expo{
float: right;
}
.tabres{
display: inline-block;
float: left;
}
</style>
<?php

require_once(dirname(__FILE__) . '/../config.php');
require_once($CFG->dirroot.'/mod/watchlist/lib.php');
require_once($CFG->dirroot.'/grade/lib.php');
require_once($CFG->dirroot.'/blocks/course_overview/locallib.php');

$PAGE->set_url('/teacher/watchlist.php');
require_login();

$PAGE->requires->js('/teacher/jquery-latest.min.js',true);
$PAGE->requires->js('/teacher/html-table-search.js',true);

$PAGE->requires->css('/teacher/bootstrap-select.css',true);
$PAGE->requires->js('/teacher/bootstrap-select.js',true);

echo "<input id='baseurl' type='hidden' value=".$CFG->wwwroot ."/>";
require_once($CFG->dirroot.'/teacher/customlib.php');
$PAGE->requires->js('/teacher/custom.js',true);
$PAGE->requires->css('/teacher/styles.css',true);


if(user_has_role_assignment($USER->id,3)) {
    $context = context_user::instance($USER->id);
    $PAGE->set_context($context);
    $enrolledcourses = block_course_overview_get_sorted_courses();
    $cours = enrol_get_users_courses($USER->id);
    echo $OUTPUT->header();


?>
<div id="demo">

        <div id="watchlist">
<a href="<?php echo $CFG->wwwroot?>/teacher/dashboard.php" class='link'>Courses</a>
<a href="<?php echo $CFG->wwwroot?>/teacher/reports.php" class='link'>Reports</a>
   <a href="<?php echo $CFG->wwwroot?>/teacher/watchlist.php" class='current link' >Watchlist</a>
<div class="yui3-skin-sam">
    <div id="course-sel">
<?php

    $html = html_writer::start_tag('form', array('action' => new moodle_url('/teacher/inx.php'),
        'method' => 'post'));
    $html .= html_writer::start_tag('label');
    $html .= "Select Course ";
    $html .= html_writer::end_tag('label');
$html .= html_writer::start_tag('select', array('id' => 'selectlist1',
    'class' => 'change-input','class' => 'selectpicker bs-select-hidden',
    'data-live-search'=>'true'
));

   /* $html .= html_writer::start_tag('option', array('value' => '0'));
    $html .= 'Select';
    $html .= html_writer::end_tag('option');*/

    foreach ($cours as $cou) {
        if($coun++==0)
            $courid=$cou->id;
        $html .= html_writer::start_tag('option', array('value' => $cou->id));
        $html .= $cou->fullname;
        $html .= html_writer::end_tag('option');
    }


    $html .= html_writer::end_tag('select');
    echo $html;
echo "</div>";
echo "<div id='notify'></div>";
   echo "<div style='float:right;margin-top:5px;display:inline-block;'><input id='wsearch' placeholder='Search' type='text'></div>";
   echo "<div id='wcontainer' style='display:inline;height:200px;margin-top: 15px;'>";
echo getWatchlistByCourse($courid);
echo "</div>";
echo "<p class='tabres' id='resu'></p> <div id='btmexpo'><p id='expo' class='sortdiv'>Export As <select style='width: 100px !important;'>
                   <option value='pdf'>PDF</option>
                  <!-- <option value='csv'>CSV</option>
                   <option value='xls'>XLS</option>-->
               </select>
               <img style='cursor:pointer;padding-left:5px;' id='wpdf' src='$CFG->wwwroot/pix/a/download_all.png'/></p></div>";

    echo html_writer::tag('input', '',
        array('type' => 'button', 'name' => 'Remove from Watchlist','id'=>'rmv', 'class' => 'bt', 'value' => 'Remove from Watchlist'));
    echo "<input type='hidden' name='wcourse' id='wcourse' value=".$courid."/></div>";
    echo html_writer::end_tag('form');



    echo $OUTPUT->footer();

}
else
    echo "<h1>Not Accessible For Student</h1>";
?>
</div>
</div>
</div>
<script>
$(document).ready(function () {
        var baseUrl=$('#baseurl').val();
        var url=baseUrl;
        $('#page-navbar').append("<div style='padding:6px;'> <a id='dlink'>Dashboard</a> <span>/</span> <b> Watchlist</b></div>");
        $('#dlink').attr("href",url);
    });
</script>

