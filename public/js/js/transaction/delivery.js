$(document).ready(function()
{

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
     });

        fetchPendingOrders();

        function fetchPendingOrders(){
        $('#pending-table').DataTable({
        
            processing: true,
            serverSide: true,

            ajax:{
            url: "/delivery/pending",
            type: "GET",
            }, 

            columns:[       
            {data: 'order_no', name: 'order_no'},
            {data: 'fullname', name: 'fullname'},
            {data: 'phone_no', name: 'phone_no'},
            {data: 'email', name: 'email'},   
            {data: 'payment_method', name: 'payment_method'},     
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action',orderable: false},
            ]
            
        });
        }

        fetchPreparingOrders();

        function fetchPreparingOrders(){
        $('#preparing-table').DataTable({
        
            processing: true,
            serverSide: true,

            ajax:{
            url: "/delivery/preparing",
            type: "GET",
            }, 

            columns:[       
            {data: 'order_no', name: 'order_no'},
            {data: 'fullname', name: 'fullname'},
            {data: 'phone_no', name: 'phone_no'},
            {data: 'email', name: 'email'},    
            {data: 'payment_method', name: 'payment_method'},     
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action',orderable: false},
            ]
            
        });
        }

        fetchCancelledOrders();

        function fetchCancelledOrders(){
        $('#cancelled-table').DataTable({
        
            processing: true,
            serverSide: true,

            ajax:{
            url: "/delivery/cancelled",
            type: "GET",
            }, 

            columns:[       
            {data: 'order_no', name: 'order_no'},
            {data: 'fullname', name: 'fullname'},
            {data: 'phone_no', name: 'phone_no'},
            {data: 'email', name: 'email'},        
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action',orderable: false},
            ]
            
        });
        }

        fetchDispatchOrders();

        function fetchDispatchOrders(){
        $('#dispatch-table').DataTable({
        
            processing: true,
            serverSide: true,

            ajax:{
            url: "/delivery/dispatch",
            type: "GET",
            }, 

            columns:[       
            {data: 'order_no', name: 'order_no'},
            {data: 'fullname', name: 'fullname'},
            {data: 'phone_no', name: 'phone_no'},
            {data: 'email', name: 'email'},  
            {data: 'payment_method', name: 'payment_method'},       
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action',orderable: false},
            ]
            
        });
        }

        var date_from = $('#date_from').val()
        var date_to = $('#date_to').val();
  
        fetchDeliveredOrders(date_from, date_to);

        function fetchDeliveredOrders(date_from, date_to){
        $('#delivered-table').DataTable({
        
            processing: true,
            serverSide: true,

            ajax:{
            url: "/delivery/delivered",
            type: "GET",
            data:{
              date_from:date_from,
              date_to:date_to
            },
            }, 

            columns:[       
            {data: 'order_no', name: 'order_no'},
            {data: 'fullname', name: 'fullname'},
            {data: 'phone_no', name: 'phone_no'},
            {data: 'email', name: 'email'},  
            {data: 'payment_method', name: 'payment_method'},       
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action',orderable: false},
            ]
            
        });
        }

        $('#date_from').change(function()
        {
          var date_from = $('#date_from').val()
          var date_to = $('#date_to').val();
    
          $('#delivered-table').DataTable().destroy();
          fetchDeliveredOrders(date_from, date_to);
        });
   
        $('#date_to').change(function()
        {
          var date_from = $('#date_from').val()
          var date_to = $('#date_to').val();
    
          $('#delivered-table').DataTable().destroy();
          fetchDeliveredOrders(date_from, date_to);
        });


        $(document).on('click', '.btn-cancel-order', function()
        {
            let order_no = $(this).attr('order-no');
            let user_id = $(this).attr('user-id');
            $('input[name="order-no"]').val(order_no);
            $('input[name="user-id"]').val(user_id);
        }); 

        $(document).on('click', '.btn-show-order', function()
        {
            var order_no = $(this).attr('order-no');
            var user_id = $(this).attr('user-id');
            $('#order-number').text(order_no);
            $('input[name="order-no"]').val(order_no);
            $('input[name="user-id"]').val(user_id);

            $.ajax({
              url:"/delivery/show-order/"+order_no,
              type:"GET",
              success:function(response){
        
               if(response.length > 0){
                console.log(response);
                tableHTML(response);
                
                getSubTotalAmount(order_no);
                getShippingFee(user_id);
                getTotalAmount(order_no, user_id);
                getCustomerInfo(user_id);
                getShippingInfo(user_id);
               }
        
              }
            });
          }); 

        function tableHTML(data){
            $('#order-table').html('');
            var html = '<thead>';
            html +='<tr>';
            html +=    '<th>Description</th>';
            html +=    '<th>Category</th>';
            html +=    '<th>Preparation Time</th> ';
            html +=    '<th>Price</th>';
            html +=    '<th>Qty</th>';
            html +=    '<th>Amount</th> '    ;   
            html +='</tr>';
            html +='</thead>';
            
            html +='<tbody>';

            if(data.length > 0)
            {
              for (var i = 0; i < data.length; i++) 
              {
                html +=    '<tr>';
                html +=        '<td>'+data[i].description+'</td>';
                html +=        '<td>'+data[i].category+'</td>';
                html +=        '<td>'+data[i].preparation_time+'</td>';
                html +=        '<td>₱'+data[i].price+'</td>';
                html +=        '<td>'+data[i].qty+'</td>';
                html +=        '<td>₱'+data[i].amount+'</td>'; 
                html +=    '</tr> ' ;
               
                
              }     
            }
            html +=    '<tr>';
            html +=        '<td></td>';
            html +=        '<td></td>';
            html +=        '<td></td>';
            html +=        '<td></td>';
            html +=        '<td style="text-align:right;">Subtotal:</td>';
            html +=        '<td>';
            html +=         '<b>₱ <span id="txt_subtotal"></span></b>';
            html +=        '</td> '  ;
            html +=     '</tr>' ;

            html +=     '<tr>';
            html +=      '<td></td>';
            html +=      '<td></td>';
            html +=      '<td></td>';
            html +=      '<td></td>';
            html +=      '<td style="text-align:right;">Shipping Fee:</td>';
            html +=      '<td>'
            html +=        '₱ <span id="txt_shipping_fee"></span>';
            html +=      '</td>'   ;
            html +=   '</tr> ';
            html +=    '<tr>';
            html +=    '<td></td>';
            html +=    '<td></td>';
            html +=   ' <td></td>';
            html +=        '<td></td>';
            html +=    '<td style="text-align:right;">Total Amount:</td>';
            html +=     '<td>';
            html +=       '<b>₱ <span id="txt_total"></span></b>';
            html +=    '</td>'   ;
            html +=  '</tr> ';
            html +='</tbody>';
            
            $('#order-table').append(html); 
        }

        function getShippingFee(user_id)
        {
            $.ajax({
                url:"/delivery/shipping-fee/"+user_id,
                type:"GET",
                success:function(response){$('#txt_shipping_fee').text(parseFloat(response).toFixed(2));}
              });
        }

        function getTotalAmount(order_no, user_id)
        {
            $.ajax({
                url:"/delivery/total-amount/"+order_no+'/'+user_id,
                type:"GET",
                success:function(response){$('#txt_total').text(parseFloat(response).toFixed(2));}
              });
        }

        function getSubTotalAmount(order_no)
        {
            $.ajax({
                url:"/delivery/subtotal-amount/"+order_no,
                type:"GET",
                success:function(response){$('#txt_subtotal').text(parseFloat(response).toFixed(2));}
              });
        }

        function getCustomerInfo(user_id)
        {
            $.ajax({
                url:"/delivery/customer-info/"+user_id,
                type:"GET",
                success:function(data)
                {
                    console.log(data);
                    $('#fullname').text(data[0].fullname);
                    $('#email').text(data[0].email);
                    $('#phone-no').text(data[0].phone_no);
                }
              });
        }

        function getShippingInfo(user_id)
        {
            $.ajax({
                url:"/delivery/shipping-info/"+user_id,
                type:"GET",
                success:function(data)
                {
                    data[0].municipality ? $('#municipality').text(data[0].municipality) : $('#municipality').text("-");
                    data[0].brgy ? $('#brgy').text(data[0].brgy) : $('#brgy').text("-");
                    data[0].flr_bldg_blk ? $('#flr-bldg-blk').text(data[0].flr_bldg_blk) : $('#flr-bldg-blk').text("-");
                    data[0].nearest_landmark ? $('#note').text(data[0].nearest_landmark) : $('#note').text("-");
                }
              });
        }
        
});