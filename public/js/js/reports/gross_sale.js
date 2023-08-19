
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      var date_from = $('#date_from').val()
      var date_to = $('#date_to').val();

      fetchGrossSale(date_from, date_to);
     
      function fetchGrossSale(date_from, date_to){
        $('#gross-sale-table').DataTable({
       
          processing: true,
          serverSide: true,
  
          ajax:{
           url: "/reports/gross_sale",
           data:{
               date_from:date_from,
               date_to:date_to
           }
          }, 
  
          columns:[    
           {data: 'transaction_no', name: 'transaction_no'},  
           {data: 'description', name: 'description'},   
           {data: 'category', name: 'category'},   
           {data: 'qty', name: 'qty'},   
           {data: 'amount', name: 'amount'},  
           {data: 'payment_method', name: 'payment_method'},   
           {data: 'order_type', name: 'order_type'},
           {data: 'created_at', name: 'created_at'},
          ]
          
         });
      }


      $('#date_from').change(function()
      {
         var date_from = $('#date_from').val()
         var date_to = $('#date_to').val();
   
         $('#gross-sale-table').DataTable().destroy();
         fetchGrossSale(date_from, date_to);
      });
   
      $('#date_to').change(function()
      {
         var date_from = $('#date_from').val()
         var date_to = $('#date_to').val();
   
         $('#gross-sale-table').DataTable().destroy();
         fetchGrossSale(date_from, date_to);
      });

      $('#btn-compute-sales').click(function(){
        var date_from = $('#date_from').val()
        var date_to = $('#date_to').val();

        computeTotalSales(date_from, date_to);
      });

      function computeTotalSales(date_from, date_to){
            $.ajax({
                url: '/reports/gross_sale/computeTotalSales/'+ date_from +'/'+ date_to,
                type: 'GET',
                success:function(data){
                    $('#total-sales').text(data)
                }
            });
          
      }

        //print pdf
    $('#btn-print-sales').click(function(){  
        var date_from = $('#date_from').val()
        var date_to = $('#date_to').val();
        window.open('/reports/gross_sale/previewPDF/'+date_from+'/'+date_to, '_blank'); 
     
      });


  });
    
    
    
    
    