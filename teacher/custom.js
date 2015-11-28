
$(function() {

  
            $('table.search-table1').tableSearch({
                searchText: 'Search : ',
                searchPlaceHolder: 'Search'
            });
 $('table.search-table').tableSearch({
                 searchText: 'Search : ',
                 searchPlaceHolder: 'Search'
             });
 $("#selectall").change(function () {
                            $(".checkbox1").prop('checked', $(this).prop("checked"));
                        });


        // Remove From Watchlist
    var baseUrl=$('#baseurl').val();

    $('#wpdf').click(function() {
        window.open(baseUrl+'/teacher/inx.php?courid='+$('#wcourse').val(), '_blank');
    });



        $('#rmv').click(function() {

            var selected = [];
            var count=0;
            $('#wtab input:checked').each(function() {
                selected.push($(this).attr('value'));
                count++;
            });
            if(count==0){
                alert("(0) rows selected");
            }else{
                if (confirm('Remove ('+count+') students from watchlist ?')) {
                    $.ajax({
                        type: "GET",
                        dataType: "html",
                        data: {selected: selected, cid: $('#wcourse').val()},
                        url: baseUrl + "/teacher/customlib.php",
                        success: function (msg) {
                            $.ajax({
                                url: baseUrl + "/teacher/customlib.php",
                                data: {
                                    "courseid": $('#wcourse').val()
                                },
                                type: "GET",
                                dataType: "html",
                                success: function (data) {
                                    $('#wcontainer').html(data);
                                },
                                error: function (xhr, status) {
                                    alert("Sorry, there was a problem!");
                                },
                                complete: function (xhr, status) {
                                    $("#selectall").change(function () {
                                        $(".checkbox1").prop('checked', $(this).prop("checked"));
                                    });
                                }
                            });

                        }
                    });
                }
            }
        });

        // Render Watchlist Based on Course Selection

        $('#selectlist1').change(function() {
            $('#wcourse').val($(this).val());
            if($(this).val()!='all') {
                $.ajax({
                    url: baseUrl+"/teacher/customlib.php",
                    data: {
                        "courseid": $(this).val()
                    },
                    type: "GET",
                    dataType: "html",
                    success: function (data) {
                        // alert(data);
                        // var result = $('<tbody />').append(data).html();


                        $('#expo').attr('display','inline-block');
                        $('#wcontainer').html(data);

                    },
                    error: function (xhr, status) {
                        alert("Sorry, there was a problem!");
                    },
                    complete: function (xhr, status) {

                        $('table.search-table1').tableSearch({
                            searchText: 'Search : ',
                            searchPlaceHolder: 'Search'
                        });
                        $("#selectall").change(function () {
                            $(".checkbox1").prop('checked', $(this).prop("checked"));
                        });
                        if($("#wcount").val()!=0)
                        $('#btmexpo :input').attr('disabled', false);
                        else
                         $('#btmexpo :input').attr('disabled', true);

			$('#resu').innerhtml='('+$('#wcount')+') results found';
                    }
                });
            }


        });



        // Render Sections Based On Course Selection

        $('#selectlist').change(function(){

 if($(this).val()!='all') {
     $.ajax({
         url: baseUrl+"/teacher/customlib.php",
         data: {
             "cid": $(this).val()
         },
         type: "GET",
         dataType: "html",
         success: function (data) {

             $('#container').html(data);
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

         },
         error: function (xhr, status) {
             alert("Sorry, there was a problem!");
         },
         complete: function (xhr, status) {
             $('table.search-table').tableSearch({
                 searchText: 'Search : ',
                 searchPlaceHolder: 'Search'
             });

         }
     });

     $('.selectable').attr('data-column', $(this).val());
    // $.tablesorter.filter.bindSearch($table, $('.search'), true);
 }
        });





    });

