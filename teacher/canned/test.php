<?php
require_once(dirname(__FILE__) . '/../../config.php');
global $PAGE,$CFG;
$PAGE->requires->js('/teacher/jquery-latest.min.js');

$PAGE->requires->js('/teacher/canned/test.js');


$export="<a href='".$CFG->wwwroot."/teacher/canned/teacher_reports.php' >TEST </a>";

echo $export;
?>
