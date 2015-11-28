<style>
    table.flexible th, .generaltable th, table.flexible td, .generaltable td {
        line-height: 20px;
        text-align: left;
        padding: 5px 0px;
    }
    .generaltable thead:first-child tr:first-child th:first-child {
        text-align: center;
    }
    .generaltable tbody tr td:first-child {
        text-align: center !important;
    }
    #myTable td{
        padding:2px 10px;
    }
.propic img {
    height: 130px !important;
    width: 110px !important;
}
.prof{
margin-top: 15px;
}
.snap {
    width: 50% !important;
    display: inline-block;
}

#creport{
padding: 0px;
min-height: 250px;
display: inline-block;
width: 49% !important;
float: right;
}
#cbody hr {
	margin-top: 2px;
	border-width: 1px 0px;
	border-style: solid none;
	border-color: #E1DDDD !important;
	margin-bottom: 5px;
}
.prof {
    width: 49% !important;
    float: right;
}
.rollno{
width: 60% !important;
float: left;
padding-left: 10%;
}
.details{
width: 20% !important;
float: left;
}
#myTable tbody tr td:first-child, #myTable thead tr th:first-child{
text-align:left !important;;
padding-left:10px !important;
}
#myTable thead tr th{
font-size:12px !important;
}
#myTable thead tr th:nth-child(2),#myTable thead tr th:nth-child(3),#myTable thead tr th:nth-child(4),#myTable thead tr th:nth-child(5){
text-align:center;
padding-left:10px !important;
}
#myTable tbody tr td:nth-child(2),#myTable tbody tr td:nth-child(3),#myTable tbody tr td:nth-child(4),#myTable tbody tr td:nth-child(5){
text-align:center;
padding-left:10px !important;
}
#cours tbody tr td:nth-child(3),#myTable tbody tr td:nth-child(4){
text-align:center;
padding-left:10px !important;
}
#Report:hover{
cursor:pointer;
}
.row1 {
    height: 100%;
    width: 100%
}
.row1 .snap {
    overflow: auto
}
.row1 .prof {
    overflow: auto
}
.row1 .prof {
    overflow: auto
}
.vsplitbar {
    width: 2px;
    background: #cab
}
.vsplitbar:hover{
    background: #eab
}
.prof {
    margin-top: 0%;
}
#creport {
    margin-top: -12px;
}

</style>
<?php
require_once(dirname(__FILE__) . '/../config.php');
require_once($CFG->dirroot . '/my/lib.php');
require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot.'/blocks/course_overview/locallib.php');
require_once($CFG->dirroot.'/grade/querylib.php');
require_once($CFG->dirroot.'/grade/lib.php');
$PAGE->requires->js('/teacher/jquery-latest.min.js',true);
require_once($CFG->dirroot.'/mod/watchlist/lib.php');
$PAGE->set_url('/teacher/student_profile.php');
require_login();
echo "<input id='baseurl' type='hidden' value=".$CFG->wwwroot ."/>";
$id= optional_param('sid', -1, PARAM_INT);

require_login();
        $student= get_complete_user_data(id,$id);
