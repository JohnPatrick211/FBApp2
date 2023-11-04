@yield('modals')
<!--Add  Modal-->
<div class="modal fade" id="ApprovalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Add user</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">

            <input type="hidden" id="cust-id-hidden">

            <div class="col-4 mb-2">
                  <label class="col-form-label">Last Name</label>
                  <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" readonly>
                  <div class="empty-reject-name mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Please input the last name</label>
                   </div>
                </div> 

              <div class="col-4 mb-2">
                  <label class="col-form-label">First Name</label>
                  <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" readonly>
                  <div class="empty-reject-name mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Please input the first name</label>
                   </div>
                </div>

                <div class="col-4 mb-2">
                  <label class="col-form-label">Middle Name</label>
                  <input type="text" class="form-control" name="mname" id="mname" placeholder="No Middle Name" readonly>
                  <div class="empty-reject-name mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Please input the middle name</label>
                   </div>
                </div>

                <div class="hide-room col-6 mb-2">
                  <label class="col-form-label">Room Number</label>
                  <input type="text" class="form-control" name="room" id="room" placeholder="Last Name" readonly>
                  <div class="empty-reject-room mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Please input the room</label>
                   </div>
                </div>

                <div class="hide-dateofoccupancy col-6">
                  <label class="col-form-label">Date of Occupancy</label>
                  <input type="date" class="form-control" id="dateofoccupancy" name="dateofoccupancy" readonly>
                  <div class="empty-reject-dateofoccupancy mr-auto ml-3" style="display: none">
                        <label class="label text-danger">Please input the Date of Occupancy</label>
                       </div>
                </div>

                <div class="col-5">
                    <label class="col-form-label">Email</label>
                    <input type="text" class="form-control" name="email" id="email"  readonly>
                    <div class="empty-reject-email mr-auto ml-3" style="display: none">
                        <label class="label text-danger">Please input the email</label>
                       </div>
                  </div>

                  <div class="col-2">
                    <label class="col-form-label">Age</label>
                    <input type="text" class="form-control" name="age" id="age">
                    <div class="empty-reject-age mr-auto ml-3" style="display: none">
                        <label class="label text-danger">Please input the Age</label>
                       </div>
                  </div>

                  <div class="col-2">
                  <label class="col-form-label">Gender</label>
                  <input type="text" class="form-control" name="gender" id="gender" readonly>
                </div>

                <div class="col-3">
                  <label class="col-form-label">Civil Status</label>
                  <input type="text" class="form-control" name="civilstatus" id="civilstatus" readonly>
                </div>

                <div class="col-6 hide-contractstart">
                  <label class="col-form-label">Contract Start</label>
                  <input type="date" class="form-control" id="contractstart" name="contractstart" readonly>
                  <div class="empty-reject-birthday mr-auto ml-3" style="display: none">
                        <label class="label text-danger">Please input the birthday</label>
                       </div>
                </div>

                <div class="col-6 hide-contractend">
                  <label class="col-form-label" >Contract End</label>
                  <input type="date" class="form-control" id="contractend" name="contractend" readonly>
                  <div class="empty-reject-birthday mr-auto ml-3" style="display: none">
                        <label class="label text-danger">Please input the birthday</label>
                       </div>
                </div>

                <div class="col-6">
                  <label class="col-form-label">Birthday</label>
                  <input type="date" class="form-control" id="birthdate" name="birthdate" readonly>
                  <div class="empty-reject-birthday mr-auto ml-3" style="display: none">
                        <label class="label text-danger">Please input the birthday</label>
                       </div>
                </div>

                <div class="col-6">
                  <label class="col-form-label">Contact Number</label>
                  <input type="number" class="form-control" name="phone" id="phone" readonly>
                  <div class="empty-reject-phone mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Please input the contact number</label>
                   </div>
                   <div class="reject-phone mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Contact Number must be 11 digits</label>
                   </div>
                </div>

                <div class="col-12">
                  <label class="col-form-label">Address</label>
                  <input type="text" class="form-control" name="address" id="address" placeholder="House Number, Street, Barangay, City/Municipality, Province" readonly>
                  <div class="empty-reject-address mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Please input the address</label>
                   </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <div class="update-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">Tenant is Successfully Approved</label>
               </div>
                   <div class="reject-validation mr-auto ml-3" style="display: none">
                    <label class="label text-danger">User Already Exist</label>
                   </div>
                   <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
                <button type="button" class="btn btn-sm btn-secondary" id="btn-close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-sm btn-danger" id="btn-reject-tenant" >Reject</button>
                <button type="submit" class="btn btn-sm btn-primary" id="btn-approve-tenant" >Approve</button>
        </div>
      </form>
      </div>
    </div>
  </div>


  