
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      fetchForValidation();

      function fetchForValidation(){

      var tbl_for_validation = $('#tenant-approval-table').DataTable({

          processing: true,
          serverSide: true,

          ajax:{
           url: "tenant-approval-data",
          },

          columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return '2023-TEN-'+data;
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
            {data: 'tenantid', name: 'tenantid'},
            {data: 'fname', name: 'fname'},
            {data: 'mname', name: 'mname'},
            {data: 'lname', name: 'lname'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'action', name: 'action', orderable:false}
           ]
        });


   $('#select-all').on('click', function(){
    var rows = tbl_for_validation.rows({ 'search': 'applied' }).nodes();
    $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });

    $('#for-validation-table tbody').on('change', 'input[type="checkbox"]', function(){
      if(!this.checked){
         var el = $('#select-all').get(0);
         if(el && el.checked && ('indeterminate' in el)){
            el.indeterminate = true;
         }
      }
   });

      }

      fetchVerified();

      function fetchVerified(){
        $('#tenant-approved-table').DataTable({

          processing: true,
          serverSide: true,

          ajax:{
           url: "tenant-approval-data-approved",
          },
          
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

      $(document).on('click', '#btn-view-upload', function(){
        var id = $(this).attr('employer-id');
          fetchUploadInfo(id);
      });

      function fetchUploadInfo(id){
        $.ajax({
          url:"/verifytenant/getverificationinfo/"+ id,
          type:"GET",

          success:function(data){
            console.log(data);
            isVerified(id);
            $('#cust-id-hidden').val(data[0].tenantid);
            $('#room-id-hidden').val(data[0].roomid);
            $('#fname').val(data[0].fname);
            $('#mname').val(data[0].mname);
            $('#lname').val(data[0].lname);
            $('#email').val(data[0].email);
            $('#status').val(data[0].status);
            $('#address').val(data[0].address);
            $('#phone').val(data[0].phone);
            $('#age').val(data[0].age);
            $('#gender').val(data[0].gender);
            $('#birthdate').val(data[0].birthdate);
            $('#civilstatus').val(data[0].civilstatus);
            $('#room').val(data[0].roomnumber);
            $('#dateofoccupancy').val(data[0].date_of_occupancy);
            $('#contractstart').val(data[0].contract_start);
            $('#contractend').val(data[0].contract_end);

          }

         });
      }

      function isVerified(id){
        $.ajax({
          url:"/verifytenant/getverificationinfo/"+ id,
          type:"GET",

          success:function(data){

           var status = data[0].pendingstatus;
           console.log(status);
              if(status == '2')
              {
                console.log('Pending');
                $("#btn-approve-tenant").attr('disabled', false);
                $("#btn-reject-tenant").attr('disabled', false);
              }
              else
              {
                $("#btn-approve-tenant").attr('disabled', true);
                $("#btn-reject-tenant").attr('disabled', true);
              }
            }
         });
      }

      $(document).on('click', '#btn-approve-tenant', function() {

        $("#confirmationpatientapproveModal").modal('show')
        

      });
      
       $(document).on('click', '#btn_confirmpatientapprove', function() {
           
            var id = $('#cust-id-hidden').val();
            var room = $('#room-id-hidden').val();
            console.log(id);
            console.log(room);
            $("#confirmationpatientapproveModal").modal('hide')
            approve(id,room);
       });

    function approve(id,room) {
      $.ajax({
        url:"/verifytenant/approve/"+ id +"/" + room,
        type:"POST",
        data:{
          id:id,
          room:room
        },
        beforeSend:function(){
          $('#btn-approve').text('Please wait...');
          $('.loader').css('display', 'inline');
        },
        success:function(){
          $('#tenant-approval-table').DataTable().ajax.reload();
          $('#tenant-approved-table').DataTable().ajax.reload();
          setTimeout(function(){
            $('.update-success-validation').css('display', 'inline');
            $('#btn-approve').text('Approve');
            $('.loader').css('display', 'none');
            setTimeout(function(){
              $('.update-success-validation').fadeOut('slow');
              $('#ApprovalModal').modal('toggle');

            },2000);

          },1000);
        }

       });
    }

    $(document).on('click', '#btn-reject-tenant', function(){
     
      $("#confirmationpatientrejectModal").modal('show')
      //reject(id,email);

    });
    
      $(document).on('click', '#btn_confirmpatientreject', function() {
             var id = $('#cust-id-hidden').val();
           $("#confirmationpatientrejectModal").modal('hide')
            reject(id);
      });

    function reject(id,email) {
      $.ajax({
        url:"/verifytenant/reject/"+ id,
        type:"POST",
        data:{
            id:id,
          },
        beforeSend:function(){
            $('#btn-reject-tenant').text('Please wait...');
            $('.loader').css('display', 'inline');
          },
        success:function(data){
            $('.reject-validation').css('display', 'inline');
            $('.loader').css('display', 'none');
            $('#btn-reject-tenant').text('Reject');
            $('#tenant-approval-table').DataTable().ajax.reload();
            setTimeout(function(){
            $('.reject-validation').fadeOut('slow');
            $('#ApprovalModal').modal('toggle');

          },2000);
        }

       });
    }

    function countForValidation() {
      $.ajax({
        url:"/verifycustomer/countforvalidation/",
        type:"GET",

        success:function(data){
          return data;
        }

       });
    }


    $('#btn-bulk-verified').click(function(){

        var user_ids = [];

        $(':checkbox:checked').each(function(i){
          user_ids[i] = $(this).val();
        });

        if(user_ids.length > 0){

            if($('#select-all').is(":checked")){
              //used slice method to start index at 1, so the value of sellect_all checkbox is not included in array
              user_ids = user_ids.slice(1).join(", ");
              console.log(user_ids);
            }
            else{
              user_ids = user_ids.join(", ");
              console.log(user_ids);
            }

            $.ajax({
              url:"/verifycustomer/bulkverified/"+user_ids,
              type:"POST",
              beforeSend:function(){
                $('.loader').css('display', 'inline');
              },
              success:function(){

                setTimeout(function(){
                  $('#for-validation-table').DataTable().ajax.reload();
                  $('#verified-table').DataTable().ajax.reload();
                  $('.loader').css('display', 'none');
                  },1000);

              }
            });
        }
        else{
            alert('Please select a customer!')

        }




    });

});




