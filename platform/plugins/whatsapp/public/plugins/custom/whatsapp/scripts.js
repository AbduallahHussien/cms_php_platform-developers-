





class WhatsappJs {
  init() {
    
      //  if(token !='' && instance!=''){
     
      //  }else{
      //   $('#modalSettings').modal('show');
      //  }
      //  $("#configurations").click(function() {
      //   $('#token').val(token);
      //   $('#instance').val(instance);
      //   $('#settings_save').addClass('update').html('Update');
      //   $('#modalSettings').modal('show');
      //  });


       // Save settings
      //  $("#settings_save").click(function() {
      //   var settings_token =  $('#token').val();
      //   var settings_instance = $('#instance').val();
      //   if(settings_token == '' ){
      //     notification.show('Token is required ','error');
      //     return false;
      //   }
      //   if(settings_instance == '' ){
      //     notification.show('Instance is required ','error');
      //     return false;
      //   }
      //   $.ajax({
      //     headers: {
      //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //    },
      //     url: save_settings_route,
      //     type: 'post',
      //     data: { "tkn_id":settings_token, "instance_id":settings_instance },
      //     success: function(response) {

      //       $('#modalSettings').modal('hide');
      //       location.reload();
      //       notification.next_page_notifiction('Settings updated successfully');
            
      //     }
      //   });
        
           
  
      // });
    // END VIEW MORE
        var currentdate = new Date(); 
        var datetime = currentdate.getHours() + ":"  + currentdate.getMinutes() ;
                  
          $('#OpenImgUpload').click(function(){ 
            if($('#conversation').data('receiver_id') && $('#conversation').data('receiver_id')!=""){
              $('#imgupload').trigger('click'); 
            }else{
              return false;
            }
          });
      

          $('#imgupload').on('change', function () {
         
            const chat_id = $('#conversation').data('receiver_id');
            const file = this.files[0];
            if (!file) return;
          
            const fileType = file.type.split('/')[0];
            const reader = new FileReader();
          
            reader.onload = function (event) {
              const fileData = event.target.result;
          
              if (fileType === "image") {
                // send_image(fileData, chat_id);
                $('#imagePreview').attr('src', fileData);
                $('#imagePreviewModal').data('fileData', fileData).data('chatId', chat_id).modal('show');
          
              } else if (fileType === "audio") {
                $.ajax({
                  url: send_audio_route,
                  type: 'POST',
                  data: { path: fileData, to: chat_id },
                  success: function (response) {
                    // Handle success if needed
                  },
                  error: function (error) {
                    // Handle error if needed
                  }
                });
          
              } else if (fileType === "text" || fileType === "application") {
                send_document(fileData, chat_id);
          
              } else if (fileType === "video") {
                send_video(fileData, chat_id);
          
              } else {
                return false;
              }
            };
          
            reader.readAsDataURL(file);
          });
          
      
        // VIEW MORE
          $("#view-more").click(function() {
            var matched = $("#conversation .message-body");
            var len = matched.length;
      
            
              var instance_id  = instance.split(/(\d+)/);
                  chat_id  = $('#conversation').data('receiver_id');  
                  $.ajax({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                      url: view_more_route,
                      type: 'post',
                      data: { "length":len, "chat_id":chat_id ,"instance":instance_id[1]},
                      success: function(response) {
                        var data  = response;
                        $.each(data, function(index) {
                                
                                var mainClass = "";
                                var subClass = "";
                                
                                if(data[index].event_type == "message_received"){
                                    mainClass = "message-main-receiver";
                                    subClass = "receiver";
                                }else{
                                    mainClass = "message-main-sender";
                                    subClass = "sender" ;
                                }
                                
                                // check type message
                              if(data[index].type == "image" ){
                                  
                                  $('#conversation').prepend(
                                  ` 
                                    <div class="row message-body">
                                        <div class="col-12 `+mainClass+`">
                                        <div class="`+subClass+`">
                                            <div class="message-text">
                                            <img id="uploadedImage" src="`+data[index].media+`" alt="Uploaded Image" accept="image/png, image/jpeg">
                                              
                                            </div>
                                            <span class="message-time pull-right">
                                            `+ convert_time(data[index].time)+`
                                            </span>
                                            <span>
                                              <a href="`+data[index].media+`" download  target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                  <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                                </svg>
                                              </a>
                                            </span>
                                            
                                            <span class="message-time pull-right">`+data[index].pushname+`</span>
                                        </div>
                                        </div>
                                    </div>    
                                  `);
                                  
                              }else if(data[index].type == "ptt" || data[index].type == "audio"){
                  
                            
                                $('#conversation').prepend(
                                  ` 
                                    <div class="row message-body">
                                        <div class="col-12 `+mainClass+`">
                                        <div class="`+subClass+`">
                                            <div class="message-text">
                                            <audio controls>
                                                <source src="`+data[index].media+`" type="audio/mpeg">
                                            </audio>
                                              
                                            </div>
                                            <span class="message-time pull-right">
                                            `+ convert_time(data[index].time)+`
                                            </span>
                                            <span>
                                              <a href="`+data[index].media+`" download  target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                  <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                                </svg>
                                              </a>
                                            </span>
                                            
                                            <span class="message-time pull-right">`+data[index].pushname+`</span>
                                        </div>
                                        </div>
                                    </div>    
                                  `);
                              }else if(data[index].type == "document"){
                  
                            
                                $('#conversation').prepend(
                                  ` 
                                    <div class="row message-body">
                                        <div class="col-12 `+mainClass+`">
                                        <div class="`+subClass+`">
                                              <div class="message-text">`+data[index].body+`</div>
                                            <span class="message-time pull-right">
                                            `+ convert_time(data[index].time)+`
                                            </span>
                                            <span>
                                              <a href="`+data[index].media+`" download  target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                  <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                                </svg>
                                              </a>
                                            </span>
                                            
                                            <span class="message-time pull-right">`+data[index].pushname+`</span>
                                        </div>
                                        </div>
                                    </div>    
                                  `);
                              }else if(data[index].type == "video" ){
                  
                            
                                $('#conversation').prepend(
                                  ` 
                                    <div class="row message-body">
                                        <div class="col-12 `+mainClass+`">
                                        <div class="`+subClass+`">
                                            <div class="message-text">
                                              <video width="210" height="150" controls>
                                                <source src="`+data[index].media+`" type="video/mp4">
                                                <source src="`+data[index].media+`" type="video/ogg">
                                          </video>
                                              
                                            </div>
                                            <span class="message-time pull-right">
                                            `+ convert_time(data[index].time)+`
                                            </span>
                                            <span>
                                              <a href="`+data[index].media+`" download  target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                  <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                                </svg>
                                              </a>
                                            </span>
                                            
                                            <span class="message-time pull-right">`+data[index].pushname+`</span>
                                        </div>
                                        </div>
                                    </div>    
                                  `);
                              }else{          
                              
                                $('#conversation').prepend(
                                ` 
                                        <div class="row message-body">
                                            <div class="col-12 `+mainClass+` ">
                                              <div class="`+subClass+`">
                                                  <div class="message-text">`+data[index].body+`</div>
                                                  <span class="message-time pull-right">`+ convert_time(data[index].time)+`</span>
                                                  <span class="message-time pull-right">`+data[index].pushname+`</span>
                                              </div>
                                            </div>
                                        </div>    
                                `);
                                
                              }
                              });   
                        $("#conversation").scrollTop(-1);
                      }
                  });
      
          });
        // END VIEW MORE
      
        //SIDE EVENTS
          $(".heading-NewChat").click(function() {
            $(".side-two").css({
              "left": "0"
            });
          });
      
          $(".heading-templates").click(function() {
            $(".side-templates").css({
              "left": "0"
            });
          });
      
          $(".heading-groups").click(function() {
            $(".side-groups").css({
              "left": "0"
            });
          });
      
          $(".heading-reports").click(function() {
            $(".side-reports").css({
              "left": "0"
            });
          });
      
          $(".newMessage-back").click(function() {
            $(".side-two").css({
              "left": "-100%"
            });
          });
      
          $(".newtemplate-back").click(function() {
            $(".side-templates").css({
              "left": "-100%"
            });
          });
      
          $(".newgroup-back").click(function() {
            $(".side-groups").css({
              "left": "-100%"
            });
          });
      
          $(".reports-back").click(function() {
            $(".side-reports").css({
              "left": "-100%"
            });
          });
      
        // END SIDE EVENTS
      
      
          $("#conversation").on('scroll', function() {
      
                var scroll = $(this).scrollTop();
                if(scroll < 20){
                  $('#view-more').removeClass("d-none");
                }else{
                  $('#view-more').addClass("d-none");
                }
          });
      
        // send audio
            function send_audio(blob){
              var chat_id  = $('#conversation').data('receiver_id');
            
              var data = new FormData();
              data.append('file', blob);
              data.append('chat_id', chat_id);
            
              $.ajax({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
                url : send_voice_route,
                type: 'POST',
                data: data,
                contentType: false,
                processData: false,
                success: function(data) {
        //             $('#conversation').append(
        //               `  
        //                 <div class="row message-body">
        //                     <div class="col-12 message-main-sender">
        //                         <div class="sender">
        //                             <audio controls>
        //                                 <source src="`+URL.createObjectURL(blob)+`" type="audio/mpeg">
        //                             </audio>
        //                         </div>
        //                     </div>
        // `);
                },    
                error: function() {
                  alert("not so boa!");
                }
              });
            }
        // End  send audio
      
        // send document
            function send_document(file,chat_id){
              var settings = {
                "async": true,
                "crossDomain": true,
                "url": "https://api.ultramsg.com/"+instance+"/messages/document",
                "method": "POST",
                "headers": {},
                "data": {
                  "token": token,
                  "to": chat_id,
                  "filename": "File",
                  "document": file,
                  "referenceId": referenceId,
                  "nocache": ""
                }
              }
              
              $.ajax(settings).done(function (response) {
                // $('#conversation').append(
                //   `  
                //     <div class="row message-body">
                //         <div class="col-12 message-main-sender">
                //         <div class="sender">
                //             <div class="message-text">
                //               document
                //             </div>
                //             <span class="message-time pull-right">
                //             `+ datetime +` 
                //             </span>
                //             <span>
                //                 <a href="`+file+`" download>
                //                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                //                       <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                //                       <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                //                     </svg>
                //                 </a>
                //             </span>
                //             <span class="message-time pull-right"></span>
                //         </div>
                //         </div>
                //     </div>
                //   `);
                  $("#conversation").scrollTop($("#conversation").prop("scrollHeight"));
              });
      
            }
        // End  send document
      
        // send image
            // function send_image(file,chat_id){
            //       $.ajax({ 
            //         url:send_img_route,
            //         type: 'post',
            //         data: { "SendImage": "1","path":file,"to":chat_id},
            //         success: function(response) {

            //         }
            //       });
            function send_image(file, chatId) {
              $.post(send_img_route, { path: file,to: chatId})
               .done(function (response) { 
                console.log('Image sent successfully');
              }).fail(function (jqXHR, textStatus, errorThrown) { 
                console.error('Failed to send image:', textStatus, errorThrown);
              });
            
            
                //   $('#conversation').append(
                //     `  
                //       <div class="row message-body">
                //           <div class="col-12 message-main-sender">
                //           <div class="sender">
                //               <div class="message-text">
                //               <img id="uploadedImage" src="`+file+`" alt="Uploaded Image" accept="image/png, image/jpeg">
                //               </div>
                //               <span class="message-time pull-right">
                //               `+ datetime +` 
                //               </span>
                //               <span>
                //                   <a href="`+file+`" download>
                //                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                //                         <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                //                         <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                //                       </svg>
                //                   </a>
                //               </span>
                //               <span class="message-time pull-right"></span>
                //           </div>
                //           </div>
                //       </div>
                //     `);
                    $("#conversation").scrollTop($("#conversation").prop("scrollHeight"));
            }
        // End  send image
      
        //send video
            function send_video(file,chat_id){
                  var settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": "https://api.ultramsg.com/"+instance+"/messages/video",
                    "method": "POST",
                    "headers": {},
                    "data": {
                      "token": token,
                      "to": chat_id,
                      "video": file,
                      "caption":"",
                      "referenceId": referenceId,
                      "nocache": ""
                    }
                  }
                  
                  $.ajax(settings).done(function (response) {
                    // $('#conversation').append(
                    //   `  
                    //     <div class="row message-body">
                    //         <div class="col-12 message-main-sender">
                    //         <div class="sender">
                    //             <div class="message-text">
                    //               Video
                    //             </div>
                    //             <span class="message-time pull-right">
                    //             `+ datetime +` 
                    //             </span>
                    //             <span>
                    //                 <a href="`+file+`" download>
                    //                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                    //                       <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                    //                       <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                    //                     </svg>
                    //                 </a>
                    //             </span>
                    //             <span class="message-time pull-right"></span>
                    //         </div>
                    //         </div>
                    //     </div>
                    //   `);
                      $("#conversation").scrollTop($("#conversation").prop("scrollHeight"));
                  });
            }
        //End send video
      
        
        
