$(document).ready(function()
{

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
        // show user details
        $(document).on('click', '#btn-show-forum', function()
        {
            let id = $(this).attr('employer-id');
            console.log(id);
            getForumComments(id)
        });

        function getForumComments(id)
        {
            $.ajax({
                url:"show-forum-comment/"+id,
                type:"GET",

                success:function(data){
                    console.log(data);
                    window.location.href = 'http://127.0.0.1:8000/show-forum-comments/' + data;
                }
               });
        }

      

       
});
