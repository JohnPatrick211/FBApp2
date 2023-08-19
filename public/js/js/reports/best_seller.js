
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      var date_from = $('#date_from').val()
      var date_to = $('#date_to').val();

      fetchBestSeller(date_from, date_to);
     
      function fetchBestSeller(date_from, date_to){
        $('#best-seller-table').DataTable({
       
          processing: true,
          serverSide: true,
  
          ajax:{
           url: "/reports/best-seller",
           data:{
               date_from:date_from,
               date_to:date_to
           }
          }, 
  
          columns:[    
           {data: 'description', name: 'description'},   
           {data: 'category', name: 'category'},     
           {data: 'qty', name: 'qty'},   
           {data: 'order_type', name: 'order_type'},
          ]
          
         });
      }


      $('#date_from').change(function()
      {
         var date_from = $('#date_from').val()
         var date_to = $('#date_to').val();
   
         $('#best-seller-table').DataTable().destroy();
         fetchBestSeller(date_from, date_to);
      });
   
      $('#date_to').change(function()
      {
         var date_from = $('#date_from').val()
         var date_to = $('#date_to').val();
   
         $('#best-seller-table').DataTable().destroy();
         fetchBestSeller(date_from, date_to);
      });


  });
    
    
    
    
    