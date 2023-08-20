$('#rule').summernote({
    height: 450,
});

$(document).ready(function()
{

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

    $('#rule').summernote({
        height: 450,
    });

    var id = 1;

    fetchRule(id);

    function fetchRule(id)
    {
        $.ajax({
            url:"rule-maintenance-details/"+id,
            type:"GET",

            success:function(data){
                console.log(data);
                $('#editid').val(id);
                $('#rule').summernote('code', data[0].description);
               
                
            }
           });
    }
    

       
});
