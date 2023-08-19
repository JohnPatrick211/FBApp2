
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });


      fetchCommentAndSuggestion();
     
      function fetchCommentAndSuggestion(){
        $('#comment-and-suggestion-table').DataTable({
       
          processing: true,
          serverSide: true,
  
          ajax:{
            url: "/utilities/comment-and-suggestion",
  
          }, 
  
          columns:[    
           {data: 'fullname', name: 'fullname'},   
           {data: 'comment', name: 'comment'},  
           {data: 'suggestion', name: 'suggestion'},   
           {data: 'created_at', name: 'created_at'},
          ]
          
         });
      }



  });
    
    
    
    
    