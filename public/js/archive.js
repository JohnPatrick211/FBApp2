$(document).ready(function()
{

    fetchAdmin();
    fetchEmployee();
    fetchTenant();
    fetchRoom();



    function fetchAdmin(){
        $('#archiveadmin-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"archive/admin",

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
        {data: 'updated_at', name: 'updated_at'},
        {data: 'action', name: 'action', orderable:false}
       ],
           order: [[0, 'desc']],

          });

       }

       $(document).on('click', '#btn-retrieve-admin', function()
       {
           let id = $(this).attr('employer-id');
           $('#id_retrieve').val(id);
           console.log(id);
       });

       $(document).on('click', '#btn_retrieve_admin', function(){
        var id = $('#id_retrieve').val();
        console.log(id);

       RetrieveAdmin(id);

      });

      function RetrieveAdmin(id) {
        $.ajax({
          url:"archiveadmin/retrieve/"+ id,
          type:"POST",
          data:{
              id:id,
            },
          beforeSend:function(){
              $('#btn_retrieve_admin').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
              $('.archiveupdate-success-validation').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn_retrieve_admin').text('Yes');
              $('#archiveadmin-table').DataTable().ajax.reload();
              setTimeout(function(){
              $('.archiveupdate-success-validation').fadeOut('slow');
              $('#retrieveAdminModal').modal('toggle');

            },2000);
          }

         });
      }
      //Archive Employee
      function fetchEmployee(){
        $('#archiveemployee-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"archive/employee",

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
        {data: 'updated_at', name: 'updated_at'},
        {data: 'action', name: 'action', orderable:false}
       ],
           order: [[0, 'desc']],

          });

       }

       $(document).on('click', '#btn-retrieve-employee', function()
       {
           let id = $(this).attr('employer-id');
           $('#id_retrieve').val(id);
           console.log(id);
       });

       $(document).on('click', '#btn_retrieve_employee', function(){
        var id = $('#id_retrieve').val();
        console.log(id);

       RetrieveEmployee(id);

      });

      function RetrieveEmployee(id) {
        $.ajax({
          url:"archiveemployee/retrieve/"+ id,
          type:"POST",
          data:{
              id:id,
            },
          beforeSend:function(){
              $('#btn_retrieve_employee').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
              $('.archiveupdate-success-validation').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn_retrieve_employee').text('Yes');
              $('#archiveemployee-table').DataTable().ajax.reload();
              setTimeout(function(){
              $('.archiveupdate-success-validation').fadeOut('slow');
              $('#retrieveEmployeeModal').modal('toggle');

            },2000);
          }

         });
      }
      //Archive Tenant
      function fetchTenant(){
        $('#archivetenant-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"archive/tenant",

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
        {data: 'updated_at', name: 'updated_at'},
        {data: 'action', name: 'action', orderable:false}
       ],
           order: [[0, 'desc']],

          });

       }

       $(document).on('click', '#btn-retrieve-tenant', function()
       {
           let id = $(this).attr('employer-id');
           $('#id_retrieve').val(id);
           console.log(id);
       });

       $(document).on('click', '#btn_retrieve_tenant', function(){
        var id = $('#id_retrieve').val();
        console.log(id);

       RetrieveTenant(id);

      });

      function RetrieveTenant(id) {
        $.ajax({
          url:"archivetenant/retrieve/"+ id,
          type:"POST",
          data:{
              id:id,
            },
          beforeSend:function(){
              $('#btn_retrieve_tenant').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
              $('.archiveupdate-success-validation').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn_retrieve_tenant').text('Yes');
              $('#archivetenant-table').DataTable().ajax.reload();
              setTimeout(function(){
              $('.archiveupdate-success-validation').fadeOut('slow');
              $('#retrieveTenantModal').modal('toggle');

            },2000);
          }

         });
      }
      //Archive Room
      function fetchRoom(){
        $('#archiveroom-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"archive/room",

           columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'ROOM-'+data;
            }
         }],

           columns:[
            {data: 'id', name: 'id'},
            {data: 'roomnumber', name: 'roomnumber'},
            {data: 'roomcapacity', name: 'roomcapacity'},
            {data: 'vacantnumber', name: 'vacantnumber'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable:false}
           ],
           order: [[4, 'desc']],

          });

       }

       $(document).on('click', '#btn-retrieve-room', function()
       {
           let id = $(this).attr('employer-id');
           $('#id_retrieve').val(id);
           console.log(id);
       });

       $(document).on('click', '#btn_retrieve_room', function(){
        var id = $('#id_retrieve').val();
        console.log(id);

       RetrieveRoom(id);

      });

      function RetrieveRoom(id) {
        $.ajax({
          url:"archiveroom/retrieve/"+ id,
          type:"POST",
          data:{
              id:id,
            },
          beforeSend:function(){
              $('#btn_retrieve_room').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
              $('.archiveupdate-success-validation').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn_retrieve_room').text('Yes');
              $('#archiveroom-table').DataTable().ajax.reload();
              setTimeout(function(){
              $('.archiveupdate-success-validation').fadeOut('slow');
              $('#retrieveRoomModal').modal('toggle');

            },2000);
          }

         });
      }
      //Archive Secretary
      function fetchSecretary(){
        $('#archivesecretary-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"secretaryarchive",

           columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'SEC-'+data;
            }
         }],

           columns:[
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'branchname', name: 'branchname'},
            {data: 'email', name: 'email'},
            {data: 'contactno', name: 'contactno'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable:false}
           ],
           order: [[5, 'desc']],
          });

       }

       $(document).on('click', '#btn-retrieve-secretary', function()
       {
           let id = $(this).attr('employer-id');
           $('#id_retrieve').val(id);
           console.log(id);
       });

       $(document).on('click', '#btn_retrieve_secretary', function(){
        var id = $('#id_retrieve').val();
        console.log(id);

       RetrieveSecretary(id);

      });

      function RetrieveSecretary(id) {
        $.ajax({
          url:"archivesecretary/retrieve/"+ id,
          type:"POST",
          data:{
              id:id,
            },
          beforeSend:function(){
              $('#btn_retrieve_secretary').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
              $('.archiveupdate-success-validation').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn_retrieve_secretary').text('Yes');
              $('#archivesecretary-table').DataTable().ajax.reload();
              setTimeout(function(){
              $('.archiveupdate-success-validation').fadeOut('slow');
              $('#retrieveSecretaryModal').modal('toggle');

            },2000);
          }

         });
      }
      //Archive Staff
      function fetchStaff(){
        $('#archivestaff-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"staffarchive",

           columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'STAFF-'+data;
            }
         }],

           columns:[
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'branchname', name: 'branchname'},
            {data: 'email', name: 'email'},
            {data: 'contactno', name: 'contactno'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable:false}
           ],
           order: [[5, 'desc']],
          });

       }

       $(document).on('click', '#btn-retrieve-staff', function()
       {
           let id = $(this).attr('employer-id');
           $('#id_retrieve').val(id);
           console.log(id);
       });

       $(document).on('click', '#btn_retrieve_staff', function(){
        var id = $('#id_retrieve').val();
        console.log(id);

       RetrieveStaff(id);

      });

      function RetrieveStaff(id) {
        $.ajax({
          url:"archivestaff/retrieve/"+ id,
          type:"POST",
          data:{
              id:id,
            },
          beforeSend:function(){
              $('#btn_retrieve_staff').text('Please wait...');
              $('.loader').css('display', 'inline');
            },
          success:function(data){
              $('.archiveupdate-success-validation').css('display', 'inline');
              $('.loader').css('display', 'none');
              $('#btn_retrieve_staff').text('Yes');
              $('#archivestaff-table').DataTable().ajax.reload();
              setTimeout(function(){
              $('.archiveupdate-success-validation').fadeOut('slow');
              $('#retrieveStaffModal').modal('toggle');

            },2000);
          }

         });
      }
});
