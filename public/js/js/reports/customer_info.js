$(document).ready(function(){
    $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      
      fetchCustomerInfo();
     
      function fetchCustomerInfo(){
        $('#customer-info-table').DataTable({
       
          processing: true,
          serverSide: true,
  
          ajax:{
           url: "/reports/customer-info",
          }, 
  
          columns:[    
           {data: 'fullname', name: 'fullname'},   
           {data: 'phone_no', name: 'phone_no'},   
           {data: 'email', name: 'email'}, 
           {data: 'total_purchased', name: 'total_purchased'},  
           {data: 'created_at', name: 'created_at'},
          ]
          
         });
      }


  });