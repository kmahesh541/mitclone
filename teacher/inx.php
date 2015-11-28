

<?php
require_once(dirname(__FILE__) . "/../config.php");

require_once($CFG->libdir."/export_reports.php");
require_once($CFG->dirroot."/teacher/customlib.php");
$cid= optional_param('courid', -1, PARAM_INT); // array od student ids

if($cid!=-1) {
    $exportresult = new Export_Reports();
    $course = get_course($cid);

//$contents1.= getWatchlistByCourse(3);
//print_r($contents1);

    $pdfheader='<table style="border:none !important;">

<tr><td style="border:none !important;"></td><td style="width:20%;border:none"></td><td style="text-align:right;border:none">Course:</td><td style="border:none">ABC</td></tr>
<tr><td style="border:none">TESSELLATOR</td><td style="width:20%;border:none"></td><td style="text-align:right;border:none">Report:</td><td style="border:none">ABCDEFR</td></tr>
</table>
<hr/>';
/*
    $pdfheader='<style>div.pdfhead{width:100%}div.pdfright{width:50%;float:right;margin-right:50px}div.pdfhead{font-family: "Open Sans","Trebuchet MS",arial,verdana,sans-serif !important;color: #C14800; font-weight: bold; font-size: 16px; padding-bottom: 0px ! important; margin-bottom: 0px ! important;height: 175px !important;}div.pdfheadleft{float:left;width:40%;}</style>';
    $pdfheadercontent='<div class="pdfhead">
<div class="pdfheadleft"><span style="padding:20px !important;">TESSELLATOR</span></div>
<div class="pdfright">ABC</div>
</div>';*/
    $contents1 = ''.$pdfheader;

    $contents1 .= '
<style>
table.watchlist-table1{
    background-color: #E5B467;

    color: #FFF;
    margin-top:20px;
}
thead  {
    text-decoration:none;
    font-size: 12px !important;
    color: black;
}

 td   {
    background-color: #FFF;

     color: black;
}
a{
text-decoration: none;
color: black;
}
input[type=checkbox]{
display:none;
}
</style>
'. getWatchlistByCoursePdf($cid);
    $exportresult->report_download_pdf($contents1);

}
?>



