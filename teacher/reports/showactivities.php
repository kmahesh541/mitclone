<?php

require_once(dirname(__FILE__) . '/../../config.php');

global $OUTPUT, $PAGE;

$processing    =   optional_param('processing',0,PARAM_INT);

$new_output = "";

$PAGE->set_context(context_system::instance());

//Get the course id and section id
if($_GET["id1"]){

    $course_id=$_GET['id1'];
    $section_id=$_GET['id2'];

    $persection=$DB->get_field_sql("SELECT `sequence`
FROM `mdl_course_sections`WHERE `course`=".$course_id." AND `section` =$section_id");

    $persection=explode(",",$persection);

    $a=0;
    $R=array();
    foreach($persection as $course_moduleid){

        $module= $DB->get_field_sql("SELECT `module`
   FROM `mdl_course_modules`
   WHERE `id` = $course_moduleid");
        $instance= $DB->get_field_sql("SELECT  `instance`
   FROM `mdl_course_modules`
   WHERE `id`=$course_moduleid
   ");
        $modname= $DB->get_field_sql("SELECT `name`
   FROM `mdl_modules`
   WHERE `id`=$module");
        $tablename="mdl_".$modname;

        $R[$a]=$DB->get_field_sql("SELECT `name`
FROM $tablename
WHERE `id` =$instance
");
        $a=$a+1;
    }

   foreach($R as $act){
        $data.=html_writer::start_tag('option');
        $data.=$act;
        $data.=html_writer::end_tag('option');

    }
}



// AJAX Includes for normal mform Javascript code
// ... First we get the script generated by the Form API


if (!$processing) {
    echo json_encode(array('html' => $data));
} else {
    echo json_encode(array('new_output'=>$new_output));
}

