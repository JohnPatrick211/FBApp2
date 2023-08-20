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
              return data + ' ' +full.mname + ' ' + full.lname;
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

        // $(document).on('click', '#btn-edit-save-room', function(){
        //     var id = $('#ecust-id-hidden').val();
        //     var roomnumber = $('#eroomnumber').val();
        //     var roomcapacity = $('#eroomcapacity').val();
        //     var form = new FormData()
        //     form.append('id', id)
        //     form.append('roomnumber', roomnumber)
        //     form.append('roomcapacity', roomcapacity)

        //     edit(form)

        // function edit(form) {
        //     $.ajax({
        //       url:"room/editroom/",
        //       type:"POST",
        //       data:form,
        //         cache: false,
        //         contentType: false,
        //         processData: false,
        //       beforeSend:function(){
        //           $('#btn-edit-save-room').text('Please wait...');
        //           $('.loader').css('display', 'inline');
        //         },
        //       success:function(data){
        //         console.log(data);
        //         if(data == 0){
        //             $('.error-capacity').css('display', 'inline');
        //             $('.loader').css('display', 'none');
        //             $('#btn-edit-save-room').text('Edit');
        //             $('#room-table').DataTable().ajax.reload();
        //             setTimeout(function(){
        //             $('.error-capacity').fadeOut('slow');
        //           },2000);
        //         }
        //         else if(data == 1){
        //           $('.error-number').css('display', 'inline');
        //             $('.loader').css('display', 'none');
        //             $('#btn-edit-save-room').text('Edit');
        //             $('#room-table').DataTable().ajax.reload();
        //             setTimeout(function(){
        //             $('.error-number').fadeOut('slow');
        //           },2000);
        //         }
        //         else{
        //             $('.update-success-validation').css('display', 'inline');
        //             $('.loader').css('display', 'none');
        //             $('#btn-edit-save-room').text('Edit');
        //             $('#room-table').DataTable().ajax.reload();
        //             setTimeout(function(){
        //             $('.update-success-validation').fadeOut('slow');
        //             $('#EditRoomModal').modal('toggle');
        //           },2000);
        //         }
                  
        //       }

        //      });
        //   }

      // });
});
