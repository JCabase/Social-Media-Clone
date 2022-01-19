<?php include('login_script.php');

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Social Media Clone - Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 

  </head>
    <body>
    <div class="jumbotron p-3 bg-primary">
          <h1 class="text-white">Welcome to Social Media Clone!</h1>  
    </div>
      <div class="container">
        <div class="row my-5">
          <div class="col-sm-12 col-lg-6 mx-auto">
            <a href="createaccount.php" class="text-success">New here? Click to Create Account!</a>
            <form method="POST" action="login_script.php" style="padding-top: 25px;">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
              <div class="row my-5">
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-primary" name="btnlogin">LOGIN</button>
                </div>
              </div>
          </div>
          </form>
          <div class="row">
              <div class="col-sm-12 col-lg-6 mx-auto">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" >FORGOT PASSWORD</button>
                
              </div>
          </div>
        </div>
        </div>
      </div>
   

      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="login_script.php">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="email" class="form-control" id="recipient-name" name="resetEmail" required>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Password:</label>
            <input type="password" class="form-control" id="recipient-name" name="resetPassword" required>
          </div>
       
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="btnReset" class="btn btn-primary">Forgot Password</button>
      </div>
      </form>
    </div>
  </div>
</div>

  
 
</body>
</html>

<script>
var exampleModal = document.getElementById('exampleModal')
exampleModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
 
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = exampleModal.querySelector('.modal-title')
  var modalBodyInput = exampleModal.querySelector('.modal-body input')

  modalTitle.textContent = 'Forgot Password'
  modalBodyInput.value = recipient
})
</script>
