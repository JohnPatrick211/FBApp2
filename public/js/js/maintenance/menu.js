
$(document).ready(function(){
    
    $.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  
  
    fetchMenu();
     
      function fetchMenu(){
        $('#menu-table').DataTable({
       
          processing: true,
          serverSide: true,
  
          ajax:{
           url: "/maintenance/menu",
          }, 
  
          columns:[    
           {data: 'description', name: 'description'},   
           {data: 'category', name: 'category'},   
           {data: 'qty', name: 'qty'},   
           {data: 'price', name: 'price'},   
           {data: 'image', name: 'image'},
           {data: 'preparation_time', name: 'preparation_time'},
           {data: 'status', name: 'status'},
           {data: 'action', name: 'action'},
          ]
          
         });
      }
      
      //edit

      $(document).on('click', '#btn-edit-menu', function(){
        var id = $(this).attr('edit-id');
        console.log(id);
          $.ajax({
              url: '/maintenance/menu/show/'+ id,
              type: 'GET',
              success:function(response){
                  console.log(response);
                $('#id').val(response[0].id);
     
                $('#edit_category').val(response[0].category_id);
                $('#edit_description').val(response[0].description);
                $('#edit_qty').val(response[0].qty);
                $('#edit_price').val(response[0].price);
                $('#edit_prep_time').val(response[0].preparation_time);              
                $('#edit_status').val(response[0].status);

                if(response[0].image !== null){
                    var img_source = '../../storage/'+response[0].image;
                }
                else{
                    var img_source = '../assets/img-placeholer.png';
                }
                $('#img_view').attr('src', img_source);
              }
          });
        
      });

  
    // delete
    var id;
    $(document).on('click', '#btn-delete', function(){
        row = $(this).closest("tr")
        id = $(this).attr('delete-id');
        console.log(id);
        category =  $(this).closest("tr").find('td:eq(0)').text();
        menu =  $(this).closest("tr").find('td:eq(1)').text();
        $('#deleteModal').modal('show');
        $('.delete-message').html('Are you sure do you want to delete this menu?');
      }); 
      $('#btn-yes').click(function(){
          $.ajax({
              url: '/maintenance/menu/delete/'+ id,
              type: 'DELETE',
              success:function(){
                $('.delete-success').css('display', 'inline');
                  setTimeout(function(){
                      row.fadeOut(500, function () {
                        table.row(row).remove().draw()
                        $('#deleteModal').modal('toggle');
                        });
                     
                  }, 2000);
                  $('.delete-success').css('display', 'none');
              }
          });
        
      });
  });
    
    
    
    
    