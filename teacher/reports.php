<style>
    .breadcrumb-nav{
        padding: 18px;
    }
    label {
        display: inline !important;
        margin-bottom: 5px;
    }
    
    .reporttable{
        overflow-y: scroll;
        height: 580px !important;
    }
#filt{
 margin-bottom: 20px;
}
</style>
<style>

    /*************
     Sai CSS
    *************/

 .reports-page .span2 #search{
     padding: 0px !important;
 }
    .reports-page .filters{
        padding: 4px;
        border: 1px solid rgb(238, 238, 238) !important;
        border-radius: 5px;
        box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.25);
        margin-top: 5px;

    }
    .reports-page .filters select {
        width: 100% !important;
        margin-bottom: 6px !important;

    }
    .reports-page .filters p{
        color: #0362A9;
        font-weight: 600;
    }
    .reports-page .filters p.eamrank{
        font-weight: normal;
    }
    .reports-page  #radiv p.eamrank{
        color: inherit;
        font-size: 12px !important;
    }
    .reports-page .span2 #search{
        width: 100%;
        background-color: #0362A9 !important;
        color: #fff;
        height: 28px;
        text-align: center !important;
    }
    .reports-page .span2 #search:hover{
        width: 100%;
        background-color: #0362A9 !important;
        color: #fff;
        height: 28px;
    }
    .reporttable{
        border: 1px solid rgb(238, 238, 254);
        box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.25);
        margin-left: 2px !important;
        margin-top: -15px !important;
    }
    #showno{
        width: 100px !important;
    }
    #expo select{
        width: 100px !important;
        margin-top: 10px !important;
        margin-top: 10px !important;
    }
    .result-tbl .span12{

        margin-top: 8px;
    }
    .recnum{
        margin-top: 8px !important;
        padding-left: 2px !important;
    }
    #export{
        padding-left: 5px;
        padding-right: 5px;
    }
    /*************
     Sai CSS end
    *************/

    /*************
  Blue Theme
 *************/
    /* overall */


    /* header */



    .tablesorter-blue .headerSortDown,
    .tablesorter-blue .tablesorter-headerSortDown,
    .tablesorter-blue .tablesorter-headerDesc {
        background-color: #8cb3d9;
        /* black desc arrow */

        /* white desc arrow */
        /* background-image: url(data:image/gif;base64,R0lGODlhFQAEAIAAAP///////yH5BAEAAAEALAAAAAAVAAQAAAINjB+gC+jP2ptn0WskLQA7); */
        /* image */
        /* background-image: url(images/black-desc.gif); */
    }
    .tablesorter-blue thead .sorter-false {
        background-image: none;
        cursor: default;
        padding: 4px;
    }

    /* tfoot */
    .tablesorter-blue tfoot .tablesorter-headerSortUp,
    .tablesorter-blue tfoot .tablesorter-headerSortDown,
    .tablesorter-blue tfoot .tablesorter-headerAsc,
    .tablesorter-blue tfoot .tablesorter-headerDesc {
        /* remove sort arrows from footer */
        background-image: none;
    }

    /* tbody */
    .tablesorter-blue td {
        color: #3d3d3d;
        background-color: #fff;
        padding: 4px;
        vertical-align: top;
    }

    /* hovered row colors
     you'll need to add additional lines for
     rows with more than 2 child rows
     */

    /* table processing indicator */
    .tablesorter-blue .tablesorter-processing {
        background-position: center center !important;
        background-repeat: no-repeat !important;
        /* background-image: url(images/loading.gif) !important; */

    }

    /* Zebra Widget - row alternating colors */

    /* Column Widget - column sort colors */

    /* caption */
    caption {
        background-color: #fff;
    }

    /* filter widget */
    .tablesorter-blue .tablesorter-filter-row {

    }
    .tablesorter-blue .tablesorter-filter-row td {
        background-color: #eee;
        line-height: normal;
        text-align: center; /* center the input */
        -webkit-transition: line-height 0.1s ease;
        -moz-transition: line-height 0.1s ease;
        -o-transition: line-height 0.1s ease;
        transition: line-height 0.1s ease;
    }
    /* optional disabled input styling */
    .tablesorter-blue .tablesorter-filter-row .disabled {
        opacity: 0.5;
        filter: alpha(opacity=50);
        cursor: not-allowed;
    }
    /* hidden filter row */
    .tablesorter-blue .tablesorter-filter-row.hideme td {
        /*** *********************************************** ***/
        /*** change this padding to modify the thickness     ***/
        /*** of the closed filter row (height = padding x 2) ***/
        padding: 2px;
        /*** *********************************************** ***/
        margin: 0;
        line-height: 0;
        cursor: pointer;
    }
    .tablesorter-blue .tablesorter-filter-row.hideme * {
        height: 1px;
        min-height: 0;
        border: 0;
        padding: 0;
        margin: 0;
        /* don't use visibility: hidden because it disables tabbing */
        opacity: 0;
        filter: alpha(opacity=0);
    }
    /* filters */
    .tablesorter-blue input.tablesorter-filter,
    .tablesorter-blue select.tablesorter-filter {
        width: 98%;
        height: auto;
        margin: 0;
        padding: 4px;
        background-color: #fff;
        border: 1px solid #bbb;
        color: #333;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-transition: height 0.1s ease;
        -moz-transition: height 0.1s ease;
        -o-transition: height 0.1s ease;
        transition: height 0.1s ease;
    }
    /* rows hidden by filtering (needed for child rows) */
    .tablesorter .filtered {
        display: none;
    }

    /* ajax error row */
    .tablesorter .tablesorter-errorRow td {
        text-align: center;
        cursor: pointer;

    }
   /*   td:nth-of-type(2) {

          display: none;

      }
      th:nth-of-type(2) {

          display: none;

      }*/
    .checkbox1{
        margin-left: 35px !important;
        margin-top: 2px !important;
    }

    .rdo{
        margin: 5px 0px 5px 30px !important;
    }
    /*Filters width*/
    .filters{
        width: 100% !important;
        border: 0px !important;
    }
   /* 
   commented by anusha
    .filters p{
        text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.25);
        background-color: #048EC7;
        background-image: linear-gradient(to bottom, #049CDB, #0378A9);
        background-repeat: repeat-x;
        border-radius: 5px 5px 0px 0px;
        box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.25);
        color: #FFF;
        margin-bottom: 0px;
        padding: 5px;
    }
*/
    .filters .eamrank{
        background: none;
        text-shadow: none;
        color: #000000;
    }

    .filters select{
width:158px !important;
    }
    .pathteacher select{
        background-color: #fff !important;

    }
    .btn {
   height: 28px;
margin-left: 5px;
color: #FFF !important;
text-shadow: none;
background-color: #0362A9 !important;
background-image: linear-gradient(to bottom, #0378A9, #0341A9) !important;
background-repeat: repeat;
border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
background-position: 0px center !important;
}
.reports-page{
/*border: 1px solid #808080;*/

}
.reports-page .span2{
padding-top:20px;
}
/**********************MENU CSS *************/
  #demo a.current:link,   #demo a.current:visited {
        background: #048EC7 linear-gradient(to bottom, #049CDB, #0378A9) repeat-x scroll left -1400px;
        color: #FFF;
        font-weight: bold;
    } /* unvisited and visited links*/

   #demo .link{
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 0px;
        border: solid 1px #20538D;
        background: #FFF;
        border-radius: 0px;
        border: 1px solid #20538D;
        background: #FFF none repeat scroll 0% 0%;
        color: #2E8BC6;
        padding: 8px 10px;
        text-decoration: none;
        font-weight: bold;
        margin: 5px 1px;
    }
   #demo .link:hover{
        text-decoration: none;
        color: #2E8BC6;
    }
