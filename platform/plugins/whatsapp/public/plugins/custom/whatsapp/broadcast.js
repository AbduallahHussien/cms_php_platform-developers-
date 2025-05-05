        (function($) {
            
            GetGroups();
            // Get all Groups
            function GetGroups(){
               
                $('#GroupResults').empty();
                $.ajax({
                    url: base_url + '/Broadcast/getGroups',
                    type: 'GET',
                    
                    success: function(response) {
                        var data = JSON.parse(response);
                     
                        $.each(data, function(index) {
                            const arr_recipients =  data[index].recipients.split("\n");
                            var counter = arr_recipients.length-1;
                       
                            $('#GroupResults').append(`  <tr>
                                    
                                    <td>`+data[index].id+`</td>
                                    <td> <strong>`+data[index].name+`</strong></td>
                                    <td>`+counter+`</td>
                                    
                                    <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                       
                                            <a id="DeleteGroup" class="dropdown-item" href="javascript:void(0);" data-id="`+data[index].id+`"><i class="bx bx-trash me-1"></i> Delete</a>
                                            <a id="EditGroup" class="dropdown-item" href="javascript:void(0);" data-id="`+data[index].id+`"><i class="bx bx-trash me-1"></i> Edit</a>

                                        </div>
                                    </div>
                                    </td>
                                </tr>
                              `);

                         });
                    },
                    error: function(){
                        notification.show("There's a mistake ,Please try again later!",'error');
                    }
                });

                $('#spinner').hide();
            }
            // End Get all Groups


            // Create Broadcast
            $(document).on("click","#add_broadcast",function() {
               
                
                $(this).prop('disabled', true);

                var id = $("#brodcastId").val();
                var name = $("#brodcastName").val();
                var recipients = $("#recipients").val();
                var pin = $('#pincode').val();

                //Check values not null
                if(name ==""){
                    $("#brodcastName").addClass("is-invalid");
                    return false;
                }else if($("#brodcastName").hasClass("is-invalid")){
                    $("#brodcastName").removeClass("is-invalid");
                }
                if(recipients ==""){
                    $("#recipients").addClass("is-invalid");
                    return false;
                }else if($("#recipients").hasClass("is-invalid")){
                    $("#brodcastName").removeClass("is-invalid");
                }
                //End check values not null

                //check after save recipents
                    let text = recipients;
                    const myArray = text.split("\n");
                    const recipient = [];
                    myArray.forEach(function(person) {
                        recipient.push(person.split(","));
                    });
                     
                    // Remove numbers if length > 8 and not nums same
                        var afterCheckLength = "";
                        var  uniqueNum = [];
                        recipient.forEach(function(row) {
                            var name = row[1];
                            var num = row[0]
                        if(num!=undefined && name!=undefined){
                            if(num.length > 8 || num.length < 8  ){
                                
                            }else{
                                if($.inArray(num, uniqueNum) === -1){
                                   
                                    uniqueNum.push(num);
                                    afterCheckLength+= num+','+name+'\n';
                                }
                            } 
                        }
                        });
                      
                    //End Remove numbers if length > 8 and not nums same
                  
                // End Check 
              
                if(afterCheckLength.length !=0){
                    if($(this).hasClass('edit')  ){
                        $('#spinner').show();
                        $.ajax({
                            url: base_url + '/Broadcast/editBroadcast',
                            type: 'post',
                            data: { id :id ,"name": name,"recipients":afterCheckLength.toString(),"pin":pin},
                            success: function(response) {
                            
                                    $('#Create').modal('hide');
                                    notification.show('Broadcast updated successfully');
                                    
                                    ;
                                    $('#add_broadcast').removeClass('edit').text('Add New');

                            },
                            error: function(){
                                notification.show("There's a mistake ,Please try again later!",'error');
                              
                                   
                            }
                        });
                        setTimeout(function() {
                            GetGroups();
                            $('#spinner').hide();
                            $('#add_broadcast').prop('disabled', false);
                        }, 1000);
                    }else {
                        $('#spinner').show();
                        $.ajax({
                            url: base_url + '/Broadcast/addBroadcast',
                            type: 'post',
                            data: { "name": name,"recipients":afterCheckLength.toString(),"pin":pin},
                            success: function(response) {
                            
                                    $('#Create').modal('hide');
                                    notification.show('Broadcast updated successfully');
                            },
                            error: function(){
                                notification.show("There's a mistake ,Please try again later!",'error');
                            }
                        });
                        setTimeout(function() {
                            GetGroups();
                            $('#spinner').hide();
                            $('#add_broadcast').prop('disabled', false);
                        }, 1000);
                    }
                }else{
                    $('#Create').modal('hide');
                    notification.show("Error , The number of digits must be 8",'error');
                }
               
                $('#add_broadcast').prop('disabled', false);
            });
            // End  Create Broadcast
            
            // Append to selection
            $(document).on("click","#sendMessage",function() {
                $('#SelectGroup').empty();
                $.ajax({
                    url: base_url + '/Broadcast/getGroups',
                    type: 'GET',
                    
                    success: function(response) {
                        var data = JSON.parse(response);
                        
                        $.each(data, function(index) {
                            $('#SelectGroup').append(`<option data-recipients="`+data[index].recipients+`" data-pin="`+data[index].pin+`" value="`+data[index].id+`">`+data[index].name+`</option>`);
                       });
                    },
                    error: function(){
                        notification.show("There's a mistake ,Please try again later!",'error');
                    }
                });

            });
            // End Append to selection
            
            // Send to Broadcast
            $(document).on("click","#SendToGroup",function() {

                $('#Send').modal('hide');
                var recipients = $("#SelectGroup").find(":selected").data("recipients");
                var id = $("#SelectGroup").find(":selected").val();
                var name = $("#SelectGroup").find(":selected").text();
                var pin = $("#SelectGroup").find(":selected").data("pin");
                var message = $("#message").val();
                if( recipients=="undefined" || recipients =="" ){
                    $("#SelectGroup").addClass("is-invalid");
                    return false; 
                }else if($("#SelectGroup").hasClass("is-invalid")){
                    $("#SelectGroup").removeClass("is-invalid");
                }
                let text = recipients;
                const myArray = text.split("\n");


                const recipient = [];
                
                myArray.forEach(function(person) {
                    recipient.push(person.split(","));
                });
                // 
                $.ajax({
                    url: base_url + '/Broadcast/AddReport',
                    type: 'post',
                    data: { "id":id,"broadcast_id":id, "name": name,"message":message},
                    success: function(response) {
                        var report_id = response;
                        recipient.forEach(function(row) {
                            var name = row[0];
                            var num = row[1]
                            if(num!=undefined && name!=undefined){
                                var settings = {
                                    "async": true,
                                    "crossDomain": true,
                                    "url": "https://api.ultramsg.com/instance22538/messages/chat",
                                    "method": "POST",
                                    "headers": {},
                                    "data": {
                                    "token": "130hfx1zxosg8okc",
                                    "to": pin+num+"@c.us",
                                    "body": message,
                                    "priority": "10",
                                    "referenceId": ""
                                    }
                                }
                                
                                $.ajax(settings).done(function (response) {
                                    
                                    if(response.error){
                                        $.ajax({
                                            url: base_url + '/Broadcast/AddElement',
                                            type: 'post',
                                            data: { "id":report_id, "element": "This Name: "+name+" , And Number: " +num+" Has Error"},
                                            success: function(response) {}
                                        
                                        });
                                    
                                    }else{
                                    
                                        $.ajax({
                                            url: base_url + '/Broadcast/AddElement',
                                            type: 'post',
                                            data: { "id":id, "element": "This Name: "+name+" , And Number: "+num+" Is Done"},
                                            success: function(response) {}
                                        
                                        });
                                   
                                    }
                                });
                            }
                           
                        });
                    }
                });

            });
            // End Send to Broadcast

            //Delete Broadcast
            $(document).on("click","#DeleteGroup",function() {
                debugger;
                $('#spinner').show();
                var id = $(this).data('id');
                $.ajax({
                    url: base_url + '/Broadcast/DeleteGroup',
                    type: 'POST',
                    data: { "id": id},
                    success: function(response) {
                        setTimeout(function() {
                                GetGroups();
                                $('#spinner').hide();
                            }, 1000);
                    },
                    error: function(){
                        notification.show("There's a mistake ,Please try again later!",'error');
                    }
                });
                
            });
            //End  Delete Broadcast

            // Edit Broadcast
            $(document).on("click","#EditGroup",function() {
              
                $('#spinner').show();
                var id = $(this).data('id');
                $.ajax({
                    url: base_url + '/Broadcast/GetGroup',
                    type: 'GET',
                    data: { "id":id},
                    success: function(response) {
                        data = JSON.parse(response)
                        
                        $('#brodcastId').val(data[0].id);
                        $('#brodcastName').val(data[0].name);
                        $('#pincode').val(data[0].pin);
                        $('#recipients').val(data[0].recipients);
                        $('#add_broadcast').text('Edit').addClass('edit');
                        $('#spinner').hide();
                        $('#Create').modal("show");
                        
                      
                    },
                    error: function(){
                        notification.show("There's a mistake ,Please try again later!",'error');
                    }
                });
                
            });
            //End  Edit Broadcast
            
           
                            
        })(jQuery);
 
  
    



