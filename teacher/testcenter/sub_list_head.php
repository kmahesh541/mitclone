<?php
/**
 * Created by PhpStorm.
 * User: Mahesh
 * Date: 16/11/15
 * Time: 4:12 PM
 *
 *
 * it includes css and head part of test center
 */
?>
<head>

    <base href="">
	<title>ISEEIT</title>


	


    <style>

        select, textarea, input[type="text"], input[type="password"], input[type="datetime"],
        input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"],
        input[type="week"], input[type="number"], input[type="email"], input[type="url"],
        input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
            display: inline-block;
            height: 30px !important;
			padding: 4px 6px;
			margin-bottom: 9px;
			font-size: 13px;
			line-height: 18px;
			color: #555;
			border-radius: 4px;
			vertical-align: middle;
		}
		.tleft{ float:left;width:49.5%;height:130px;}
		.tright{ float:right;width:49.5%;overflow-y: scroll;  height: 120px;}
		.sta{border:1px solid gray;  margin-top:10px;float:left;width:100%;height:75px;}
		.sub{
            width: 23%;
            border-right: 1px solid #808080;
			padding: 15px 10px;
			font-size: 16px;
			float: left;
			height: 45px;

		}
		.subp{margin-top:5px;font-size: 16px;padding-top: 0px;}
		.subp2{margin-top:2px;font-size: 14px;}
		.report{border: 1px solid #808080;
			margin-top: 3px;
			padding: 0px;
			float: right;
			width: 100%;}
        .con{width:100%;}

        .container-demo{
            width: 1170px;margin-right: auto;margin-left: auto;
        }


        .repo{margin-top:10px;width:100%;height:350px;float:left;padding-top:10px;}
		#panel, #flip {
			padding: 5px;
			text-align: center
		}
		p, fieldset, table, pre {
            margin-bottom: 0em !important;
		}

		meter {
            font-size: 6px;
			margin-top: 5px;
			width: 85%;
		}
		#flip{
			color: #FFF;
			text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.25);
			background-color: #048EC7;
			background-image: linear-gradient(to bottom, #049CDB, #0378A9);
			background-repeat: repeat-x;
			border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
			text-align: center;
			border-width: 0px 0px 1px 1px;
			font-size: 15px;
			font-family: Arial;
			font-weight: bold;
			color: #FFF;
			cursor: pointer;
		}

		#fl{
			text-align:right;padding-right:20px;margin-top:5px
		}
		.fa-angle-double-up,.fa-angle-double-down{
            font-size:18px;
		}
		#ccourse{
			float:left;margin-right:180px;margin-left:40px;
		}
		#ctopic{
			float:left;margin-right:180px;
		}
		#cactivity{
			float:left;margin-right:180px;
		}
		#panel {
			display: block;
		}

		#t01 th, td {
			padding: 5px;
			text-align: left;
			border: 1px solid black;

		}
		table#t01 {
			width: 100%;
			border: 1px solid gray;
			border-collapse: collapse;
		}



		#progressBar {
			width: 400px;
			height: 22px;
			border: 1px solid #111;
			background-color: #292929;
		}
		#progressBar div {
			height: 100%;
			color: #fff;
			text-align: right;
			line-height: 22px; /* same as #progressBar height if we want text middle aligned */
			width: 0;
			background-color: #0099ff;
		}
		.btn {
        background: #3498db;
        background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
        background-image: -moz-linear-gradient(top, #3498db, #2980b9);
        background-image: -ms-linear-gradient(top, #3498db, #2980b9);
        background-image: -o-linear-gradient(top, #3498db, #2980b9);
        background-image: linear-gradient(to bottom, #3498db, #2980b9);
			font-family: Arial;
			color: #ffffff;
			font-size: 15px;
			padding: 5px 18px 6px 18px;
			text-decoration: none;
		}

		.btn:hover {
        background: #3cb0fd;
        background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
        background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
        background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
        background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
        background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
			text-decoration: none;
		}
		.CSSTableGenerator { overflow: auto; }
		.CSSTableGenerator tbody { height: auto; }


        tbody tr td:first-child{
            text-align: center;
        }
            tbody tr td:last-child{
        text-align: center;
            }
            tbody tr th:first-child{
        text-align: center !important;
            }
            tbody tr th:last-child{
        text-align: center !important;
            }

            .navbar {
        margin-bottom: 0px;
            }
            thead{
        cursor: pointer;
    }
            td{height: 30px;}
        #t01 img{
        padding:5px;
        }
        .sta {
            border: 1px solid #808080;
            margin-top: 0px;
            float: left;
            width: 100%;
            height: 45px;
        }
        .sub {
            width: 23%;
            border-right: 1px solid #808080;
            padding: 2px 10px;
            font-size: 16px;
            float: left;
            height: 42px;
        }
         .repo {
            margin-top: 0px;
            width: 100%;
            height: 350px;
            float: left;
            padding-top: 5px;
        }
        .report {
            border: 1px solid #808080;
            margin-top: 3px;
            padding: 0px;
            float: right;
            width: 100%;
            height: 750px;
            margin-bottom: 30px;
        }
        #fl{
        height:20px;
        }
        .showhide{
            border: none;
            background: none;
            cursor: pointer;
        }
	.pagecover1{
	    display: none; position: absolute; width: 95%; background-color: rgb(255, 255, 255); z-index: 300; opacity: 0.9; height: 800px; top: 60px;margin-left: -10px;
	}
.pagecover{
	    display: none;
}
.watchlist {
    cursor: pointer;
}

#current-activity{
font-weight:bold;
}

/*#current-activity {
  animation: blinker 2.7s cubic-bezier(.5, 0, 1, 1) infinite alternate;
}
@keyframes blinker {  
  from { opacity: 1; }
  to { opacity: 0; }
}*/


/* Test Center Css */
table tbody tr {
	border: 1px solid  #CDCDCD ;
}
		.sta {
			margin:5px;
			border:0px;
		}
		table tbody tr td {
			border: 1px solid  #CDCDCD ;
		}
		.sub {
			border: 1px solid  #CDCDCD ;
		}
		#show {
			background: transparent;
			background-image: none;
			background-repeat: repeat-x;
		}
