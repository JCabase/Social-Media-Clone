<!DOCTYPE html>
<html>
  <head>
    <title>Social Media Clone - Create Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>
    <body>
      <div class="jumbotron p-3 bg-primary">
            <h1 class="text-white">Create Account</h1>  
      </div>
      <div class="container">
        <div class="row my-5">
          <div class="col-sm-12">
          <a href="index.php" class="text-primary">Already have an account? Click here to Login!</a>
            <form method="POST" action="createaccount_script.php" style="padding-top: 25px;">
              <div class="row my-2">
                <div class="col-sm-6">
                  <label class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Email" value="" required>
                </div>
                <div class="col-sm-6">
                  <label class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" value="" placeholder = "Password" required>
                </div>
              </div>
              <div class="row my-2">
                <div class="col-sm-6">
                  <label class="form-label">First Name</label>
                  <input type="text" class="form-control" name="firstname" value="" placeholder="First Name" required>
                </div>
                <div class="col-sm-6">
                  <label class="form-label">Last Name </label>
                  <input type="text" class="form-control" name="lastname" value="" placeholder="Last Name" required>
                </div>
              </div>
              <div class="row my-2">
                <div class="col-sm-6">
                  <label class="form-label">Birthday</label>
                  <input type="date" class="form-control" name="birthday" value="" required>
                </div>
                <div class="col-sm-6">
                <label class="form-label">Gender</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gender" id="gender" value = "Male" required>
                  <label class="form-check-label" for="gender">
                    Male
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gender" id="gender" value = "Female" required>
                  <label class="form-check-label" for="gender">
                    Female
                  </label>
                </div>
                </div>
              </div>
              <div class="row my-5">
                <div class="col-sm-12 text-center">
                  <button type="submit" class="btn btn-success" name="btnsignup">CREATE ACCOUNT</button>
                </div>
              </div>
          </div>
          </form>
        </div>
      </div>
    </body>
</html>
