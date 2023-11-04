$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    
    $('#btn-signup').click(function(){
        console.log("asd");
        var firstname = $('#firstname').val();
        var middlename = $('#middlename').val();
        var lastname = $('#lastname').val();
        var phone_no = $('#phone_no').val();
        var password = $('#password').val();
        var email = $('#email').val();
        var roomnumber = $('#roomnumber').val();
        var dateofoccupancy = $('#dateofoccupancy').val();
        var contractstart = $('#contractstart').text();
        var contractend = $('#contractend').text();
        var address = $('#address').text();
        var username = $('#username').val();
        var age = $('#age').val();
        var birthdate = $('#birthdate').val();
        var gender = $('#gender').val();
        var civilstatus = $('#civilstatus').val();
        var form = new FormData();
        form.append('firstname',firstname);
        form.append('middlename',middlename);
        form.append('lastname',lastname);
        form.append('phone_no',phone_no);
        form.append('password',password);
        form.append('email',email);
        form.append('roomnumber',roomnumber);
        form.append('dateofoccupancy',dateofoccupancy);
        form.append('contractstart',contractstart);
        form.append('contractend',contractend);
        form.append('address',address);
        form.append('username',username);
        form.append('age',age);
        form.append('birthdate',birthdate);
        form.append('gender',gender);
        form.append('civilstatus',civilstatus);


        var is_valid = validateInputs(firstname, lastname, phone_no, password,email,roomnumber, dateofoccupancy, contractstart, contractend,username,age,gender,birthdate, address);
        
        if(is_valid){
            console.log("OK1")
            signUp(form);
        }
      
    });

    function validateInputs(firstname, lastname, phone_no, password,email,roomnumber, dateofoccupancy, contractstart, contractend,username,age,gender,birthdate, address) {

        if(birthdate == '' || gender == '' || age == '' || firstname == '' || lastname == '' || phone_no == '' || password == '' || email == '' || roomnumber == '' || address == ''||dateofoccupancy == '' || contractstart == '' || contractend == '' || username == ''){
            alert('Please input all of the required credentials!');
        }
        else{
            return true;     
        }
         
    }

    function validatePassword(password, confirm_password) {
        if(password.replace(/ /g,'').length >= 8){
            if(password == confirm_password){
                return true;
            }
            else{
                alert('Password do not match!');
            }
        }
        else{
            alert('Minimum of 8 characters!')
        }
    }

    $('#birthdate').change(function() {
        var userinput = document.getElementById("birthdate").value;
        var dob = new Date(userinput);
         //calculate month difference from current date in time
        var month_diff = Date.now() - dob.getTime();
        
        //convert the calculated difference in date format
        var age_dt = new Date(month_diff); 
        
        //extract year from date    
        var year = age_dt.getUTCFullYear();
        
        //now calculate the age of the user
        var age = Math.abs(year - 1970);

        $('#age').val(age);   
        
        //display the calculated age
        // return document.getElementById("result").innerHTML =  
        //         "Age is: " + age + " years. ";

            
        });

    $('#send-OTP').click(function() {
        var email = $('#email').val();
        sendOTP(email);
      // setTimer();
    });

    function sendOTP(email){
        if(email){
            $.ajax({
                url:"/signup/send-OTP",
                type:"GET",
                data:{
                email:email
                },
                success:function(){
                    setTimer();
                }         
               });
       }

    }

    function setTimer(){
        $('#send-OTP').css('display', 'none');
        var timer2 = "0:30";
        var interval = setInterval(function() {
        
          var timer = timer2.split(':');
          //by parsing integer, I avoid all extra string processing
          var minutes = parseInt(timer[0], 10);
          var seconds = parseInt(timer[1], 10);
          --seconds;
          minutes = (seconds < 0) ? --minutes : minutes;
          if (minutes < 0) clearInterval(interval);
          seconds = (seconds < 0) ? 59 : seconds;
          seconds = (seconds < 10) ? '0' + seconds : seconds;
          //minutes = (minutes < 10) ?  minutes : minutes;
          $('.countdown').text('Resend OTP in ' + minutes + ':' + seconds);
          timer2 = minutes + ':' + seconds;

          if(seconds == 0){
              minutes = 0;
              seconds = 0;
            $('.countdown').css('display', 'none');
            $('#send-OTP').css('display', 'inline');
            $('#send-OTP').text('Resend OTP');
          }
        }, 1000);
    }


    $('#otp').blur(function() {
         var otp = $(this).val();
         console.log(otp);
         validateOTP(otp);
    });

    function validateOTP(otp){
        if(otp){
            $.ajax({
                url:"/signup/validate-otp/"+otp,
                type:"GET",
                success:function(response){
                    if(response == '1'){
                        $("#pn-validation").remove();
                        $('#otp')
                        .after('<span class="label-small text-success" id="pn-validation">OTP is valid.</div>');
                    }
                    else{
                        $("#pn-validation").remove();
                        $('#otp')
                        .after('<span class="label-small text-danger" id="pn-validation">OTP is invalid.</div>');
                    }
                }         
               });
        }
    }

    function signUp(form) {
        var otp = $('#otp').val();
        console.log("OK2")
        if(otp){
            $.ajax({
                url:"/signup/validate-otp/"+otp,
                type:"GET",
                success:function(response){
                    console.log(response)
                    if(response == '1'){
                        $.ajax({
                            url:"/signup/signup",
                            type:"POST",
                            data:form,
                            cache: false,
                            contentType: false,
                            processData: false,
                            beforeSend:function(){
                                $('#loading-modal').modal('toggle');
                            },
                            success:function(){
                                $('#alert-acc-success').css('display', 'block');
                                $('#alert-acc-success').addClass('alert-success');
                                $('#alert-acc-success')
                                .html('You have successfully created your account!');
                                window.location.href = "https://fbapp.online/";
                            }         
                           });   
                    }
                    else{
                        $("#pn-validation").remove();
                        $('#otp')
                        .after('<span class="label-small text-danger" id="pn-validation">OTP is invalid.</div>');
                    }
                }         
               });
        }
           
       
    }

});