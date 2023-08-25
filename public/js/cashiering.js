$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
}); 

var data_storage;
var last_key = 0;

async function readTray() {
    
    $('.tbl-tray tbody').html('');
    $('#tray-loader').css('display', 'block');
    $.ajax({
        url: '/read-tray',
        type: 'GET',
        success:async function(data){
            console.log('reading');
            console.log(data);
            $('#tray-loader').hide();
            var html = "";
            var total = 0;
            if (data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                     html += await getTrayItems(data[i]);
                     total = parseFloat(total) + parseFloat(data[i].amount); 
                } 
                document.getElementById("proccess").disabled = false;
            }
            else {
                document.getElementById("proccess").disabled = true;
            }

            let discount_percentage = 0;
            let minimum_purchase = $('#minimum-purchase').val();
            let wholesale_discount_amount = 0;
            let senior_pwd_discount_amount = 0;
            let subtotal = total;
            
            if ($('input[name="rad_discount"]').is(":checked")) {
                discount_percentage = $('input[name="rad_discount"]:checked').val();
                senior_pwd_discount_amount = parseFloat(discount_percentage) * parseFloat(total);
                total = total - parseFloat(senior_pwd_discount_amount);
            }
            if (total >= minimum_purchase || $('input[name="rad_discount"]:checked').attr('data-force') == '1') { 
                wholesale_discount_amount = parseFloat($('#discount-percentage').val()) * parseFloat(total);
                total = total - parseFloat(wholesale_discount_amount);
            }

            // to get data for printing
            localStorage.setItem('wholesale_discount_amount', wholesale_discount_amount);
            localStorage.setItem('senior_pwd_discount_amount', senior_pwd_discount_amount);

            html += '<tr>';
            html += '<td></td>';
            html += '<td><b>Total</b></td>';
            html += '<td><b id="total">₱'+ formatNumber(total) +'</b></td>'
            html += '</tr>';
            $('.tbl-tray tbody').append(html);

            if (data.length > 4) { 
                $(".tray-container").scrollTop($(".tray-container")[0].scrollHeight);
            }
        }
    });
}

async function getTrayItems (data) {
    console.log(data);
    var html = "";
    html += '<tr>';
    html += '<td>'+ data.product_name +'</td>';
    html += '<td>₱'+ formatNumber(data.amount) +'</td>';
    html += '<td><a style="color:#1970F1;" class="btn btn-sm btn-void" data-id='+ data.id +'> Void</a></td>'
    console.log(data);
    return html;
}


function searchUser()
        {
            var id = $('#input-search-userid').val();
            if(id == ''){
                Swal.fire(
                    'Error',
                    'Please Enter the Tenant ID',
                    'error'
                  )
            }
            else{
                $.ajax({
                    url:"getTenantInfo/"+id,
                    type:"GET",
    
                    success:function(data){
                        console.log(data)
                        if(Object.keys(data).length == 0){
                            $('#input-search-userid').val(""); 
                            Swal.fire(
                                'Error',
                                'Not Found Tenant ID in the Database',
                                'error'
                              )
                        }
                        else{
                            var fullname = data[0].fname + ' ' + data[0].mname + ' ' + data[0].lname;
                            console.log(fullname);
                            $('#input-tenantname').val(fullname);
                            $('#input-roomnumber').val(data[0].roomnumber);
                        }
                    }
                   });
            }
        }

