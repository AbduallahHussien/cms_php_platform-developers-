// platform/plugins/whatsapp/resources/js/chat.js
import { db, ref, onChildAdded,query, orderByChild, limitToLast, get,child } from './firebase';

// Reference the chat path in Firebase




///////////////////////////////////////////////////////////////////////////////
$(function() {
  $(document).on("click",".sideBar-body",function() 
  { 
    $('.sideBar-body').removeClass('hover');
    $(this).addClass('hover');
    $('.conversation').removeClass('d-none');
    $('.start-bg').addClass('d-none');
    $(this).find('.unread').remove();

    if (window.innerWidth < 700){
      $(".side").css({"display": "none"});
    }
    var instance_id  = instance.split(/(\d+)/);
    var chatName = ($(this).find('.name-meta').text());
    var chat_id = $(this).data('chat_id');
    
    var chat_img = $(this).find('img').attr('src');
    var chat_title = $(this).find('.name-meta').text();

    $('#conversation-type').data('chat_title',chat_title);
    $('#conversation-type').data('chat_img',chat_img);
    $('a.heading-name-meta').empty().text(chatName);
    $('#conversation').empty();
    
    $('#conversation').data("receiver_id",chat_id);
    
    heading_image(chat_id);
    
    async function loadChatMessages(chat_id, instance_id) {
      const snapshot = await get(child(ref(db), 'whatsapp_chat'));
   
      if (snapshot.exists()) {
         
        let messages = [];
    
        snapshot.forEach(childSnapshot => {
          const msg = childSnapshot.val();

          if (
            msg.chat_id === instance_id 
            &&
            String(msg.msg_id).includes(chat_id)
          ) {
            messages.push(msg);
          }
        });
    
        // Sort by time ascending
        messages.sort((a, b) => a.time - b.time); 
    
        // Now use `messages` array to update DOM
        return messages;
      } else { 
        return [];
      }
    }
    
    // // Example usage:
    // chat_id = "963995275137@c.us";
    // instance_id = "117593"; 
    if (chat_id && instance_id) { 
      loadChatMessages(chat_id, instance_id[1]).then(data => {
     
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
            if(data[index].type == "image" )
            {
                
                $('#conversation').append(
                `<div class="row message-body">
                      <div class="col-12 `+mainClass+`">
                      <div class="`+subClass+`">
                          <div class="message-text">
                          <img id="uploadedImage" src="${data[index].media}" alt="Uploaded Image" accept="image/png, image/jpeg">
                          </div>
                          <span class="message-time pull-right">`+ convert_time(data[index].time)+`</span>
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
                  </div>`);
                
            }else if(data[index].type == "ptt" || data[index].type == "audio"){

          
              $('#conversation').append(
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
            }
            else if(data[index].type === "location" ){
              console.log('data.lo_latitude',data.lo_latitude)
              console.log('data.lo_longitude',data.lo_longitude)
              $('#conversation').append(`
                <div class="row message-body">
                  <div class="col-12 ${mainClass}">
                    <div class="${subClass}">
                      <div class="message-text">
                        <iframe 
                          width="270" 
                          height="200" 
                          style="border:0;width:100%" 
                          loading="lazy" 
                          allowfullscreen 
                          referrerpolicy="no-referrer-when-downgrade"
                          src="https://www.google.com/maps?q=${data.lo_latitude},${data.lo_longitude}&z=17&output=embed">
                        </iframe>
                      </div>
                      <span class="message-time pull-right">
                        ${convert_time(data.time)}
                      </span>
                      <span class="message-time pull-right">${pushname}</span>
                    </div>
                  </div>
                </div>
              `);
            }else if(data[index].type == "document"){

          
              $('#conversation').append(
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

          
              $('#conversation').append(
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
            
              $('#conversation').append(
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
        $("#conversation").scrollTop($("#conversation").prop("scrollHeight"));

      });
      // console.log('after loadChatMessages')
    } else {
      console.warn("Missing chat_id or instance_id");
  }  
       
          
  });

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
});


///////////////////////////////////////////////////////////////////////////////
// Listen for new messages
const chatRef = ref(db, 'whatsapp_chat');

onChildAdded(chatRef, (snapshot) => {

    const data = snapshot.val();

    // // 1. Basic validation
    // if (!data || !data.event_type) {
    //     console.error("🔥 Received invalid data from Firebase:", message);
    //     return;
    // }
    // alert("Hello eng");
    //     debugger;
                          
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
                      }
                      else if(data.type == "location" ){
                        console.log('data.lo_latitude',data.lo_latitude)
                        console.log('data.lo_longitude',data.lo_longitude)
                        $('#conversation').append(`
                          <div class="row message-body">
                            <div class="col-12 ${mainClass}">
                              <div class="${subClass}">
                                <div class="message-text">
                                  <iframe 
                                    width="270" 
                                    height="200" 
                                    style="border:0;width:100%" 
                                    loading="lazy" 
                                    allowfullscreen 
                                    referrerpolicy="no-referrer-when-downgrade"
                                    src="https://www.google.com/maps?q=${data.lo_latitude},${data.lo_longitude}&z=17&output=embed">
                                  </iframe>
                                </div>
                                <span class="message-time pull-right">
                                  ${convert_time(data.time)}
                                </span>
                                <span class="message-time pull-right">${pushname}</span>
                              </div>
                            </div>
                          </div>
                        `);
                        
                        // $('#conversation').append(
                        //   `
                        //     <div class="row message-body">
                        //       <div class="col-12 ${mainClass}">
                        //         <div class="${subClass}">
                        //           <div class="message-text">
                        //             <a href="https://maps.google.com/maps?q=${data.lo_latitude},${data.lo_longitude}&z=17&hl=en"
                        //                target="_blank" aria-label="Open map location">
                        //               <img style="width:100%" crossorigin="anonymous"
                        //                    src="https://maps.googleapis.com/maps/api/staticmap?zoom=15&size=270x200&scale=1&language=en&client=gme-whatsappinc&markers=color%3Ared%7C${data.lo_latitude},${data.lo_longitude}&signature=KN6_HP6wExvhlWIXmMBppuhuxIo">
                        //             </a>
                        //           </div>
                        //           <span class="message-time pull-right">
                        //             ${convert_time(data.time)}
                        //           </span>
                        //           <span class="message-time pull-right">${pushname}</span>
                        //         </div>
                        //       </div>
                        //     </div>
                        //   `
                        // );                        
                      }
                      else if(data.type == "video" ){
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
                      }
                      else if(data.type == "document"){
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
  
});

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



