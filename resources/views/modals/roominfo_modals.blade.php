
  <!-- Edit Modal -->
  @yield('servicemodal')
<div class="modal fade" id="RoomInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Room Information</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="row">
                {{ csrf_field() }}

                <input type="hidden" id="discount_hidden">

                <div class="col-md-6">
                    <label class="col-form-label">Room Number</label>
                    <input type="text" class="form-control" name="inforoomnumber" id="inforoomnumber" readonly>
                    <span class="text-danger" id="brancherror"></span>
                  </div>

                  <div class="col-sm-12 col-md-6 col-lg-6">
                    <label class="col-form-label">Room Capacity</label>
                     <input type="text" step="1" class="form-control" name="inforoomcapacity" id="inforoomcapacity" min="1" readonly>
                  </div>

                  <div class="col-md-12 mt-4">
                    <div class="card shadow mb-4">
                          <div class="card-body">
                              <div class="table-responsive">
                                  <table class="table table-bordered" id="tenantroom-table" width="100%" cellspacing="0">
                                      <thead>
                                          <tr>
                                              <th>Tenant ID</th>
                                              <th>Full Name</th>
                                              <th>Middle Name</th>
                                              <th>Last Name</th>
                                              <th>Email</th>
                                              <th>Contact Number</th>
                                              <th>Date of Occupancy</th>
                                              <th>Action</th>
                                          </tr>
                                      </thead>
                                  </table>
                              </div>
                          </div>
                      </div>
                   </div>
          </div>
          <br><br>
          <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
  </div>
</div>

<div class="modal fade" id="RoomTenantArchiveModal" tabindex="-1" role="dialog">
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
            <label class="col-form-label">Are you sure you want to remove tenant in this room?</label>
          <p class="delete-message"></p>
        </div>
        <div class="dupdate-success-validation" style="display: none;">
          <span style="margin-left:145px;" class="text-success">Remove Tenant Successfully!</span>
          </div>
          <div class="existservice-success" style="display: none;">
          <span style="margin-left:180px;" class="text-danger">Room Already Used</span>
          </div>
        <div class="modal-footer">
          <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
          <button class="btn btn-sm btn-outline-dark" type="button" name="ok_button" id="btn_archive_tenantroom">Yes</button>
        <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>

        </div>
      </div>
    </div>
  </div>


