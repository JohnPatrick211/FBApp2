$(document).ready(function()
{

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

    fetchProperty();
    fetchEmployeeProperty();

    function fetchProperty(){
        $('#property-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"tenantproperty-maintenance/property",

           columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'MAIN-'+data;
            }
         }, {
          targets: 3,
          orderable: true,
          changeLength: true,
          className: 'dt-body-center',
          render: function (data, type, full, meta){
            if(data == 1){
                return 'Completed'
            }
            else if(data == 0){
                return 'Pending'
            }
            else{
                return 'Ongoing'
            }
          }
       }],


           columns:[
            {data: 'maintenance_id', name: 'maintenance_id'},
            {data: 'roomnumber', name: 'roomnumber'},
            {data: 'maintenance_desc', name: 'maintenance_desc'},
            {data: 'maintenance_status', name: 'maintenance_status'},
            {data: 'action', name: 'action', orderable:false}
           ]

          });

       }

       function fetchEmployeeProperty(){
        $('#employeeproperty-table').DataTable({

           processing: true,
           serverSide: true,

           ajax:"employeeproperty-maintenance/property",

           columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: true,
            changeLength: true,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return 'MAIN-'+data;
            }
         }, {
          targets: 3,
          orderable: true,
          changeLength: true,
          className: 'dt-body-center',
          render: function (data, type, full, meta){
            if(data == 1){
                return 'Completed'
            }
            else if(data == 0){
                return 'Pending'
            }
            else{
                return 'Ongoing'
            }
          }
       }],


           columns:[
            {data: 'maintenance_id', name: 'maintenance_id'},
            {data: 'roomnumber', name: 'roomnumber'},
            {data: 'maintenance_desc', name: 'maintenance_desc'},
            {data: 'maintenance_status', name: 'maintenance_status'},
            {data: 'action', name: 'action', orderable:false}
           ]

          });

       }
       
       $('#maintenance').change(function()
       {
         let maintenance = $('#maintenance').val()
         if(maintenance == 'Others')
         {
          var test = $('#others').val('');
          $('.hide-others').css('display', 'inline');
         }
         else
         {
          var test = $('#others').val('none');
          $('.hide-others').css('display', 'none');
          console.log(test)
         }
       });
       
      //  $('#emaintenance').change(function()
      //  {
      //    let maintenance = $('#emaintenance').val()
      //    if(maintenance == 'Others')
      //    {
      //     var test = $('#eothers').val('');
      //     $('.ehide-others').css('display', 'inline');
      //    }
      //    else
      //    {
      //     var test = $('#eothers').val('none');
      //     $('.ehide-others').css('display', 'none');
      //     console.log(test)
      //    }
      //  });
       
       $('#empmaintenance').change(function()
       {
         let maintenance = $('#empmaintenance').val()
         if(maintenance == 'Others')
         {
          var test = $('#empothers').val('');
          $('.ehide-others').css('display', 'inline');
         }
         else
         {
          var test = $('#empothers').val('none');
          $('.ehide-others').css('display', 'none');
          console.log(test)
         }
       }); 

       // show property details
        $(document).on('click', '#btn-edit-property', function()
        {
            let maintenance = $('#emaintenance').val()
              if(maintenance == 'Others')
              {
                var test = $('#eothers').val('');
                $('.ehide-others').css('display', 'inline');
              }
              else
              {
                var test = $('#eothers').val('none');
                $('.ehide-others').css('display', 'none');
                console.log('nope')
              }
            let id = $(this).attr('employer-id');
            console.log(id);
            getPropertyDetails(id);
        });

        $(document).on('click', '#btn-edit-empproperty', function()
        {
            let id = $(this).attr('employer-id');
            console.log(id);
            getEmpPropertyDetails(id);
        });

        function getPropertyDetails(id)
        {
            $.ajax({
                url:"property-maintenance-details/"+id,
                type:"GET",

                success:function(data){
                    console.log(data);
                    $('#ecust-id-hidden').val(id);
                    $('#eproperty_roomid').val(data[0].room_id);
                    if(data[0].maintenance_desc == 'Carpenter' || data[0].maintenance_desc == 'Plumber' || data[0].maintenance_desc == 'Electrician')
                    {
                        // var test = $('#eothers').val('');
                        document.getElementById("emaintenance").value = data[0].maintenance_desc;
                        var test = $('#eothers').val('none');
                        $('.ehide-others').css('display', 'none');
                        // $('.ehide-others').css('display', 'inline');
                        console.log('success')
                    }
                    else
                    {
                        document.getElementById("emaintenance").value = 'Others';
                         $('.ehide-others').css('display', 'inline');
                         $('#eothers').val(data[0].maintenance_desc);
                        // document.getElementById("ebranch").value = data[0].branch_id;
                        // $('.ehide-others').css('display', 'none');
                        // console.log(test)
                        console.log('failed')
                    }
                }
               });
        }

        function getEmpPropertyDetails(id)
        {
            $.ajax({
                url:"empproperty-maintenance-details/"+id,
                type:"GET",

                success:function(data){
                    console.log(data);
                    $('#empcust-id-hidden').val(id);
                    $('#empproperty_roomid').val(data[0].room_id);
                    $('#empmaintenance').val(data[0].maintenance_desc);
                    
                        // var test = $('#eothers').val('');
                        document.getElementById("empstatus").value = data[0].maintenance_status;
                }
               });
        }

            $(document).on('click', '#btn-edit-save-property', function()
            {
                var id =  $('#ecust-id-hidden').val();
                var room_id = $('#eproperty_roomid').val();
                var maintenance = $('#emaintenance').val();
                var others = $('#eothers').val();
                var form = new FormData()
                form.append('id', id)
                form.append('room_id', room_id)
                form.append('maintenance', maintenance)
                form.append('others', others)

                edit(form)
            });

            $(document).on('click', '#btn-edit-save-empproperty', function()
            {
                var id =  $('#empcust-id-hidden').val();
                var room_id = $('#empproperty_roomid').val();
                var status = $('#empstatus').val();
                var form = new FormData()
                form.append('id', id)
                form.append('room_id', room_id)
                form.append('status', status)

                editemp(form)
            });

            function edit(form) {
            $.ajax({
              url:"property/editproperty",
              type:"POST",
              data:form,
                cache: false,
                contentType: false,
                processData: false,
              beforeSend:function(){
                  $('#btn-edit-save-property').text('Please wait...');
                  $('.loader').css('display', 'inline');
                },
              success:function(data){
                console.log(data);   
                    $('.update-success-validation').css('display', 'inline');
                    $('.loader').css('display', 'none');
                    $('#btn-edit-save-property').text('Edit');
                    $('#property-table').DataTable().ajax.reload();
                    setTimeout(function(){
                    $('.update-success-validation').fadeOut('slow');
                    $('#EditPropertyModal').modal('toggle');
                  },2000);
                  
              }

             });

            }

            function editemp(form) {
              $.ajax({
                url:"empproperty/empeditproperty",
                type:"POST",
                data:form,
                  cache: false,
                  contentType: false,
                  processData: false,
                beforeSend:function(){
                    $('#btn-edit-save-empproperty').text('Please wait...');
                    $('.loader').css('display', 'inline');
                  },
                success:function(data){
                  console.log(data);   
                      $('.update-success-validation').css('display', 'inline');
                      $('.loader').css('display', 'none');
                      $('#btn-edit-save-empproperty').text('Update');
                      $('#employeeproperty-table').DataTable().ajax.reload();
                      setTimeout(function(){
                      $('.update-success-validation').fadeOut('slow');
                      $('#EmployeePropertyModal').modal('toggle');
                    },2000);
                    
                }
  
               });
  
              }

        $(document).on('click', '#btn-delete-property', function()
        {
            let id = $(this).attr('employer-id');
            console.log(id);
            $('#id_archive').val(id);
        });

        $(document).on('click', '#btn-delete-empproperty', function()
        {
            let id = $(this).attr('employer-id');
            console.log(id);
            $('#id_archive').val(id);
        });

        $(document).on('click', '#btn_delete_property', function(){
            var id = $('#id_archive').val();
            console.log(id);

           Delete(id);

         });

         $(document).on('click', '#btn_delete_empproperty', function(){
          var id = $('#id_archive').val();
          console.log(id);

         empDelete(id);

       });

          function Delete(id) {
            $.ajax({
              url:"property-maintenance/deleteproperty/"+ id,
              type:"POST",
              data:{
                  id:id,
                },
                beforeSend:function(){
                    $('#btn_delete_property').text('Please wait...');
                    $('.loader').css('display', 'inline');
                  },
                success:function(data){
                    $('.dupdate-success-validation').css('display', 'inline');
                    $('.loader').css('display', 'none');
                    $('#btn_delete_property').text('Yes');
                    $('#property-table').DataTable().ajax.reload();
                    setTimeout(function(){
                    $('.dupdate-success-validation').fadeOut('slow');
                    $('#DeletePropertyModal').modal('toggle');

                },2000);
              }

             });
          }

          function empDelete(id) {
            $.ajax({
              url:"empproperty-maintenance/deleteproperty/"+ id,
              type:"POST",
              data:{
                  id:id,
                },
                beforeSend:function(){
                    $('#btn_delete_empproperty').text('Please wait...');
                    $('.loader').css('display', 'inline');
                  },
                success:function(data){
                    $('.dupdate-success-validation').css('display', 'inline');
                    $('.loader').css('display', 'none');
                    $('#btn_delete_empproperty').text('Yes');
                    $('#employeeproperty-table').DataTable().ajax.reload();
                    setTimeout(function(){
                    $('.dupdate-success-validation').fadeOut('slow');
                    $('#EmployeeDeletePropertyModal').modal('toggle');

                },2000);
              }

             });
          }


    //     $(document).on('click', '#btn-edit-save-room', function(){
    //         var id = $('#ecust-id-hidden').val();
    //         var roomnumber = $('#eroomnumber').val();
    //         var roomcapacity = $('#eroomcapacity').val();
    //         var form = new FormData()
    //         form.append('id', id)
    //         form.append('roomnumber', roomnumber)
    //         form.append('roomcapacity', roomcapacity)

    //         edit(form)

    //     function edit(form) {
    //         $.ajax({
    //           url:"room/editroom/",
    //           type:"POST",
    //           data:form,
    //             cache: false,
    //             contentType: false,
    //             processData: false,
    //           beforeSend:function(){
    //               $('#btn-edit-save-room').text('Please wait...');
    //               $('.loader').css('display', 'inline');
    //             },
    //           success:function(data){
    //             console.log(data);
    //             if(data == 0){
    //                 $('.error-capacity').css('display', 'inline');
    //                 $('.loader').css('display', 'none');
    //                 $('#btn-edit-save-room').text('Edit');
    //                 $('#room-table').DataTable().ajax.reload();
    //                 setTimeout(function(){
    //                 $('.error-capacity').fadeOut('slow');
    //               },2000);
    //             }
    //             else if(data == 1){
    //               $('.error-number').css('display', 'inline');
    //                 $('.loader').css('display', 'none');
    //                 $('#btn-edit-save-room').text('Edit');
    //                 $('#room-table').DataTable().ajax.reload();
    //                 setTimeout(function(){
    //                 $('.error-number').fadeOut('slow');
    //               },2000);
    //             }
    //             else{
    //                 $('.update-success-validation').css('display', 'inline');
    //                 $('.loader').css('display', 'none');
    //                 $('#btn-edit-save-room').text('Edit');
    //                 $('#room-table').DataTable().ajax.reload();
    //                 setTimeout(function(){
    //                 $('.update-success-validation').fadeOut('slow');
    //                 $('#EditRoomModal').modal('toggle');
    //               },2000);
    //             }
                  
    //           }

    //          });
    //       }

    //       function editwithoutpassword(form) {
    //         $.ajax({
    //           url:"usermaintenance/edituserwithoutpassword/",
    //           type:"POST",
    //           data:form,
    //           cache: false,
    //             contentType: false,
    //             processData: false,
    //           beforeSend:function(){
    //               $('#ebtn-update').text('Please wait...');
    //               $('.loader').css('display', 'inline');
    //             },
    //           success:function(data){
    //             console.log(data);
    //               $('.eupdate-success-validation').css('display', 'inline');
    //               $('.loader').css('display', 'none');
    //               $('#ebtn-update').text('Edit');
    //               $('#admin-table').DataTable().ajax.reload();
    //               $('#tenant-table').DataTable().ajax.reload();
    //               $('#employee-table').DataTable().ajax.reload();
    //               setTimeout(function(){
    //               $('.eupdate-success-validation').fadeOut('slow');
    //               $("#eprofilepic").val('');
    //               $('#editUserModal').modal('toggle');

    //             },2000);
    //           }

    //          });
    //       }

    //    });
});
