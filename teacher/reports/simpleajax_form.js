M.simpleajax_form = {

    // params from PHP
    Y : null,
    root : null,

    init: function(Y) {
        this.Y  =   Y;
        this.root = M.cfg.wwwroot;

        M.simpleajax_form.prepare_clickme_for_ajax();
    },
    prepare_clickme_for_ajax: function() {
        var Y = this.Y;

 Y.one('.search').on('click', function() {

    var courseid= Y.one('#courses').get('value');
    if(courseid==''){
alert("select one")
    }
    else
    {
$('#loading').show();
$('.tb').hide();
//var tblhead="<input type='text' id='search1'/><table   class='generaltable'><thead><th>Roll NO</th><th>Full Name</th><th>Grade</th><th>Rank</th><th>Department</th><th>Watchlist</th></thead><tbody class='target tb' id='tblData'>";

   var url = this.getData('url');
   var selected_values="";//array for sending selected info to backend

selected_values=courseid; 

var topicid= Y.one('#topics').get('value');
   selected_values+="@"+topicid; 



var actid= Y.one('#act').get('value');
   selected_values+="@"+actid; 

var acttype= Y.one('#activitytype').get('value');
   selected_values+="@"+acttype;

 selected_values+="@"; 


var gt= Y.one('.grade').get('value');
var watchlist=$('input[name=watchlist]:checked').val();

var rank="";
 $('input[name=rank]:checked').each(function() {
   rank+=":"+$(this).val();
});
 var dept= Y.one('#dept').get('value');
   
var section= Y.one('#section').get('value');
url=url+"?values="+selected_values+"&gt="+gt+"&dept="+dept+"&section="+section+"&wl="+watchlist+"&rank="+rank;

     Y.io(url, {
                method: "POST",
                on: {
                    success: function(id, r) {
                       
                       var response = Y.JSON.parse(r.responseText);

                       var form = Y.Node.create(response.html);

                        var formarea = Y.one('.tb');


                        formarea.setHTML(form);

var rowCount = $('#tableData tr').length;
rowCount=rowCount-1;
$(".tblcount").text("Found"+rowCount+"Records");
                    }, complete: function(){
        $('#loading').hide();
$('.tb').show();

//$("#tableData").tablesorter();

      }

                }
            });


}
            });
/*************************EXPORTS ***********************/
Y.one('.export').on('click', function() {

    
var courseid= Y.one('#courses').get('value');
 if(courseid==''){
alert("select Course");
    }
    else
    {
 var url = this.getData('url');

   var selected_values="";//array for sending selected info to backend

selected_values=courseid; 

var topicid= Y.one('#topics').get('value');
   selected_values+="@"+topicid; 


var actid= Y.one('#act').get('value');
   selected_values+="@"+actid;
var acttype= Y.one('#activitytype').get('value');
   selected_values+="@"+acttype;
 
 selected_values+="@"; 


var gt= Y.one('.grade').get('value');
var watchlist=$('input[name=watchlist]:checked').val();

var rank="";
 $('input[name=rank]:checked').each(function() {
   rank+=":"+$(this).val();
});
 var dept= Y.one('#dept').get('value');
   
var section= Y.one('#section').get('value');
url=url+"?values="+selected_values+"&gt="+gt+"&dept="+dept+"&section="+section+"&wl="+watchlist+"&rank="+rank;


var redirectWindow = window.open(url, '_blank');
    redirectWindow.location;
     
}
        });

/***********************For GRADE TYPE *********************/
Y.one('.act').on('change', function() {

            
            var activity= Y.one('#act').get('value');
var act_values=activity.split("-");

     if(act_values[1]=='vpl')
     {

     $('.sub').show();
     $('.nsub').show();
 }
 else{

     $('.sub').hide();
     $('.nsub').hide();
 }

        });


/**********************END OF EXPORTS ********************/
        Y.one('.course').on('change', function() {

            var url = this.getData('url');
            var courseid= Y.one('#courses').get('value');

            url=url+"?cid="+courseid;
//alert(url);
            Y.io(url, {
                method: "POST",
                on: {
                    success: function(id, o) {
                        var response = Y.JSON.parse(o.responseText);

                        var form = Y.Node.create(response.html);

                        var formarea = Y.one('.topic');

                        formarea.setHTML(form);
              $('#topics').val("0");
                       
             $('#act').val("0");            
                    }
                }
            });
        });

Y.one('.topic').on('change', function() {

            var url = this.getData('url');
            var courseid= Y.one('#courses').get('value');
            var sectionid= Y.one('#topics').get('value');
            //alert(sectionid);
            url=url+"?cid="+courseid+"&sid="+sectionid;
            Y.io(url, {
                method: "POST",
                on: {
                    success: function(id, o) {
                        var response = Y.JSON.parse(o.responseText);

                        var form = Y.Node.create(response.html);

                        var formarea = Y.one('.act');
                        //alert(formarea);
                        formarea.setHTML(form);


 $('#act').val("0");

 $('#grade').val("");
                    }
                }
            });
        });

    },
    

}
