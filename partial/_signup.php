

<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Signup</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="controller/loginsignup.php" method="post">
            <div class="modal-body">
                        <div class="mb-3">
                            <label for="signupemail" class="form-label">Email address</label>
                            <input type="email" class="form-control" name="signupemail" id="signupemail" aria-describedby="emailHelp" required>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="signupusername" class="form-label">Username</label>
                            <input type="text" class="form-control" name="signupusername" id="signupusername" minlength="3" maxlength="15" required>
                        </div>
                        <div class="mb-3">
                            <label for="singuppassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="singuppassword" name="singuppassword" minlength="8" maxlength="20" required>
                        </div>
                        <div class="mb-3">
                            <label for="csinguppassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="csinguppassword" name="csinguppassword" required>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="singup-submit" name="singup-submit">Signup</button>
                <button type="reset" class="btn btn-primary">Reset</button>
            </div>
      </form>
    </div>
  </div>
</div>