<div class="modal fade" id="signInModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signInModalLabel">Log In</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name='login' id="login_form" action="/login.php" method="post">
          <div id="alert_placeholder_login"></div>
          <div class="form-group">
            <label for="email">Email address</label>
            <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input name="password" type="password" class="form-control" id="password" placeholder="Password">
          </div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-primary" />
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="signUpModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signUpModalLabel">Sign Up</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="registration" id="registration_form" action="/login.php" method="post">
          <div id="alert_placeholder_registration"></div>
          <div class="form-group">
            <label for="email">Email address</label>
            <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your personal info with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input name="password" type="password" class="form-control" id="password" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="confirmPassword">Confirm Password</label>
            <input name="confirmPassword" type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password">
          </div>
          <div class="form-group">
            <label for="ageGroup">Age Group</label>
            <select name="ageGroup" class="form-control" id="ageGroup">
              <option value="child">Child (5-18 years)</option>
              <option value="student">Student (18-30 years)</option>
              <option value="adult">Adult (30+ years)</option>
            </select>
          </div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-primary" />
        </form>
      </div>
    </div>
  </div>
</div>
