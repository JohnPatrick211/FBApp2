$(document).ready(function()
{

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

    fetchRoom();

    function fetchRoom(){
        $('#floor-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"floor-maintenance/floor",

           columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'FLR-'+data;
            }
         }],


           columns:[
            {data: 'id', name: 'id'},
            {data: 'floornumber', name: 'floornumber'},
            {data: 'no_of_room', name: 'no_of_room'},
            {data: 'action', name: 'action', orderable:false}
           ]

          });

       }       
        // show user details
        $(document).on('click', '#btn-edit-floor', function()
        {
            let id = $(this).attr('employer-id');
            console.log(id);
            getFloorDetails(id);
        });

        function getFloorDetails(id)
        {
            $.ajax({
                url:"floor-maintenance-details/"+id,
                type:"GET",

                success:function(data){
                    console.log(data);
                    $('#ecust-id-hidden').val(id);
                    $('#efloornumber').val(data[0].floornumber);
                    $('#eno_of_room').val(data[0].no_of_room);
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

        $(document).on('click', '#btn-archive-floor', function()
        {
            let id = $(this).attr('employer-id');
            console.log(id);
            $('#id_archive').val(id);
        });

        $(document).on('click', '#btn_archive_floor', function(){
            var id = $('#id_archive').val();
            console.log(id);

           Archive(id);

        });

          function Archive(id) {
            $.ajax({
              url:"floor-maintenance/archivefloor/"+ id,
              type:"POST",
              data:{
                  id:id,
                },
                beforeSend:function(){
                    $('#btn_archive_floor').text('Please wait...');
                    $('.loader').css('display', 'inline');
                  },
                success:function(data){
                    $('.dupdate-success-validation').css('display', 'inline');
                    $('.loader').css('display', 'none');
                    $('#btn_archive_floor').text('Yes');
                    $('#floor-table').DataTable().ajax.reload();
                    setTimeout(function(){
                    $('.dupdate-success-validation').fadeOut('slow');
                    $('#FloorArchiveModal').modal('toggle');

                },2000);
              }

             });
          }


        $(document).on('click', '#btn-edit-save-floor', function(){
            var id = $('#ecust-id-hidden').val();
            var roomnumber = $('#efloornumber').val();
            var roomcapacity = $('#eno_of_room').val();
            var form = new FormData()
            form.append('id', id)
            form.append('floornumber', roomnumber)
            form.append('no_of_room', roomcapacity)

            edit(form)

        function edit(form) {
            $.ajax({
              url:"floor/editfloor",
              type:"POST",
              data:form,
                cache: false,
                contentType: false,
                processData: false,
              beforeSend:function(){
                  $('#btn-edit-save-floor').text('Please wait...');
                  $('.loader').css('display', 'inline');
                },
              success:function(data){
                if(data == 1){
                  $('.error-number').css('display', 'inline');
                    $('.loader').css('display', 'none');
                    $('#btn-edit-save-floor').text('Edit');
                    $('#floor-table').DataTable().ajax.reload();
                    setTimeout(function(){
                    $('.error-number').fadeOut('slow');
                  },2000);
                }
                else{
                  console.log(data);
                    $('.update-success-validation').css('display', 'inline');
                    $('.loader').css('display', 'none');
                    $('#btn-edit-save-floor').text('Edit');
                    $('#floor-table').DataTable().ajax.reload();
                    setTimeout(function(){
                    $('.update-success-validation').fadeOut('slow');
                    $('#EditFloorModal').modal('toggle');
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
