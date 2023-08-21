$(document).ready(function()
{

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

    fetchTenantInfo();

    function fetchTenantInfo(){
        $('#tenantinfo-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"tenant-information/tenant",

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
            {data: 'tenant_id', name: 'tenant_id'},
            {data: 'fname', name: 'fname'},
            {data: 'mname', name: 'mname'},
            {data: 'lname', name: 'lname'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'action', name: 'action', orderable:false}
           ]

          });

       }

      //  show tenant info details
        $(document).on('click', '#btn-info-tenant', function()
        {
            let id = $(this).attr('employer-id');
            console.log(id);
            getTenantInfoDetails(id);
        });

        function getTenantInfoDetails(id)
        {
            $.ajax({
                url:"tenant-information-details/"+id,
                type:"GET",

                success:function(data){
                    console.log(data);
                    $('#infofname').val(data[0].fname);
                    $('#infomname').val(data[0].mname);
                    $('#infolname').val(data[0].lname);
                    $('#inforoomnumber').val(data[0].roomnumber);
                    $('#infodateofoccupancy').val(data[0].date_of_occupancy);
                    $('#infoemail').val(data[0].email);
                    $('#infoage').val(data[0].age);
                    $('#infogender').val(data[0].gender);
                    $('#infocivilstatus').val(data[0].civilstatus);
                    $('#infobirthdate').val(data[0].birthdate);
                    $('#infophone').val(data[0].phone);
                    $('#infoaddress').val(data[0].address);
                    var img_source = '../../images/'+data[0].profile_pic;
                    $('#infoshowprofile').attr('src', img_source);
                }
               });
        }

    //     $(document).on('click', '#btn-archive-tenant', function()
    //     {
    //         let id = $(this).attr('employer-id');
    //         console.log(id);
    //         $('#id_archive').val(id);
    //     });

    //     $(document).on('click', '#btn_archive_tenantroom', function(){
    //       var id = $('#id_archive').val();
    //       console.log(id);

    //      Archive(id);

    //   });

    //   function Archive(id) {
    //     $.ajax({
    //       url:"room-information/archivetenantroom/"+ id,
    //       type:"POST",
    //       data:{
    //           id:id,
    //         },
    //         beforeSend:function(){
    //             $('#btn_archive_tenantroom').text('Please wait...');
    //             $('.loader').css('display', 'inline');
    //           },
    //         success:function(data){
    //             $('.dupdate-success-validation').css('display', 'inline');
    //             $('.loader').css('display', 'none');
    //             $('#btn_archive_tenantroom').text('Yes');
    //             $('#tenantroom-table').DataTable().ajax.reload();
    //             $('#roominfo-table').DataTable().ajax.reload();
    //             setTimeout(function(){
    //             $('.dupdate-success-validation').fadeOut('slow');
    //             $('#RoomTenantArchiveModal').modal('toggle');

    //         },2000);
    //       }

     //     });
     // }
});
