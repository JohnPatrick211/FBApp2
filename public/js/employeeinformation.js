$(document).ready(function()
{

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

    fetchTenantInfo();

    function fetchTenantInfo(){
        $('#employeeinfo-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"employee-information/employee",

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
            {data: 'emp_id', name: 'emp_id'},
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
        $(document).on('click', '#btn-info-employee', function()
        {
            let id = $(this).attr('employer-id');
            console.log(id);
            getEmployeeInfoDetails(id);
        });

        function getEmployeeInfoDetails(id)
        {
            $.ajax({
                url:"employee-information-details/"+id,
                type:"GET",

                success:function(data){
                    console.log(data);
                    $('#infofname').val(data[0].fname);
                    $('#infolname').val(data[0].lname);
                    $('#infoemail').val(data[0].email);
                    $('#infoage').val(data[0].age);
                    $('#infogender').val(data[0].gender);
                    $('#infocivilstatus').val(data[0].civilstatus);
                    $('#infobirthdate').val(data[0].birthdate);
                    $('#infophone').val(data[0].phone);
                    $('#infoaddress').val(data[0].address);
                    var img_source = '../../images/'+data[0].profile_pic;
                    $('#infoshowprofile').attr('src', img_source);
                    if(data[0].mname === null){
                      $('#infomname').val('No Middle Name');
                    }
                    else{
                      $('#infomname').val(data[0].mname);
                    }
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
