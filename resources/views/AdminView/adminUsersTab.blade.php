<style>
  #user_staff_wrapper>div:first-child {
    background-color: #318791;
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
    color: white;
  }
</style>
<div class="p-3">
  <h4>User Access</h4>
</div>
<div>
  <!-- userModal Start -->
  <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="userModalLabel">User Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- User details form goes here -->
          <form>
            <div class="mb-3">
              <label for="userName" class="form-label">Username</label>
              <input type="text" class="form-control" id="userName" value="DOST_SETUP-Polyo">
            </div>
            <!-- Add more fields as needed -->
          </form>
        </div>
        <div class="modal-footer">
          <h6>Action To Perform:</h6>
          <button class="btn btn-primary">Toggle Acess</button>
          <button class="btn btn-danger">Delete</button>
        </div>
      </div>
    </div>
  </div>
  <!-- userModal end -->
  <!-- Add User Modal -->
  <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="addUserModalLabel">Add User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- User details form goes here -->
          <form>
            <div class="mb-3">
              <label for="userName" class="form-label">Username</label>
              <input type="text" class="form-control" id="userName">
            </div>
            <!-- Add more fields as needed -->
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Add</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Add User Modal end -->
  <div class="py-4 bg-white rounded-5">
    <div class="d-flex justify-content-end">
      <button type="button" class="btn btn-primary" id="addUserModal" data-bs-toggle="modal" data-bs-target="#addUserModal">
        Add user
      </button>
    </div>
    <div class="mx-2">
      <table id="user_staff" class="table table-hover mx-2" style="width:100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Password</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="tableBody">
          <tr>
            <td>1</td>
            <td>Pol You</td>
            <td>DOST_SETUP-Polyo</td>
            <td>43y5uiy3uiy88t78uiqy58yuikjqhjkhjkhq475y78uhjhfhwfg74792jtg8934258uihg</td>
            <td><strong>has access</strong></td>
            <td>
              <button type="button" class="btn" id="userModal" data-bs-toggle="modal" data-bs-target="#userModal">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="30" height="30">
                  <path d="M56.177,16.832c-0.547-4.731-4.278-8.462-9.009-9.009C43.375,7.384,38.264,7,32,7S20.625,7.384,16.832,7.823c-4.731,0.547-8.462,4.278-9.009,9.009C7.384,20.625,7,25.736,7,32s0.384,11.375,0.823,15.168c0.547,4.731,4.278,8.462,9.009,9.009C20.625,56.616,25.736,57,32,57s11.375-0.384,15.168-0.823c4.731-0.547,8.462-4.278,9.009-9.009C56.616,43.375,57,38.264,57,32S56.616,20.625,56.177,16.832z M36,32c0,2.209-1.791,4-4,4s-4-1.791-4-4s1.791-4,4-4S36,29.791,36,32z M36,45c0,2.209-1.791,4-4,4s-4-1.791-4-4s1.791-4,4-4S36,42.791,36,45z M36,19c0,2.209-1.791,4-4,4s-4-1.791-4-4s1.791-4,4-4S36,16.791,36,19z" fill="#000000" />
                </svg>
              </button>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>Michele Sam</td>
            <td>DOST_SETUP-MicheleSam</td>
            <td>fhjkahhu4uhfhjhjhajshjfhuu4888qkkffhbqjjeruuakkfjeueuqiogkhadhgjhjhue</td>
            <td><strong>no access</strong></td>
            <td>
              <button type="button" class="btn" id="userModal" data-bs-toggle="modal" data-bs-target="#handleProjectModal" disabled>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="30" height="30">
                  <path d="M56.177,16.832c-0.547-4.731-4.278-8.462-9.009-9.009C43.375,7.384,38.264,7,32,7S20.625,7.384,16.832,7.823c-4.731,0.547-8.462,4.278-9.009,9.009C7.384,20.625,7,25.736,7,32s0.384,11.375,0.823,15.168c0.547,4.731,4.278,8.462,9.009,9.009C20.625,56.616,25.736,57,32,57s11.375-0.384,15.168-0.823c4.731-0.547,8.462-4.278,9.009-9.009C56.616,43.375,57,38.264,57,32S56.616,20.625,56.177,16.832z M36,32c0,2.209-1.791,4-4,4s-4-1.791-4-4s1.791-4,4-4S36,29.791,36,32z M36,45c0,2.209-1.791,4-4,4s-4-1.791-4-4s1.791-4,4-4S36,42.791,36,45z M36,19c0,2.209-1.791,4-4,4s-4-1.791-4-4s1.791-4,4-4S36,16.791,36,19z" fill="#000000" />
                </svg>
              </button>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Password</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('#user_staff').DataTable(); // Then initialize DataTables
  });
</script>