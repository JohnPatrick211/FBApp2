
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
        let salesreportbranch = $('#salesreportbranch').val()
        fetchSalesReport(date_from,date_to,salesreportbranch);
        console.log(salesreportbranch);
        fetchTotalSales(date_from, date_to,salesreportbranch);

      }


      function fetchSalesReport(date_from,date_to,salesreportbranch){
      var tbl_for_validation = $('#sales-report-table').DataTable({

          processing: true,
          serverSide: true,

          ajax:{
           url: "sales-report-data",
           data:{
            date_from:date_from,
            date_to:date_to,
            salesreportbranch:salesreportbranch,
            },
          },

          success:function(data){

            console.log(data);
             },

             columnDefs: [{
              targets: 1,
              searchable: false,
              orderable: true,
              changeLength: true,
              className: 'dt-body-center',
              render: function (data, type, full, meta){
                const firstDigitStr = String(data)[0];
                console.log(firstDigitStr);
                if(firstDigitStr == 1)
                {
                  return 'P-'+data;
                }
                else
                {
                  return 'S-'+data;
                }
              }
           },
           {
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'INV-'+data;
            }
          },{
            targets: 3,
            visible: false,
          },
           {
            targets: [4,6],
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return '₱'+data;
            }
         }],

  
            columns:[
              {data: 'invoice_no', name: 'invoice_no'},
              {data: 'product_id', name: 'product_id'},
              {data: 'productname', name: 'productname'},
              {data: 'branchname', name: 'branchname'},
              {data: 'selling_price', name: 'selling_price'},
              {data: 'qty', name: 'qty'},
              {data: 'amount', name: 'amount'},
              {data: 'created_at', name: 'created_at'},
  
              // { data: 'BIR_file', name: 'BIR_file',
              //         render: function( data, type, full, meta ) {
              //             return "<img src=\"/storage/BIR/" + data + "\" height=\"50\"id=\"trigger\"/>";
              //           // return '<div align="center"><a href="/storage/jobposts/" """><img src="{{ asset("siteicons/Info_Box_Blue.png") }}" id="trigger" onclick="ShowSlider(0)"></a></div>';
              //         }
              //     },
            ],
             order: [[7, 'desc']],
          });

      }

      $('#salesreportdate_from').change(function()
      {
        let date_from = $('#salesreportdate_from').val()
        let date_to = $('#salesreportdate_to').val();
        let salesreportbranch = $('#salesreportbranch').val()
        $('#sales-report-table').DataTable().destroy();
        fetchSalesReport(date_from,date_to,salesreportbranch);
        fetchTotalSales(date_from, date_to,salesreportbranch);
       
      });

      $('#salesreportdate_to').change(function()
      {
        let date_from = $('#salesreportdate_from').val()
        let date_to = $('#salesreportdate_to').val();
        let salesreportbranch = $('#salesreportbranch').val()
        $('#sales-report-table').DataTable().destroy();
        fetchSalesReport(date_from,date_to,salesreportbranch);
        fetchTotalSales(date_from, date_to,salesreportbranch);
      });

      $('#salesreportbranch').change(function()
      {
        let date_from = $('#salesreportdate_from').val()
        let date_to = $('#salesreportdate_to').val();
        let salesreportbranch = $('#salesreportbranch').val()
        $('#sales-report-table').DataTable().destroy();
        fetchSalesReport(date_from,date_to,salesreportbranch);
        fetchTotalSales(date_from, date_to,salesreportbranch);
       
      });
      
      $('#btn-salesreport-print').click(function () {
        let date_from = $('#salesreportdate_from').val()
        let date_to = $('#salesreportdate_to').val();
        let salesreportbranch = $('#salesreportbranch').val()
        window.open('sales-report/print/'+date_from+'/'+date_to+'/'+salesreportbranch, '_blank');

      });

      function fetchTotalSales(date_from, date_to,salesreportbranch) {
        $('#txt-total-sales').html('<i class="fas fa-spinner fa-spin"></i>');
        $.ajax({
            url: '/compute-total-sales',
            type: 'GET',
            data: {
                date_from        :date_from,
                date_to          :date_to,
                salesreportbranch:salesreportbranch,
            },
            success:function(total_sales){
                
                total_sales = parseFloat(total_sales)
                $('#txt-total-sales').html(formatNumber(total_sales));
            }
        });
    }

});