if(user_has_role_assignment($USER->id,3)) {
    $context = context_user::instance($USER->id);
    $PAGE->set_context($context);

    echo $OUTPUT->header();

    ?>
    <div class="row1">
        <div class="snap">

            <h4 style="text-align: left;
margin: 0px 2px;"><?php echo ucfirst($student->firstname); ?>  <input name="View Profile" value="Profile" id='viewp' type="button" style='float:right;'></h4><h4 style="text-align: left;margin: 15px 2px;">Performance Snapshot<input name="Full Report" value="Full Report" id='viewp' type="button" style='float:right;'> </h4>

             <table id="myTable" class="generaltable" style="background-color:#EBEDF7;text-align:left;width:100%;" width="100%"  cellpadding="2" cellspacing="0">
                <thead>
                <tr><th>Course</th>
<th>Total<br>Labs</th>
                    <th>Attempted<br/>Labs</th>
<th>Total<br>Quizs</th>
                    <th>Attempted<br/>Quizs</th>
        
                    <th>Mean Grade</th>
                    <th>Actions</th>
                </tr></thead>
                <tbody>
                <?php
                $html='';
//$id=$USER->id;
                $studentenrolledcourses = enrol_get_users_courses($USER->id);

                $coursecount=0;$tgrade=0;
    $countlabs=0;
    $countquiz=0;
    $submittedlab=0;
    $gradedlabs=0;
    $notattemptedlabs=0;
    $submittedquiz=0;
    $gradedquiz=0;
    $notattemptedquiz=0;
                foreach($studentenrolledcourses as $course)
                {


                    $coursecount++;
                    $html.=html_writer::start_tag('tr');
                    $html.=html_writer::start_tag('td',array('align'=>'left'));
                    $html.=$course->fullname;
                    $html.=html_writer::end_tag('td');
                    $activities=get_array_of_activities($course->id) ;

      foreach($activities as $key1 => $value1){
        if(is_object($value1)){
            if (($value1->mod == 'vpl') || ($value1->mod == 'quiz')) {
                $act[$value1->name] = $value1->mod;
                $actid[$value1->name] = $value1->cm;
            }
        }
    }
                    

                    // getting course average grade
                    $grade_r = grade_get_course_grades($course->id, $USER->id);// courseid studentid
                    $grd = $grade_r->grades[$USER->id]; //student id
                    $cgrd=$grd->str_grade;
                    $tgrade+=$cgrd;
                    $vpl=0;$quiz=0;
                    foreach($act as $key2 => $value2){
        if($value2=='vpl'){
            $countlabs=$countlabs+1;
            $getvplinstance=$DB->get_field_sql("SELECT `instance`
FROM `mdl_course_modules`
WHERE `id` ='$actid[$key2]'
AND `course` ='$courseid'");

            $submissions=$DB->get_fieldset_sql("SELECT  `datesubmitted`
FROM `mdl_vpl_submissions`
WHERE `vpl` ='$getvplinstance'
AND `userid` ='$USER->id'");

            // var_dump($getvplinstance);
            if(is_array($submissions))
            {
                if(sizeof($submissions)>0)
                {
                    $submissions=1;
                }

                else
                {
                    $submissions=0;
                    $notattemptedlabs=$notattemptedlabs+1;
                }

            }
            else{
                $submissions=0;
                $notattemptedlabs=$notattemptedlabs+1;
            }
            $grades=$DB->get_fieldset_sql("SELECT   `dategraded`
FROM `mdl_vpl_submissions`
WHERE `vpl` ='$getvplinstance'
AND `userid` ='$USER->id'");
            if(is_array($grades))
            {   $num=0;
                foreach($grades as $grd){
                    if($num<$grd)
                        $num=$grd;
                }
                if($num>0)
                    $grades=1;
                else
                    $grades=0;
            }
            else{
                $grades=0;
            }
            $submittedlab=$submittedlab+$submissions;
            $gradedlabs=$gradedlabs+$grades;
        }
    }
   
                    $html.=html_writer::start_tag('td',array('align'=>'center'));
                    $html.=$countlabs;
                    $html.=html_writer::end_tag('td');
$html.=html_writer::start_tag('td',array('align'=>'center'));
                    $html.=$submittedlab;
                    $html.=html_writer::end_tag('td');
                    $html.=html_writer::start_tag('td',array('align'=>'center'));


 $countquiz=0;
    foreach($act as $key3 => $value3){
        if($value3=='quiz'){
            $countquiz=$countquiz+1;
            $quizid=$DB->get_field_sql("SELECT `id`
FROM `mdl_quiz`
WHERE `course` ='$courseid'
AND `name` = '$key3'");

            $attempts=$DB->get_fieldset_sql("SELECT `attempt`
FROM `mdl_quiz_attempts`
WHERE `quiz` ='$quizid'
AND `userid` ='$USER->id'");
          // var_dump($attempts);
            if(is_array($attempts)){
                $attempts=sizeof($attempts);
                if($attempts>0){
                    $submissions=1;
                    $graded=$DB->get_field_sql("SELECT `grade`
FROM `mdl_quiz_grades`
WHERE `quiz` ='$quizid'
AND `userid` ='$USER->id'");

                    if($graded==''){
                        $grades=0;
                    }
                    else{
                        $grades=1;
                    }
                }
                else{
                    $submissions=0;
                    $grades=0;
                }
            }

            else{
                $submissions=0;
                $grades=0;
            }

            $submittedquiz=$submittedquiz+$submissions;
            $gradedquiz=$gradedquiz+$grades;
        }
    }

                    $html.=$countquiz;
                    $html.=html_writer::end_tag('td');
$html.=html_writer::start_tag('td');
                    $html.=$submittedquiz;
                    $html.=html_writer::end_tag('td');
                    $html.=html_writer::start_tag('td');
                    $html.=$cgrd;
                    $html.=html_writer::end_tag('td');
                    $html.=html_writer::start_tag('td');

                    $html.="<img src='https://cdn2.iconfinder.com/data/icons/freecns-cumulus/16/519597-095_Chart-128.png' style='width:16px;height:16px;padding-left:10px;' class='report' name='$course->id-$id' id='Report' style='cursor:pointer' >";
                    $html.=html_writer::end_tag('td');
                    $html.=html_writer::end_tag('tr');
                    $act=null;
                }

                echo $html;
                ?>
                </tbody>
            </table>
        </div>
        <?php

        //var_dump($student);
        ?>
        <div class="prof">
            <div class="profile">
                <h3 style="text-align:center;"><?php echo ucfirst(fullname($student));?> Profile</h3>
                <div class="rollno" style="width:68%;float: left;">
                   <!-- <p> Name : <b><?php echo ucfirst($student->firstname);?></b></p>-->
                    <p>Roll Number : <b style="text-transform:Uppercase;"><?php echo $student->profile['rollno'];?></b> </p>

                    <p>Eamcet Rank : <b style="text-transform:Uppercase;"><?php echo $student->profile['eamcetrank'];?></b> </p>
                    <p>Watchlisted : <b style="text-transform:Uppercase;"><?php echo getAllWatchlistCountByUser($id)?></b> Times</p>
                    <p>Email : <?php echo $student->email;?> </p>
                    <p>Phone No : <b style="text-transform:Uppercase;"><?php echo $student->phone1;?></b> </p>

                </div>
                <div class="details" style="width:32%;float: left;">
                    <div class="propic">
                        <img src="<?php echo $CFG->wwwroot; ?>/user/pix.php/<?php echo $id; ?>/f1.jpg " >
                    </div>
                    <p>Grade : <b><?php echo round($tgrade/$coursecount,2) ?></b></p>
                </div>

            </div>
        </div>
	 <div class="topic" id="creport" style="padding: 0px 0px;min-height:250px;">

        </div>
<div class='span12' style='display:inline;'>
<div class="span6" style='display:inline;'></div>
 <div id="expo" class="span6 " style="padding: 0px 0px 0px 17%;
width: 48%;
float: right;display:none;">
            <span>Export as </span><select style="width: 100px !important;">
                   <option value="pdf">PDF</option>
                  
               </select>
               <img style="cursor:pointer;padding-left:5px;" id="rexport" src="<?php echo $CFG->wwwroot.'/pix/a/download_all.png'?>"/>
            <input type="button" name="Send Mail" value="Send Mail" />


        </div>
</div>
    </div>
   
    <div class="row3" style="display:none;">

        <div class="span6"></div>
        <div class="span6 " style="padding:15px;width: 30%;
float: right;">
     <!--       <span>Export as </span><select style='width: 100px !important;'>
                   <option value='pdf'>PDF</option>
                  <!-- <option value='csv'>CSV</option>
                   <option value='xls'>XLS</option>
               </select>
               <img style='cursor:pointer;padding-left:5px;' id='rexport' src="<?php echo $CFG->wwwroot.'/pix/a/download_all.png'?>"/>
            <input type="button" name="Send Mail" value="Send Mail" />-->
            <input type="hidden"  id='courid' name="selected course" value="" />

        </div>

    </div>

    <?php



    echo $OUTPUT->footer();


}
?>
<style>
.rollno p {
    font-size: 16px !important;
    margin: 8px 9px !important;
}
.details p{
font-size: 16px;
}
#creport{
margin-top: 12px;
}
</style>

<script>

 $(document).ready(function () {

        var baseUrl=$('#baseurl').val();
        var url=baseUrl+'teacher/dashboard.php';
        $('#page-navbar').append("<div style='padding:6px;'> <a id='dlink'>Dashboard</a> <span>/</span> <b> Student Profile</b></div>");
        $('#dlink').attr("href",url);

    });
// Remove From Watchlist
$('#rexport').click(function() {
    var baseUrl='<?php echo $CFG->wwwroot?>';
    val=$('#courid').val();
    arr=val.split("-");
    window.open(baseUrl+'/teacher/pdf.php?cid='+arr[0]+'&sid='+arr[1], '_blank');

});
$('#viewp').click(function(){
$('.prof').toggle();
});
        $('.report').click(function() {
            var baseUrl='<?php echo $CFG->wwwroot?>';
            val=$(this).attr('name');
            arr=val.split("-")
            $('#courid').val(val);
            $(".row3").show();
              $.ajax({
             type: "GET",
             dataType: "html",
             data: {cid:arr[0],sid:arr[1]},
             url: baseUrl+"/teacher/report.php",
             success: function(msg){
             $('#creport').html(msg);
             },
             error: function (xhr, status) {
             alert("Sorry, there was a problem!");
             },
             complete: function (xhr, status) {
		$(".prof").hide();
$("#expo").show();
             }
             });
        });



</script>


