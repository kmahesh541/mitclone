
<style>

    .btn-default{
        margin-top: -10px !important;
    }
    .cooursesel {
        margin-top: 0px !important;
    }
    #cours thead tr th:first-child{
        text-align: center;
    }
    #cours tbody tr:hover td{
        background-color: #F4E1C2 !important;
    }
#cours {
margin-top:15px !important;
}

</style>
<?php
require_once(dirname(__FILE__) . '/../config.php');
require_once($CFG->dirroot.'/mod/watchlist/lib.php');
require_once($CFG->dirroot.'/grade/lib.php');
require_once($CFG->dirroot.'/blocks/course_overview/locallib.php');
require_once($CFG->dirroot.'/grade/querylib.php');
require_once($CFG->dirroot.'/teacher/customlib.php');
$PAGE->set_url('/teacher/dashboard.php');
require_login();
$PAGE->requires->js('/teacher/jquery-latest.min.js',true);
$PAGE->requires->js('/teacher/html-table-search.js',true);
echo "<input id='baseurl' type='hidden' value=".$CFG->wwwroot ."/>";
$PAGE->requires->js('/teacher/custom.js',true);

$PAGE->requires->css('/teacher/bootstrap-select.css',true);
$PAGE->requires->js('/teacher/bootstrap-select.js',true);


$PAGE->requires->css('/teacher/styles.css',true);


if(user_has_role_assignment($USER->id,3)) {
    $context = context_user::instance($USER->id);
    $PAGE->set_context($context);
    $enrolledcourses = block_course_overview_get_sorted_courses();


/*// activity grade
$instace= $DB->get_field_sql("SELECT  `instance`
   FROM `mdl_course_modules`
   WHERE `id`=$course_moduleid
   ");
$grading_info=grade_get_grades('$cid', 'mod', '$modname', '$instace', '$sid'); // course mod name instance sid
$item = $grading_info->items[0];
$grade= $item->grades[4];
$mygrade =round($grade->grade+0,2); // Convert to number.
echo "Act Grade : ".round($mygrade,2);


// course grade
$grade_r = grade_get_course_grades(3, 4);
$grd = $grade_r->grades[4];
$grd=$grd->str_grade;
echo "Course Grade : ".$grd;*/
///$instace= $DB->get_records_sql("SELECT * FROM `mdl_course_modules`");

    echo $OUTPUT->header();


?>

<div id="demo">


        <div id="courss">
<a href="<?php echo $CFG->wwwroot?>/teacher/dashboard.php" class='current link'>Courses</a>
<a href="<?php echo $CFG->wwwroot?>/teacher/reports.php" class='link'>Reports</a>
   <a href="<?php echo $CFG->wwwroot?>/teacher/watchlist.php" class='link' >Watchlist</a>
<br/>

        <div class="yui3-skin-sam">
<?php

    $cours = enrol_get_users_courses($USER->id);
    $html .= html_writer::start_tag('form', array('action' => new moodle_url('/teacher/testcenter/index.php'),
        'method' => 'post'));
$html.="<div class='cooursesel'>";
    $html .= html_writer::start_tag('label');
    $html .= "Select Course ";
    $html .= html_writer::end_tag('label');
    $html .= html_writer::start_tag('select', array('id' => 'selectlist',
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
$html.="</div>";

    echo $html;

   ?>

            <div class="status">
 <label style="padding: 5px 10px;display:inline-block;">Status:  </label>
                <div style="display: inline; font-size: 10px;">0</div>
                <meter id="cousta" value="0" ></meter>
                <div style="display: inline; font-size: 10px;">100%</div>
            </div>
    <div class="cousearch"><input id='wsearch' placeholder='Search' type='text'></div>

 <div id="container" style="display: inline;min-height:250px;">

<?php
$course = $DB->get_record('course', array('id' => $courid), '*', MUST_EXIST);
echo get_courselist($course);
?>


</div>
<?php
    echo html_writer::tag('input', '',
        array('id'=>'gtt','type' => 'submit', 'name' => 'GO TO TEST CENTER', 'class' => 'butn', 'value' => 'Go to Test Center'));

    echo html_writer::end_tag('form');

echo "</div>";

    echo $OUTPUT->footer();
    echo "</div>";

}
else
    echo "<h1>Not Accessible For Student</h1>";

?>
            <script>
            $( document ).ready(function() {
                op = $('#cstatus').val();
                arr = op.split(",");
                if(arr[1]!=0 && arr[0]!=''){
                val = parseFloat(arr[0]) / parseFloat(arr[1]);
                $('#cousta').val(val);
                    $("#gtt").removeAttr("disabled");
                }
                else{
                    $('#cousta').val(0);
                    $('#gtt').attr('disabled',true);
                }
                var baseUrl=$('#baseurl').val();
                    var url=baseUrl+'teacher/dashboard.php';
                    $('#page-navbar').append("<div style='padding:6px;'> <a id='dlink'>Dashboard</a> <span>/</span> <b> Courses</b></div>");
                    $('#dlink').attr("href",url);
            });

            $('form').bind("keypress", function(e) {
                if (e.keyCode == 13) {
                    e.preventDefault();
                    return false;
                }
            });
            </script>
