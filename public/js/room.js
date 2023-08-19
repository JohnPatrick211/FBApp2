$(document).ready(function()
{

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

    fetchRoom();

    function fetchRoom(){
        $('#room-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"room-maintenance/room",

           columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'ROOM-'+data;
            }
         }, {
          targets: 3,
          orderable: true,
          changeLength: true,
          className: 'dt-body-center',
          render: function (data, type, full, meta){
            if(data == 1){
                return 'Occupied'
            }
            else{
                return 'Not Occupied'
            }
          }
       }],


           columns:[
            {data: 'id', name: 'id'},
            {data: 'roomnumber', name: 'roomnumber'},
            {data: 'roomcapacity', name: 'roomcapacity'},
            {data: 'isOccupied', name: 'isOccupied'},
            {data: 'vacantnumber', name: 'vacantnumber'},
            {data: 'action', name: 'action', orderable:false}
           ]

          });

       }       
        // show user details
        // $(document).on('click', '#btn-edit-user', function()
        // {
        //     let id = $(this).attr('employer-id');
        //     let user_type = $(this).attr('user-type');
        //     console.log(id);
        //     console.log(user_type);
        //     if(user_type == 'Tenant')
        //     {
        //         $('#edit_user_type').val('Tenant'); 
        //         console.log(user_type);
        //         var test = $('#eroom').val('');
        //         $('.ehide-room').css('display', 'inline');
        //         console.log(test);
        //         getUserDetails(id,user_type);
        //     }
        //     else if(user_type == 'Employee'){
        //         $('#edit_user_type').val('Employee');
        //         console.log(user_type);
        //         var test = $('#eroom').val('none');
        //         $('.ehide-room').css('display', 'none');
        //        console.log(test);
        //        getUserDetails(id,user_type);
        //     }
        //     else if(user_type == 'System Admin'){
        //       $('#edit_user_type').val('System Admin');
        //       console.log(user_type);
        //       var test = $('#eroom').val('none');
        //      $('.ehide-room').css('display', 'none');
        //      console.log(test);
        //      getUserDetails(id,user_type);
        //   }
        // });

        // function getUserDetails(id,user_type)
        // {
        //     $.ajax({
        //         url:"user-maintenance-details/"+id+"/"+ user_type,
        //         type:"GET",

        //         success:function(data){
        //             console.log(data);
        //             $('#euser_id_hidden').val(id);
        //             $('#euser_type').text(data[0].user_role);
        //             $('#efname').val(data[0].fname);
        //             $('#emname').val(data[0].mname);
        //             $('#elname').val(data[0].lname);
        //             $('#eemail').val(data[0].email);
        //             $('#ephone').val(data[0].phone);
        //             $('#eaddress').val(data[0].address);
        //             $('#eusername').val(data[0].username);
        //             $('#eage').val(data[0].age);
        //             $('#ebirthdate').val(data[0].birthdate);
        //             $('#egender').val(data[0].gender);
        //             $('#ecivilstatus').val(data[0].civilstatus);
        //             document.getElementById("eroom").value = data[0].roomid;
        //             var img_source = '../../images/'+data[0].profile_pic;
        //             $('#showprofile').attr('src', img_source);
        //               $("#eprofilepic").on("change", function (e) {
        //                 //var file = $(this)[0].files[0];
        //                 var file =URL.createObjectURL($(this)[0].files[0]);
        //                 $('#showprofile').attr('src', file);
        //                 console.log(file);
        //             });
        //             console.log(img_source);
        //             // if(data[0].user_role == 'Doctor')
        //             // {
        //             //   $('#eroom').val(data[0].specialty);
        //             // }
        //             // else{
        //             //   $('#eroom').val('none');
        //             // }
        //            // $('#ebranch').val(data[0].branchname);
        //         }
        //        });
        // }

        $(document).on('click', '#btn-archive-room', function()
        {
            let id = $(this).attr('employer-id');
            console.log(id);
            $('#id_archive').val(id);
        });

        $(document).on('click', '#btn_archive_room', function(){
            var id = $('#id_archive').val();
            console.log(id);

           Archive(id);

          });

          function Archive(id) {
            $.ajax({
              url:"room-maintenance/archiveroom/"+ id,
              type:"POST",
              data:{
                  id:id,
                },
                beforeSend:function(){
                    $('#btn_archive_room').text('Please wait...');
                    $('.loader').css('display', 'inline');
                  },
                success:function(data){
                    $('.dupdate-success-validation').css('display', 'inline');
                    $('.loader').css('display', 'none');
                    $('#btn_archive_room').text('Yes');
                    $('#room-table').DataTable().ajax.reload();
                    setTimeout(function(){
                    $('.dupdate-success-validation').fadeOut('slow');
                    $('#RoomArchiveModal').modal('toggle');

                },2000);
              }

             });
          }


        // $(document).on('click', '#ebtn-update', function(){
        //     var id = $('#euser_id_hidden').val();
        //     var user_type = $('#euser_type').text();
        //     var fname = $('#efname').val();
        //     var mname = $('#emname').val();
        //     var lname = $('#elname').val();
        //     var room = $('#eroom').val();
        //     if($('#eroom').has('option').length == 0){
        //       var room = 'none'
        //       console.log(room);
        //     }
        //     else{
        //       var room = $('#eroom').val();
        //       console.log(room);
        //     }
        //     var email = $('#eemail').val();
        //     var phone = $('#ephone').val();
        //     var address = $('#eaddress').val();
        //     var username = $('#eusername').val();
        //     var password =  $('#epassword').val();
        //     var age = $('#eage').val();
        //     var birthdate = $('#ebirthdate').val();
        //     var gender = $('#egender').val();
        //     var civilstatus = $('#ecivilstatus').val();
        //     var profilepic = $('#eprofilepic').prop('files')[0];
        //     var form = new FormData()
        //     form.append('id', id)
        //     form.append('user_type', user_type)
        //     form.append('fname', fname)
        //     form.append('mname', mname)
        //     form.append('lname', lname)
        //     form.append('room', room)
        //     form.append('email', email)
        //     form.append('phone', phone)
        //     form.append('address', address)
        //     form.append('username', username)
        //     form.append('password', password)
        //     form.append('birthdate', birthdate)
        //     form.append('civilstatus', civilstatus)
        //     form.append('profilepic', profilepic)
        //     form.append('age', age)
        //     form.append('gender', gender)
        //     console.log(id);
        //     console.log(user_type);
        //     console.log(profilepic);
        //     if(password.trim() == '')
        //     {
        //         editwithoutpassword(form);
        //     }
        //     else
        //     {
        //         edit(form);
        //     }

        // function edit(form) {
        //     $.ajax({
        //       url:"usermaintenance/edituser/",
        //       type:"POST",
        //       data:form,
        //         cache: false,
        //         contentType: false,
        //         processData: false,
        //       beforeSend:function(){
        //           $('#ebtn-update').text('Please wait...');
        //           $('.loader').css('display', 'inline');
        //         },
        //       success:function(data){
        //           $('.eupdate-success-validation').css('display', 'inline');
        //           $('.loader').css('display', 'none');
        //           $('#ebtn-update').text('Edit');
        //           $('#admin-table').DataTable().ajax.reload();
        //           $('#tenant-table').DataTable().ajax.reload();
        //           $('#employee-table').DataTable().ajax.reload();
        //           setTimeout(function(){
        //           $('.eupdate-success-validation').fadeOut('slow');
        //           var password =  $('#epassword').val("");
        //           $("#eprofilepic").val('');
        //           $('#editUserModal').modal('toggle');

        //         },2000);
        //       }

        //      });
        //   }

        //   function editwithoutpassword(form) {
        //     $.ajax({
        //       url:"usermaintenance/edituserwithoutpassword/",
        //       type:"POST",
        //       data:form,
        //       cache: false,
        //         contentType: false,
        //         processData: false,
        //       beforeSend:function(){
        //           $('#ebtn-update').text('Please wait...');
        //           $('.loader').css('display', 'inline');
        //         },
        //       success:function(data){
        //         console.log(data);
        //           $('.eupdate-success-validation').css('display', 'inline');
        //           $('.loader').css('display', 'none');
        //           $('#ebtn-update').text('Edit');
        //           $('#admin-table').DataTable().ajax.reload();
        //           $('#tenant-table').DataTable().ajax.reload();
        //           $('#employee-table').DataTable().ajax.reload();
        //           setTimeout(function(){
        //           $('.eupdate-success-validation').fadeOut('slow');
        //           $("#eprofilepic").val('');
        //           $('#editUserModal').modal('toggle');

        //         },2000);
        //       }

        //      });
        //   }

       // });
});
