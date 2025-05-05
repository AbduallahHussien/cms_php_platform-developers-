(function($) {
    GetTemplates();
    // Get all Groups
    function GetTemplates(){
        $('#tempaltes').empty();

        $.ajax({
            url: base_url + '/BusinessTools/GetTemplates',
            type: 'GET',
            
            success: function(response) {
                $('#templates').empty();
                $('#messages-selection').empty();
                var data = JSON.parse(response);
             
                $.each(data, function(index) {
                   
                    $('#templates').append(`
                            
                            <div class="alert alert-primary alert-dismissible" role="alert" >
                                `+data[index].title+`
                                <a  class="btn-edit" data-id="`+data[index].id+`"><i class='bx bx-pencil'></i> </a>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"  data-id="`+data[index].id+`"></button>
                            </div>
                      `);
                      
                      $('#messages-selection').append(`<option value="`+data[index].id+`">`+data[index].title+`</option>`);
                      

                 });
                 $('#messages-selection').select2();
            },
            error: function(){
                
            }
        });

    }
    // End Get all Groups

    // Create Template
    $(document).on("click","#AddTemplate",function() {
                 
        var title = $("#TempTitle").val();
        var file = $("#TempAudio").val();
        var file_type = '';
        if(file!=''){
                file_type = 'audio';
        }

        var message = $("#TempMessage").val();

        if( title==""){
            $("#TempTitle").addClass("is-invalid");
            return false; 
        }else if(message=="" && $("#message-box").is(":checked")){
            $("#TempTitle").removeClass("is-invalid");
            $("#TempMessage").addClass("is-invalid");
            return false;
        }else{
            $("#TempTitle").removeClass("is-invalid");
            $("#TempMessage").removeClass("is-invalid");
        }
        if($(this).hasClass('edit'))  {
            var id = $('#TempId').val();

            $.ajax({
                url: base_url + '/BusinessTools/EditTemplate',
                type: 'post',
                data: { "id":id,"title":title,"file_type":file_type,"file":file,"message":message},
                success: function(response) {
                    GetTemplates();
                    $('#saveTemplate').modal('hide');
                } 
            });
            $(this).removeClass('edit')
        }else{
            $.ajax({
                url: base_url + '/BusinessTools/AddTemplate',
                type: 'post',
                data: { "title":title,"file_type":file_type,"file":file,"message":message},
                success: function(response) {
                    GetTemplates();
                    $('#saveTemplate').modal('hide');
                } 
            });
        }    // 
       

   
    });
    // End Create Template

    //Delete Template
    $(document).on("click",".btn-close",function() {
        var id = $(this).data('id');
        $.ajax({
            url: base_url + '/BusinessTools/DeleteTemplate',
            type: 'POST',
            data: { "id": id},
            success: function(response) {
                setTimeout(function() {
                        GetTemplates();
                    }, 1000);
            },
            error: function(){
            }
        });
        
    });
    //End Delete Template
    
    //Edit Template
    $(document).on("click",".btn-edit",function() {
        var id = $(this).data('id');
        $.ajax({
            url: base_url + '/BusinessTools/GetTemplateById',
            type: 'GET',
            data: { "id": id},
            success: function(response) {
                
                data = JSON.parse(response)
                $('#TempId').val(data[0].id);
                $('#TempTitle').val(data[0].title);
                // $('#TempAudio').val(data[0].file);
                $('#TempMessage').val(data[0].message);
                if(data[0].fileType && data[0].fileType=="audio"){
                    $('.row-file').removeClass('d-none');
                    $('#file-box').prop( "checked", true );
                    ////
                       // Get a reference to our file input
                        const fileInput = document.querySelector('input[id="TempAudio"]');

                        // Create a new File object
                        const myFile = new File([data[0].file], data[0].file, {
                            type: 'audio/mp3',
                            lastModified: new Date(),
                        });

                        // Now let's create a FileList
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(myFile);
                        fileInput.files = dataTransfer.files;
                }
                $('#AddTemplate').text('Edit').addClass('edit');
                $('#spinner').hide();
                $('#saveTemplate').modal("show");
            },
            error: function(){
            }
        });
        
    });
    

    $("#file-box").change(function() {
        if(this.checked) {
          $('.row-file').removeClass("d-none");
        }else{
            $('.row-file').addClass("d-none");  
        }
    });

    
    $(document).on("click","#JobSave",function() {
            date = $('#JobDate').val();
            var myDate = new Date(date);
            var result = myDate.getTime();
            console.log(result);
            setTimeout(function() {
              
                SendTemplate();

            }, result - Date.now());

   
          
    });

     //Delete Template
     $(document).on("click","#SendTemplate",function() {
        SendTemplate();  
    });
    function SendTemplate(){
        Templates = $('#messages-selection').val();
  
        const Groups = [];
         $('input[name="group-checked"]:checked').each(function() {
             Groups.push(this.value); 
         });
         var from = $('#from').val();
         var to  = $('#to').val();
         // valid
         if(Templates == ''){
             notification.show('Please select template','error');
             return false;
         }
 
         if(Groups == ''){
             notification.show('Please select group','error');
             return false;
         }   
         if(parseInt(to) < parseInt(from) ){
             $('#to').addClass('is-valid');
             notification.show('To must be > from','error');
             return false
         }else{
             $('#to').removeClass('is-valid');
         }
         notification.loading($('.accordion-body')); 
         console.log(Groups);
         $.ajax({
             url: base_url + '/BusinessTools/SendTemplate',
             type: 'POST',
             data: { "groupsIds":Groups,'templatesIds':Templates,"to":to,'from':from ,"instance":instance,"token":token,"referenceId":referenceId},
             success: function(response) {
                 console.log(response);
                 if(response == '"success"'){
 
                     notification.next_page_notifiction("Template Send Successfully");
                     location.reload();
 
                 }
             },
             error: function(){
             }
         });

    }

    //End Delete Template
    

})(jQuery);