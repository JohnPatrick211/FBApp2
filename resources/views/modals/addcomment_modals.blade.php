
  <!-- Edit Modal -->
  @yield('servicemodal')
<div class="modal fade" id="AddCommentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Add Comment</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form action="AddComment" method="POST" enctype="multipart/form-data">

              <div class="row">
                {{ csrf_field() }}

                <input type="hidden" id="parent_id" name="parent_id" value="{{$forums->forum_id}}">

                  <div class="col-sm-12 col-md-12 col-lg-12">
                    <label class="col-form-label">Comment</label>
                    <textarea name="comment_body" rows="10" cols="30" class="form-control" required></textarea>
                  </div>
          </div>
          <br><br>
          <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-sm btn-primary" id="btn-add-job">Add</button>
          </div>
        </form>
        </div>
      </div>
  </div>
</div>



