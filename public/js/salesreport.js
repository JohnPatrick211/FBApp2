
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      load_data();

      function load_data()  {
        let date_from = $('#salesreportdate_from').val()
        let date_to = $('#salesreportdate_to').val();
        let payment_method = $('#salespayment_method').val();
        fetchSalesReport(date_from,date_to,payment_method);
        fetchTotalSales(date_from, date_to,payment_method);

      }


      function fetchSalesReport(date_from,date_to,payment_method){
      var tbl_for_validation = $('#sales-report-table').DataTable({

          processing: true,
          serverSide: true,

          ajax:{
           url: "sales-report-data",
           data:{
            date_from:date_from,
            date_to:date_to,
            payment_method:payment_method
            },
          },

          success:function(data){

            console.log(data);
             },

             columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'INV-'+data;
            }
          },{
            targets: [6],
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return '₱'+data;
            }
         }, {
            targets: 1,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return data + ' ' +full.mname + ' ' + full.lname;
            }
         },
         { "visible": false,  "targets": [ 2 ] },
         { "visible": false,  "targets": [ 3 ] }],

  
            columns:[
              {data: 'invoice_no', name: 'invoice_no'},
              {data: 'fname', name: 'fname'},
              {data: 'mname', name: 'mname'},
              {data: 'lname', name: 'lname'},
              {data: 'product_name', name: 'product_name'},
              {data: 'payment_method', name: 'payment_method'},
              {data: 'amount', name: 'amount'},
              {data: 'created_at', name: 'created_at'},
            ],
             order: [[7, 'desc']],
          });

      }

      $('#salesreportdate_from').change(function()
      {
        let date_from = $('#salesreportdate_from').val()
        let date_to = $('#salesreportdate_to').val();
        let payment_method = $('#salespayment_method').val()
        $('#sales-report-table').DataTable().destroy();
        fetchSalesReport(date_from,date_to,payment_method);
        fetchTotalSales(date_from, date_to,payment_method);
       
      });

      $('#salesreportdate_to').change(function()
      {
        let date_from = $('#salesreportdate_from').val()
        let date_to = $('#salesreportdate_to').val();
        let payment_method = $('#salespayment_method').val()
        $('#sales-report-table').DataTable().destroy();
        fetchSalesReport(date_from,date_to,payment_method);
        fetchTotalSales(date_from, date_to,payment_method);
      });

      $('#salespayment_method').change(function()
      {
        let date_from = $('#salesreportdate_from').val()
        let date_to = $('#salesreportdate_to').val();
        let payment_method = $('#salespayment_method').val()
        $('#sales-report-table').DataTable().destroy();
        fetchSalesReport(date_from,date_to,payment_method);
        fetchTotalSales(date_from, date_to,payment_method);
       
      });
      
      $('#btn-salesreport-print').click(function () {
        let date_from = $('#salesreportdate_from').val()
        let date_to = $('#salesreportdate_to').val();
        let payment_method = $('#salespayment_method').val()
        window.open('sales-report/print/'+date_from+'/'+date_to+'/'+payment_method, '_blank');

      });

      function fetchTotalSales(date_from, date_to,payment_method) {
        $('#txt-total-sales').html('<i class="fas fa-spinner fa-spin"></i>');
        $.ajax({
            url: '/compute-total-sales',
            type: 'GET',
            data: {
                date_from        :date_from,
                date_to          :date_to,
                payment_method:payment_method,
            },
            success:function(total_sales){
                
                total_sales = parseFloat(total_sales)
                $('#txt-total-sales').html(formatNumber(total_sales));
            }
        });
    }

});




