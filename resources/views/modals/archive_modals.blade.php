<div class="modal fade" id="retrieveAdminModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to retrieve this Admin account?</p>
        </div>
        {{-- <form action="{{ action('Utilities\ArchiveCtr@retrieve') }}" method="POST">
          @csrf --}}
        <input type="hidden" id="id_retrieve" name="id_retrieve">
        <div class="modal-footer">
            <div class="archiveupdate-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">Admin Account is Successfully Retrieved</label>
               </div>
                   <div class="archivereject-validation mr-auto ml-3" style="display: none">
                    <label class="label text-success">Error, Please try again</label>
                   </div>
                   <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
          <button class="btn btn-sm btn-outline-dark" type="submit" id="btn_retrieve_admin">Yes</button>
          <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="retrieveEmployeeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to retrieve this Employee account?</p>
        </div>
        {{-- <form action="{{ action('Utilities\ArchiveCtr@retrieve') }}" method="POST">
          @csrf --}}
        <input type="hidden" id="id_retrieve" name="id_retrieve">
        <div class="modal-footer">
            <div class="archiveupdate-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">Employee Account is Successfully Retrieved</label>
               </div>
                   <div class="archivereject-validation mr-auto ml-3" style="display: none">
                    <label class="label text-success">Error, Please try again</label>
                   </div>
                   <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
          <button class="btn btn-sm btn-outline-dark" type="submit" id="btn_retrieve_employee">Yes</button>
          <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="retrieveTenantModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to retrieve this Tenant Account?</p>
        </div>
        {{-- <form action="{{ action('Utilities\ArchiveCtr@retrieve') }}" method="POST">
          @csrf --}}
        <input type="hidden" id="id_retrieve" name="id_retrieve">
        <div class="modal-footer">
            <div class="archiveupdate-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">Tenant Account is Successfully Retrieved</label>
               </div>
                   <div class="archivereject-validation mr-auto ml-3" style="display: none">
                    <label class="label text-success">Error, Please try again</label>
                   </div>
                   <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
          <button class="btn btn-sm btn-outline-dark" type="submit" id="btn_retrieve_tenant">Yes</button>
          <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="retrieveRoomModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to retrieve this Room?</p>
        </div>
        {{-- <form action="{{ action('Utilities\ArchiveCtr@retrieve') }}" method="POST">
          @csrf --}}
        <input type="hidden" id="id_retrieve" name="id_retrieve">
        <div class="modal-footer">
            <div class="archiveupdate-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">Room is Successfully Retrieved</label>
               </div>
                   <div class="archivereject-validation mr-auto ml-3" style="display: none">
                    <label class="label text-success">Error, Please try again</label>
                   </div>
                   <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
          <button class="btn btn-sm btn-outline-dark" type="submit" id="btn_retrieve_room">Yes</button>
          <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="retrieveSecretaryModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to retrieve this Secretary?</p>
        </div>
        {{-- <form action="{{ action('Utilities\ArchiveCtr@retrieve') }}" method="POST">
          @csrf --}}
        <input type="hidden" id="id_retrieve" name="id_retrieve">
        <div class="modal-footer">
            <div class="archiveupdate-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">Secretary Account is Successfully Retrieved</label>
               </div>
                   <div class="archivereject-validation mr-auto ml-3" style="display: none">
                    <label class="label text-success">Error, Please try again</label>
                   </div>
                   <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
          <button class="btn btn-sm btn-outline-dark" type="submit" id="btn_retrieve_secretary">Yes</button>
          <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="retrieveStaffModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to retrieve this Staff?</p>
        </div>
        {{-- <form action="{{ action('Utilities\ArchiveCtr@retrieve') }}" method="POST">
          @csrf --}}
        <input type="hidden" id="id_retrieve" name="id_retrieve">
        <div class="modal-footer">
            <div class="archiveupdate-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">Staff Account is Successfully Retrieved</label>
               </div>
                   <div class="archivereject-validation mr-auto ml-3" style="display: none">
                    <label class="label text-success">Error, Please try again</label>
                   </div>
                   <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
          <button class="btn btn-sm btn-outline-dark" type="submit" id="btn_retrieve_staff">Yes</button>
          <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
        </form>
        </div>
      </div>
    </div>
  </div>