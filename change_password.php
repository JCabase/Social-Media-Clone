<?php include('createaccount_script.php');
if (empty($_SESSION['displayname'])) {
    header('location: index.php');
} else {
    $user = $_SESSION['displayname'];
    $userID = $_SESSION['senduserID'];
}


if(isset($_GET['id'])){
    $getuserid = $_GET['id']; // get id through query string 
    $db = mysqli_connect('localhost', 'root', '', 'fb_db');
    $query = "SELECT * FROM `user_table` WHERE `ID` = '$getuserid'";
    $result = mysqli_query($db, $query);
    while ($row = mysqli_fetch_array($result)) :;
    $getpassword = $row['user_password'];
    endwhile;
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Social Media Clone - Change Password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
  <?php 
    if(isset($_GET['id'])){
    $getpostid = $_GET['id']; // get id through query string 
    $db = mysqli_connect('localhost', 'root', '', 'fb_db');
    $query = "SELECT * FROM post_table WHERE post_id = '$getpostid'";
    $result = mysqli_query($db, $query);
    while ($row = mysqli_fetch_array($result)) :;
    $post = $row['post'];
    $tags = $row['tags'];
    $image = $row['images'];
    endwhile;
    }
  ?>
  <div class="jumbotron p-3 bg-primary">
        <h1 class="text-white">Social Media Clone</h1>  
  </div>
  <div class="container">
      <div class="row" style="padding-top: 25px;padding-bottom: 25px;">
          <div class="col-sm-12 col-lg-6 mx-auto">
            <div class="card bg-light">
                <div class="card-body">
                    <h4 class="card-title">Change Password</h4>
                    <p class="text-danger">Hi <?php echo $user;?>! You are changing your password.</p>
                    <form class="edit_password" method="POST" action="change_password_script.php" enctype = "multipart/form-data" style="padding-top: 25px;">
                        <div class="row my-2">
                            <div class="col-sm-12">
                                <label class="form-label">New Password</label>                       
                                <input type = "password" id="form_message" name="change_password" class="form-control" value="" required>
                                <p class="text-primary">Old Password: <?php echo $getpassword ?></p>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-sm-12">    
                                <button type="submit" class="btn btn-success btn-send btn-block" name="btnchangepassword" value = "<?php echo $getuserid; ?>">Change</button>
                                <button type = "button" class="btn btn-error btn-send btn-block btn-danger" onclick="history.go(-1);">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>