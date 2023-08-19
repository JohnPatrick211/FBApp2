
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      var date_from = $('#date_from').val()
      var date_to = $('#date_to').val();

      fetchAudit(date_from, date_to);
     
      function fetchAudit(date_from, date_to){
        $('#audit-table').DataTable({
       
          processing: true,
          serverSide: true,
  
          ajax:{
            url: "/utilities/audit-trail",
            data:{
                date_from:date_from,
                date_to:date_to
            }
          }, 
  
          columns:[    
           {data: 'fullname', name: 'fullname'},   
           {data: 'role', name: 'role'},  
           {data: 'module', name: 'module'},    
           {data: 'action', name: 'action'},    
           {data: 'created_at', name: 'created_at'},
          ]
          
         });
      }

      $('#date_from').change(function()
      {
         var date_from = $('#date_from').val()
         var date_to = $('#date_to').val();
            console.log(date_from);
         $('#audit-table').DataTable().destroy();
         fetchAudit(date_from, date_to);
      });
   
      $('#date_to').change(function()
      {
         var date_from = $('#date_from').val()
         var date_to = $('#date_to').val();
   
         $('#audit-table').DataTable().destroy();
         fetchAudit(date_from, date_to);
      });



  });
    
    
    
    
    