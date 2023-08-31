


<div class="modal fade" id="EmployeePropertyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Edit Property</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">



              <div class="row">


                <input type="hidden" id="empcust-id-hidden">

                <input type="hidden" id="empproperty_roomid" name="empproperty_roomid">

                  <div class="col-md-12">
                    <label class="col-form-label">Maintenance</label>
                    <input type="text" class="form-control" name="empmaintenance" id="empmaintenance" readonly>
                    <span class="text-danger" id="brancherror"></span>
                  </div>

                  <div class="col-sm-12 col-md-12 col-lg-12">
                    <label class="col-form-label">Maintenance</label>
                    <select class="form-control" name="empstatus" id="empstatus">
                      <option value="0">Pending</option>
                      <option value="1">Completed</option>
                      <option value="2">Ongoing</option>
                  </select>
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
               <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-sm btn-primary" id="btn-edit-save-empproperty">Update</button>
          </div>
        </form>
        </div>
      </div>
  </div>
</div>

<div class="modal fade" id="EmployeeDeletePropertyModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
             <input type="hidden" id="id_archive">
            <label class="col-form-label">Are you sure you want to delete this maintenance request?</label>
          <p class="delete-message"></p>
        </div>
        <div class="dupdate-success-validation" style="display: none;">
          <span style="margin-left:145px;" class="text-success">Maintenance Delete Successfully!</span>
          </div>
          <div class="existservice-success" style="display: none;">
          <span style="margin-left:180px;" class="text-danger">Room Already Used</span>
          </div>
        <div class="modal-footer">
          <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
          <button class="btn btn-sm btn-outline-dark" type="button" name="ok_button" id="btn_delete_empproperty">Yes</button>
        <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>

        </div>
      </div>
    </div>
  </div>

