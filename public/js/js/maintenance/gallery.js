
$(document).ready(function(){
    
    $.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  
 
    // delete
    var id
    $(document).on('click', '#btn-delete-gallery', function(){
        row = $(this).closest("tr")
        id = $(this).attr('delete-id');
        console.log(id);
        $('#deleteModal').modal('show');
        $('.delete-message').html('Are you sure do you want to delete this image?');
      }); 
      $('#btn-gallery').click(function(){
          $.ajax({
              url: '/maintenance/gallery/delete/'+ id,
              type: 'GET',
              success:function(){
                  console.log(id);
                $('.delete-success').css('display', 'inline');
                setTimeout(function(){
                    $('#deleteModal').modal('toggle');
                    $('#gallery-table').load('gallery #gallery-table');
                }, 1000);
              }
          });
        
      });
  });
    
    
    
    
    