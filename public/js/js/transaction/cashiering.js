
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  
  //search menu
  $(document).on('keyup', '#txt_search', function(){

    var search_key = $(this).val();
  
    $.ajax({
      url:"/transaction/cashiering/search/"+search_key,
      type:"GET",
      success:function(response){

       if(response.length > 0){
        console.log(response);
        $('#id').val(response[0].id);
        $('#description').val(response[0].description);
        $('#category').val(response[0].category);
        $('#price').val(response[0].price);
        computeAmount();
       }
       else{
        clearFields();
       }

      }
    });
  }); 

  function clearFields(){     
    $('#id').val('');
    $('#description').val('');
    $('#category').val('');
    $('#price').val('');
    $('#amount').val('');
  }
  
  //search menu
  $(document).on('keyup', '#qty', function(){
    computeAmount();
  }); 

  computeAmount();

  function computeAmount(){
    var qty = $('#qty').val();
    var price = $('#price').val();
    var amount = qty * price;
    $('#amount').val(parseFloat(amount));
  }


  $(document).on('click', '.btn-add', function(){

    var menu_id = $(this).attr('menu-id');
    var price= $(this).attr('price');
    var qty = $('#menu'+menu_id).val();
    var amount = price * qty; 

    console.log(menu_id);
    console.log(amount);
    console.log(qty);

    $.ajax({
      url:"/transaction/isQtyAvailable/"+menu_id+"/"+qty,
      type:"GET",
      success:function(response){
         if(response==1)
         {
           alert('Not enough qty!');
         }
         else{
          $.ajax({
            url:"/transaction/cashiering/add",
            type:"POST",
            data:{
                menu_id:menu_id,
                amount:amount,
                qty:qty
            },
            success:function(response){
                console.log(response);
                $('#tray_table').load('cashiering #tray_table');
                $('#txt_total_amount').load('cashiering #txt_total_amount');
            }
          });
         }
       
      }
    });
    
  }); 

  $(document).on('keyup', '#txt_tendered', function(){

    var tendered = $(this).val();
    $('#txt_change').text(computeChange(tendered));
  }); 

  function computeChange(tendered){
    var total_amount = $('#txt_total_amount').text();

    return tendered - total_amount;
  }


  $(document).on('click', '#btn-process', function(){

    var payment_method;

        if($('#radio-cash').is(':checked')){
          payment_method = 'Cash';
        }
        else if($('#radio-gcash').is(':checked')){
          payment_method = 'GCash';
        }


    $.ajax({
        url:"/transaction/cashiering/process",
        type:"POST",
        data:{
            payment_method:payment_method
        },
        beforeSend:function(){
            $('#btn-process').text('Please wait...')
        },
        success:function(response){
            
          setTimeout(function(){
            updateStatus();
            $('#tray_table').load('cashiering #tray_table');
            $('#txt_total_amount').load('cashiering #txt_total_amount');
            $('#menu-cont').load('cashiering #menu-cont');
            $('#txt_change').text('0');
            $('#txt_tendered').val(0);
            clearFields();
            $('#btn-process').text('Process');
          },1000)
        }
      });
  }); 

  $(document).on('click', '.btn-remove', function(){
    var id = $(this).attr('delete-id');
    console.log(id);
    $.ajax({
        url:"/transaction/cashiering/remove/"+id,
        type:"GET",
        success:function(){
            $('#tray_table').load('cashiering #tray_table');
            $('#txt_total_amount').load('cashiering #txt_total_amount');
            computeAmount();
         
        }
      });
  }); 

  updateStatus();

  function updateStatus()
  {
    
    $.ajax({
      url:"/updateMenuStatus",
      type:"POST",
      success:function(){}
    });
  }


  });
    
    
    
    
    