        // send location
            function send_location(lat,lng,address){
            
              var chat_id  = $('#conversation').data('receiver_id');
              if(chat_id){
                  var settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": "https://api.ultramsg.com/"+instance+"/messages/location",
                    "method": "POST",
                    "headers": {},
                    "data": {
                      "token": token,
                      "to": chat_id,
                      "address": "Location",
                      "lat": lat,
                      "lng": lng,
                      "referenceId": referenceId
                    }
                  }
                  
                  $.ajax(settings).done(function (response) {
                    // $('#conversation').append(
                    //   `  
                    //     <div class="row message-body">
                    //         <div class="col-12 message-main-sender">
                    //         <div class="sender">
                    //             <div class="message-text">
                    //               Location
                    //             </div>
                    //             <span class="message-time pull-right">
                    //             `+ datetime +` 
                    //             </span>
                              
                    //             <span class="message-time pull-right"></span>
                    //         </div>
                    //         </div>
                    //     </div>
                    //   `);
                      $("#conversation").scrollTop($("#conversation").prop("scrollHeight"));
                  });
              }
              
            }       
        //End send loction
          
        // send Message
            $(document).on('keypress',function(e) {
            if(e.which == 13) {
              var chat_id  = $('#conversation').data('receiver_id');
              var message = $('#comment').val();
              
                  if(message){
                    Send_message(chat_id ,message );
                  }
                  
                $("#conversation").scrollTop($("#conversation").prop("scrollHeight"));
                $('#comment').val('');
                return false;
              }
            });  
        // End send Message
      
        //Send message
            function Send_message(chat_id , message){
              var settings = {
      
                "async": true,
                "crossDomain": true,
                "url": "https://api.ultramsg.com/"+instance+"/messages/chat",
                "method": "POST",
                "headers": {},
                "success": function(response){
                 
                    if (response.error){
                      
                      $("#notification").show().text("Mobile Number Is Valid");
                      setTimeout(function() { 
                        $("#notification").fadeOut("slow")
                    }, 2000);           
                    }else{
                      $('#exampleModal').modal('hide');
                    }
                    
                
                },
                "data": {
                  "token": token,
                  "to": chat_id,
                  "body": message,
                  "priority": "10",
                  "referenceId": referenceId
                }
              }
              $.ajax(settings).done();
      
            }
        // End send message
      
        // Get All contacts 
            $('.heading-NewChat').click(function() {
                  get_all_contacts();
            });
          
            function get_all_contacts(){ 
              var settings = {
                "async": true,
                "crossDomain": true,
                "url": "https://api.ultramsg.com/"+instance+"/contacts",
                "method": "GET",
                "headers": {},
                "data": {
                  "token": token,
                  "limit":50
                }
              }                

              $.ajax(settings).done(function (response) {
      
                  $.each(response, function(index) {
                  var chat_id = response[index].id;
                  $('.compose-sideBar').append(
                      `   <div class="row sideBar-body" data-chat_id="`+chat_id+`" data-selector="`+response[index].id.replace('@','').replace('.','')+`" >
                          
                              <div class="col-3 sideBar-avatar avatar`+response[index].id.replace('@','').replace('.','')+`">
                              
                              </div>
                              <div class="col-9  sideBar-main">
                                <div class="row">
                                    <div class="col-8  sideBar-name">
                                      <span class="name-meta">`+response[index].name+`
                                      </span>
                                      <br>
                                      <small>`+response[index].pushname+`</small>
                                    </div>
                                    
                                </div>
                              </div>
                      </div> 
                      `);
                      if(response[index].unread > 0 ){
                        $("[data-selector="+response[index].id.replace('@','').replace('.','')+"]").append(`<span class="unread" >`+response[index].unread+`</span>`);    
                      }
                      var settings = {
                          "async": true,
                          "crossDomain": true,
                          "url": "https://api.ultramsg.com/"+instance+"/contacts/image?token="+token+"&chatId="+chat_id+"",
                          "method": "GET",
                          "headers": {
                              "content-type": "application/x-www-form-urlencoded"
                          }
                          }
      
                          $.ajax(settings).done(function (data) {
                          if(data.success){
                              $(".avatar" + chat_id.replace('@','').replace('.','') ).empty().append(`<div class="avatar-icon"> <img src="`+data.success+`"> </div>`);
      
                              }else{
                              $(".avatar" + chat_id.replace('@','').replace('.','') ).empty().append(`<span data-testid="default-user" data-icon="default-user" class=""><svg viewBox="0 0 212 212" width="50" height="50" class=""><path fill="#DFE5E7" class="background" d="M106.251.5C164.653.5 212 47.846 212 106.25S164.653 212 106.25 212C47.846 212 .5 164.654.5 106.25S47.846.5 106.251.5z"></path><g fill="#FFF"><path class="primary" d="M173.561 171.615a62.767 62.767 0 0 0-2.065-2.955 67.7 67.7 0 0 0-2.608-3.299 70.112 70.112 0 0 0-3.184-3.527 71.097 71.097 0 0 0-5.924-5.47 72.458 72.458 0 0 0-10.204-7.026 75.2 75.2 0 0 0-5.98-3.055c-.062-.028-.118-.059-.18-.087-9.792-4.44-22.106-7.529-37.416-7.529s-27.624 3.089-37.416 7.529c-.338.153-.653.318-.985.474a75.37 75.37 0 0 0-6.229 3.298 72.589 72.589 0 0 0-9.15 6.395 71.243 71.243 0 0 0-5.924 5.47 70.064 70.064 0 0 0-3.184 3.527 67.142 67.142 0 0 0-2.609 3.299 63.292 63.292 0 0 0-2.065 2.955 56.33 56.33 0 0 0-1.447 2.324c-.033.056-.073.119-.104.174a47.92 47.92 0 0 0-1.07 1.926c-.559 1.068-.818 1.678-.818 1.678v.398c18.285 17.927 43.322 28.985 70.945 28.985 27.678 0 52.761-11.103 71.055-29.095v-.289s-.619-1.45-1.992-3.778a58.346 58.346 0 0 0-1.446-2.322zM106.002 125.5c2.645 0 5.212-.253 7.68-.737a38.272 38.272 0 0 0 3.624-.896 37.124 37.124 0 0 0 5.12-1.958 36.307 36.307 0 0 0 6.15-3.67 35.923 35.923 0 0 0 9.489-10.48 36.558 36.558 0 0 0 2.422-4.84 37.051 37.051 0 0 0 1.716-5.25c.299-1.208.542-2.443.725-3.701.275-1.887.417-3.827.417-5.811s-.142-3.925-.417-5.811a38.734 38.734 0 0 0-1.215-5.494 36.68 36.68 0 0 0-3.648-8.298 35.923 35.923 0 0 0-9.489-10.48 36.347 36.347 0 0 0-6.15-3.67 37.124 37.124 0 0 0-5.12-1.958 37.67 37.67 0 0 0-3.624-.896 39.875 39.875 0 0 0-7.68-.737c-21.162 0-37.345 16.183-37.345 37.345 0 21.159 16.183 37.342 37.345 37.342z"></path></g></svg></span>`);
      
                              }
                          });
                              
      
                  });    
              });
            };
        // Get All contacts
      
        // Get All Chats 
            get_all_chat();
            function get_all_chat(){                
              var settings = {
                      "async": true,
                      "crossDomain": true,
                      "url": "https://api.ultramsg.com/"+instance+"/chats?token="+token+"",
                      "method": "GET",
                      "headers": {"content-type": "application/x-www-form-urlencoded"}
              }  
              $.ajax(settings).done(function (response) {
      
                  $.each(response, function(index) {
                  var chat_id = response[index].id;
                  $('.sideBar').append(
                      `   <div class="row sideBar-body" data-chat_id="`+chat_id+`" data-selector="`+response[index].id.replace('@','').replace('.','')+`" >
                          
                              <div class="col-3  sideBar-avatar avatar`+response[index].id.replace('@','').replace('.','')+`">
                              
                              </div>
                              <div class="col-9  sideBar-main">
                                <div class="row">
                                    <div class="col-8  sideBar-name">
                                      <span class="name-meta">`+response[index].name+`
                                      </span>
                                    </div>
                                    <div class="col-4 pull-right sideBar-time">
                                      <span class="time-meta pull-right">`+convert_time(response[index].last_time)+`</span>
                                    </div>
                                </div>
                              </div>
                      </div> 
                      `);
                      if(response[index].unread > 0 ){
                        $("[data-selector="+response[index].id.replace('@','').replace('.','')+"]").append(`<span class="unread" >`+response[index].unread+`</span>`);    
                      }
                      var settings = {
                          "async": true,
                          "crossDomain": true,
                          "url": "https://api.ultramsg.com/"+instance+"/contacts/image?token="+token+"&chatId="+chat_id+"",
                          "method": "GET",
                          "headers": {
                              "content-type": "application/x-www-form-urlencoded"
                          }
                          }
      
                          $.ajax(settings).done(function (data) {
                          if(data.success){
                              $(".avatar" + chat_id.replace('@','').replace('.','') ).empty().append(`<div class="avatar-icon"> <img src="`+data.success+`"> </div>`);
      
                              }else{
                              $(".avatar" + chat_id.replace('@','').replace('.','') ).empty().append(`<span data-testid="default-user" data-icon="default-user" class=""><svg viewBox="0 0 212 212" width="50" height="50" class=""><path fill="#DFE5E7" class="background" d="M106.251.5C164.653.5 212 47.846 212 106.25S164.653 212 106.25 212C47.846 212 .5 164.654.5 106.25S47.846.5 106.251.5z"></path><g fill="#FFF"><path class="primary" d="M173.561 171.615a62.767 62.767 0 0 0-2.065-2.955 67.7 67.7 0 0 0-2.608-3.299 70.112 70.112 0 0 0-3.184-3.527 71.097 71.097 0 0 0-5.924-5.47 72.458 72.458 0 0 0-10.204-7.026 75.2 75.2 0 0 0-5.98-3.055c-.062-.028-.118-.059-.18-.087-9.792-4.44-22.106-7.529-37.416-7.529s-27.624 3.089-37.416 7.529c-.338.153-.653.318-.985.474a75.37 75.37 0 0 0-6.229 3.298 72.589 72.589 0 0 0-9.15 6.395 71.243 71.243 0 0 0-5.924 5.47 70.064 70.064 0 0 0-3.184 3.527 67.142 67.142 0 0 0-2.609 3.299 63.292 63.292 0 0 0-2.065 2.955 56.33 56.33 0 0 0-1.447 2.324c-.033.056-.073.119-.104.174a47.92 47.92 0 0 0-1.07 1.926c-.559 1.068-.818 1.678-.818 1.678v.398c18.285 17.927 43.322 28.985 70.945 28.985 27.678 0 52.761-11.103 71.055-29.095v-.289s-.619-1.45-1.992-3.778a58.346 58.346 0 0 0-1.446-2.322zM106.002 125.5c2.645 0 5.212-.253 7.68-.737a38.272 38.272 0 0 0 3.624-.896 37.124 37.124 0 0 0 5.12-1.958 36.307 36.307 0 0 0 6.15-3.67 35.923 35.923 0 0 0 9.489-10.48 36.558 36.558 0 0 0 2.422-4.84 37.051 37.051 0 0 0 1.716-5.25c.299-1.208.542-2.443.725-3.701.275-1.887.417-3.827.417-5.811s-.142-3.925-.417-5.811a38.734 38.734 0 0 0-1.215-5.494 36.68 36.68 0 0 0-3.648-8.298 35.923 35.923 0 0 0-9.489-10.48 36.347 36.347 0 0 0-6.15-3.67 37.124 37.124 0 0 0-5.12-1.958 37.67 37.67 0 0 0-3.624-.896 39.875 39.875 0 0 0-7.68-.737c-21.162 0-37.345 16.183-37.345 37.345 0 21.159 16.183 37.342 37.345 37.342z"></path></g></svg></span>`);
      
                              }
                          });
                              
      
                  });    
              });
            };
        // Get All Chats
      
        // Add Heading Image
            function heading_image(chat_id){
                var settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": "https://api.ultramsg.com/"+instance+"/contacts/image?token="+token+"&chatId="+chat_id+"",
                    "method": "GET",
                    "headers": {
                    "content-type": "application/x-www-form-urlencoded"
                    }
                }
                $.ajax(settings).done(function (data) {
                    //check if has image 
                    if(data.success){
                        $(".conversation .heading-avatar-icon").empty().append(` <img src="`+data.success+`"> `);
                    }else{
                        $(".conversation .heading-avatar-icon").empty().append(`<span data-testid="default-user" data-icon="default-user" class=""><svg viewBox="0 0 212 212" width="40" height="40" class=""><path fill="#DFE5E7" class="background" d="M106.251.5C164.653.5 212 47.846 212 106.25S164.653 212 106.25 212C47.846 212 .5 164.654.5 106.25S47.846.5 106.251.5z"></path><g fill="#FFF"><path class="primary" d="M173.561 171.615a62.767 62.767 0 0 0-2.065-2.955 67.7 67.7 0 0 0-2.608-3.299 70.112 70.112 0 0 0-3.184-3.527 71.097 71.097 0 0 0-5.924-5.47 72.458 72.458 0 0 0-10.204-7.026 75.2 75.2 0 0 0-5.98-3.055c-.062-.028-.118-.059-.18-.087-9.792-4.44-22.106-7.529-37.416-7.529s-27.624 3.089-37.416 7.529c-.338.153-.653.318-.985.474a75.37 75.37 0 0 0-6.229 3.298 72.589 72.589 0 0 0-9.15 6.395 71.243 71.243 0 0 0-5.924 5.47 70.064 70.064 0 0 0-3.184 3.527 67.142 67.142 0 0 0-2.609 3.299 63.292 63.292 0 0 0-2.065 2.955 56.33 56.33 0 0 0-1.447 2.324c-.033.056-.073.119-.104.174a47.92 47.92 0 0 0-1.07 1.926c-.559 1.068-.818 1.678-.818 1.678v.398c18.285 17.927 43.322 28.985 70.945 28.985 27.678 0 52.761-11.103 71.055-29.095v-.289s-.619-1.45-1.992-3.778a58.346 58.346 0 0 0-1.446-2.322zM106.002 125.5c2.645 0 5.212-.253 7.68-.737a38.272 38.272 0 0 0 3.624-.896 37.124 37.124 0 0 0 5.12-1.958 36.307 36.307 0 0 0 6.15-3.67 35.923 35.923 0 0 0 9.489-10.48 36.558 36.558 0 0 0 2.422-4.84 37.051 37.051 0 0 0 1.716-5.25c.299-1.208.542-2.443.725-3.701.275-1.887.417-3.827.417-5.811s-.142-3.925-.417-5.811a38.734 38.734 0 0 0-1.215-5.494 36.68 36.68 0 0 0-3.648-8.298 35.923 35.923 0 0 0-9.489-10.48 36.347 36.347 0 0 0-6.15-3.67 37.124 37.124 0 0 0-5.12-1.958 37.67 37.67 0 0 0-3.624-.896 39.875 39.875 0 0 0-7.68-.737c-21.162 0-37.345 16.183-37.345 37.345 0 21.159 16.183 37.342 37.345 37.342z"></path></g></svg></span>`);
      
                    }
                });
            }
        // End  Add Heading Image
      
        // New Chat
            $('#AddNewChat').click(function(){ 
              var num = $('#mobile_number').val();
              var message = $('#message').val();
      
              if(!num && num==''){
                $('#mobile_number').addClass('is-invalid');
                return false;
              }else if($('#mobile_number').hasClass('is-invalid')){
                $('#mobile_number').removeClass('is-invalid');
              }
      
              if(!message && message==''){
                $('#message').addClass('is-invalid');
                return false;
              }else if($('#message').hasClass('is-invalid')){
                $('#message').removeClass('is-invalid');
              }
      
              var chat_id = num+"@c.us";
          
              Send_message(chat_id,message);
            
              $('#new-message').modal('hide');
              $('.modal-backdrop').remove(); 
              get_all_chat();
      
            });
        //End New Chat
      
            $('#backChat').click(function(){
              $(".side").css({"display": "block"}); 
            });
            if (window.innerWidth > 700){
              $("#backChat").css({"display": "none"});
            }
      
        //Get Messages Form Chat
            // $(document).on("click",".sideBar-body",function() {
            //   $('.sideBar-body').removeClass('hover');
            //   $(this).addClass('hover');
            //   $('.conversation').removeClass('d-none');
            //   $('.start-bg').addClass('d-none');
            //   $(this).find('.unread').remove();

            //     if (window.innerWidth < 700){
            //       $(".side").css({"display": "none"});
            //     }
            //     var instance_id  = instance.split(/(\d+)/);
            //     var chatName = ($(this).find('.name-meta').text());
            //     var chat_id = $(this).data('chat_id');
            //     var chat_img = $(this).find('img').attr('src');
            //     var chat_title = $(this).find('.name-meta').text();
            //     $('#conversation-type').data('chat_title',chat_title);
            //     $('#conversation-type').data('chat_img',chat_img);
            //     //Get Conversation
            //     $.ajax({
            //       url: get_con_route,
            //       type: 'GET',
            //       data: { "chat_id":chat_id },
            //       success: function(response) {
            //         var data  = response ;
            //         if( data !=''){
            //           if(data[0].type == 'close'){
      
                        
            //             $('#conversation-type').data('action','open');
            //             $('#conversation-type').data('chat_id',chat_id).removeClass('btn-success').addClass('btn-secondary').text('Open Conversation');
            
            //           }else {
            //             $('#conversation-type').data('action','close');
            //             $('#conversation-type').data('chat_id',chat_id).removeClass('btn-secondary').addClass('btn-success').text('Close Conversation');
            //           }
            //         }else {
            //           $('#conversation-type').data('action','close');
            //           $('#conversation-type').data('chat_id',chat_id).removeClass('btn-secondary').addClass('btn-success').text('Close Conversation');
            //         }
                  
            //       $('#conversation-type').removeClass('d-none');
            //       }
            //     });
      
            //     //End Get Conversation
            //     // send read chat
            //     $.ajax({
            //         url: get_chat_route,
            //         type: 'GET',
            //         data: { "chat_id":chat_id ,"instance":instance_id[1]},
            //         success: function(response) {
            //           $('a.heading-name-meta').empty().text(chatName);
            //           $('#conversation').empty();
            //           $('#conversation').data("receiver_id",chat_id);
            //           heading_image(chat_id);
            //           var data  = response;
            //           $.each(data, function(index) {
                              
            //                   var mainClass = "";
            //                   var subClass = "";
                              
            //                   if(data[index].event_type == "message_received"){
            //                       mainClass = "message-main-receiver";
            //                       subClass = "receiver";
            //                   }else{
            //                       mainClass = "message-main-sender";
            //                       subClass = "sender" ;
            //                   }
                              
            //                   // check type message
            //                 if(data[index].type == "image" ){
                                
            //                     $('#conversation').append(
            //                     ` 
            //                       <div class="row message-body">
            //                           <div class="col-12 `+mainClass+`">
            //                           <div class="`+subClass+`">
            //                               <div class="message-text">
            //                               <img id="uploadedImage" src="`+data[index].media+`" alt="Uploaded Image" accept="image/png, image/jpeg">
                                            
            //                               </div>
            //                               <span class="message-time pull-right">
            //                               `+ convert_time(data[index].time)+`
            //                               </span>
            //                               <span>
            //                                 <a href="`+data[index].media+`" download  target="_blank">
            //                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
            //                                     <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
            //                                     <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
            //                                   </svg>
            //                                 </a>
            //                               </span>
                                          
            //                               <span class="message-time pull-right">`+data[index].pushname+`</span>
            //                           </div>
            //                           </div>
            //                       </div>    
            //                     `);
                                
            //                 }else if(data[index].type == "ptt" || data[index].type == "audio"){
                
                          
            //                   $('#conversation').append(
            //                     ` 
            //                       <div class="row message-body">
            //                           <div class="col-12 `+mainClass+`">
            //                           <div class="`+subClass+`">
            //                               <div class="message-text">
            //                               <audio controls>
            //                                   <source src="`+data[index].media+`" type="audio/mpeg">
            //                               </audio>
                                            
            //                               </div>
            //                               <span class="message-time pull-right">
            //                               `+ convert_time(data[index].time)+`
            //                               </span>
            //                               <span>
            //                                 <a href="`+data[index].media+`" download  target="_blank">
            //                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
            //                                     <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
            //                                     <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
            //                                   </svg>
            //                                 </a>
            //                               </span>
                                          
            //                               <span class="message-time pull-right">`+data[index].pushname+`</span>
            //                           </div>
            //                           </div>
            //                       </div>    
            //                     `);
            //                 }else if(data[index].type == "document"){
                
                          
            //                   $('#conversation').append(
            //                     ` 
            //                       <div class="row message-body">
            //                           <div class="col-12 `+mainClass+`">
            //                           <div class="`+subClass+`">
            //                                 <div class="message-text">`+data[index].body+`</div>
            //                               <span class="message-time pull-right">
            //                               `+ convert_time(data[index].time)+`
            //                               </span>
            //                               <span>
            //                                 <a href="`+data[index].media+`" download  target="_blank">
            //                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
            //                                     <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
            //                                     <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
            //                                   </svg>
            //                                 </a>
            //                               </span>
                                          
            //                               <span class="message-time pull-right">`+data[index].pushname+`</span>
            //                           </div>
            //                           </div>
            //                       </div>    
            //                     `);
            //                 }else if(data[index].type == "video" ){
                
                          
            //                   $('#conversation').append(
            //                     ` 
            //                       <div class="row message-body">
            //                           <div class="col-12 `+mainClass+`">
            //                           <div class="`+subClass+`">
            //                               <div class="message-text">
            //                                 <video width="210" height="150" controls>
            //                                   <source src="`+data[index].media+`" type="video/mp4">
            //                                   <source src="`+data[index].media+`" type="video/ogg">
            //                             </video>
                                            
            //                               </div>
            //                               <span class="message-time pull-right">
            //                               `+ convert_time(data[index].time)+`
            //                               </span>
            //                               <span>
            //                                 <a href="`+data[index].media+`" download  target="_blank">
            //                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
            //                                     <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
            //                                     <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
            //                                   </svg>
            //                                 </a>
            //                               </span>
                                          
            //                               <span class="message-time pull-right">`+data[index].pushname+`</span>
            //                           </div>
            //                           </div>
            //                       </div>    
            //                     `);
            //                 }else{          
                            
            //                   $('#conversation').append(
            //                   ` 
            //                           <div class="row message-body">
            //                               <div class="col-12 `+mainClass+` ">
            //                                 <div class="`+subClass+`">
            //                                     <div class="message-text">`+data[index].body+`</div>
            //                                     <span class="message-time pull-right">`+ convert_time(data[index].time)+`</span>
            //                                     <span class="message-time pull-right">`+data[index].pushname+`</span>
            //                                 </div>
            //                               </div>
            //                           </div>    
            //                   `);
                              
            //                 }
            //                 });   
            //             $("#conversation").scrollTop($("#conversation").prop("scrollHeight"));
            //         }
            //     });
            //     var settings = {
            //       "async": true,
            //       "crossDomain": true,
            //       "url": "https://api.ultramsg.com/"+instance+"/chats/read",
            //       "method": "POST",
            //       "headers": {},
            //       "data": {
            //         "token": token,
            //         "chatId": chat_id
            //     }
            //     }
                
            //     $.ajax(settings).done(function (response) {
            //     });
            //     // End  send read chat
                    
            // });
        //END Get Messages Form Chat
      
        //Conversation Action
            $(document).on("click","#conversation-type",function() {
              var action = $(this).data('action');
              var chat_id = $(this).data('chat_id');
              var chat_title = $(this).data('chat_title');
              var chat_img = $(this).data('chat_img');
      
              if(action == "close"){
                $('#conversation-type').data('action','open').removeClass('btn-success').addClass('btn-secondary').text('Open Conversation');
              }else{
                $('#conversation-type').data('action','close').removeClass('btn-secondary').addClass('btn-success').text('Close Conversation');
              }
      
                $.ajax({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                  url: set_con_route,
                  type: 'post',
                  data: { "chat_id":chat_id , "action":action ,"img":chat_img , "title":chat_title},
                  success: function(response) {
                  }
                });
      
      
            });
        //End Conversation Action
      
        //Function Convert Time
            function convert_time(timestamp){
                var date = new Date(timestamp * 1000);
                // Hours part from the timestamp
                var hours = date.getHours();
                // Minutes part from the timestamp
                var minutes = "0" + date.getMinutes();
                // Seconds part from the timestamp
                var seconds = "0" + date.getSeconds();
                // Will display time in 10:30:23 format
                var formattedTime = hours + ':' + minutes.substr(-2);
                return(formattedTime);
            };
        //End Function Convert Time
      
      
            // Pest Here java script code
             Pusher.logToConsole = true;
             var pusher = new Pusher(pusher_key, {
                    encrypted: true
            });
            // End Pest Here java script code
           

          // End  Add Profile Image 
          var current_id = $('#profile_image').data('current_id');
          var channel = pusher.subscribe('whatsapp-'+instance); 
          var chat_id  = $('#conversation').data('receiver_id');
      
            //Event Name
             channel.bind('App\\Events\\NotificationEvent', function(data) {
              
              
                 $.ajax({
                      headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                        url: save_chat_route,
                        type: 'post',
                        data: { "data": data},
                        success: function(response) {
                          if(response.action == 'done'){
                          
                                // RE ORDER CHAT 
                                  if(data.event_type == "message_received"){    
                                    $('[data-chat_id="'+data.from+'"]').insertBefore('.sideBar-body:first-child');
                                  var unread_count =  $('[data-chat_id="'+data.from+'"] .unread').html();
                                  if(unread_count){
                                    $('[data-chat_id="'+data.from+'"] .unread').html(parseInt(unread_count)+1);
                                  }else{
                                    $('[data-chat_id="'+data.from+'"]').append(`<span class="unread">1</span>`);
                                  }
                                  }else{  
                                      $('[data-chat_id="'+data.to+'"]').insertBefore('.sideBar-body:first-child');
                                  }
                                //END  RE ORDER CHAT 
                                var receiver_id =   $('#conversation').data('receiver_id');
                                if(receiver_id && receiver_id !=''){
                                  
                                    var mainClass = "";
                                    var subClass = "";
                                    //Check Message Type
                                      if(data.event_type == "message_received"){
                                          mainClass = "message-main-receiver";
                                          subClass = "receiver";
                                          
                                          $('[data-chat_id="'+data.from+'"]').insertBefore('.sideBar-body:first-child');
                                      }else{
                                          mainClass = "message-main-sender";
                                          subClass = "sender" ;
                                          $('[data-chat_id="'+data.to+'"]').insertBefore('.sideBar-body:first-child');
                                      }
                                      var pushname = '';
                                      if(data.pushname !=null){
                                          pushname = data.pushname;
                                      }else{
                                          pushname = 'me' ;
                                      }
                                      //CHECK IF CONVERSATION OPEN 
                                          if(subClass == 'receiver' && receiver_id == data.from || subClass == 'sender' && receiver_id == data.to  ){
                                            if(data.type == "image"){
                                    
                                                
                                              $('#conversation').append(
                                                ` 
                                                  <div class="row message-body">
                                                      <div class="col-12 `+mainClass+`">
                                                      <div class="`+subClass+`">
                                                          <div class="message-text">
                                                          <img id="uploadedImage" src="`+data.media+`" alt="Uploaded Image" accept="image/png, image/jpeg">
                                                            
                                                          </div>
                                                          <span class="message-time pull-right">
                                                          `+ convert_time(data.time)+`
                                                          </span>
                                                          <span>
                                                            <a href="`+data.media+`" download  target="_blank">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                                              </svg>
                                                            </a>
                                                          </span>
                                                          
                                                          <span class="message-time pull-right">`+pushname+`</span>
                                                      </div>
                                                      </div>
                                                  </div>    
                                                `);
                                              }else if(data.type == "ptt" || data.type == "audio"){
                                                    $('#conversation').append(
                                                      ` 
                                                        <div class="row message-body">
                                                            <div class="col-12 `+mainClass+`">
                                                              <div class="`+subClass+`">
                                                                <div class="message-text">
                                                                <audio controls>
                                                                    <source src="`+data.media+`" type="audio/mpeg">
                                                                </audio>
                                                                  
                                                                </div>
                                                                <span class="message-time pull-right">
                                                                `+ convert_time(data.time)+`
                                                                </span>
                                                                <span>
                                                                  <a href="`+data.media+`" download  target="_blank">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                                      <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                                      <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                                                    </svg>
                                                                  </a>
                                                                </span>
                                                                
                                                                <span class="message-time pull-right">`+pushname+`</span>
                                                            </div>
                                                            </div>
                                                        </div>    
                                                      `);
                                              }else if(data.type == "video" ){
                                                    $('#conversation').append(
                                                      ` 
                                                        <div class="row message-body">
                                                            <div class="col-12 `+mainClass+`">
                                                              <div class="`+subClass+`">
                                                                <div class="message-text">
                                                                
                                                                <video width="210" height="150" controls>
                                                                  <source src="`+data.media+`" type="video/mp4">
                                                                  <source src="`+data.media+`" type="video/ogg">
                                                                </video>
                                                                  
                                                                </div>
                                                                <span class="message-time pull-right">
                                                                `+ convert_time(data.time)+`
                                                                </span>
                                                                <span>
                                                                  <a href="`+data.media+`" download  target="_blank">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                                      <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                                      <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                                                    </svg>
                                                                  </a>
                                                                </span>
                                                                
                                                                <span class="message-time pull-right">`+pushname+`</span>
                                                            </div>
                                                            </div>
                                                        </div>    
                                                      `);
                                              }else if(data.type == "location" ){
                                                  $('#conversation').append(
                                                    ` 
                                                      <div class="row message-body">
                                                          <div class="col-12 `+mainClass+`">
                                                            <div class="`+subClass+`">
                                                              <div class="message-text">
                                                                <a   href="https://maps.google.com/maps?q=`+data.latitude+`%2C`+data.longitude+`&amp;z=17&amp;hl=en" target="_blank" aria-label="Open map location">
                                                                    <img style="width:100%" crossorigin="anonymous" src=https://maps.googleapis.com/maps/api/staticmap?zoom=15&size=270x200&scale=1&language=en&client=gme-whatsappinc&markers=color%3Ared%7C`+data.latitude+`%2C+`+data.longitude+`&signature=KN6_HP6wExvhlWIXmMBppuhuxIo">
                                                                </a>
                                                              </div>
                                                              <span class="message-time pull-right">
                                                              `+ convert_time(data.time)+`
                                                              </span>
                                                            
                                                              
                                                              <span class="message-time pull-right">`+pushname+`</span>
                                                          </div>
                                                          </div>
                                                      </div>    
                                                    `);
                                              }else if(data.type == "document"){
                                                      $('#conversation').append(
                                                        ` 
                                                          <div class="row message-body">
                                                              <div class="col-12 `+mainClass+`">
                                                                <div class="`+subClass+`">
                                                                  <div class="message-text">
                                                                    <span> `+data.type+`</span>
                                                                  </div>
                                                                  <span class="message-time pull-right">
                                                                  `+ convert_time(data.time)+`
                                                                  </span>
                                                                  <span>
                                                                    <a href="`+data.media+`" download  target="_blank">
                                                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                                                      </svg>
                                                                    </a>
                                                                  </span>
                                                                  
                                                                  <span class="message-time pull-right">`+pushname+`</span>
                                                              </div>
                                                              </div>
                                                          </div>    
                                                        `);
                                              }else{
                                                  $('#conversation').append(
                                                  ` 
                                                    <div class="row message-body">
                                                        <div class="col-12 `+mainClass+`">
                                                          <div class="`+subClass+`">
                                                            <div class="message-text">
                                                            `+data.body+`
                                                            </div>
                                                            <span class="message-time pull-right">
                                                            `+ convert_time(data.time)+`
                                                            </span>
                                                            <span class="message-time pull-right">`+pushname+`</span>
                                                        </div>
                                                        </div>
                                                    </div>    
                                                  `);
                                              }
                                              // $('.sideBar').empty();
                                              // get_all_chat();
                                              $("#conversation").scrollTop($("#conversation").prop("scrollHeight"));
                                          }else{
                                            // $('.sideBar').empty();
                                            // get_all_chat();
                                          }
                
                                          
                                }
                          }
                          
                        },
                        error: function(){
                            return false;
                        }
                });
            
              
          
                  
            });
            
        // Map 
        if (document.getElementById('map-canvas')) {
            var content;
            var latitude = 52.525595;
            var longitude = 13.393085;
            var map;
            var marker;
            navigator.geolocation.getCurrentPosition(loadMap);  
      
            function loadMap(location) {
                if (location.coords) {
                    latitude = location.coords.latitude;
                    longitude = location.coords.longitude;
                }
      
                // Coordinates to center the map
                var myLatlng = new google.maps.LatLng(latitude, longitude);
      
                // Other options for the map, pretty much selfexplanatory
                var mapOptions = {
                    zoom: 14,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
      
                // Attach a map to the DOM Element, with the defined settings
                map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
      
                content = document.getElementById('information');
                google.maps.event.addListener(map, 'click', function(e) {
                placeMarker(e.latLng);
                
                });
      
                var input = document.getElementById('search_input');
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
      
                var searchBox = new google.maps.places.SearchBox(input);
      
                google.maps.event.addListener(searchBox, 'places_changed', function() {
                var places = searchBox.getPlaces();
                placeMarker(places[0].geometry.location);
                });
                                                
                marker = new google.maps.Marker({
                map: map
                });
            }
            }
          function placeMarker(location) {
            debugger;
            //marker.setPosition(location);
            //map.setCenter(location)
            // content.innerHTML = "Lat: " + location.lat() + " / Long: " + location.lng();
            send_location(location.lat(),location.lng());
            
            
            // google.maps.event.addListener(marker, 'click', function(e) {
            //     new google.maps.InfoWindow({
            //         content: "Lat: " + location.lat() + " / Long: " + location.lng()
                    
            //     });
            // });
          
                $('#location').modal('hide');
               
            }
        //End Map
      
        // recording
          const button = document.querySelector('.reply-recording');
      
          // set the options of this 3rd party mp3 js encoder
          const recorder = new MicRecorder({
              bitRate: 128
          });
        
          // start recording with a click of the button
          button.addEventListener('click', startRecording);
        
          // start the recording
            function startRecording() {
                var chat_id  = $('#conversation').data('receiver_id');
                if(chat_id && chat_id !=""){
                    recorder.start().then(() => {
                        
                        $('.reply-recording').empty();
                        $('.reply-recording').append(`<svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='red' class='bi bi-mic-fill' viewBox='0 0 16 16'><path d='M5 3a3 3 0 0 1 6 0v5a3 3 0 0 1-6 0V3z'></path><path d='M3.5 6.5A.5.5 0 0 1 4 7v1a4 4 0 0 0 8 0V7a.5.5 0 0 1 1 0v1a5 5 0 0 1-4.5 4.975V15h3a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1h3v-2.025A5 5 0 0 1 3 8V7a.5.5 0 0 1 .5-.5z'></path></svg>`);
                        button.removeEventListener('click', startRecording);
                        button.addEventListener('click', stopRecording);
                    }).catch((e) => {
                        console.error(e);
                    });
                }else{
                    return false;
                }
            }
        
          // stop the recording
            function stopRecording() {
                // create the mp3
                recorder.stop().getMp3().then(([buffer, blob]) => {
                   
                    // create the file
                    const file = new File(buffer, 'audio.mp3', {
                        type: blob.type,
                        lastModified: Date.now()
                    });
                    send_audio(file);
                  
                        $('.reply-recording').empty();
                        $('.reply-recording').append(`<svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='black' class='bi bi-mic-fill' viewBox='0 0 16 16'><path d='M5 3a3 3 0 0 1 6 0v5a3 3 0 0 1-6 0V3z'></path><path d='M3.5 6.5A.5.5 0 0 1 4 7v1a4 4 0 0 0 8 0V7a.5.5 0 0 1 1 0v1a5 5 0 0 1-4.5 4.975V15h3a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1h3v-2.025A5 5 0 0 1 3 8V7a.5.5 0 0 1 .5-.5z'></path></svg>`);
                    button.removeEventListener('click', stopRecording);
                    button.addEventListener('click', startRecording);
                }).catch((e) => {
                    console.error(e);
                });
            }
      
        // End recording
      
        // Get conversations by type 
          $('#conversations_types').on('change', function() {
            $('.sideBar').empty();
             var type = this.value;
             if(type != "all" ){
                $.ajax({
                  url: GetConByType,
                  type: 'GET',
                  data: { "type":type},
                  success: function(response) {
                    
                    var data  = response;
                    arr = [];
                    $.each(data, function(index) {
                        arr.push(data[index].id);
                    });
          
                    // get chats
                    var settings = {
                      "async": true,
                      "crossDomain": true,
                      "url": "https://api.ultramsg.com/"+instance+"/chats?token="+token+"",
                      "method": "GET",
                      "headers": {"content-type": "application/x-www-form-urlencoded"}
                    }  
                    $.ajax(settings).done(function (response) {
          
                      $.each(response, function(index) {
                        var chat_id = response[index].id;
      
                            if(arr.includes(chat_id )){
                            $('.sideBar').append(
                              `   <div class="row sideBar-body" data-chat_id="`+chat_id+`" data-selector="`+response[index].id.replace('@','').replace('.','')+`" >
                                  
                                      <div class="col-3  sideBar-avatar avatar`+response[index].id.replace('@','').replace('.','')+`">
                                      
                                      </div>
                                      <div class="col-9  sideBar-main">
                                        <div class="row">
                                            <div class="col-8  sideBar-name">
                                              <span class="name-meta">`+response[index].name+`
                                              </span>
                                            </div>
                                            <div class="col-4 pull-right sideBar-time">
                                              <span class="time-meta pull-right">`+convert_time(response[index].last_time)+`</span>
                                            </div>
                                        </div>
                                      </div>
                              </div> 
                              `);
                              if(response[index].unread > 0 ){
                                $("[data-selector="+response[index].id.replace('@','').replace('.','')+"]").append(`<span class="unread" >`+response[index].unread+`</span>`);    
                              }
                              var settings = {
                                  "async": true,
                                  "crossDomain": true,
                                  "url": "https://api.ultramsg.com/"+instance+"/contacts/image?token="+token+"&chatId="+chat_id+"",
                                  "method": "GET",
                                  "headers": {
                                      "content-type": "application/x-www-form-urlencoded"
                                  }
                                  }
                
                                  $.ajax(settings).done(function (data) {
                                  if(data.success){
                                      $(".avatar" + chat_id.replace('@','').replace('.','') ).empty().append(`<div class="avatar-icon"> <img src="`+data.success+`"> </div>`);
                
                                      }else{
                                      $(".avatar" + chat_id.replace('@','').replace('.','') ).empty().append(`<span data-testid="default-user" data-icon="default-user" class=""><svg viewBox="0 0 212 212" width="50" height="50" class=""><path fill="#DFE5E7" class="background" d="M106.251.5C164.653.5 212 47.846 212 106.25S164.653 212 106.25 212C47.846 212 .5 164.654.5 106.25S47.846.5 106.251.5z"></path><g fill="#FFF"><path class="primary" d="M173.561 171.615a62.767 62.767 0 0 0-2.065-2.955 67.7 67.7 0 0 0-2.608-3.299 70.112 70.112 0 0 0-3.184-3.527 71.097 71.097 0 0 0-5.924-5.47 72.458 72.458 0 0 0-10.204-7.026 75.2 75.2 0 0 0-5.98-3.055c-.062-.028-.118-.059-.18-.087-9.792-4.44-22.106-7.529-37.416-7.529s-27.624 3.089-37.416 7.529c-.338.153-.653.318-.985.474a75.37 75.37 0 0 0-6.229 3.298 72.589 72.589 0 0 0-9.15 6.395 71.243 71.243 0 0 0-5.924 5.47 70.064 70.064 0 0 0-3.184 3.527 67.142 67.142 0 0 0-2.609 3.299 63.292 63.292 0 0 0-2.065 2.955 56.33 56.33 0 0 0-1.447 2.324c-.033.056-.073.119-.104.174a47.92 47.92 0 0 0-1.07 1.926c-.559 1.068-.818 1.678-.818 1.678v.398c18.285 17.927 43.322 28.985 70.945 28.985 27.678 0 52.761-11.103 71.055-29.095v-.289s-.619-1.45-1.992-3.778a58.346 58.346 0 0 0-1.446-2.322zM106.002 125.5c2.645 0 5.212-.253 7.68-.737a38.272 38.272 0 0 0 3.624-.896 37.124 37.124 0 0 0 5.12-1.958 36.307 36.307 0 0 0 6.15-3.67 35.923 35.923 0 0 0 9.489-10.48 36.558 36.558 0 0 0 2.422-4.84 37.051 37.051 0 0 0 1.716-5.25c.299-1.208.542-2.443.725-3.701.275-1.887.417-3.827.417-5.811s-.142-3.925-.417-5.811a38.734 38.734 0 0 0-1.215-5.494 36.68 36.68 0 0 0-3.648-8.298 35.923 35.923 0 0 0-9.489-10.48 36.347 36.347 0 0 0-6.15-3.67 37.124 37.124 0 0 0-5.12-1.958 37.67 37.67 0 0 0-3.624-.896 39.875 39.875 0 0 0-7.68-.737c-21.162 0-37.345 16.183-37.345 37.345 0 21.159 16.183 37.342 37.345 37.342z"></path></g></svg></span>`);
                
                                      }
                                  });
                                    
                            }
      
                      }); 
      
                    });
                    
                  }
                });
              }else{
                get_all_chat();
              }
            
      
          });
        // End  Get conversations by type 
      
        // Append to selection
            $(document).on("click","#sendMessage",function() {
              $('#SelectGroup').empty();
              $.ajax({
                  url: get_Grou_route,
                  type: 'GET',
                  
                  success: function(response) {
                      var data = response;
                      
                      $.each(data, function(index) {
                          $('#SelectGroup').append(`<option data-recipients="`+data[index].recipients+`"  value="`+data[index].id+`">`+data[index].name+`</option>`);
                    });
                  },
                  error: function(){
                      $(".alert-danger").show();
                          setTimeout(function() {
                              $(".alert-danger").hide();
                          }, 3000);
                  }
              });
      
            });
        // End Append to selection
      
        // Send to Broadcast
            $(document).on("click","#SendToGroup",function() {
      
              if($('#navs-top-template').hasClass('show')){
                Sendtemplates();
                return false;
              }else if($('#navs-top-message').hasClass('show')){
                SendMessage();
                return false;
              }else{
      
                return false;
              }
            });
        // End Send to Broadcast
      
        //Edit Template
          $("#SaveAsTemplate").change(function() {
            if(this.checked) {
              $('.SaveReply').removeClass('d-none');
            }else{
                $('.SaveReply').addClass('d-none'); 
            }
          });
        //End Edit Template
          
        // SendMESSAGE TO GROUPS
          function SendMessage(){
            var  Groups = $('#Send #SelectGroup').val();
            var title = $("#Send #TempTitle").val();
            var file = $("#Send #TempAudio").val();
            var message = $("#Send #TempMessage").val();
            var file_type = '';
            // valid
            if(Groups == ''){
                notification.show('Please select group','error');
                return false;
            }  
          
            if(file!=''){
                  file_type = 'audio';
            }else if( $("#Send .file-box").is(':checked') ){
              
                notification.show('Please select audio file','error');
                return false;
            }
            if(message==""){
      
              notification.show('Message is required','error');
              return false; 
      
            }
            //check if save as template is checked
            if( $( "#SaveAsTemplate").is(':checked')){
                if(title==""){
                  notification.show('Title is required','error');
                  return false; 
                }
                $.ajax({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                  url: add_template_route,
                  type: 'post',
                  data: { "title":title,"file_type":file_type,"file":file,"message":message},
                  success: function(response) {
      
                  } 
                });
      
            }
            //check if save as quick reply 
            if($( "#Send #quickReply").is(':checked')){
              if(message==""){
                notification.show('Message is required','error');
                return false; 
              }
              $.ajax({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
                url: Add_QuickReply_route,
                type: 'post',
                data: { "message":message},
                success: function(response) {
      
                } 
              });
            }
      
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
              url: send_group_route,
              type: 'POST',
              data: { "groupsIds":Groups,'message':message,"file":file,"fileType":file_type ,"instance":instance,"token":token,"referenceId":referenceId},
              success: function(response) {
                  
                      notification.next_page_notifiction("Message Send Successfully");
                      location.reload();
              },
              error: function(){
              }
          });
      
          }
        // End SendTemplate
      
        // SendTemplate
          function Sendtemplates(){
            var Templates = $('#SelectTemplates').val();
            var  Groups = $('#SelectGroup').val();
      
            var from = $('#from').val();
            var to  = $('#to').val();
            // valid
            if(Groups == ''){
                notification.show('Please select group','error');
                return false;
            } 
            if(Templates == ''){
                notification.show('Please select template','error');
                return false;
            }
            if(parseInt(to) < parseInt(from) ){
                $('#Send #to').addClass('is-valid');
                notification.show('To must be > from','error');
                return false
            }else{
                $('#Send #to').removeClass('is-valid');
            }
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
                url: send_group_templates_route ,
                type: 'POST',
                data: { "groupsIds":Groups,'templatesIds':Templates,"to":to,'from':from ,"instance":instance,"token":token,"referenceId":referenceId},
                success: function(response) {

                        notification.next_page_notifiction("Template Send Successfully");
                        // location.reload();
                },
                error: function(){
                }
            });
      
          }
        // End SendTemplate
      
        // Create Template
          $(document).on("click","#AddTemplate",function() {
                        
              var title = $("#saveTemplate #TempTitle").val();
              var file = $("#saveTemplate #TempAudio").val();
              var file_type = '';
              if(file!=''){
                      file_type = 'audio';
              }
      
              var message = $("#saveTemplate #TempMessage").val();
      
              if( title==""){
                notification.show('Title is required','error');
                return false;
                  
              }else if(message=="" && $("#saveTemplate #message-box").is(":checked")){
                notification.show('Message is required','error');
                  return false;
                  
              }
      
              //check if save as quick reply 
              if($( "#saveTemplate #quickReply").is(':checked')){
                if(message==""){
                  notification.show('Message is required','error');
                  return false; 
                }
                $.ajax({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                  url: Add_QuickReply_route,
                  type: 'post',
                  data: { "message":message},
                  success: function(response) {
      
                  } 
                });
              }
              if($(this).hasClass('edit'))  {
                  var id = $('#TempId').val();
      
                  $.ajax({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                      url: edit_template_route,
                      type: 'post',
                      data: { "id":id,"title":title,"file_type":file_type,"file":file,"message":message},
                      success: function(response) {
                        notification.next_page_notifiction("Template updated successfully");
                        location.reload();
                      } 
                  });
                  $(this).removeClass('edit')
              }else{
                  $.ajax({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                      url: add_template_route,
                      type: 'post',
                      data: { "title":title,"file_type":file_type,"file":file,"message":message},
                      success: function(response) {
                        notification.next_page_notifiction("Template created successfully");
                        location.reload();
                      } 
                  });
              }    // 
            
      
        
          });
        // End Create Template
          
        // Get all Groups
          GetTemplates();
          function GetTemplates(){
            
              $('#templates').empty();
              $('#SelectTemplates').empty();
            
      
              $.ajax({
                  type: 'GET',
                  url: get_temp_route,
                 
                  
                  success: function(response) {
                      $('#templates').empty();
                      var data = response;
                  
                      $.each(data, function(index) {
                        
                          $('#templates').append(`
                                  
                                  <div class="alert alert-primary alert-dismissible" role="alert" >
                                      `+data[index].title+`
                                      <a  class="btn-edit template-edit" data-id="`+data[index].id+`"><i class='bx bx-pencil'></i> </a>
                                      <button type="button" class="btn-close delete-template" data-bs-dismiss="alert" aria-label="Close"  data-id="`+data[index].id+`"></button>
                                  </div>
                            `);
                            $('#SelectTemplates').append(`<option value="`+data[index].id+`"> `+data[index].title+`</option>`);
                            
                            
      
                      });
                    
                  },
                  error: function(){
                      
                  }
              });
      
          }
        // End Get all templates
      
        //Delete Template
          $(document).on("click",".delete-template",function() {
            var id = $(this).data('id');
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
                url: delete_template_route,
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
          $(document).on("click",".template-edit",function() {
            var id = $(this).data('id');
            $.ajax({
                url: get_template_route,
                type: 'GET',
                data: { "id": id},
                success: function(response) {
                    
                    var data = response;
                    $('#saveTemplate #TempId').val(data[0].id);
                    $('#saveTemplate #TempTitle').val(data[0].title);
                    // $('#TempAudio').val(data[0].file);
                    $('#saveTemplate #TempMessage').val(data[0].message);
                    if(data[0].fileType && data[0].fileType=="audio"){
                        $('#saveTemplate .row-file').removeClass('d-none');
                        $('#saveTemplate .file-box').prop( "checked", true );
                        ////
                           // Get a reference to our file input
                            const fileInput = document.querySelector('#saveTemplate input[id="TempAudio"]');
      
                            // Create a new File object
                            const myFile = new File([data[0].file], data[0].file, {
                                type: 'audio/mp3',
                                lastModified: new Date(),
                            });
      
                            // Now let's create a FileList
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(myFile);
                            fileInput.files = dataTransfer.files;
                    }else{
                      $('#saveTemplate .row-file').addClass('d-none');
                      $('#saveTemplate .file-box').prop( "checked", false );
                      $('#saveTemplate input[id="TempAudio"]').val('');
                    }
                    $('#saveTemplate #AddTemplate').text('Edit').addClass('edit');
                    $('#spinner').hide();
                    $('#saveTemplate').modal("show");
                },
                error: function(){
                }
            });
            
          });
        //End Edit Template
      
        $(".file-box").change(function() {
          if(this.checked) {
            $(this).closest('.modal').find('.row-file').removeClass("d-none");
          }else{
            $(this).closest('.modal').find('.row-file').addClass("d-none");  
          }
        });
      
        // Create Broadcast
          $(document).on("click","#add_broadcast",function() {
                      
                        
      
            var id = $("#brodcastId").val();
            var name = $("#brodcastName").val();
            var recipients = $("#recipients").val();
      
            //Check values not null
            if(name ==""){
              notification.show('Name is required','error');
              return false;
            }
            if(recipients ==""){
              notification.show('Recipients is required','error');
              return false;
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
                        
                      if($.inArray(num, uniqueNum) === -1){
                              
                                uniqueNum.push(num);
                                afterCheckLength+= num+','+name+'\n';
                      
                      }
                    }
                    });
                  
                //End Remove numbers if length > 8 and not nums same
              
            // End Check 
          
            if(afterCheckLength.length !=0){
                if($(this).hasClass('edit')  ){
                    $.ajax({
                      headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                        url: edit_broadcast_route,
                        type: 'post',
                        data: { id :id ,"name": name,"recipients":afterCheckLength.toString()},
                        success: function(response) {
                        
                                location.reload();
                                notification.show('Broadcast updated successfully');
                                
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
                    
                    $.ajax({
                      headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                        url: add_broadcast_route,
                        type: 'post',
                        data: { "name": name,"recipients":afterCheckLength.toString()},
                        success: function(response) {
                        
                                $('#CreateGroup').modal('hide');
                                notification.show('Broadcast updated successfully');
                        },
                        error: function(){
                            notification.show("There's a mistake ,Please try again later!",'error');
                        }
                    });
                    
                        location.reload();
                        $('#add_broadcast').prop('disabled', false);
                }
            }else{
                notification.show("Error , The number",'error');
            }
            });
        // End  Create Broadcast
      
        // Get all Groups
          GetGroups();
          function GetGroups(){
                        
            $.ajax({
                url: get_Grou_route,
                type: 'GET',
                
                success: function(response) {
                    var data = response;
                
                    $.each(data, function(index) {
                        const arr_recipients =  data[index].recipients.split("\n");
                        var counter = arr_recipients.length-1;
                  
                      
                          $('#groups').append(` <div class="alert alert-primary alert-dismissible" role="alert" >
                                                  `+data[index].name+` (`+counter+`)
                                                  <a  class="btn-edit edit-group" data-id="`+data[index].id+`"><i class='bx bx-pencil'></i> </a>
                                                  <button type="button" class="btn-close delete-group" data-bs-dismiss="alert" aria-label="Close"  data-id="`+data[index].id+`"></button>
                                                </div>`
                                              );
      
                    });
                },
                error: function(){
                    notification.show("There's a mistake ,Please try again later!",'error');
                }
            });
      
            }
        // End Get all Groups
      
        //Delete Broadcast
          $(document).on("click",".delete-group",function() {
            var id = $(this).data('id');
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
                url: del_Grou_route,
                type: 'POST',
                data: { "id": id},
                success: function(response) {
                  
                },
                error: function(){
                    notification.show("There's a mistake ,Please try again later!",'error');
                }
            });
            
            });
        //End  Delete Broadcast
        // Edit Broadcast
        $(document).on("click",".edit-group",function() {
      
          var id = $(this).data('id');
          $.ajax({
              url: get_SGrou_route,
              type: 'GET',
              data: { "id":id},
              success: function(response) {
                  var data = response;
                  
                  $('#brodcastId').val(data[0].id);
                  $('#brodcastName').val(data[0].name);
                  $('#recipients').val(data[0].recipients);
                  $('#add_broadcast').text('Edit').addClass('edit');
                  $('#CreateGroup').modal("show");
                  
                
              },
              error: function(){
                  notification.show("There's a mistake ,Please try again later!",'error');
              }
          });
          
          });
        //End  Edit Broadcast
      
        //call Function
          GetReports();
      
        //Function Get All Reports
            function GetReports(){
              
                $('#reports').empty();
                $.ajax({
                    url:get_rep_route,
                    type: 'GET',
                    
                    success: function(response) {
                        var data = response;
                    
                        $.each(data, function(index) {
                              $('#reports').append(`
                              <div class="card p-3 report-card mb-2">
                              <div class="row">
                                  <div class="col">
                                              <figure class="p-3 mb-0">
                                                  <span>
                                                      <figcaption class=" mb-0 text-muted"><i class='bx bxs-group' ></i> `+data[index].GroupName+`</figcaption>
                                                  </span>
                                              </figure>
                                              <figure class="p-3 mb-0">
                                                  <span>
                                                      <figcaption class=" mb-0 text-muted"><i class='bx bxs-layout'></i> `+data[index].templateName+`</figcaption>
                                                  </span>
                                              </figure>
                                          
                                      </figure>
                                  </div>
                                  <div class="col">
                                      <figure class="p-3 mb-0">
                                          <span><figcaption class=" mb-0 text-muted"><i class='bx bxs-calendar'></i>`+data[index].date+`</figcaption></span>
                                      </figure>
                                      <figure class="p-3 mb-0">
                                          <span><figcaption class=" mb-0 text-muted"><i class='bx bxs-timer'></i>`+data[index].count+`</figcaption></span>  
                                      </figure>
      
                                  </div>
                              </div>
                              <button type="button" class="btn rounded-pill btn-icon btn-outline-primary view-report" data-id="`+data[index].id+`" data-bs-toggle="modal" data-bs-target="#view-report">
                                <span class="tf-icons bx bx-show"></span>
                              </button>
                          </div>`);
      
                        });
                    },
                    error: function(){
                        
                    }
                });
            }
        //END Function Get All Reports
      
        // View Report
            $(document).on("click","#reports .view-report",function() {
                var id= $(this).data("id");
                $.ajax({
                    url: get_Srep_route,
                    type: 'GET',
                    data:{"id":id},
                    
                    success: function(response) {
                        var data = response;     
                    $('#R-Date span').text(data[0].date);
                    $('#R-GroupName span').text(data[0].GroupName);
                    $('#R-TemplateName span').text(data[0].templateName);
                    $('#R-message span').text(data[0].message);
                    $('#R-CountSender span').text(data[0].count);
                    $('#R-CountSeen span').text(data[0].count);
                    
                        // $.each(data, function(index) {
                          
                        
                      
                        //     $('#Viewreport .modal-body').append(`
                        //         <div class="bs-toast toast fade show bg-primary" role="alert" aria-live="assertive" aria-atomic="true">
                        //             <div class="toast-body">
                        //                 `+data[index].element+`
                        //             </div>
                        //         </div>
                        //         </br></br>
                        //     `);
      
                        //  });
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
      
      
      // CHECK NUMBERS
          $("#cleanNumbers").change(function() {
            if(this.checked) {
      
          
              var recipients = $("#recipients").val();
      
              if(recipients ==""){
                notification.show('Recipients is required','error');
                return false;
              }
          //End check values not null
      
          //check after save recipents
              let text = recipients;
              const myArray = text.split("\n");
              const recipient = [];
              myArray.forEach(function(person) {
                  recipient.push(person.split(","));
              });
              $('#WrongNumbers .list-group').empty();
              // Remove numbers if length > 8 and not nums same
                  var afterCheckLength = "";
                  var  uniqueNum = [];
                  recipient.forEach(function(row) {
                      var name = row[1];
                      var num = row[0]
                  if(num!=undefined && name!=undefined){
                  
                          if($.inArray(num, uniqueNum) === -1){
                            
                            var settings = {
                              "async": true,
                              "crossDomain": true,
                              "url": "https://api.ultramsg.com/"+instance+"/contacts/check?token="+token+"&chatId="+num+"",
                              "method": "GET",
                              "headers": {
                                "content-type": "application/x-www-form-urlencoded"
                              }
                            }
                            
                            $.ajax(settings).done(function (response) {
                              if(response.status && response.status == 'valid'){
      
                              }else{
                                $('#WrongNumbers .list-group').append(`<li class="list-group-item list-group-item-danger">`+num+`</li>`)
                              }
                            });
                              
                          }
                      } 
                
                   
                  });
                
              //End Remove numbers if length > 8 and not nums same
            
                }
          });
      // End Check 
      
  
      

  }
}

$(document).ready(() => {
  new WhatsappJs().init();
});