#reports-tab
{
padding:10px;
}
.reports-page .btn{

margin: 4px 0px 10px 88px !important;
}
    #cbody tr > td{
        font-size: 13px !important;
        color: #333 !important;
    }
    .filters select{
        width: 100% !important;
        margin-bottom: 0px !important;
    }
.result-tbl{
        border: 0px !important;
    }

    table thead tr th,table thead tr td{

        font-size: 13px !important;
        font-style: normal;
    }
    /*------------------- My Styles--------------*/
    .filters{
        margin-left: 14px;
    }
    .reports-page .btn {
        margin: 4px 0px 0px 10% !important;
        width: 98%;
        padding: 0% 36%;
    }
    .tit {
        font-size: 14px;
        font-weight: bold;
        padding: 3px 5px;
        margin-top: 8px !important;
    }
    .reports-page .span2 {
        padding-top: 10px;
    }
    .reporttable{
        display: inline;
    }
    .reporttable {
        overflow-y: scroll;

        display: inline-block;
        width: 100%;
    }
    .ser > .sortdiv {
        display: inline-block;
        margin: 0px;
    }
    .sort{
        float: left;
        padding: 15px 10px;
    }
    #showno {
        background-color: #FFF !important;
        display: inline-block;
        height: 34px !important;
        margin-bottom: 0px !important;
        font-size: 14px;
        line-height: 18px;
        color: #555;
        border-radius: 4px;
        vertical-align: middle;
        padding: 5px !important;
        margin-top: 3px;
    }
   #expo{
       margin-left: 1%;
       float: right;
       margin-right: 5%;
   }
   tbody tr td {
       padding: 5px 5px !important;
       line-height: 20px !important;
       text-align: left;
       vertical-align: top;
       font-size: 13px !important;
       font-style: normal;
       border-top: 0px solid #DDD;
   }
    #tableData tbody tr:hover td{
        background-color: #F4E1C2 !important;
    }
	.shall{
width: 18%;
display: inline-block;
padding-top: 10px;
}
.result-tbl .sort{
float: left;
width: 50%;
padding: 10px;

}
.generaltable td {
    font-family: "Open Sans","Trebuchet MS",arial,verdana,sans-serif !important;
    vertical-align: top;
    font-size: 13px !important;
    font-style: normal;
    border-top: 0px solid #DDD;
}
#export:hover{
cursor:pointer;
}
#expo select {
    width: 100px !important;
    margin-top: 0px !important;
}
#tableData tbody tr td:nth-child(7){
text-align:center !important;
}
#tableData thead tr th:nth-child(7){
text-align:center !important;
}

    #expo {
        margin-left: 1%;
        float: right;
        margin-right: 5%;
        margin-bottom: 0px !important;
    }
    .result-tbl .sort {
        width: 48%;
        padding-top: 0px !important;
    }
    .shall {
        width: 18%;
        display: inline-block;
        padding-top: 0px;
    }
    #filt tbody tr:hover td{
        background-color: none !important;
    }
    #filt tbody tr td{
        background-color: inherit !important;
        padding-left:20px !important;
    }
    .cell{
        width:25%;

    }
    .reports-page .span3 #search {
        width: 47% !important;
        background-color: #DD9B35 !important;
        color: #FFF;
        height: 28px;
        text-align: center !important;
        background-image: none !important;
        margin: 4px 0px 0px 3% !important;
        display: inline;
    }
    .reports-page .span3 #clear {
        width: 44% !important;
        background-color: #DD9B35 !important;
        color: #FFF;
        height: 28px;
        text-align: center !important;
        background-image: none !important;
        margin: 4px 0px 0px 3% !important;
        display: inline;
    }
    .reports-page .btn {

        padding: 0% 5%;
    }
    .ser{
        padding: 10px 0px 0px !important;

    }
