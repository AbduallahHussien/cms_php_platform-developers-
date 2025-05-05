(function($) {
    
    //call Function
    GetReports();

    //Function Get All Reports
    function GetReports(){
       
        $('#ReportsResults').empty();
        $.ajax({
            url: base_url + '/Reports/getReports',
            type: 'GET',
            
            success: function(response) {
                var data = JSON.parse(response);
             
                $.each(data, function(index) {
                  
                 
               
                    $('#ReportsResults').append(`  <tr>
                            
                            <td>`+data[index].id+`</td>
                            <td> <strong>`+data[index].name+`</strong></td>
                            <td>`+data[index].message+`</td>
                            
                            <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                               
                                    <a id="view" class="dropdown-item" href="javascript:void(0);" data-id="`+data[index].id+`"><i class="bx bx-trash me-1"></i> View</a>

                                </div>
                            </div>
                            </td>
                        </tr>
                      `);

                 });
            },
            error: function(){
                $(".alert-danger").show();
                    setTimeout(function() {
                        $(".alert-danger").hide();
                    }, 3000);
            }
        });

        $('#spinner').hide();
    }
    //END Function Get All Reports

    // View Report
    $(document).on("click","#view",function() {
        $('#Viewreport .modal-body').empty();
        var id= $(this).data("id");
        $.ajax({
            url: base_url + '/Reports/getReport',
            type: 'GET',
            data:{"id":id},
            
            success: function(response) {
                var data = JSON.parse(response);
             
                $.each(data, function(index) {
                  
                 
               
                    $('#Viewreport .modal-body').append(`
                        <div class="bs-toast toast fade show bg-primary" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-body">
                                `+data[index].element+`
                            </div>
                        </div>
                        </br></br>
                    `);

                 });
            },
            error: function(){
                $(".alert-danger").show();
                    setTimeout(function() {
                        $(".alert-danger").hide();
                    }, 3000);
            }
           
        });
        $('#Viewreport').modal("show");
    });
    //End  View Report
    
})(jQuery);