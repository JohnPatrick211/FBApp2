
$(document).ready(function(){
    
  $.ajaxSetup({
    headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });


  fetchCategoryAndMenu();
   
    function fetchCategoryAndMenu(){
      $('#category-table').DataTable({
     
        processing: true,
        serverSide: true,

        ajax:{
         url: "/maintenance/category",
        }, 

        columns:[       
         {data: 'category', name: 'category'},
         {data: 'image', name: 'image'},
         {data: 'is_active', name: 'is_active'},
         {data: 'action', name: 'action'},
        ]
        
       });
    }          
      

//edit modal show
$(document).on('click', '#btn-edit', function(){
  var id = $(this).attr('edit-id');
  
  console.log(id);

  $.ajax({
    url:"/maintenance/category/show/"+id,
    type:"GET",
    success:function(response){
      console.log(response);
      $('#id').val(response[0].id);
      $('#edit_category').val(response[0].category);
      $('select[name="status"]').val(response[0].is_active);
  
    }
   });
}); 




  // delete
  var id, category;
  $(document).on('click', '#btn-delete', function(){
      row = $(this).closest("tr")
      id = $(this).attr('delete-id');
      console.log(id);
      category =  $(this).closest("tr").find('td:eq(0)').text();
      $('#deleteModal').modal('show');
      $('.delete-message').html('Are you sure do you want to delete category <b>'+ category +'?');
    }); 
    $('#btn-yes').click(function(){
        $.ajax({
            url: '/maintenance/category/delete/'+ id,
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
  
  
  
  
  