$(document).ready(function()
{

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

    fetchTenant();
    fetchEmployee();
    fetchAdmin();
    

    document.getElementById('age').readOnly = true;
    document.getElementById('eage').disabled = true;

  $(document).on('click', '#btn-user-book', function()
        {
          var img_source = '../../img/undraw_profile.svg';
          $('#addshowprofile').attr('src', img_source);
      
          $("#profilepic").on("change", function (e) {
            var file =URL.createObjectURL($(this)[0].files[0]);
            $('#addshowprofile').attr('src', file);
            console.log(file);
        });
        $("#profilepic").val('');
        });

    // var check4 = function() {
    //   if (document.getElementById('password').value.trim().length <=
    //    7) {
    //     $('.reject-password').css('display', 'inline');
    //     document.getElementById('btn-register-user').disabled = false;
    //   }if(document.getElementById('registerpassword').value !=
    //   document.getElementById('registerconfirm_password').value){
    //     $('.registerprofile-fail').css('display', 'inline');
    //     $('.registerprofile-success').css('display', 'none');
    //     document.getElementById('btn-register-user').disabled = true;
    //     }     
    // }

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

      $('#ebirthdate').change(function() {
        var userinput = document.getElementById("ebirthdate").value;
        var dob = new Date(userinput);
         //calculate month difference from current date in time
        var month_diff = Date.now() - dob.getTime();
        
        //convert the calculated difference in date format
        var age_dt = new Date(month_diff); 
        
        //extract year from date    
        var year = age_dt.getUTCFullYear();
        
        //now calculate the age of the user
        var age = Math.abs(year - 1970);
  
        $('#eage').val(age);   
        
        //display the calculated age
        // return document.getElementById("result").innerHTML =  
        //         "Age is: " + age + " years. ";
  
            
        });

    // function LoadRoom()
    // {
    //   let user_type = $('#user_type').val()
    //      if(user_type == 'Doctor')
    //      {
    //       var test = $('#room').val('');
    //       $('.hide-room').css('display', 'inline');
    //       console.log(test);
    //      }
    //      else
    //      {
    //       var test = $('#room').val('none');
    //       $('.hide-room').css('display', 'none');
    //       console.log(test);
    //      }
    // }

    // function LoadRoom2()
    // {
    //   let user_type = $('#euser_type').val()
    //      if(user_type == 'Tenant')
    //      {
    //       var test = $('#eroom').val('');
    //       $('.ehide-room').css('display', 'inline');
    //       console.log(test);
    //      }
    //      else
    //      {
    //       var test = $('#eroom').val('none');
    //       $('.ehide-room').css('display', 'none');
    //       console.log(test);
    //      }
    // }

    function fetchAdmin(){
        $('#admin-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"user-maintenance/admin",

           columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'ADM-'+data;
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
            {data: 'id', name: 'id'},
            {data: 'fname', name: 'fname'},
            {data: 'mname', name: 'mname'},
            {data: 'lname', name: 'lname'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'action', name: 'action', orderable:false}
           ]

          });

       }

       function fetchEmployee(){
        $('#employee-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"user-maintenance/employee",

           columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'EMP-'+data;
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
            {data: 'id', name: 'id'},
            {data: 'fname', name: 'fname'},
            {data: 'mname', name: 'mname'},
            {data: 'lname', name: 'lname'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'action', name: 'action', orderable:false}
           ]

          });

       }

       function fetchTenant(){
        $('#tenant-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"user-maintenance/tenant",

           columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'TEN-'+data;
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
            {data: 'tenantid', name: 'tenantid'},
            {data: 'fname', name: 'fname'},
            {data: 'mname', name: 'mname'},
            {data: 'lname', name: 'lname'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'action', name: 'action', orderable:false}
           ]

          });

       }

       $('#user_type').change(function()
       {
         let user_type = $('#user_type').val()
         if(user_type == 'Tenant')
         {
          var test = $('#room').val('');
          var test2 = $('#dateofoccupancy').val('');
          $('.hide-room').css('display', 'inline');
          $('.hide-dateofoccupancy').css('display', 'inline');
          $('.hide-contractstart').css('display', 'inline');
          $('.hide-contractend').css('display', 'inline');
          document.getElementById("dateofoccupancy").required = true;
          document.getElementById("contractstart").required = true;
          document.getElementById("contractend").required = true;
          console.log(test);
          console.log(test2);
          
         }
         else
         {
          var test = $('#room').val('none');
          var test2 = $('#dateofoccupancy').val('');
          $('.hide-room').css('display', 'none');
          $('.hide-dateofoccupancy').css('display', 'none');
          $('.hide-contractstart').css('display', 'none');
          $('.hide-contractend').css('display', 'none');
          document.getElementById("dateofoccupancy").required = false;
          document.getElementById("contractstart").required = false;
          document.getElementById("contractend").required = false;
          console.log(test);
          console.log(test2);
         }
       });

      //  $('#euser_type').change(function()
      //  {
      //    let user_type = $('#euser_type').val()
      //    if(user_type == 'Doctor')
      //    {
      //     var test = $('#eroom').val('');
      //     $('.ehide-room').css('display', 'inline');
      //     console.log(test);
      //    }
      //    else
      //    {
          // var test = $('#eroom').val('none');
          // $('.ehide-room').css('display', 'none');
          // console.log(test);
      //    }
      //  });

       
        // show user details
        $(document).on('click', '#btn-edit-user', function()
        {
            let id = $(this).attr('employer-id');
            let user_type = $(this).attr('user-type');
            console.log(id);
            console.log(user_type);
            if(user_type == 'Tenant')
            {
                $('#edit_user_type').val('Tenant'); 
                console.log(user_type);
                var test = $('#eroom').val('');
                var test2 = $('#edateofoccupancy').val('');
                $('.ehide-dateofoccupancy').css('display', 'inline');
                $('.ehide-room').css('display', 'inline');
                $('.ehide-contractstart').css('display', 'inline');
                $('.ehide-contractend').css('display', 'inline');
                console.log(test);
                console.log(test2);
                getUserDetails(id,user_type);
            }
            else if(user_type == 'Employee'){
                $('#edit_user_type').val('Employee');
                console.log(user_type);
                var test = $('#eroom').val('none');
                var test2 = $('#edateofoccupancy').val('');
                $('.ehide-dateofoccupancy').css('display', 'none');
                $('.ehide-room').css('display', 'none');
                $('.ehide-contractstart').css('display', 'none');
                $('.ehide-contractend').css('display', 'none');
               console.log(test);
               console.log(test2);
               getUserDetails(id,user_type);
            }
            else if(user_type == 'System Admin'){
              $('#edit_user_type').val('System Admin');
              console.log(user_type);
              var test = $('#eroom').val('none');
              var test2 = $('#edateofoccupancy').val('');
              $('.ehide-dateofoccupancy').css('display', 'none');
             $('.ehide-room').css('display', 'none');
             $('.ehide-contractstart').css('display', 'none');
             $('.ehide-contractend').css('display', 'none');
             console.log(test);
             console.log(test2);
             getUserDetails(id,user_type);
          }
        });

        function getUserDetails(id,user_type)
        {
            $.ajax({
                url:"user-maintenance-details/"+id+"/"+ user_type,
                type:"GET",

                success:function(data){
                    console.log(data);
                    $('#euser_id_hidden').val(id);
                    $('#euser_type').text(data[0].user_role);
                    $('#efname').val(data[0].fname);
                    $('#emname').val(data[0].mname);
                    $('#elname').val(data[0].lname);
                    $('#eemail').val(data[0].email);
                    $('#ephone').val(data[0].phone);
                    $('#eaddress').val(data[0].address);
                    $('#eusername').val(data[0].username);
                    $('#eage').val(data[0].age);
                    $('#ebirthdate').val(data[0].birthdate);
                    $('#edateofoccupancy').val(data[0].date_of_occupancy);
                    $('#econtractstart').val(data[0].contract_start);
                    $('#econtractend').val(data[0].contract_end);
                    $('#egender').val(data[0].gender);
                    $('#ecivilstatus').val(data[0].civilstatus);
                    document.getElementById("eroom").value = data[0].roomid;
                    if(data[0].roomid == null){
                       document.getElementById('eroom').disabled = false;
                       console.log(data[0].roomid)
                    }
                    else{
                      document.getElementById('eroom').disabled = true;
                      console.log(data[0].roomid)
                    }
                    var img_source = '../../images/'+data[0].profile_pic;
                    $('#showprofile').attr('src', img_source);
                      $("#eprofilepic").on("change", function (e) {
                        //var file = $(this)[0].files[0];
                        var file =URL.createObjectURL($(this)[0].files[0]);
                        $('#showprofile').attr('src', file);
                        console.log(file);
                    });
                    console.log(img_source);
                    // if(data[0].user_role == 'Doctor')
                    // {
                    //   $('#eroom').val(data[0].specialty);
                    // }
                    // else{
                    //   $('#eroom').val('none');
                    // }
                   // $('#ebranch').val(data[0].branchname);
                }
               });
        }

        $(document).on('click', '#btn-archive-user', function()
        {
            let id = $(this).attr('employer-id');
            let user_type = $(this).attr('user-type');
            console.log(id);
            console.log(user_type);
            $('#id_archive').val(id);
            $('#user_type_archive').val(user_type);
        });

        $(document).on('click', '#btn_archive_user', function(){
            var id = $('#id_archive').val();
            let user_type = $('#user_type_archive').val();
            console.log(id,user_type);

           Archive(id,user_type);

          });

          function Archive(id,user_type) {
            $.ajax({
              url:"usermaintenance/archiveuser/"+ id + "/" + user_type,
              type:"POST",
              data:{
                  id:id,
                  user_type:user_type,
                },
                beforeSend:function(){
                    $('#btn_archive_user').text('Please wait...');
                    $('.loader').css('display', 'inline');
                  },
                success:function(data){
                    $('.dupdate-success-validation').css('display', 'inline');
                    $('.loader').css('display', 'none');
                    $('#btn_archive_user').text('Yes');
                    $('#admin-table').DataTable().ajax.reload();
                    $('#tenant-table').DataTable().ajax.reload();
                    $('#employee-table').DataTable().ajax.reload();
                    setTimeout(function(){
                    $('.dupdate-success-validation').fadeOut('slow');
                    $('#archiveModal').modal('toggle');

                },2000);
              }

             });
          }


        $(document).on('click', '#ebtn-update', function(){
            var id = $('#euser_id_hidden').val();
            var user_type = $('#euser_type').text();
            var fname = $('#efname').val();
            var mname = $('#emname').val();
            var lname = $('#elname').val();
            var room = $('#eroom').val();
            const element = document.getElementById('eroom');
            if($('#eroom').has('option').length == 0){
              var room = 'none'
              console.log(room);
            }
            else{
              var room = $('#eroom').val();
              console.log(room);
            }
            if(element.disabled){
              var room = 'not'
            }
            var email = $('#eemail').val();
            var phone = $('#ephone').val();
            var address = $('#eaddress').val();
            var username = $('#eusername').val();
            var password =  $('#epassword').val();
            var age = $('#eage').val();
            var birthdate = $('#ebirthdate').val();
            var dateofoccupancy = $('#edateofoccupancy').val();
            var contractstart = $('#econtractstart').val();
            var contractend = $('#econtractend').val();
            var gender = $('#egender').val();
            var civilstatus = $('#ecivilstatus').val();
            var profilepic = $('#eprofilepic').prop('files')[0];
            var form = new FormData()
            form.append('id', id)
            form.append('user_type', user_type)
            form.append('fname', fname)
            form.append('mname', mname)
            form.append('lname', lname)
            form.append('room', room)
            form.append('email', email)
            form.append('phone', phone)
            form.append('address', address)
            form.append('username', username)
            form.append('password', password)
            form.append('birthdate', birthdate)
            form.append('contractstart', contractstart)
            form.append('contractend', contractend)
            form.append('dateofoccupancy', dateofoccupancy)
            form.append('civilstatus', civilstatus)
            form.append('profilepic', profilepic)
            form.append('age', age)
            form.append('gender', gender)
            console.log(id);
            console.log(user_type);
            console.log(profilepic);
            if(password.trim() == '')
            {
                editwithoutpassword(form);
            }
            else
            {
                edit(form);
            }

        function edit(form) {
            $.ajax({
              url:"usermaintenance/edituser/",
              type:"POST",
              data:form,
                cache: false,
                contentType: false,
                processData: false,
              beforeSend:function(){
                  $('#ebtn-update').text('Please wait...');
                  $('.loader').css('display', 'inline');
                },
              success:function(data){
                  $('.eupdate-success-validation').css('display', 'inline');
                  $('.loader').css('display', 'none');
                  $('#ebtn-update').text('Edit');
                  $('#admin-table').DataTable().ajax.reload();
                  $('#tenant-table').DataTable().ajax.reload();
                  $('#employee-table').DataTable().ajax.reload();
                  setTimeout(function(){
                  $('.eupdate-success-validation').fadeOut('slow');
                  var password =  $('#epassword').val("");
                  $("#eprofilepic").val('');
                  $('#editUserModal').modal('toggle');

                },2000);
              }

             });
          }

          function editwithoutpassword(form) {
            $.ajax({
              url:"usermaintenance/edituserwithoutpassword/",
              type:"POST",
              data:form,
              cache: false,
                contentType: false,
                processData: false,
              beforeSend:function(){
                  $('#ebtn-update').text('Please wait...');
                  $('.loader').css('display', 'inline');
                },
              success:function(data){
                console.log(data);
                  $('.eupdate-success-validation').css('display', 'inline');
                  $('.loader').css('display', 'none');
                  $('#ebtn-update').text('Edit');
                  $('#admin-table').DataTable().ajax.reload();
                  $('#tenant-table').DataTable().ajax.reload();
                  $('#employee-table').DataTable().ajax.reload();
                  setTimeout(function(){
                  $('.eupdate-success-validation').fadeOut('slow');
                  $("#eprofilepic").val('');
                  $('#editUserModal').modal('toggle');

                },2000);
              }

             });
          }

        });
        // $(document).on('click', '#btn-save-user', function(){
        //     var user_type = $('#user_type').val();
        //     var name = $('#name').val();
        //     var room = $('#room').val();
        //     console.log(room);
        //     var email = $('#email').val();
        //     var phone = $('#phone').val();
        //     var address = $('#address').val();
        //     var username = $('#username').val();
        //     var password =  $('#password').val();
        //     var age = $('#age').val();
        //     var birthdate = $('#birthdate').val();
        //     var gender = $('#gender').val();
        //     var civilstatus = $('#civilstatus').val();
        //     var branch = $('#branch').val();
        //     add(user_type,name,email,phone,address,username,password,age,birthdate,gender,civilstatus,branch,room);

        //     function add(user_type,name,email,phone,address,username,password,age,birthdate,gender,civilstatus,branch,room) {
        //         $.ajax({
        //           url:"usermaintenance/adduser/"+ user_type +"/"+ name +"/"+ email +"/"+ phone +"/"+ address +"/"+ username +"/"+ password +"/"+ age +"/"+ birthdate +"/"+ gender +"/"+ civilstatus +"/"+ branch+"/"+ room,
        //           type:"POST",
        //           dataType:"json",
        //           data:{
        //               user_type:user_type,
        //               name:name,
        //               email:email,
        //               phone:phone,
        //               address:address,
        //               username:username,
        //               password:password,
        //               age:age,
        //               birthdate:birthdate,
        //               gender:gender,
        //               civilstatus:civilstatus,
        //               branch:branch,
        //               room:room,
        //             },
        //           beforeSend:function(){
        //               $('#btn-save-user').text('Please wait...');
        //               $('.loader').css('display', 'inline');
        //               $('.empty-reject-password').css('display', 'none');
        //               $('.reject-password').css('display', 'none');
        //               $('.empty-reject-name').css('display', 'none');
        //               $('.empty-reject-email').css('display', 'none');
        //               $('.empty-reject-phone').css('display', 'none');
        //               $('.empty-reject-address').css('display', 'none');
        //               $('.empty-reject-username').css('display', 'none');
        //               $('.reject-phone').css('display', 'none');
        //             },
        //           success:function(response){
        //             if(response.status == 1)
        //               {
        //                   console.log(response.status);
        //                    $('.update-success-validation').css('display', 'inline');
        //                     $('.loader').css('display', 'none');
        //                     $('#btn-save-user').text('Save');
        //                     $('#secretary-table').DataTable().ajax.reload();
        //                     $('#doctor-table').DataTable().ajax.reload();
        //                     $('#staff-table').DataTable().ajax.reload();
        //                     $('#admin-table').DataTable().ajax.reload();
        //                     setTimeout(function(){
        //                     $('.update-success-validation').fadeOut('slow');
        //                     var user_type = $('#user_type').val();
        //                     var name = $('#name').val("");
        //                     var room = $('#room').val('');
        //                     var email = $('#email').val("");
        //                     var phone = $('#phone').val("");
        //                     var address = $('#address').val("");
        //                     var username = $('#username').val("");
        //                     var password =  $('#password').val("");
        //                     var age = $('#age').val("");
        //                     var birthdate = $('#birthdate').val();
        //                     $('#addUserModal').modal('toggle');

        //                     },2000);
        //               }
        //                 else
        //                 {
        //                     console.log(response.status);
        //                       $('.reject-validation').css('display', 'inline');
        //                       $('.loader').css('display', 'none');
        //                       $('#btn-save-user').text('Save');
        //                       $('#secretary-table').DataTable().ajax.reload();
        //                       $('#doctor-table').DataTable().ajax.reload();
        //                       $('#staff-table').DataTable().ajax.reload();
        //                       $('#admin-table').DataTable().ajax.reload();
        //                       setTimeout(function(){
        //                           $('.reject-validation').fadeOut('slow');
        //                           var password =  $('#password').val("");
        //                           },2000);
        //                 }



        //             //   else if(response.status == 2)
        //             //   {
        //             //       $('.reject-password').css('display', 'inline');
        //             //       $('.loader').css('display', 'none');
        //             //     $('#btn-save-user').text('Save');
        //             //     console.log('aaa');
        //             //   }

        //           },
        //           error: function (data) {
        //             if (data.status == 404) {
        //                 var pass = password.trim().length;
        //                 var con = phone.trim().length;
        //                 if(password.trim() == '')
        //                 {
        //                     $('.empty-reject-password').css('display', 'inline');
        //                     $('.loader').css('display', 'none');
        //                     $('#btn-save-user').text('Save');
        //                 }
        //                 else if(pass <= 7)
        //                 {
        //                     $('.reject-password').css('display', 'inline');
        //                     $('.loader').css('display', 'none');
        //                     $('#btn-save-user').text('Save');
        //                 }
        //                 if(name.trim() == '')
        //                 {
        //                     $('.empty-reject-name').css('display', 'inline');
        //                     $('.loader').css('display', 'none');
        //                     $('#btn-save-user').text('Save');
        //                 }if(age.trim() == '')
        //                 {
        //                     $('.empty-reject-age').css('display', 'inline');
        //                     $('.loader').css('display', 'none');
        //                     $('#btn-save-user').text('Save');
        //                 }
        //                 if(birthdate.trim() == '')
        //                 {
        //                     $('.empty-reject-birthday').css('display', 'inline');
        //                     $('.loader').css('display', 'none');
        //                     $('#btn-save-user').text('Save');
        //                 }
        //                 if(email.trim() == '')
        //                 {
        //                     $('.empty-reject-email').css('display', 'inline');
        //                     $('.loader').css('display', 'none');
        //                     $('#btn-save-user').text('Save');
        //                 }
        //                 if(username.trim() == '')
        //                 {
        //                     $('.empty-reject-username').css('display', 'inline');
        //                     $('.loader').css('display', 'none');
        //                     $('#btn-save-user').text('Save');
        //                 }
        //                 if(address.trim() == '')
        //                 {
        //                     $('.empty-reject-address').css('display', 'inline');
        //                     $('.loader').css('display', 'none');
        //                     $('#btn-save-user').text('Save');
        //                 }
        //                 if(phone.trim() == '')
        //                 {
        //                     $('.empty-reject-phone').css('display', 'inline');
        //                     $('.loader').css('display', 'none');
        //                     $('#btn-save-user').text('Save');
        //                 }
        //                 if(room.trim() == ''){
        //                   $('.empty-reject-room').css('display', 'inline');
        //                     $('.loader').css('display', 'none');
        //                     $('#btn-save-user').text('Save');
        //                 }
        //                 else if(con <= 10)
        //                 {
        //                     $('.reject-phone').css('display', 'inline');
        //                     $('.loader').css('display', 'none');
        //                     $('#btn-save-user').text('Save');
        //                 }

        //             }
        //         }

        //          });
        //       }

        // });
});
