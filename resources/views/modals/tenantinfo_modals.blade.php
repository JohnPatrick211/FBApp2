@yield('modals')


  <!--edit  Modal-->
  <div class="modal fade" id="TenantInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Tenant Information</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="row justify-content-center">
                <!--{{ csrf_field() }}-->
                <div class="col-md-2.5 m-auto ">
                    <img class="responsive" id="infoshowprofile" height="200px" width="250px"
                    >
                  </div>
                </div>

                <br/> <br/>

            <div class="row">

              <input type="hidden" name="user_id_hidden" id="euser_id_hidden">

            <div class="col-4 mb-2">
                <label class="col-form-label">First Name</label>
                <input type="text" class="form-control" name="infofname" id="infofname" placeholder="First Name" readonly>
              </div>

              <div class="col-4 mb-2">
                <label class="col-form-label">Middle Name</label>
                <input type="text" class="form-control" name="infomname" id="infomname" placeholder="Middle Name" readonly>
              </div>

              <div class="col-4 mb-2">
                <label class="col-form-label">Last Name</label>
                <input type="text" class="form-control" name="infolname" id="infolname" placeholder="Last Name" readonly>
              </div>

              <div class="col-12 mb-2">
                <label class="col-form-label">Room Number</label>
                <input type="text" class="form-control" name="inforoomnumber" id="inforoomnumber" placeholder="Last Name" readonly>
              </div>

              <div class="col-12">
                <label class="col-form-label">Date of Occupancy</label>
                <input type="text" class="form-control" name="infodateofoccupancy" id="infodateofoccupancy" placeholder="Last Name" readonly>
              </div>

              <div class="col-5">
                  <label class="col-form-label">Email</label>
                  <input type="text" class="form-control" name="infoemail" id="infoemail" readonly>
                </div>

                <div class="col-2">
                    <label class="col-form-label">Age</label>
                    <input type="text" class="form-control" name="infoage" id="infoage"  readonly>
                    <div class="empty-reject-age mr-auto ml-3" style="display: none">
                        <label class="label text-danger">Please input the Age</label>
                       </div>
                  </div>

                  <div class="col-2">
                  <label class="col-form-label">Gender</label>
                  <input type="text" class="form-control" name="infogender" id="infogender" readonly>
                </div>

                <div class="col-3">
                  <label class="col-form-label">Civil Status</label>
                  <input type="text" class="form-control" name="infocivilstatus" id="infocivilstatus" readonly>
                </div>

                <div class="col-6">
                <label class="col-form-label">Birthday</label>
                <input type="text" class="form-control" name="infobirthdate" id="infobirthdate" placeholder="Last Name" readonly>
              </div>

              <div class="col-6">
                <label class="col-form-label">Contact Number</label>
                <input type="text" class="form-control" name="infophone" id="infophone" readonly>
              </div>

              <div class="col-12">
                <label class="col-form-label">Address</label>
                <input type="text" class="form-control" name="infoaddress" id="infoaddress" placeholder="House Number, Street, Barangay, City, Province" readonly>
              </div>

            </div>

        </div>
        <div class="modal-footer">
            <div class="eupdate-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">User is Successfully Updated</label>
               </div>
                   <div class="ereject-validation mr-auto ml-3" style="display: none">
                    <label class="label text-success">Employer Job is Successfully Rejected</label>
                   </div>
                   <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
                <button type="button" class="btn btn-sm btn-secondary" id="ebtn-close" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


