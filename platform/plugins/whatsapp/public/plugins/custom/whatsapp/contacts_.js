
class ContactsJs {
    init() {
  
  
    // Call Function On Page Load
    GetContacts();

    // Get All Contacts
    function GetContacts(){
        $('#contactsResults').empty();

            $.ajax({
                url: get_contacts_route,
                type: 'GET',
                
                success: function(response) {
                    var data = response;
                    $.each(data, function(index) {
                    
                    
                
                        $('#contactsResults').append(`  
                            <tr>
                                <td>
                                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                        <li
                                        data-bs-toggle="tooltip"
                                        data-popup="tooltip-custom"
                                        data-bs-placement="top"
                                        class="avatar avatar-xs pull-up"
                                        title="Christina Parker"
                                        >
                                        <img src="`+data[index].display+`" alt="Avatar" style="width: 49px;" class="rounded-circle" />
                                        </li>
                                    </ul>
                                </td>
                                <td> <strong>`+data[index].name+`</strong></td>
                                <td>`+data[index].channel+`</td>
                                <td>`+data[index].email+`</td>
                                <td>`+data[index].phone+`</td>
                                <td>`+data[index].tags+`</td>
                                <td>`+data[index].country+`</td>
                                <td>`+data[index].language+`</td>
                                <td><span class="badge bg-label-primary me-1">`+data[index].conversation_Status+`</span></td>
                                <td>`+data[index].assignee+`</td>
                                <td>`+data[index].last_message+`</td>
                                <td>`+data[index].date_added+`</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                        <a class="dropdown-item edit_contact" data-id="`+data[index].id+`" href="javascript:void(0);"
                                            ><i class="bx bx-edit-alt me-1"></i>Edit</a
                                        >
                                        <a class="dropdown-item" data-id="`+data[index].id+`" href="javascript:void(0);"
                                            ><i class="bx bx-trash me-1"></i> View Messages </a
                                        >
                                        <a class="dropdown-item" id="DeleteContact" data-id="`+data[index].id+`" href="javascript:void(0);"
                                            ><i class="bx bx-trash me-1"></i> Delete</a
                                        >
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
    //END Get All Contacts

    // Open Modal &  Fill Values Contact
    $(document).on("click",".edit_contact",function() {
            
        $('#spinner').show();
        var id = $(this).data('id');
        $.ajax({
            url: get_contacts_route,
            type: 'GET',
            data: { "id":id},
            success: function(response) {
                var data = response;

                $('#id').val(data[0].id);
                $('#name').val(data[0].name);
                $('#channel').val(data[0].channel);
                $('#email').val(data[0].email);
                $('#phone').val(data[0].phone);
                $('#tags').val(data[0].tags);
                $('#country').val(data[0].country);
                $('#language').val(data[0].language);
                $('#conversation_status').val(data[0].conversation_Status);
                $('#assignee').val(data[0].assignee);
                $('#spinner').hide();
                $('#EditModal').modal("show");
                
            
            },
            error: function(){
                $(".alert-danger").show();
                    setTimeout(function() {
                        $(".alert-danger").hide();
                    }, 3000);
            }
        });
        
    });
    //End  Open Modal &  Fill Values Contact.

    //Edit contact
    $(document).on("click","#EditContact",function() {
        $('#spinner').show();
                var id= $('#id').val();
                var name= $('#name').val();
                var channel= $('#channel').val();
                var email= $('#email').val();
                var phone = $('#phone').val();
                var tags = $('#tags').val();
                var country = $('#country').val();
                var language = $('#language').val();
                var conversation_status = $('#conversation_status').val();
                var assignee = $('#assignee').val();
        $.ajax({
            url: edit_contact_route,
            type: 'post',
            data: { "id":id , "name": name , "channel":channel , "email":email , "phone":phone , "tags":tags , 
                    "country":country , "language":language , "conversation_status":conversation_status , "assignee":assignee },
            success: function(response) {
            
                    $('#EditModal').modal('hide');
                      
                    $(".alert-success").text("Contact updated successfully").show();

                    setTimeout(function() {
                        $(".alert-success").hide();
                    }, 3000);

            },
            error: function(){
                $(".alert-danger").show();
                    setTimeout(function() {
                        $(".alert-danger").hide();
                    }, 3000);
            }
        });
        setTimeout(function() {
            GetContacts();
            $('#spinner').hide();
        }, 1000);
    });
    //End Edit contact

    // Delete Contact
    $(document).on("click","#DeleteContact",function() {
        $('#spinner').show();
        var id = $(this).data('id');
        $.ajax({
            url: delete_contact_route,
            type: 'POST',
            data: { "id": id},
            success: function(response) {
                GetContacts();
                setTimeout(function() {
                        $('#spinner').hide();
                    }, 1000);
            },
            error: function(){
                $(".alert-danger").show();
                    setTimeout(function() {
                        $(".alert-danger").hide();
                    }, 3000);
            }
        });
        
    });
    //End Delete Contact

        
    
        
  
    }
  }
  
  $(document).ready(() => {
    new ContactsJs().init();
  });