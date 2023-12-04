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
            else if(data == 2){
                return 'Not Fully Occupied'
            }
            else if(data == 3){
              return 'Overloaded, Please Decrease the Tenant of this Room'
          }
            else{
                return 'Not Occupied'
            }
          }
       }],


           columns:[
            {data: 'id', name: 'id'},
            {data: 'floornumber', name: 'floornumber'},
            {data: 'roomnumber', name: 'roomnumber'},
            {data: 'roomcapacity', name: 'roomcapacity'},
            {data: 'isOccupied', name: 'isOccupied'},
            {data: 'vacantnumber', name: 'vacantnumber'},
            {data: 'action', name: 'action', orderable:false}
           ]

          });

       }       
        // show user details
        $(document).on('click', '#btn-edit-room', function()
        {
            let id = $(this).attr('employer-id');
            console.log(id);
            getRoomDetails(id);
        });

        function getRoomDetails(id)
        {
            $.ajax({
                url:"room-maintenance-details/"+id,
                type:"GET",

                success:function(data){
                    console.log(data);
                    $('#ecust-id-hidden').val(id);
                    $('#eroomnumber').val(data[0].roomnumber);
                    $('#efloor').val(data[0].floornumber);
                    document.getElementById("efloor").value = data[0].floor_id;
                    $('#eroomcapacity').val(data[0].roomcapacity);
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


        $(document).on('click', '#btn-edit-save-room', function(){
            var id = $('#ecust-id-hidden').val();
            var roomnumber = $('#eroomnumber').val();
            var roomcapacity = $('#eroomcapacity').val();
            var form = new FormData()
            form.append('id', id)
            form.append('roomnumber', roomnumber)
            form.append('roomcapacity', roomcapacity)

            edit(form)

        function edit(form) {
            $.ajax({
              url:"room/editroom",
              type:"POST",
              data:form,
                cache: false,
                contentType: false,
                processData: false,
              beforeSend:function(){
                  $('#btn-edit-save-room').text('Please wait...');
                  $('.loader').css('display', 'inline');
                },
              success:function(data){
                console.log(data);
                if(data == 0){
                    $('.error-capacity').css('display', 'inline');
                    $('.loader').css('display', 'none');
                    $('#btn-edit-save-room').text('Edit');
                    $('#room-table').DataTable().ajax.reload();
                    setTimeout(function(){
                    $('.error-capacity').fadeOut('slow');
                  },2000);
                }
                else if(data == 1){
                  $('.error-number').css('display', 'inline');
                    $('.loader').css('display', 'none');
                    $('#btn-edit-save-room').text('Edit');
                    $('#room-table').DataTable().ajax.reload();
                    setTimeout(function(){
                    $('.error-number').fadeOut('slow');
                  },2000);
                }
                else{
                    $('.update-success-validation').css('display', 'inline');
                    $('.loader').css('display', 'none');
                    $('#btn-edit-save-room').text('Edit');
                    $('#room-table').DataTable().ajax.reload();
                    setTimeout(function(){
                    $('.update-success-validation').fadeOut('slow');
                    $('#EditRoomModal').modal('toggle');
                  },2000);
                }
                  
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
});
