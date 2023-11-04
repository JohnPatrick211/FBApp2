$(document).ready(function()
{

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

    fetchRoomInfo();

    function fetchRoomInfo(){
        $('#roominfo-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"room-information/room",

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
            {data: 'roomnumber', name: 'roomnumber'},
            {data: 'roomcapacity', name: 'roomcapacity'},
            {data: 'isOccupied', name: 'isOccupied'},
            {data: 'vacantnumber', name: 'vacantnumber'},
            {data: 'action', name: 'action', orderable:false}
           ]

          });

       }
       
       function fetchTenantRoom(id){
        $('#tenantroom-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"room-tenantinformation/tenantroom/"+id,

           columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'TEN-'+data;
            }
         },{
          targets: 1,
          orderable: true,
          changeLength: true,
          className: 'dt-body-center',
          render: function (data, type, full, meta){
            if(full.mname === null){
              return data + ' ' + full.lname;
            }
            else{
              return data + ' ' +full.mname + ' ' + full.lname;
            }
          }
       },
       { "visible": false,  "targets": [ 2 ] },
       { "visible": false,  "targets": [ 3 ] }],


           columns:[
            {data: 'tenant_id', name: 'tenant_id'},
            {data: 'fname', name: 'fname'},
            {data: 'mname', name: 'mname'},
            {data: 'lname', name: 'lname'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'date_of_occupancy', name: 'date_of_occupancy'},
            {data: 'action', name: 'action', orderable:false}
           ]

          });

       }

        //show room info details
        $(document).on('click', '#btn-info-room', function()
        {
            let id = $(this).attr('employer-id');
            console.log(id);
            getRoomInfoDetails(id);
        });

        function getRoomInfoDetails(id)
        {
            $.ajax({
                url:"room-information-details/"+id,
                type:"GET",

                success:function(data){
                    console.log(data);
                    $('#ecust-id-hidden').val(id);
                    $('#inforoomnumber').val(data[0].roomnumber);
                    $('#inforoomcapacity').val(data[0].roomcapacity);
                    $("#tenantroom-table").dataTable().fnDestroy();
                    console.log(id);
                    fetchTenantRoom(id);

                }
               });
        }

        $(document).on('click', '#btn-archive-tenant', function()
        {
            let id = $(this).attr('employer-id');
            console.log(id);
            $('#id_archive').val(id);
        });

        $(document).on('click', '#btn_archive_tenantroom', function(){
          var id = $('#id_archive').val();
          console.log(id);

         Archive(id);

      });

      function Archive(id) {
        $.ajax({
          url:"room-information/archivetenantroom/"+ id,
          type:"POST",
          data:{
              id:id,
            },
            beforeSend:function(){
                $('#btn_archive_tenantroom').text('Please wait...');
                $('.loader').css('display', 'inline');
              },
            success:function(data){
                $('.dupdate-success-validation').css('display', 'inline');
                $('.loader').css('display', 'none');
                $('#btn_archive_tenantroom').text('Yes');
                $('#tenantroom-table').DataTable().ajax.reload();
                $('#roominfo-table').DataTable().ajax.reload();
                setTimeout(function(){
                $('.dupdate-success-validation').fadeOut('slow');
                $('#RoomTenantArchiveModal').modal('toggle');

            },2000);
          }

         });
      }
});