</style>



<?php

require_once(dirname(__FILE__) . '/../config.php');
require_once($CFG->dirroot . '/my/lib.php');
require_once("$CFG->libdir/formslib.php");

require_once($CFG->dirroot.'/blocks/course_overview/locallib.php');


/************* FOR REPORTS ***************/
require_once($CFG->dirroot.'/teacher/reports/reports_db.php');
echo "<input id='baseurl' type='hidden' value=".$CFG->wwwroot ."/>";
$PAGE->requires->js('/teacher/reports/search.js');
$PAGE->requires->css('/teacher/reports/reports.css');
$PAGE->set_url('/teacher/reports.php');
purge_all_caches();


global $OUTPUT, $PAGE, $CFG;

$PAGE->requires->js('/teacher/jquery-latest.min.js');

$PAGE->requires->js('/teacher/jquery.tablesorter.js');
//$PAGE->requires->js('/teacher/jquery.tablesorter.widgets.js',true);
//$PAGE->requires->js('/teacher/datatable.js',true);
//$PAGE->set_url('/teacher/reports.php');
require_login();
if(user_has_role_assignment($USER->id,3)) {
    $context = context_user::instance($USER->id);
    $PAGE->set_context($context);
    $enrolledcourses = block_course_overview_get_sorted_courses();

//$PAGE->blocks->add_region('content');


    echo $OUTPUT->header();
/**************************** MENU *******************************************/

print <<<END
<div id="demo">


        <div id="reports-tab">
<a href=" $CFG->wwwroot/teacher/dashboard.php" class=' link'>Courses</a>
<a href="$CFG->wwwroot/teacher/reports.php" class=' current link'>Reports</a>
   <a href=" $CFG->wwwroot/teacher/watchlist.php" class='link' >Watchlist</a>
</div>
</div>
END;

/****************************************************MENU **************************/
//var_dump($USER->profile['rollno']);

//font awesome and Opensans font
    $html1.=html_writer::start_tag('link',array('href'=>
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
        'rel'=>'stylesheet'
    ));
    $html1.=html_writer::end_tag('link');
    $html1.=html_writer::start_tag('link',array('href'=>
        '//fonts.googleapis.com/css?family=Open+Sans:400,300,700',
        'rel'=>'stylesheet'
    ));
    $html1.=html_writer::end_tag('link');
    echo $html1;

    $timetoshowusers = 3000; //Seconds default
    $timefrom = 100 * floor((time() - $timetoshowusers) / 100);
    $timetoshowusers = 3000; //Seconds default
    $timefrom = 100 * floor((time() - $timetoshowusers) / 100); // Round to nearest 100 seconds for better query cache
    $query = "SELECT COUNT(*)as cou FROM mdl_user AS lastaccess WHERE lastaccess > $timefrom and id !=1";
    $res=$DB->get_record_sql($query);
    
    
/************************************************************
**********************START OF LEFT NAVIGATION **************
*********************************************************************/

      
    print <<<END
    <div class="yui3-skin-sam reports-page">
    <div class="span3" style='margin-top: 10px;'><div><span style="width:80px;float:left;padding-left:2px;display:none"><b>Select to search</b></span>
END;
    /**
     * Edited by Sai
     * btn class remmoved from button
     *
     */
$btn=html_writer::tag("button","Search",array('class'=>'search btn','id'=>'search','value'=>'click me', 'data-url'=> $CFG->wwwroot . '/teacher/reports/showreports.php'));

    $btn.=html_writer::tag("button","Clear",array('class'=>'clear btn','id'=>'clear','value'=>'click me'));

    echo $btn;
    print <<<END

</div><div class="filters">
                <!--Edited by Sai--!>
                   <p class="" id="">Course
                   <!--Edited by Sai close--!>
                   <!--Commented by Sai-- <i id="coi" class="fa fa-angle-double-up" style="font-size:16px;float:right;padding-right:5px;">
				   </i>
				   <i class="fa fa-angle-double-down" style="font-size:16px;float:right;padding-right:5px;"></i>
				   --!>
				   </p>
                   <div id="codiv">
END;

$PAGE->set_context(context_system::instance());

//$PAGE->set_url($CFG->wwwroot . '/local/simpleajax_form/index.php');

/*********************AJAX LIB **********************/
$jsarguments = array();

$jsmodule = array(
    'name'      => 'ilp_ajax_addnew',
    'fullpath'  => '/teacher/reports/simpleajax_form.js',
    'requires'      => array('io','io-form', 'json-parse', 'json-stringify', 'json', 'base', 'node')
);

$PAGE->requires->js_init_call('M.simpleajax_form.init', $jsarguments, true, $jsmodule);



$cours = enrol_get_users_courses($USER->id);
//var_dump($cours);

$html.=html_writer::start_tag("select",array('class'=>'course','id'=>'courses',
    'data-url'=> $CFG->wwwroot . '/teacher/reports/showfilters.php'));
//ADIING SELECT ONE OPTION
$html.=html_writer::start_tag("option",array('value'=>""));
 $html.="Select Course";
$html.=html_writer::end_tag("option");

foreach($cours as $courses=>$name){

    if(is_object($name)){
        foreach($name as $courz=>$value){
            if($courz=='id'){
                $courseid=$value;


            }
            if($courz=='fullname'){
                $html.=html_writer::start_tag("option",array('value'=>$courseid));

                $html.=$value;
                $html.=html_writer::end_tag("option");

            }

        }
    }
}
$html.=html_writer::end_tag("select");
echo $html;
/*   ***************END OF COURSES *****************************/
/***************** FETCHING TOPICS *********************************/
    print <<< END


</div>

                  <!--Commented by Sai-- <p class="tit" id="to">Topic<i id="toi" class="fa fa-angle-double-up" style="font-size:16px;float:right;padding-right:5px;">
				   </i><i class="fa fa-angle-double-down" style="font-size:16px;float:right;padding-right:5px;"></i></p>
                    --!>
                   <div id="todiv">

END;
                 

$html=html_writer::start_tag("select",array('class'=>'topic','id'=>'topics',
    'data-url'=> $CFG->wwwroot . '/teacher/reports/showfilters.php'));
$html.=html_writer::end_tag("select");
echo $html;

/*********************8 START OF ACTIVITIES ****************/


/***************** Activity Type Start *********************************/
    print <<< END


</div>

      <!--Commented by Sai--             <p class="tit" id="to">Activity Type<i id="toi" class="fa fa-angle-double-up" style="font-size:16px;float:right;padding-right:5px;">
				   </i><i class="fa fa-angle-double-down" style="font-size:16px;float:right;padding-right:5px;"></i></p>

                  --!> <div id="todiv">
<select id='activitytype' class='activitytype'>
<option value="" selected>Select Activity Type</option>
                                          <option value="both" selected>Both</option>
                       <option value="quiz"  >Quiz</option>
                       <option value="vpl">Lab</option>
                       

                   </select>

END;
                 



/*********************Activity Type END ****************/


             print <<< END
       </div>

                  <!--Commented by Sai-- <p class="tit" id="ac">Activity <i id="aci" class="fa fa-angle-double-up" style="font-size:16px;float:right;padding-right:5px;">
				   </i><i class="fa fa-angle-double-down" style="font-size:16px;float:right;padding-right:5px;"></i></p>
                   --!>
                   <div id="acdiv">
END;

//activities select
$html=html_writer::start_tag("select",array('class'=>'act','id'=>'act'
    ));
$html.=html_writer::end_tag("select");
echo $html;


    /*********************** START OF GARDE FILTER *********/    
                        print <<< END
                        </div>


                  <!--Commented by Sai-- <p class="tit" id="gr">Grade Type  <i id="gri" class="fa fa-angle-double-up" style="font-size:16px;float:right;padding-right:5px;">
				   </i><i class="fa fa-angle-double-down" style="font-size:16px;float:right;padding-right:5px;"></i></p>
                  --!>
                   <div id="grdiv">
                 
                   <select id='grade' class='grade'>
                                          <option value="" selected>All</option>
                       <option value="submitted" class='sub' style='display:none'>Submitted</option>
                       <option value="notsubmitted" class='nsub' style='display:none'>Not Submitted</option>
                       <option value="graded">Graded</option>
                       <option value="notgraded">Non Graded</option>

                   </select></div>

<!--Edited by Sai-->

<p class="<!--tit-->" id="<!--wt--!>">Watched <!--Edited by Sai over-->
 <!--Commented by Sai <i id="wti" class="fa fa-angle-double-up" style="font-size:16px;float:right;padding-right:5px;">
				   </i><i class="fa fa-angle-double-down" style="font-size:16px;float:right;padding-right:5px;"></i></p>
                   --!>
                   <div id="wtdiv">
                       <input type="radio" class='watchlist' name="watchlist" value="1">Yes
                       <input type="radio" class='watchlist' name="watchlist" value="0" >NO
                        <input type="radio"  class='watchlist' name="watchlist"  checked="checked"  value="undefined" style="margin-left:15px;">Both
                       
                       </div>
                       <!--Edited by Sai-->
                   <p class="<!--tit--!>" id="<!--ra--!>">EAMCET Rank <!--Edited by Sai over-->
                    <!--Commented by Sai
                    <i id="rai" class="fa fa-angle-double-up" style="font-size:16px;float:right;padding-right:5px;">
				   </i><i class="fa fa-angle-double-down" style="font-size:16px;float:right;padding-right:5px;"></i></p>
                   --!>
                   <div id="radiv">
                      <p class="eamrank"><input class="rank" type="checkbox" name='rank' value="1-10000">1-10000</input></p>
<p class="eamrank"><input class="rank" type="checkbox" name='rank' value="10001-20000">10001-20000</input></p>
<p class="eamrank"><input class="rank" type="checkbox" name='rank' value="20000-30000">20000-30000</input></p>
<p class="eamrank"><input class="rank" type="checkbox"  value="30000-40000" name='rank'>30000-40000</input></p>
<p class="eamrank"><input class="rank" type="checkbox" value="40000 and above" name='rank'>40000 and above</input></p>


                   </div>
                        <!--Commented by Sai-- <p class="tit" id="de">Department  <i id="dei" class="fa fa-angle-double-up" style="font-size:16px;float:right;padding-right:5px;">
				   </i><i class="fa fa-angle-double-down" style="font-size:16px;float:right;padding-right:5px;"></i></p>
                   --!>
                   <div id="dediv"><select class='dept' id='dept'>
                   <option value="">Select Department</option>
                       <option value="cse">CSE</option>
                       <option value="it">IT</option>
                       <option value="oth">OTH</option>
                      
                   </select></div>
                   <!--Commented by Sai--
                   <p class="tit" id="se">Section <i id="sei" class="fa fa-angle-double-up" style="font-size:16px;float:right;padding-right:5px;">
				   </i><i class="fa fa-angle-double-down" style="font-size:16px;float:right;padding-right:5px;"></i></p>
                   --!>
                   <div id="sediv"><select id='section'>
                   <option value="">Select Section</option>
                       <option value="a">A</option>
                       <option value="b">B</option>
                       <option value="c">C</option>
                       <option value="d">D</option>
                   </select>
                   </div>
               </div>
    </div>
    <div class="span9 result-tbl">
   
END;

print <<< END
 <div class="ser" style="float:right;padding:10px;"><p class="sortdiv"><input style="margin-top: 2px; font-style: italic; color: #555;" placeholder="Search"  id='search1' type="text"></p>
               </div>
<table id='filt' class='generaltable generalbox quizreviewsummary'>
<tr><th class="cell" scope="row">Course</th><td id='scour' class="cell">--</td><th class="cell" scope="row">Activity Type</th><td id='atype' class="cell">--</td></tr>
<tr><th class="cell" scope="row">Topic</th><td id='stopic' class="cell">--</td><th class="cell" scope="row">Watchlisted</th><td id='swat' class="cell">--</td></tr>

<tr><th class="cell" scope="row">Activity </th><td id='sact' class="cell">--</td><th class="cell" scope="row">Department</th><td id='sdept' class="cell">--</td></tr>

<tr><th class="cell" scope="row">Submission Type</th><td id='ssub' class="cell">--</td><th class="cell" scope="row">Section</th><td id='ssec' class="cell">--</td></tr>
<tr><th class="cell" scope="row">EAMCET Rank</th><td id='seam' class="cell" colspan='3'></td></tr>
</table>


 <div class="reporttable">
END;
$ImgUrl= $OUTPUT->pix_url('loading', 'theme'); 
 
//$result.="<input type='text' id='search1'/>";
    $result.="<table   class=' generaltable' id='tableData'><thead>
                                   <th>Roll No</th>
                                   <th>Full Name</th>
                                  <th>Grade (%)</th>
                                   <th>EAMCET Rank</th><th>Dept</th><th>Sec</th><th>Watchlist</th></thead>";

    /************************************************************************************************************************************************************************************
    ******************GRADE TABLE **************************************************************************************************
    ****************************************************************/


//$gradeObj=new custom_grade_report_db();
/* getting students */

//$students=$gradeObj->getStudentsByCourse(3);
//getting grades based on course 
//$result.=$gradeObj->getGradeByDept($students);
echo $result;

   $tb=html_writer::start_tag("tbody",array('class'=>'target tb','id'=>'tblData'));
$tb.=html_writer::end_tag("tbody");
echo $tb;



    echo "</table>";
$loading_img="<img id='loading' src='".$ImgUrl."'  style='display:none;'/>";
echo $loading_img;

    print <<<END
        </div>
        <div class="span12">
           <div class="span12">
        <div class="sort" style="float:left;padding:10px;">
                 <!--  <p class="sortdiv">Sort By:  <select>
                       <option value="opel">Rank</option>
                       <option value="audi">Watch List</option>
                       <option value="audi">Submission List</option>

                       <option value="volvo">Grade High to Low </option>
                       <option value="saab">Grade Low to High</option>
                   </select></p> -->
                <!--Commented by Sai   <p class="sortdiv new">Show Records :  <select id="showno" class="showno">
                       <option value="20">20</option>
                       <option value="50">50</option>
                       <option value="100">100</option>
                       <option value="all" selected>All</option>
                   </select></p>-->
                    <p class="recnum"><span class='tblcount'>(0)</span> results found</p>

               </div>
<div class='shall'><p class="sortdiv">Show   <select id="showno" class="showno">
                       <option value="20">20</option>
                       <option value="50">50</option>
                       <option value="100">100</option>
                       <option value="all" selected="">All</option>
                   </select></p></div>
END;
    /**
     *
     *
     */
echo "<p id='expo' class='sortdiv'><span id='exp'>Export As </span><select>
                   <option value='pdf'>PDF</option>
                  <!-- <option value='csv'>CSV</option>
                   <option value='xls'>XLS</option>-->
               </select>";
$export=html_writer::start_tag("img",array('class'=>'export bt','id'=>'export','value'=>'Export','src'=>$CFG->wwwroot.'/pix/a/download_all.png'
    ,'data-url'=> $CFG->wwwroot . '/teacher/grade_export.php'));
//Commented By sai $export.="Export";
$export.=html_writer::end_tag("img");
$export.="</p>";
echo $export;

/*print <<<END
<input type="button" value="Send Mail" name="submit"></input>
        </div>
        </div>
        </div>
        </div>

        <div id="watchlist">
END;
*/


    echo $OUTPUT->footer();


}
else
    Echo "<h1>Not Accessible For Student</h1>";
