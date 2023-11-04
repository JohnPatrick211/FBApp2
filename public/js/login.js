const inputs = document.querySelectorAll('.input');

function focusFunc(){
    let parent = this.parentNode.parentNode;
    parent.classList.add('focus');
}

function blurFunc(){
    let parent = this.parentNode.parentNode;
    if(this.value == "")
    {
        parent.classList.remove('focus');
    }
}

inputs.forEach(input => {
    input.addEventListener('focus',focusFunc);
    input.addEventListener('blur',blurFunc);
})

//document.getElementById("btn-signup").disabled = true;

var check = function() {
    if (document.getElementById('editpassword').value ==
      document.getElementById('editconfirm_password').value) {
      $('.editprofile-success').css('display', 'inline');
      $('.editprofile-fail').css('display', 'none');
    }if(document.getElementById('editpassword').value !=
    document.getElementById('editconfirm_password').value){
      $('.editprofile-fail').css('display', 'inline');
      $('.editprofile-success').css('display', 'none');
    }
  }

  var check2 = function() {
    if (document.getElementById('registerpassword').value ==
      document.getElementById('registerconfirm_password').value) {
      $('.registerprofile-success').css('display', 'inline');
      $('.registerprofile-fail').css('display', 'none');
      document.getElementById('btn-register-user').disabled = false;
    }if(document.getElementById('registerpassword').value !=
    document.getElementById('registerconfirm_password').value){
      $('.registerprofile-fail').css('display', 'inline');
      $('.registerprofile-success').css('display', 'none');
      document.getElementById('btn-register-user').disabled = true;
      }     
  }

  var check3 = function() {
    if (document.getElementById('password').value !=
      document.getElementById('confirm_password').value) {
      $('.signupprofile-success').css('display', 'none');
      $('.signupprofile-fail').css('display', 'inline');
      $('.signupprofile-char').css('display', 'none');
document.getElementById("btn-signup").disabled = true
    }
    
    //if(document.getElementById('password').value !=
   // document.getElementById('confirm_password').value){
    //  $('.signupprofile-fail').css('display', 'inline');
    //  $('.signupprofile-success').css('display', 'none');
   // }
    else if(document.getElementById('password').value.length < 8){
       $('.signupprofile-fail').css('display', 'none');
      $('.signupprofile-char').css('display', 'inline');
      $('.signupprofile-success').css('display', 'none');
document.getElementById("btn-signup").disabled = true
    }
    else{
 $('.signupprofile-success').css('display', 'inline');
 $('.signupprofile-fail').css('display', 'none');
document.getElementById("btn-signup").disabled = false;
    }
  }

  function showPassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }

  function showPassword2() {
    var u = document.getElementById("password2");
    if (u.type === "password") {
      u.type = "text";
    } else {
      u.type = "password";
    }
  }

  function showPassword3() {
    var u = document.getElementById("registerpassword");
    if (u.type === "password") {
      u.type = "text";
    } else {
      u.type = "password";
    }
  }

  $('#registerphone_no').blur(function() {
    var phone_no = $('#registerphone_no').val();
    isPhoneNumberExists(phone_no.replace(/\s/g, ''));
  });

  function isPhoneNumberExists(phone_no) {
    $.ajax({
        url:"/signup/isexists",
        type:"GET",
        data:{
            phone_no:phone_no
        },
        success:function(response){
         
         setTimeout(function() {
            if(isPhoneNoValid(phone_no) == true)
            {
                if(response == '1')
                {
                    $("#pn-validation").remove();
                    $('#registerphone_no')
                    .after('<span class="label-small text-danger" id="pn-validation">Phone number is already exists.</div>');
                    $('#registerphone_no').val('');
                    document.getElementById('btn-register-user').disabled = true;
                }
                else{
                    $("#pn-validation").remove();
                    document.getElementById('btn-register-user').disabled = false;
                }
              }
         },500);
          
        }         
       })
}

function isPhoneNoValid(phone_no) {
  if(phone_no){
      if(phone_no.replace(/ /g,'').length > 11 || phone_no.replace(/ /g,'').length <= 10){
          $("#pn-validation").remove();
          $('#registerphone_no')
          .after('<span class="label-small text-danger" id="pn-validation">Please enter a valid phone number.</div>');
          document.getElementById('btn-register-user').disabled = true;
          return false
      }
      else{
          $("#pn-validation").remove();
          document.getElementById('btn-register-user').disabled = false;
          return true;
      }
  }
}

    document.getElementById('registercity').disabled = true;
    document.getElementById('registerbarangay').disabled = true;
    console.log("connected");

    $('#registerbirthdate').change(function() {
      var userinput = document.getElementById("registerbirthdate").value;
      var dob = new Date(userinput);
       //calculate month difference from current date in time
      var month_diff = Date.now() - dob.getTime();
      
      //convert the calculated difference in date format
      var age_dt = new Date(month_diff); 
      
      //extract year from date    
      var year = age_dt.getUTCFullYear();
      
      //now calculate the age of the user
      var age = Math.abs(year - 1970);

      $('#registerage').val(age);   
      
      //display the calculated age
      // return document.getElementById("result").innerHTML =  
      //         "Age is: " + age + " years. ";

          
      });

      $('#registerprovince').change(function()
      {
        let province = $('#registerprovince').val()
        console.log(province);
        fetchCity2(province);
        document.getElementById('registercity').disabled = false;
      });

      $('#registercity').change(function()
      {
        let province = $('#registerprovince').val()
        let city = $('#registercity').val()
        console.log(city);
        fetchBrgy2(province, city);
        document.getElementById('registerbarangay').disabled = false;
      });

      function fetchCity2(province){
        console.log("OK");
        $.ajax({
          url:"/address/getcity/"+ province,
          type:"GET",

          success:function(data){
            console.log(data);
            var len = data.length;

            $("#registercity").empty();
            for( var i = 0; i<len; i++){
                var id = data[i]['citymunCode'];
                var name = data[i]['citymunDesc'];
                
                $("#registercity").append("<option value='"+id+"'>"+name+"</option>");

            }
          }

         });
      }

      function fetchBrgy2(province, city){
        console.log("OK");
        $.ajax({
          url:"/address/getbrgy/"+ province + "/" + city,
          type:"GET",

          success:function(data){
            console.log(data);
            var len = data.length;

            $("#registerbarangay").empty();
            for( var i = 0; i<len; i++){
                var id = data[i]['brgyCode'];
                var name = data[i]['brgyDesc'];
                
                $("#registerbarangay").append("<option value='"+id+"'>"+name+"</option>");

            }
          }

         });
      }



