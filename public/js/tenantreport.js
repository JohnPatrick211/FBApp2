
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      load_data();

      function load_data()  {
        let date_from = $('#tenantreportdate_from').val()
        let date_to = $('#tenantreportdate_to').val();
        let payment_method = $('#tenantpayment_method').val();
        fetchTenantReport(date_from,date_to,payment_method);

      }


      function fetchTenantReport(date_from,date_to,payment_method){
      var tbl_for_validation = $('#tenant-report-table').DataTable({

          processing: true,
          serverSide: true,

          ajax:{
           url: "tenant-report-data",
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
                return 'PDT-'+data;
            }
          }, {
            targets: 1,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
              if(full.mname === null){
                return data + ' ' + full.lname;
              }
              else{
                return data + ' ' +full.mname + ' ' + full.lname;
              }
            }
         },
         { "visible": false,  "targets": [ 2 ] },
         { "visible": false,  "targets": [ 3 ] }],

  
            columns:[
              {data: 'id', name: 'id'},
              {data: 'fname', name: 'fname'},
              {data: 'mname', name: 'mname'},
              {data: 'lname', name: 'lname'},
              {data: 'paid_status', name: 'paid_status'},
              {data: 'next_payment', name: 'next_payment'},
            ],
             order: [[0, 'desc']],
          });

      }

      $('#tenantreportdate_from').change(function()
      {
        let date_from = $('#tenantreportdate_from').val()
        let date_to = $('#tenantreportdate_to').val();
        let payment_method = $('#tenantpayment_method').val()
        $('#tenant-report-table').DataTable().destroy();
        fetchTenantReport(date_from,date_to,payment_method);
       
      });

      $('#tenantreportdate_to').change(function()
      {
        let date_from = $('#tenantreportdate_from').val()
        let date_to = $('#tenantreportdate_to').val();
        let payment_method = $('#tenantpayment_method').val()
        $('#tenant-report-table').DataTable().destroy();
        fetchTenantReport(date_from,date_to,payment_method);
      });

      $('#tenantpayment_method').change(function()
      {
        let date_from = $('#tenantreportdate_from').val()
        let date_to = $('#tenantreportdate_to').val();
        let payment_method = $('#tenantpayment_method').val()
        $('#tenant-report-table').DataTable().destroy();
        fetchTenantReport(date_from,date_to,payment_method);
      });
      
      $('#btn-tenantreport-print').click(function () {
        let date_from = $('#tenantreportdate_from').val()
        let date_to = $('#tenantreportdate_to').val();
        let payment_method = $('#tenantpayment_method').val()
        window.open('tenant-report/print/'+date_from+'/'+date_to+'/'+payment_method, '_blank');

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




