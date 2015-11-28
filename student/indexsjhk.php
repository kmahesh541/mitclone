<style>
    .breadcrumb-nav{
        padding: 18px;
    }
    label {
        display: inline !important;
        margin-bottom: 5px;
    }
    .btn{
        margin: 20px !important;
        text-align: right !important;
        margin-left: 77% !important;
    }

</style>

<?php
require_once(dirname(__FILE__) . '/../config.php');
require_once($CFG->dirroot . '/my/lib.php');
require_once("$CFG->libdir/formslib.php");
require_once($CFG->dirroot.'/user/profile/lib.php');
require_once($CFG->dirroot.'/blocks/course_overview/locallib.php');
//$user = $DB->get_record('user', array('id'=>$USER->id));
//var_dump($user);
//var_dump(get_complete_user_data(id,3));
echo $OUTPUT->header();

$context = get_context_instance(CONTEXT_COURSE,3);
//$students = get_role_users(5 , $context);
//$courses = get_courses();
//var_dump($courses);

$courses = get_courses();
$context = get_context_instance(CONTEXT_COURSE,3);//course id
$students = get_role_users(5 , $context); //student context

$course = $DB->get_record('course', array('id' => 3), '*', MUST_EXIST);
echo "COURSE NAME : ".$course->fullname;

echo "<table class='generaltable'><thead><td>Name</td><td>Roll NO</td><td>Eamcet Rank</td><td>Department</td><td>Watchlist</td></thead>";
foreach($students as $student){
   $userobj= get_complete_user_data(id,$student->id);
    //var_dump($userobj);
    echo "<tr>";
    echo "<td> ".$userobj->firstname ."</td><td> ".$userobj->profile['rollno']."</td><td> ".$userobj->profile['rank']." </td><td> ".$userobj->profile['dept']." </td><td> ".$userobj->profile['watchlist']."</td></tr>";

}
echo "</table>";
//var_dump($courses);
//var_dump($students);
//var_dump($USER->profile['rollno']);
echo "STUDENT DASH BOARD";
echo $OUTPUT->footer();

?>

