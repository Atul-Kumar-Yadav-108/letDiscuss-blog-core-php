

<!-- Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changePasswordModalLabel">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="controller/loginsignup.php" method="post">
            <div class="modal-body">
                        <div class="mb-3">
                            <label for="changePassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="changePassword" name="changePassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="cChangePassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="cChangePassword" name="cChangePassword" required>
                        </div>
                        <!-- <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div> -->
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="change-pass-submit" id="change-pass-submit">Change Password</button>
            </div>
      </form>
    </div>
  </div>
</div>