print <<<END
</div>
</div>
</div>
END;

?>
<!-- script for show start -->
<script type="text/javascript">
 $('#showno').change(function(){
var x=$('#showno').val();

if(x=='all')
{

$("#tableData tr:gt(0)").show();

}
else
{

$("#tableData tr:gt("+x+")").hide();
$("#tableData tr:lt("+x+")").show();
}
 });
</script >
<!-- script for show end -->
<!-- SCRIPT FOR SEARCH START -->

<script type="text/javascript">
			$(document).ready(function()
			{
				$('#search1').keyup(function()
				{
					searchTable($(this).val());
				});
			});
			function searchTable(inputVal)
			{
				var table = $('#tblData');
				table.find('tr').each(function(index, row)
				{
					var allCells = $(row).find('td');
					if(allCells.length > 0)
					{
						var found = false;
						allCells.each(function(index, td)
						{
							var regExp = new RegExp(inputVal, 'i');
							if(regExp.test($(td).text()))
							{
								found = true;
								return false;
							}
						});
						if(found == true)$(row).show();else $(row).hide();
					}
				});
			}
		</script>
<!-- SCRIPT FOR SEARCH END -->

<script id="js">$(function() {
		var baseUrl=$('#baseurl').val();
            var url=baseUrl+'teacher/dashboard.php';
            $('#page-navbar').append("<div style='padding:6px;'> <a id='dlink'>Dashboard</a> <span>/</span> <b> Reports</b></div>");
            $('#dlink').attr("href",url);


        $("#courses").change(function(){
            $("#scour").text($('option:selected', $(this)).text());
        });
        $("#topics").change(function(){
            $("#stopic").text($('option:selected', $(this)).text());
        });
        $("#act").change(function(){
            $("#sact").text($('option:selected', $(this)).text());
        });
        $("#grade").change(function(){
            $("#ssub").text($('option:selected', $(this)).text());
        });
        $("#dept").change(function(){
            $("#sdept").text($('option:selected', $(this)).text());
        });
        $("#section").change(function(){
            $("#ssec").text($('option:selected', $(this)).text());
        });
        $("#activitytype").change(function(){
            $("#atype").text($('option:selected', $(this)).text());
        });


        $('input:radio[name="watchlist"]').change(function(){
            val=$("input[name='watchlist']:checked").val()
              if(val==0){
                  $("#swat").text('Not Watch listed');
              }
            else  if(val==1){
                  $("#swat").text('Watch listed');
              }
            else{
                  $("#swat").text('Both');
              }

        });


        $(".rank").change(function() {
            if(this.checked)
            {

                $('#seam').append($(this).val()+' ');

            }
            else{
                $('#seam').text('');
            }

        });

        var $table = $('table').tablesorter({
            theme: 'blue',
            widgets: ["zebra", "filter"],
            widgetOptions : {
                filter_columnFilters: false,
                filter_saveFilters : true,
                filter_reset: '.reset'
            }
        });
        $.tablesorter.filter.bindSearch( $table, $('.search') );


        $('select').change(function(){

            $('#cours tbody tr').hide(); // hiding all trs
            $("#cou").val($(this).val());
            var x='.'+$(this).val();
            $(x).fadeIn('fast');
            if($(this).val()=='all')
                $('#cours tbody tr').show(); // hiding all trs

            $('.selectable').attr( 'data-column', $(this).val() );
            $.tablesorter.filter.bindSearch( $table, $('.search'), true );
        });


            $("#selecctall").change(function(){
                $(".checkbox1").prop('checked', $(this).prop("checked"));
            });







    });





</script>



<style>
    .filtered{
        border:1px solid #ccc;

    }
    .filtered tr td{
        border:1px solid #ccc;
        padding:10px;
    }
</style>

