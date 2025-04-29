

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="controller/loginsignup.php" method="post">
            <div class="modal-body">
                        <div class="mb-3">
                            <label for="loginemail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="loginemail" name="loginemail" aria-describedby="emailHelp" required>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="loginpassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="loginpassword" name="loginpassword" required>
                        </div>
                        <!-- <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div> -->
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="login-submit" id="login-submit">Login</button>
            </div>
      </form>
    </div>
  </div>
</div>