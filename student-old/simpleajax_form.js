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
        Y.one('.refresh').on('click', function() {

            var url = this.getData('url');
            url=url+"?id=1";


            Y.io(url, {
                method: "POST",
                on: {
                    complete: function(id, r) {
                       
 var response = Y.JSON.parse(r.responseText);

                       var form = Y.Node.create(response.html);
document.getElementById("taccordion").innerHTML ="";

                        var formarea = Y.one('#taccordion');

                        formarea.setHTML(form);

                   //     $( "#accordion" ).accordion();

                    },
                    success: function(id, o) {



                        //alert("success");
                        //$( "#accordion" ).accordion();

                    },
                    end: function(id, o) {
                       
                            //$( "#accordion" ).accordion();

                       // alert("end");


                    }
                },
                complete:{
                    end: function(id, o) {

                        $( "#accordion" ).accordion();

                       // alert("Com plete");


                    }
                }
            });

        });


    },


}
