<div class="modal fade" id="EditCommentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Edit Comment</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form action="EditComment" method="post" enctype="multipart/form-data">


              <div class="row">
              {{ csrf_field() }}

              {{ method_field('PATCH') }}


                <input type="hidden" name="comment_id" id="comment_id">

                  <div class="col-sm-12 col-md-12 col-lg-12">
                    <label class="col-form-label">Comment</label>
                    <textarea name="editcomment_body" id="editcomment_body" rows="10" cols="30" class="form-control" required ></textarea>
                  </div>
          </div>
          <br><br>
          <div class="modal-footer">
            <div class="update-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">Edit Successfully</label>
               </div>
               <div class="error-capacity mr-auto ml-3" style="display: none">
                <label class="label text-danger">Vacant Beds cannot be less than zero</label>
               </div>
               <div class="error-number mr-auto ml-3" style="display: none">
                <label class="label text-danger">Room Number Already Exist</label>
               </div>
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-sm btn-primary">Edit</button>
          </div>
        </form>
        </div>
      </div>
  </div>
</div>