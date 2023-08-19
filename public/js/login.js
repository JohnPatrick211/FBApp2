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
    if (document.getElementById('password').value ==
      document.getElementById('confirm_password').value) {
      $('.signupprofile-success').css('display', 'inline');
      $('.signupprofile-fail').css('display', 'none');
    }if(document.getElementById('password').value !=
    document.getElementById('confirm_password').value){
      $('.signupprofile-fail').css('display', 'inline');
      $('.signupprofile-success').css('display', 'none');
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



