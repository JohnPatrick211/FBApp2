
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      fetchUser();
     
      function fetchUser(){
        $('#user-table').DataTable({
       
          processing: true,
          serverSide: true,
  
          ajax:{
           url: "/utilities/user",
          }, 
  
          columns:[    
           {data: 'emp_id', name: 'emp_id'},  
           {data: 'fullname', name: 'fullname'}, 
           {data: 'username', name: 'username'},   
           {data: 'role', name: 'role'},     
           {data: 'contact_no', name: 'contact_no'},
           {data: 'status', name: 'status'},
           {data: 'action', name: 'action'},
          ]
          
         });
      }



  //edit modal show
  $(document).on('click', '#btn-edit-user', function(){
    var id = $(this).attr('edit-id');
    console.log(id);
      $.ajax({
          url: '/utilities/user/show/'+ id,
          type: 'GET',
          success:function(response){
              console.log(response);
              $('#id').val(response[0].id);
              $('#emp_id').val(response[0].emp_id);
              $('#fullname').val(response[0].fullname);
              $('#username').val(response[0].username);
              $('#password').val(response[0].password);
              $('#role').val(response[0].role);
              $('#contact_no').val(response[0].contact_no);
              $('#status').val(response[0].is_active);
          }
      });
    
  });  
  
  
// delete
var id, emp_name;
$(document).on('click', '#btn-delete-user', function(){
    row = $(this).closest("tr")
    id = $(this).attr('delete-id');
    console.log(id);
    emp_name =  $(this).closest("tr").find('td:eq(1)').text();
    $('#deleteModal').modal('show');
    $('.delete-message').html('Are you sure do you want to delete user <b>'+ emp_name +'?');
  }); 
  
  $('#btn-confirm-del-user').click(function(){
      $.ajax({
          url: '/utilities/user/delete/'+ id,
          type: 'DELETE',
          beforeSend:function(){
            $('#btn-confirm-del-user').text('Deleting...');
        },
          success:function(){
            setTimeout(function(){
                
                $('.delete-success').css('display', 'inline');  
                row.fadeOut(500, function () {
                  table.row(row).remove().draw() 
                  });
               
            }, 2000);

           setTimeout(function(){            
                $('#btn-confirm-del-user').text('Yes');
                $('#deleteModal').modal('hide');
           },4000)
                
           $('.delete-success').css('display', 'none');
          }
      });
    
  });


  });
    
    
    
    
    