function formatNumber(total)
{
  var decimal = (Math.round(total * 100) / 100).toFixed(2);
  return money_format = parseFloat(decimal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function on_Click () {
    
    $(document).on('click', '#btn-add-to-tray',  function(){
        var product_name = $('#input-description').val();
        var id           = $('#input-search-userid').val();
        var amount       = $('#input-amount').val();
        console.log(product_name)
        console.log(id)
        console.log(amount)
        if(product_name == '' || id == '' || amount == ''){
            swal.fire({
                title: "Error!",
                icon: 'error',
                text: "Please Input the Details",
                timer: 3000,
                showConfirmButton: true
              });
        }
        else{
            $.ajax({
                url: '/add-to-tray',
                type: 'POST',
                data: {
                    product_name : product_name,
                    id : id,
                    amount : amount
                },
                
                success: function($data){
                    console.log($data);
                    if($data == false){
                        swal.fire({
                            title: "Error!",
                            icon: 'error',
                            text: "Tray Already Exist",
                            type: "error",
                            timer: 3000,
                            showConfirmButton: true
                          });
                        readTray();
                    }
                    else{
                        Swal.fire(
                            'Success',
                            'Tray Added Successfully',
                            'success'
                          )
                        readTray();   
                    }
                }
            });
        }
    });

    $(document).on('click', '.btn-search-userid', function(){
        searchUser ();
    });

    $(document).on('click', '#proccess', function(){

        var total = $('#total').text().slice(1).replace(",", ""); 
        var tendered = $('#tendered').val();
        var invoice_no = $('#invoice-no').val();
        var id = $('#input-search-userid').val();

        total = parseFloat(total);
        tendered = parseFloat(tendered);
        let accountid = $('#input-tenantname').val()

        if (tendered){
            if (total > tendered) {
                $(this).html("Process");
                alert('Tendered amount is less than total amount.');
            }
            else {
                if (invoice_no) {
                    if(accountid == ''){
                        alert('Please enter the Tenant ID');
                    }
                    else{
                        $(this).html("Please wait...");
                        var payment_method = "Cash";
                        if ($('#gcash-payment').is(":checked")) {
                            payment_method = "GCash"
                        }
                        $.ajax({
                            url: '/record-sale',
                            type: 'POST',
                            data: {
                                payment_method : payment_method,
                                invoice_no     : invoice_no,
                                id             : id,
                            },
                            success:async function(res){
    
                                if (res == 'success') {
                                    let invoice = $('#invoice-no').val()
                                    let tenantname = $('#input-tenantname').val()
                                    $('#change').val('');
                                    $('#tendered').val('');
                                    $('#invoice-no').val('');
                                    $('#proccess').html("Process");
                                    swal.fire({
                                        title: "Transaction was successfully recorded",
                                        icon: 'success',
                                        text: "Generating Invoice...",
                                        timer: 4000,
                                      });
                                    setTimeout(async function()
                                    {
                                        window.open("/preview-invoice/"+tenantname+"/"+invoice);
                                        setTimeout(async function()
                                        {
                                            await readTray();
                                        },300);
                                    },3000);
    
                                }
                                else if (res == 'invoice_exists') {
                                    $('#proccess').html("Process")
                                    alert('Invoice # is already exists.')
                                }
                                else {
                                    swal.fire({
                                        title: "Something went wrong",
                                        icon: 'error',
                                        text: "Please contact the development team",
                                        timer: 4000,
                                      });
                                }
                            }
                        });
                    }        
                }
                else {
                    alert('Please enter the Invoice #');
                }
            }
        }
        else {
            alert('Please enter the tendered amount.');
        }
    });

    $(document).on('click', '#gcash-payment', function(){ console.log($(this).is(":checked"))
        if ($(this).is(":checked")) {
            $('.img-gcash-qr').css('display', 'block');
        }
        else {
            $('.img-gcash-qr').css('display', 'none');
        }
    });

    $(document).on('click', '.btn-void', function(){
        $('#void-modal').modal('show');
        var id = $(this).attr('data-id');  console.log(id)
        $('#btn-confirm-void').attr('data-id', id);
        
    });

    $(document).on('click', '#btn-confirm-void', function(){
        var id = $(this).attr('data-id');
        var username = $('#username').val();
        var password = $('#password').val();


        if (username && password) {
            $(this).html('Please wait...');
            $.ajax({
                url: '/void/'+id,
                type: 'POST',
                data: {
                    username : username,
                    password : password
                },
                success:async function(res){
                    $('#void-modal').modal('hide');
                    $('#btn-confirm-void').html('Void');
                    if (res == 'success') {
                        setTimeout(async function(){
                            swal.fire({
                                title: "Success",
                                icon: 'success',
                                text: "Item was successfully void.",
                                timer: 4000,
                              });
                            await readTray();
                        },300);
                    }
                    else {
                        alert('Invalid username or password');
                    }
                }
            });
        }
        else {
            alert('Please input the credential.')
        }
    });
}


function on_Keyup() {
    $(document).on('keydown', '#input-search-product', function(e){ 
        if (e.keyCode == 13) {
            e.preventDefault();
            searchProduct ();
            return false;
        }
    });
    
    $(document).on('keyup', '#tendered', function(){ 
        var tendered = $(this).val();
        var total = $('#total').text().slice(1).replace(",", ""); 
        var change = parseFloat(tendered) - parseFloat(total);
        $('#change').val(change.toFixed(2));
    });
}

async function render() {
    $('.img-gcash-qr').css('display', 'none');  
    await readTray();
    on_Click();
    on_Keyup();
}

render();
