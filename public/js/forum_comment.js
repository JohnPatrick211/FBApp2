$(document).ready(function()
{

  $('#forum-table').DataTable();
  
  

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
        //show user details
        $(document).on('click', '#editcomment', function()
        {
            let id = $(this).attr('comment-id');
            //let commentbody = $(this).attr('comment-body');
            $('#comment_id').val(id);
            getCommentInfo(id)
        });

        $(document).on('click', '#deletecomment', function()
        {
            let id = $(this).attr('comment-id');
            //let commentbody = $(this).attr('comment-body');
            $('#forcommentdelete').val(id);
        });

        function getCommentInfo(id)
        {
            $.ajax({
                url:"getcomment/"+id,
                type:"GET",

                success:function(data){
                    console.log(data);
                    $('#editcomment_body').val(data[0].comment_body);
                }
               });
        }

      

       
});
