
<!-- Add Service -->
  <!--Confirm Modal-->
  <div class="modal fade" id="DeleteCommentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="DeleteComment" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

        {{ method_field('PATCH') }}

             <input type="hidden" id="forcommentdelete" name="forcommentdelete">
            <label class="col-form-label">Are you sure you want to delete this comment?</label>
          <p class="delete-message"></p>
        </div>
        <div class="dupdate-success-validation" style="display: none;">
          <span style="margin-left:145px;" class="text-success">Room Archive Successfully!</span>
          </div>
          <div class="existservice-success" style="display: none;">
          <span style="margin-left:180px;" class="text-danger">Room Already Used</span>
          </div>
        <div class="modal-footer">
          <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
          <button class="btn btn-sm btn-outline-dark" type="submit" name="ok_button" >Yes</button>
        <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>

        </div>
      </div>
    </div>
    </form>
  </div>


  