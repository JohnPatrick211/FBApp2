@yield('modals')
<!--Add  Modal-->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Add user</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="row justify-content-center">
                <!--{{ csrf_field() }}-->
                <div class="col-md-2.5 m-auto ">
                    <img class="responsive" id="addshowprofile" height="200px" width="250px"
                    >
                  </div>
                </div>

                <br/> <br/>
          
        <form action="AddUser" method="POST" enctype="multipart/form-data">
            <div class="row">
            {{ csrf_field() }}
              <div class="col-3">
                  <label class="col-form-label">User type</label>
                  <select class="form-control" name="user_type" id="user_type">
                      <option value="Employee">Employee</option>
                      <option value="Tenant">Tenant</option>
                      <option value="System Admin">System Admin</option>
                  </select>
                </div>

              <div class="col-3 mb-2">
                  <label class="col-form-label">First Name</label>
                  <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" required>
                  <div class="empty-reject-name mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Please input the first name</label>
                   </div>
                </div>

                <div class="col-3 mb-2">
                  <label class="col-form-label">Middle Name</label>
                  <input type="text" class="form-control" name="mname" id="mname" placeholder="Middle Name">
                  <div class="empty-reject-name mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Please input the middle name</label>
                   </div>
                </div>

                <div class="col-3 mb-2">
                  <label class="col-form-label">Last Name</label>
                  <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" required>
                  <div class="empty-reject-name mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Please input the last name</label>
                   </div>
                </div>

                <div class="hide-room col-12 mb-2" style="display: none">
                  <label class="col-form-label">Room Number</label>
                  <select class="form-control" name="room" id="room">
                  @foreach($users4 as $item)
                      <option value="{{$item->id}}">{{$item->roomnumber}}</option>
                  @endforeach
                  </select>
                  <div class="empty-reject-room mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Please input the room</label>
                   </div>
                </div>

                <div class="hide-dateofoccupancy col-12" style="display: none">
                  <label class="col-form-label">Date of Occupancy</label>
                  <input type="date" class="form-control" id="dateofoccupancy" name="dateofoccupancy">
                  <div class="empty-reject-dateofoccupancy mr-auto ml-3" style="display: none">
                        <label class="label text-danger">Please input the Date of Occupancy</label>
                       </div>
                </div>

                <div class="col-5">
                    <label class="col-form-label">Email</label>
                    <input type="text" class="form-control" name="email" id="email"  required>
                    <div class="empty-reject-email mr-auto ml-3" style="display: none">
                        <label class="label text-danger">Please input the email</label>
                       </div>
                  </div>

                  <div class="col-2">
                    <label class="col-form-label">Age</label>
                    <input type="text" class="form-control" name="age" id="age"  required>
                    <div class="empty-reject-age mr-auto ml-3" style="display: none">
                        <label class="label text-danger">Please input the Age</label>
                       </div>
                  </div>

                  <div class="col-2">
                  <label class="col-form-label">Gender</label>
                  <select class="form-control" name="gender" id="gender" required>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                  </select>
                </div>

                <div class="col-3">
                  <label class="col-form-label">Civil Status</label>
                  <select class="form-control" name="civilstatus" id="civilstatus" required>
                      <option value="Single">Single</option>
                      <option value="Married">Married</option>
                      <option value="Widowed">Widowed</option>
                      <option value="Separated">Separated</option>
                      <option value="Divorced">Divorced</option>
                  </select>
                </div>

                <div class="col-6 hide-contractstart" style="display: none">
                  <label class="col-form-label">Contract Start</label>
                  <input type="date" class="form-control" id="contractstart" name="contractstart" >
                  <div class="empty-reject-birthday mr-auto ml-3" style="display: none">
                        <label class="label text-danger">Please input the birthday</label>
                       </div>
                </div>

                <div class="col-6 hide-contractend" style="display: none">
                  <label class="col-form-label" >Contract End</label>
                  <input type="date" class="form-control" id="contractend" name="contractend">
                  <div class="empty-reject-birthday mr-auto ml-3" style="display: none">
                        <label class="label text-danger">Please input the birthday</label>
                       </div>
                </div>

                <div class="col-6">
                  <label class="col-form-label">Birthday</label>
                  <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                  <div class="empty-reject-birthday mr-auto ml-3" style="display: none">
                        <label class="label text-danger">Please input the birthday</label>
                       </div>
                </div>

                <div class="col-6">
                  <label class="col-form-label">Contact Number</label>
                  <input type="number" class="form-control" name="phone" id="phone" required>
                  <div class="empty-reject-phone mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Please input the contact number</label>
                   </div>
                   <div class="reject-phone mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Contact Number must be 11 digits</label>
                   </div>
                </div>

                <div class="col-12">
                  <label class="col-form-label">Address</label>
                  <input type="text" class="form-control" name="address" id="address" placeholder="House Number, Street, Barangay, City/Municipality, Province" required>
                  <div class="empty-reject-address mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Please input the address</label>
                   </div>
                </div>
                <br/><br/><br/><br/>
                <div class="col-12">
                        <label class="label-small">Profile Picture</label>
                        <input type="file"  name="profilepic" id="profilepic" enctype="multipart/form-data" required="true">
                </div>

                <div class="col-6 mb-2">
                    <label class="col-form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                    <div class="empty-reject-username mr-auto ml-3" style="display: none">
                        <label class="label text-danger">Please input the username</label>
                       </div>
                  </div>

                <div class="col-6 mb-2">
                  <label class="col-form-label">Password</label>
                  <input type="password" class="form-control" name="password" id="password" onkeyup='check4();' required>
                  <div class="reject-password mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Password must be 8 characters</label>
                   </div>
                   <div class="empty-reject-password mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Please input the password</label>
                   </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <div class="update-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">User is Successfully Created</label>
               </div>
                   <div class="reject-validation mr-auto ml-3" style="display: none">
                    <label class="label text-danger">User Already Exist</label>
                   </div>
                   <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
                <button type="button" class="btn btn-sm btn-secondary" id="btn-close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-sm btn-primary" id="btn-save-user" >Save</button>
        </div>
      </form>
      </div>
    </div>
  </div>


  <!--edit  Modal-->
  <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Edit user</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="row justify-content-center">
                <!--{{ csrf_field() }}-->
                <div class="col-md-2.5 m-auto ">
                    <img class="responsive" id="showprofile" height="200px" width="250px"
                    >
                  </div>
                </div>

                <br/> <br/>

            <div class="row">

              <input type="hidden" name="user_id_hidden" id="euser_id_hidden">

              <div class="col-3">
                <label class="col-form-label">User type</label>
                <p id="euser_type"></p>
              </div>

            <div class="col-3 mb-2">
                <label class="col-form-label">First Name</label>
                <input type="text" class="form-control" name="fname" id="efname" placeholder="First Name" required>
              </div>

              <div class="col-3 mb-2">
                <label class="col-form-label">Middle Name</label>
                <input type="text" class="form-control" name="mname" id="emname" placeholder="Middle Name">
              </div>

              <div class="col-3 mb-2">
                <label class="col-form-label">Last Name</label>
                <input type="text" class="form-control" name="lname" id="elname" placeholder="Last Name" required>
              </div>

              <div class="ehide-room col-12 mb-2" style="display: none">
                  <label class="col-form-label">Room Number</label>
                  <select class="form-control" name="eroom" id="eroom" >
                  @foreach($users5 as $item)
                      <option value="{{$item->id}}">{{$item->roomnumber}}</option>
                  @endforeach
                  </select>
                  <div class="empty-reject-room mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Please input the Room Number</label>
                   </div>
                </div>

                <div class="ehide-dateofoccupancy col-12" style="display: none">
                  <label class="col-form-label">Date of Occupancy</label>
                  <input type="date" class="form-control" id="edateofoccupancy" name="edateofoccupancy">
                  <div class="empty-reject-dateofoccupancy mr-auto ml-3" style="display: none">
                        <label class="label text-danger">Please input the Date of Occupancy</label>
                       </div>
                </div> 

              <div class="col-5">
                  <label class="col-form-label">Email</label>
                  <input type="text" class="form-control" name="email" id="eemail" required>
                </div>

                <div class="col-2">
                    <label class="col-form-label">Age</label>
                    <input type="text" class="form-control" name="age" id="eage"  required>
                    <div class="empty-reject-age mr-auto ml-3" style="display: none">
                        <label class="label text-danger">Please input the Age</label>
                       </div>
                  </div>

                  <div class="col-2">
                  <label class="col-form-label">Gender</label>
                  <select class="form-control" name="gender" id="egender">
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                  </select>
                </div>

                <div class="col-3">
                  <label class="col-form-label">Civil Status</label>
                  <select class="form-control" name="civilstatus" id="ecivilstatus">
                      <option value="Single">Single</option>
                      <option value="Married">Married</option>
                      <option value="Widowed">Widowed</option>
                      <option value="Separated">Separated</option>
                      <option value="Divorced">Divorced</option>
                  </select>
                </div>

                <div class="col-6 ehide-contractstart" style="display: none">
                  <label class="col-form-label">Contract Start</label>
                  <input type="date" class="form-control" id="econtractstart" name="econtractstart">
                  <div class="empty-reject-birthday mr-auto ml-3" style="display: none">
                        <label class="label text-danger">Please input the birthday</label>
                       </div>
                </div>

                <div class="col-6 ehide-contractend" style="display: none">
                  <label class="col-form-label" >Contract End</label>
                  <input type="date" class="form-control" id="econtractend" name="econtractend">
                  <div class="empty-reject-birthday mr-auto ml-3" style="display: none">
                        <label class="label text-danger">Please input the birthday</label>
                       </div>
                </div>

                <div class="col-6">
                  <label class="col-form-label">Birthday</label>
                  <input type="date" class="form-control" id="ebirthdate" placeholder="ebirthdate" required>
                </div>

              <div class="col-6">
                <label class="col-form-label">Contact Number</label>
                <input type="text" class="form-control" name="phone" id="ephone" required>
              </div>

              <div class="col-12">
                <label class="col-form-label">Address</label>
                <input type="text" class="form-control" name="address" id="eaddress" placeholder="House Number, Street, Barangay, City, Province" required>
              </div>
              <br/><br/><br/><br/>
              <div class="col-12">
                        <label class="label-small">Profile Picture</label>
                        <input type="file"  name="eprofilepic" id="eprofilepic" enctype="multipart/form-data">
                </div>

              <div class="col-6 mb-2">
                  <label class="col-form-label">Username</label>
                  <input type="text" class="form-control" name="username" id="eusername" required>
                </div>

              <div class="col-6 mb-2">
                <label class="col-form-label">New Password</label>
                <input type="password" class="form-control" name="password" id="epassword" >
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
                <button type="submit" class="btn btn-sm btn-primary" id="ebtn-update" >Update</button>
        </div>
      </div>
    </div>
  </div>


    <!--Confirm Modal-->
    <div class="modal fade" id="archiveModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Are you sure do you want to archive this user?</p>
          </div>
          <input type="hidden" id="id_archive" name="id_archive">
          <input type="hidden" id="user_type_archive" name="user_type_archive">
          <div class="modal-footer">
            <div class="dupdate-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">User is Successfully Archived</label>
               </div>
                   <div class="dreject-validation mr-auto ml-3" style="display: none">
                    <label class="label text-success">Employer Job is Successfully Rejected</label>
                   </div>
                   <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
            <button class="btn btn-sm btn-outline-dark" type="submit" id="btn_archive_user">Yes</button>
            <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>

    <script>
      var check4 = function() {
        if (document.getElementById('password').value.trim().length <=
        7) {
          $('.reject-password').css('display', 'inline');
          document.getElementById('btn-save-user').disabled = true;
        }else{
          $('.reject-password').css('display', 'none');
          document.getElementById('btn-save-user').disabled = false;
          }     
    }
    </script>


