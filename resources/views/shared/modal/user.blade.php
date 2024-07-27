<div id="user-modal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="user-modal" aria-hidden="true">
  <div class="modal-dialog with-nav-tab">
    <div class="modal-content">
      <ul class="nav nav-tabs px-4" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#sign-in" type="button" role="tab"
            aria-controls="sign-in" aria-selected="true">SIGN IN</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#sign-up" type="button" role="tab"
            aria-controls="sign-up" aria-selected="false">SIGN UP</button>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="sign-in" role="tabpanel" aria-labelledby="sign-in" tabindex="0">
          <form name="login" class="needs-validation mt-3" method="POST" novalidate>
            <div class="px-4">
              <div class="mb-3">
                <label for="sign-in-email" class="form-label required">Email</label>
                <input type="email" class="form-control" id="sign-in-email" name="email" required>
              </div>
              <div class="mb-3">
                <label for="sign-in-password" class="form-label required">Password</label>
                <input type="password" class="form-control" id="sign-in-password" name="password" required>
              </div>
            </div>
            <div class="modal-footer px-4">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-warning text-light">Sign In</button>
            </div>
          </form>
        </div>
        <div class="tab-pane fade" id="sign-up" role="tabpanel" aria-labelledby="sign-up" tabindex="0">
          <form name="register" class="needs-validation mt-3" method="POST" novalidate>
            <div class="px-4">
              <div class="mb-3">
                <label for="name" class="form-label required">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label required">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label required">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <div class="mb-3">
                <label for="confirm-password" class="form-label required">Confirm Password</label>
                <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
                <div class="custom-invalid-feedback">Passwords do not match</div>
              </div>
            </div>
            <div class="modal-footer px-4">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-warning text-light">Sign Up</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