table{width:100%;}

		#myTable thead tr th{
			padding:8px !important;
			font-size:15px;
		}
		table thead tr th{
			padding:8px !important;
			font-size:15px;
		}
		#myTable tbody tr td{
			border:0px;
		}
		table thead tr th, table thead tr td {
			font-size: 13px !important;
			font-style: normal;
			text-align: left;
		}
		.container, .navbar-static-top .container, .navbar-fixed-top .container, .navbar-fixed-bottom .container {
			width: 100% !important;
		}
		.tleft {
			float: left;
			height:auto;
			width: 30%;
		}
		.tright {
			float: right;
			overflow-y: scroll;
			height: auto;
			width: 69.7%;
		}
		.report {
			border: 0px solid #808080;
			margin-top: 3px;
			padding: 0px;
			float: right;
			width: 100%;
			height: 695px;
			margin-bottom: 30px;
		}
		#stu-section{
			width: 100px !important;
			margin-bottom: 0px !important;
		}

	</style>
	<style>
		.sub{
			width:10% !important;
		}
		.tright {
			float: right;
			overflow-y: scroll;
			height: 140px !important;
			width: 68.5%;
			padding: 0px !important;
		}
		.tright table tr td:nth-child(2){
			font-weight: bold;
		}
		.tleft tr td:first-child{
			width: 20%;
			font-weight: bold;

		}
		.tright table tr:hover td{
			background-color: transparent !important;
		}
		.tleft table tr:hover td{
			background-color: transparent !important;
		}
		.tleft tr td{
			padding: 5px;
			line-height: 12px;
			vertical-align: top;
			font-size: 12px !important;
		}
		.coursetab tbody tr:first-child td{
			background-color: rgb(228, 228, 228) !important;
		}
		.tleft tbody tr td:last-child {
			text-align: left;
		}
		#show{
			background-color: rgb(70, 165, 70);
			color: #FFF;
			font-size: 12px;
			padding: 2px 10px;
			display: inline-block;
			float: left;
		}
		#hide{
			color: #FFF;
			display: inline-block;
			font-size: 12px;
			padding: 2px 10px;
			float: left;
			background-color: rgb(157, 38, 29);
			margin-left: 8%;
		}
		#complete{
			background-color:red;
			color:#FFF;
		}
		.stopclose{
			background-color: red;color: rgb(255, 255, 255); display: inline-block; font-size: 12px; padding: 2px 10px; float: left; margin-left: 8%;
		}
		.stopclose:hover{background-color: red;}
		.showhide:hover{
			color:#fff;
		}
		#titile-sta{
			text-align: center ! important; float: left;width: 95%;
		}
		input[type:"button"]:hover, input[type:"button"]:focus{
															-moz-border-bottom-colors: none;
															-moz-border-left-colors: none;
															-moz-border-right-colors: none;
															-moz-border-top-colors: none;
															background-color: #F5F5F5;
															background-image: linear-gradient(to bottom, #FFF, #E6E6E6);
															background-repeat: repeat-x;
															border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) #B3B3B3;
															border-image: none;

														}
		.tleft{
			width:29% !important;
		}
		#stas td{
			text-align: center !important;
			font-weight: bold;
		}

		#stas td{
			line-height: 16px;
			font-size: 12px !important;
			font-style: normal;
			border-top: 0px solid #DDD;
			padding: 0px;
			color: #655C5C;
			text-align: center;
			color:#655C5C;
		}
		#stas tr:hover td{
			background-color: transparent !important;
		}
		#panel{
			height:140px;
		}
		#stas{
			margin:5px 5px 5px 5px;
			width:99%;
		}
		#coursename{
			width: 100%; height: 75px;
			border: 0px solid rgb(243, 240, 240);
			background-color: rgb(118, 139, 149);
			box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.6);
			font-size: 24px; font-weight: bold;
			color: white; vertical-align: middle; line-height: 75px;
		}
		#topicname{
			margin-top: 5px;
			width: 100%;
			height: 35px; border: 0px solid rgb(243, 240, 240);
			background-color: rgb(118, 139, 149);
			box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.6);
			font-size: 16px; font-weight: bold;
			color: white; vertical-align: middle;
			padding-top: 4px;
		}
		#fl{
			height: 16px !important;
			line-height: 16px !important;
			vertical-align: middle !important;
			margin-top:0px !important;
		}
		#myTable{
			padding: 2px !important;

			line-height: 18px !important;
			font-size: 12px !important;
			font-style: normal !important;
			vertical-align: middle !important;

		}
		#myTable thead tr th {
			padding: 3px !important;
			background-color: #048EC7;
			background-image: linear-gradient(to bottom, #049CDB, #0378A9);
			background-repeat: repeat-x;

			font-weight: bold !important;
		}
		#myTable thead tr th {
			padding: 3px !important;
			font-size: 15px;
		}
		#myTable tbody tr td {
			border: 0px none;
			padding: 2px;

			vertical-align: middle;
		}
		#head td {
			color: #000 !important;
			background-color: #D3E0EA !important;
		}
		#stas tr:hover td{
			background-color:inherit !important;
		}
		#stas td {
			line-height: 18px;
			font-size: 12px !important;
			font-style: normal;
			border-top: 0px solid #DDD;
			padding: 0px;
			color: #655C5C;
			vertical-align: middle !important;
			background-color: #F8F2E5;
		}
		#fil{
			color: #000 !important;
			background-color: white !important;
		}
		#ref{
			vertical-align: middle;
			width: 21%;
			color: #787676 !important;
			background-color: #FFF !important;
		}
		.status-text{
			display: block; font-size: 9px ! important; text-align: center; font-weight: normal;line-height: 12px;
		}

		button.disabled,
		input.form-submit.disabled, input.disabled[type="button"],
		input.disabled[type="submit"], input.disabled[type="reset"], button[disabled],
		input.form-submit[disabled], input[type="button"][disabled], input[type="submit"][disabled],
		input[type="reset"][disabled] {
			box-shadow: none;
			opacity: 0.25 !important;
			background-image:none !important;
		}

		button, input.form-submit, input[type="button"], input[type="submit"], input[type="reset"] {
			background-image:none !important;
		}

		.activity-status-img{
			margin-right: 5px;
			padding-bottom: 2px;
			width: 10px;
		}
		#warn-msg{
			font-size: 8px;
			display: block;margin-top: -5px;
		}
	</style>
	<?php
	//$cid = required_param('cid', PARAM_INT);
	$params = explode("-", $_POST['topics']);
	$id=(int)$params[0];
	$cid=$id;
	if(!$cid){
		$cid = optional_param('cid',0, PARAM_INT);
	}
	if($cid){

	}
	else{
		redirect($CFG->wwwroot.'/teacher/dashboard.php');
	}
	?>
	<!--including necessary libraries for the javascript-->

	<script src="<?php echo $CFG->wwwroot; ?>/teacher/testcenter/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $CFG->wwwroot; ?>/teacher/testcenter/js/jquery.tablesorter.js"></script>


	<script>

		$j=$.noConflict();

		$j(document).on('ready',function(){



			//initializing script variables
			var setIntervalId=0;
			var cid='<?php echo $cid; ?>';
			var baseUrl='<?php echo $CFG->wwwroot; ?>';
			var hideshowurl='<?php echo $CFG->wwwroot."/course/mod.php?sesskey=".sesskey()."&sr=0&" ?>';
			$j("#myTable").tablesorter();
			var url=baseUrl+'/teacher/dashboard.php';
			$j('#page-navbar').append("<div style='padding:6px 2%;'> <a id='dlink'>Dashboard</a> <span>/</span> <b> Test center</b></div>");
			$j('#dlink').attr("href",url);

			$j('.stop').attr("disabled",'true');
			$j('.complete').attr("disabled",'true');
			$j('.stop').css("cursor",'not-allowed');
			$j('.complete').css("cursor",'not-allowed');


			get_loggedin_users();

			//on load call the activity
			call_Activity();




			//call the results and start fetching results if activity status is available
			function call_Activity(){

				//if current page reloads or not stopped activities lead to call this logic
				var activitytypeid=parseInt($j('#modtypeid').val());
				var section=$j('#stu-section').val();
				var current_activity_id=parseInt($j('#hcactivity-id').val());
				var current_activity_status=parseInt($j('#hcactivity-status').val());
				if(current_activity_status){
					if((activitytypeid&&current_activity_id&&current_activity_status)&(activitytypeid==16||activitytypeid==23)){



						$j('.actstatus'+current_activity_id).html("<b>STARTED </b><br/>on "+getCurrentDateTime());
						$j('.actstatus'+current_activity_id).css('color','#46A546');
						$j("#current-activity").text("STARTED");
						$j("#current-activity").css("color","rgb(70, 165, 70)");
						$j('.show'+current_activity_id).css("cursor",'not-allowed');
						$j('.complete'+current_activity_id).css("cursor",'not-allowed');
						$j('.show'+current_activity_id).css('background-color','#d1d3d3 !important');
						$j('.hide'+current_activity_id).attr("disabled",false);
						$j('.hide'+current_activity_id).css("cursor",'pointer');
						$j('.show'+current_activity_id).attr("disabled",true);
						$j('#current_activity').text($j('#hcactivity').val());

						$j('.complete'+current_activity_id).attr("disabled",true);


						var setInt=parseInt($j("#setinterval-id").val());
						if(setInt){
							clearInterval(setInt);
							$j("#setinterval-id").val(0);
						}
						getResults();
						$j("#setinterval-id").val(setInterval(getResults,10000));

					}//end of checking all conditions
					else{
						alert("something went wrong, Refresh Page and Continue..");
					}
				}//end of current_activity_status
				else{
					$j('.stop').attr("disabled",'true');
					$j('.complete').attr("disabled",'true');
					$j('.stop').css("cursor",'not-allowed');
					$j('.complete').css("cursor",'not-allowed');

				}
			}




			//this will get the list of students with submission and grade status based on student section
			function getResults(){

				var activitytypeid=parseInt($j('#modtypeid').val());
				var section=$j('#stu-section').val();
				var current_activity_id=parseInt($j('#hcactivity-id').val());


				//pre-cheking all the variable to start getting results


				$j(".pagecover").css("display","block");
				$j.ajax({
					url: baseUrl+"/teacher/testcenter/sub_list.php",
					data: {
						"id": current_activity_id,
						"secname":section,
						"typeid":activitytypeid,
						"cid":cid
					},
					type: "GET",
					dataType: "html",
					success: function (data) {
						var result = $j('<div />').append(data).html();
						$j('#sub_list').html(result);

						var subCount = $j($j.parseHTML(data)).filter("#subCount").text();
						var gradeCount = $j($j.parseHTML(data)).filter("#gradeCount").text();
						var activity_status = $j($j.parseHTML(data)).filter("#acivitystatus").text();
						var loggedinusers = $j($j.parseHTML(data)).filter("#loggedinusers").text();

						$j('#csubCount').text(subCount);
						$j('#cgradeCount').text(gradeCount);
						$j('#subCountMeter').val(loggedinusers);
						$j('#gradeCountMeter').val(loggedinusers);
						$j('.loggedinCount').text(loggedinusers);
						$j('#hcactivity-status').val(activity_status);
					},
					error: function (xhr, status) {
						//alert("Sorry, there was a problem!");
					},
					complete: function (xhr, status) {
						$j("#myTable").tablesorter();
						$j(".pagecover").css("display","none");

						if(parseInt($j('#hcactivity-status').val())){

							$j("#current-activity").text("STARTED");
							$j("#current-activity").css("color","rgb(70, 165, 70)");
							$j('.actstatus'+$j('#hcactivity-id').val()).css('color','#46A546');
							//$j('#hcactivity-status').val(1);

						}
						else{
							//disable stop button
							$j('.actstatus'+$j('#hcactivity-id').val()).html("<b>STOPPED </b><br/>on "+getCurrentDateTime());
							$j('.actstatus'+$j('#hcactivity-id').val()).css('color','#9D261D');
							$j('.hide'+$j('#hcactivity-id').val()).css("cursor",'not-allowed');
							$j("#current-activity").text("STOPPED");
							$j('#current-activity').css("color",'rgb(157, 38, 29)');
							$j('.hide'+$j('#hcactivity-id').val()).css('background-color','#d1d3d3 !important');
							$j('.hide'+$j('#hcactivity-id').val()).attr("disabled",true);
							$j('.show'+$j('#hcactivity-id').val()).attr("disabled",false);
							$j('.complete'+$j('#hcactivity-id').val()).attr("disabled",false);

							$j('.show'+$j('#hcactivity-id').val()).css("cursor",'pointer');
							$j('.complete'+$j('#hcactivity-id').val()).css("cursor",'pointer');


							var setInt=parseInt($j("#setinterval-id").val());
							if(setInt){
								clearInterval(setInt);
								$j("#setinterval-id").val(0);
							}
							//need to make enable start and complete buttons
						}
					}//end of complete statement
				});
			}//get_results()






			//selectt section from given dropdown list
			$j('#stu-section').on('change', function() {
				//alert($j(this).val());
				//set current section name to display based on selection
				$j('#current-stu-section').text($j(this).val());

				//fetch current section count based on selection
				$j('#studentCount').val($j('#stu-section option[value="'+$j(this).val()+'"]').attr('id'));
				var studentCount = parseInt($j('#studentCount').val());
				$j('.studentCount').text(studentCount);

				$j('#subCountMeter').attr('max',studentCount);
				$j('#gradeCountMeter').attr('max',studentCount);


				if(parseInt($j('#hcactivity-status').val())==0){
					if(parseInt($j('#hcactivity-id').val())==0) {
						get_students_by_section(cid,$j(this).val());
					}
					else{
						getResults();
					}
				}
				else{
					call_Activity();
				}

			});






			//refresh button functionality
			$j(document).delegate("#refresh","click",function(){

				get_activity_id();
				if(parseInt($j('#hcactivity-id').val())==0) {
					get_students_by_section(cid,$j('#stu-section').val());
				}
				else{
					if(parseInt($j('#hcactivity-status').val())==0){
						getResults();
					}
					else{
						call_Activity();
					}

				}

			});








			//this will perform retriving of current activity id from activity status table
			function get_activity_id(){

				$j.ajax({
					url: baseUrl+"/teacher/testcenter/testcenterutil.php",
					type: "GET",
					data: {
						"mid":4,
					},
					dataType: "text",
					success: function (data) {
						//alert(data.length);
						if(data.length!=1){
							var activities_array=data.split(',');
							var i=0;
							for(i=0;i<activities_array.length;i++){
								if($j('.show'+activities_array[i]).length){
									//alert(activities_array[i]);
									$j('#hcactivity-status').val(1);
									$j('#hcactivity').val($j('.activitymod'+activities_array[i]).text());
									$j('#hcactivity-id').val(activities_array[i]);
									$j('#modtypeid').val($j(".show"+activities_array[i]).data('mid'));
									//$j("#current-activity").text('STARTED');
									$j("#cactivity").text('Activity: '+$j("#hcactivity").val());
									//$j('.show'+activities_array[i]).hide();
									//$j('.hide'+activities_array[i]).show();
								}
							}

						}
					},
					error: function (xhr, status) {
						//alert("Sorry, there was a problem!");
					},
					complete: function (xhr, status) {
						// $j('.show'+startbtnid).hide();
						//$j('.hide'+stopbtnid).show();
					}
				});//ajax call end
			}//end of the get_activity_id() function









			// $j('.hide').hide(); $j('.complete').hide(); //hide stop and complete options on load

			$j(document).delegate(".showhide","click",function(){


				//check whether the activity is running presently or not
				if(parseInt($j('#hcactivity-status').val())&&($j(this).attr('id')=='show')){
					alert("currently one activity is in progress, please stop it and then start new one");
				}
				else{

				var clickvalue = 'mod'+$j(this).attr('value');
				var modtypeid = $j(this).data('mid');
				var modid=$j(this).attr('value');
				$j('.complete'+modid).attr("disabled",true);
				//changing and storing current activity id and name based on selection
				$j("#hcactivity").val($j(".activity"+clickvalue).text());
				$j("#hcactivity-id").val(modid);
				$j("#current-activity").text($j(".activity"+clickvalue).text());
				$j('#cactivity').text('Activity: '+$j('#hcactivity').val());
				$j('#modtypeid').val(modtypeid);
				var id = $j(this).attr('id');
				var value = $j(this).attr('value');
				var hideshowajax=hideshowurl+id+'='+value;

				//this will perform storing of current activity id and time
				if($j(this).attr('id')=='show'){
					//$j('.show'+modid).hide();
					//$j('.hide'+modid).show();

					$j('.actstatus'+modid).html("<b>STARTED </b><br/>on "+getCurrentDateTime());
					$j('.actstatus'+modid).css('color','#46A546');
					$j("#current-activity").text("STARTED");
					$j("#current-activity").css("color","rgb(70, 165, 70)");
					$j('.show'+modid).css("cursor",'not-allowed');
					$j('.complete'+modid).css("cursor",'not-allowed');
					$j('.show'+modid).css('background-color','#d1d3d3 !important');
					$j('.hide'+modid).attr("disabled",false);
					$j('.hide'+modid).css("cursor",'pointer');
					$j('.show'+modid).attr("disabled",true);
					$j('#hcactivity-status').val(1);
					record_activity_date(modid);


				}
				if($j(this).attr('id')=='hide'){

					$j('.actstatus'+modid).html("<b>STOPPED </b><br/>on "+getCurrentDateTime());
					$j('.actstatus'+modid).css('color','#9D261D');
					$j("#current-activity").text("STOPPED");
					$j('#current-activity').css("color",'rgb(157, 38, 29)');
					$j('.hide'+modid).css("cursor",'not-allowed');
					$j('.hide'+modid).css('background-color','#d1d3d3 !important');
					$j('.hide'+modid).attr("disabled",true);
					$j('.show'+modid).attr("disabled",false);
					$j('.complete'+modid).attr("disabled",false);
					$j('.show'+modid).css("cursor",'pointer');
					$j('.complete'+modid).css("cursor",'pointer');
					//$j('.hide'+modid).hide();$j('.complete'+modid).show();$j('.show'+modid).show();
					record_activity_date(modid);
				}

				//ajax call to show or hide the activity to the student
				$j.ajax({
					url: hideshowajax,
					type: "GET",
					dataType: "html",
					success: function (data) {

					},
					error: function (xhr, status) {
						alert("Sorry, there was a problem!");
					},
					complete: function (xhr, status) {

						if(id=='show'){
							//intimate that activity is started

							call_Activity();


						}
						if(id=='hide'){
							var setint=parseInt($j("#setinterval-id").val());
							clearInterval(setint);
							$j("#setinterval-id").val(0);
							$j("#hcactivity-status").val(0);

							$j("#cactivity").text('Activity: '+$j("#hcactivity").val()+" :STOPED");
						}
					}
				});//hide or show ajax call end


				}//if activity is not running currently

			});//showhide click function end





			//this will get the list of students based on section
			function get_students_by_section(cid,section){
				$j(".pagecover").css("display","block");
				$j.ajax({
					url: baseUrl+"/teacher/testcenter/enrolledstudents.php",
					data: {
						"cid": cid,
						"secname":section

					},
					type: "GET",
					dataType: "html",
					success: function (data) {
						var result = $j('<div />').append(data).html();
						$j('#sub_list').html(result);

						var loggedinusers = $j($j.parseHTML(data)).filter("#loggedinusers").text();
						$j('.loggedinCount').text(loggedinusers);

					},
					error: function (xhr, status) {
						//alert("Sorry, there was a problem!");
					},
					complete: function (xhr, status) {
						$j("#myTable").tablesorter();$j(".pagecover").css("display","none");
					}
				});


			}//end of get_students_by_section() function







			//this will perform storing of current activity id and time in a table
			function record_activity_date(modid){
				var startbtnid='show'+modid;
				var stopbtnid='hide'+modid;
				$j.ajax({
					url: baseUrl+"/teacher/testcenter/testcenterutil.php",
					type: "GET",
					data: {
						"aid": modid,
						"mid":2,
					},
					dataType: "html",
					success: function (data) {

					},
					error: function (xhr, status) {
						//alert("Sorry, there was a problem!");
					},
					complete: function (xhr, status) {
					}
				});//ajax call end
			}//end of the record_activity_date() function







			//ajax call to mark activity as complete and no more changes after completion of activity
			//on complete it will remove all the data stored in temp table today

			//$j('.markascomplete').css('color','grey');
			$j(document).delegate(".complete","click",function(){
				$j(".pagecover").css("display","block");
				var modid=$j(this).attr('value');
				//alert($j(this).data('itemid'));
				set_course_absenties(cid,modid);
				insert_zero_values_for_gradetable($j(this).data('itemid'));

				$j.ajax({
					url: baseUrl+"/teacher/testcenter/testcenterutil.php",
					type: "GET",
					data: {
						"aid": modid,
						"mid":3,
					},
					dataType: "html",
					success: function (data) {
						//var result = $j('<div />').append(data).html();
						//$j('#sub_list').html(result);
						//alert(data);

					},
					error: function (xhr, status) {
						//alert("Sorry, there was a problem!");
					},
					complete: function (xhr, status) {
						$j('.actstatus'+modid).html("<b>CLOSED </b><br/>on "+getCurrentDateTime());
						$j('.actstatus'+modid).css("color","red");
						$j("#current-activity").text("CLOSED");
						$j("#current-activity").css("color","red");
						$j('.show'+modid).attr('disabled','true');
						$j('.show'+modid).css("cursor",'not-allowed');
						$j('.complete'+modid).css("cursor",'not-allowed');
						$j('.complete'+modid).attr('disabled','true');
						$j('.activity'+modid).addClass('markascomplete');
						$j('.mod'+modid).addClass('markascomplete');
						$j(".pagecover").css("display","none");
					}
				});//ajax call end
			});//end of complete as mark action function






			//this used to add student into watchlist
			$j(document).delegate(".watchlist","click",function(){

				if(parseInt($j(this).data('ref'))){
					$j(this).attr("src",baseUrl+"/teacher/testcenter/images/unwatch-512.png");
					$j(this).data('ref',0);
					$j('watchlist-status'+$j(this).attr("id")).text('');
				}
				else{
					$j(this).attr("src",baseUrl+"/teacher/testcenter/images/eye-24-512.png");
					$j(this).data('ref',1);
					$j('watchlist-status'+$j(this).attr("id")).text(1);
				}

				var stuid=$j(this).attr('id');

				$j.ajax({
					url: baseUrl+"/teacher/testcenter/testcenterutil.php",
					type: "GET",
					data: {
						"uid": stuid,
						"cid":cid,
						"mid":6,
					},
					dataType: "html",
					success: function (data) {
						//var result = $j('<div />').append(data).html();
						/* $j('#sub_list').html(result);*/
						//alert(data);

					},
					error: function (xhr, status) {
						//alert("Sorry, there was a problem!");
					},
					complete: function (xhr, status) {

						//$j('.complete'+modid).attr('disabled','true');
					}
				});//ajax call end
			});//end of watchlist action function







			//toggle control panel visibility
			$j("#titile-status").hide();
			$j("#flip").click(function(){
				toggle_visibility('panel');
			});


			function toggle_visibility(id)
			{
				var e = document.getElementById(id);
				if (e.style.display == 'block' || e.style.display=='')
				{
					$j("#titile-status").show();
					$j("#titile-sta").hide();
					e.style.display = 'none';
					$j('.fa-angle-double-up').hide();

				}
				else
				{
					$j("#titile-status").hide();
					$j("#titile-sta").show();
					e.style.display = 'block';
					$j('.fa-angle-double-up').show();

				}
			}

			$j('#cactivity').text('Activity: '+$j('#hcactivity').val());


			function getCurrentDateTime(){
				var d = new Date();
				var monthNames = ["January", "February", "March", "April", "May", "June",
					"July", "August", "September", "October", "November", "December"
				];
				var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
				var dayname=days[d.getDay()];
				var day=d.getDate();
				var month=monthNames[d.getMonth()];
				var year=d.getFullYear();
				var hour=d.getHours();
				var min=d.getMinutes();


				var mid = hour >= 12 ? 'PM' : 'AM';
				hour = hour % 12;
				fhour = hour ? hour : 12; // the hour '0' should be '12'

				if(min<10){
					min='0'+min;
				}
				var currentDateTime=dayname+", "+day+" "+month+" "+year+", "+fhour+":"+min+' '+mid;
				return currentDateTime;
			}

			
			/*code to insert 0 for non-graded students or absent students*/
			var sesskey='<?php echo sesskey(); ?>';
			
			function insert_zero_values_for_gradetable(itemid){
			var gurl=baseUrl+"/grade/report/singleview/index.php?id="+cid+"&itemid="+itemid+"&item=grade";
			var jsonData = {};
			
			var type='bulk_'+itemid+'_type';
			var value='bulk_'+itemid+'_value';
			var apply='bulk_'+itemid+'_apply';
			var oldbulk_value='oldbulk_'+itemid+'_value';
			
			jsonData[type]='blanks';
			jsonData[value]=0;
			jsonData['group']='';
			jsonData[apply]=1;
			jsonData[oldbulk_value]=0;
			jsonData['sesskey']=sesskey;

			request = $j.ajax({
				url : gurl,
				type: "post",
				data: jsonData
			});

			// Callback handler that will be called on success
			request.done(function (response, textStatus, jqXHR){
				// Log a message to the console
				//console.log(response);
				//console.log("Hooray, it worked!");
			});

			}


			function set_course_absenties(cid,aid){

				$j.ajax({
					url: baseUrl+"/teacher/testcenter/testcenterutil.php",
					type: "GET",
					data: {
						"aid": aid,
						"cid":cid,
						"mid":12,
					},
					dataType: "html",
					success: function (data) {
						//var result = $j('<div />').append(data).html();
						/* $j('#sub_list').html(result);*/
						//alert(data);

					},
					error: function (xhr, status) {
						//alert("Sorry, there was a problem!");
					},
					complete: function (xhr, status) {

						//$j('.complete'+modid).attr('disabled','true');
					}
				});//ajax call end

			}

			//this will get the number of students logged in based on section
			function get_loggedin_users(){

					var sec=$j('#stu-section').val();
					$j.ajax({
						url: baseUrl+"/teacher/testcenter/enrolledstudents.php",
						data: {
							"cid": cid,
							"secname":sec

						},
						type: "GET",
						dataType: "html",
						success: function (data) {
							var result = $j('<div />').append(data).html();
							//$j('#sub_list').html(result);

							var loggedinusers = $j($j.parseHTML(data)).filter("#loggedinusers").text();
							$j('.loggedinCount').text(loggedinusers);

						},
						error: function (xhr, status) {
							//alert("Sorry, there was a problem!");
						},
						complete: function (xhr, status) {
							//$j("#myTable").tablesorter();$j(".pagecover").css("display","none");
						}
					});


				}//end of get_loggedin_users() function




			/*  //set refresh time from given dropdown list
			 $j('#refresh-time').on('change', function() {

			 var setInt=parseInt($j("#setinterval-id").val());
			 clearInterval(setInt);
			 $j("#setinterval-id").val(setInterval(updateDiv,parseInt(this.value)*1000,$j('#hcactivity-id').val()));

			 });*/


			//toggle function

			//$j('#ctopic').text('Topic: '+$j("#hctopic").val());
			//$j('#ccourse').text('Course: '+$j('#hccourse').val());


		});//end of ready function
	</script>


</head>
