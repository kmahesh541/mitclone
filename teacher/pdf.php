

<?php
require_once(dirname(__FILE__) . "/../config.php");

require_once($CFG->libdir."/export_reports.php");
require_once($CFG->dirroot."/teacher/report.php");
$cid= optional_param('cid', -1, PARAM_INT); // array od student ids
$sid= optional_param('sid', -1, PARAM_INT); // array od student ids
$exportresult=new Export_Reports();
if(($cid!=-1) && ($sid!=-1)){
$contents1='';
$contents1 .='
<style>
table {
    background-color: #E5B467;
    border-bottom: 1px solid #E5B467;
    color: #FFF;
}
thead  {
    text-decoration:none;
    font-size: 12px !important;
    color: black;
}

 td   {
    background-color: #FFF;
    border-bottom: 1px solid #E6E6E6;
     color: black;
     padding:8px 0px !important;
}
 hr {
    margin-top: 5px;
    border-width: 1px 0px;
    border-style: solid none;
    border-color: #988989;
    margin-bottom: 5px;
}
h3{
text-align: center;text-decoration: underline;
}
</style>
'.getStudentReportbyCoursePdf($sid,$cid);
$exportresult->report_download_pdf($contents1);

}

