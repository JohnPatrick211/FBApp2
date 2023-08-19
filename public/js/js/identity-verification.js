
$(document).ready(function(){
    
    $.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  
  
    fetchCustomerUploads();
     
      function fetchCustomerUploads(){
        $('#identity-verification-table').DataTable({
       
          processing: true,
          serverSide: true,
  
          ajax:{
           url: "/identity-verification",
          }, 
  
          columns:[       
           {data: 'fullname', name: 'fullname'},
           {data: 'phone_no', name: 'image'},
           {data: 'email', name: 'email'},
           {data: 'id_type', name: 'id_type'},
           {data: 'id_number', name: 'id_number'},
           {data: 'is_verified', name: 'is_verified'},
           {data: 'action', name: 'action'},
          ]
          
         });
      }          
        
  
      $(document).on('click', '.btn-upload-details', function(){
        var user_id = $(this).attr('user-id');
        fetchUploadInfo(user_id);
    });

    function fetchUploadInfo(user_id){
      $.ajax({
        url:"/showUploadDetails/"+ user_id,
        type:"GET",

        success:function(data){
              console.log(data);
         // isVerified(cust_id);
            $('input[name="user_id"]').val(data[0].user_id);
            $('#id-type').text(data[0].id_type);
            $('#id-number').text(data[0].id_number);

            var img_id = '../../storage/'+data[0].image;
    
            $('#img-valid-id').attr('src', img_id);

            var img_selfie = '../../storage/'+data[0].selfie_with_id;
    
            $('#img-selfie-with-id').attr('src', img_selfie);
        }
         
       });
    }
  
  });
    
    
    
    
    