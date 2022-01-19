<?php include('createaccount_script.php');
if (empty($_SESSION['displayname'])) {
    header('location: index.php');
} else {
    $user = $_SESSION['displayname'];
    $userID = $_SESSION['senduserID'];
}


if(isset($_GET['id'])){
    $getprofileid = $_GET['id']; // get id through query string 
    $db = mysqli_connect('localhost', 'root', '', 'fb_db');
    $query = "SELECT * FROM `user_table` WHERE `ID` = '$userID'";
    $result = mysqli_query($db, $query);
    while ($row = mysqli_fetch_array($result)) :;
     $getuser_firstname = $row['user_firstname'];
     $getuser_lastname = $row['user_lastname'];
     $getuser_birthday = $row['user_birthday'];
     $getuser_gender = $row['user_gender'];
     $getuser_work = $row['work'];
     $getuser_status = $row['status'];
     $getuser_image = $row['user_profile_image'];

    ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Social Media Clone - Edit Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <style>
    .socmedimg{
        object-fit: cover;
    }
    img{
        max-width: 100%;
        height: auto;
    }

    .imagestan{
        width: 250px;  
        height: auto;  
        text-align: center;  
        padding: 15px;  
        border: 3px solid black;  

    }
  </style>
  <body>    
  <div class="jumbotron p-3 bg-primary">
        <h1 class="text-white">Social Media Clone</h1>  
  </div>
  <div class="container">
      <div class="row" style="padding-top: 25px;padding-bottom: 25px;">
          <div class="col-sm-12">
                <div class="card bg-light">
                    <div class="card-body">
                        <h4 class="card-title">Edit Profile</h4>
                        <p class="text-danger">Hi <?php echo $user;?>! You are editing your profile.</p>
                        <form class="user" method="POST" action="edit_profile_script.php" enctype = "multipart/form-data" style="padding-top: 25px;">
                            <div class="row my-2">
                                <div class="col-sm-6">
                                <?php     if (!$row['user_profile_image']){
                                            echo "No image";
                                            echo "<br>";
                                            echo "<input type='file' name='uploadfile' id='fileToUpload'>";
                                            echo "<br>";
                                        }
                                        else {
                                            echo "<div class= 'imagestan'>";
                                            echo "<img class='socmedimg' src = 'images/" . $row['user_profile_image']."'>";
                                           
                                            echo "</div>";
                                            echo "<input type='file' name='uploadfile' id='fileToUpload' class='my-2'>";
                                        }
                                        ?>
                                </div>
                            </div>
                            <div class="row my-2"> 
                                <div class="col-sm-6">
                                    <label class="form-label">First Name</label> 
                                    <input type="text" class="form-control" name="firstname" value="<?php echo $getuser_firstname; ?>" placeholder = "Enter First Name">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Last Name</label> 
                                    <input type="text"  class="form-control" name="lastname" value="<?php echo $getuser_lastname; ?>" placeholder = "Enter Last Name">
                                </div>
                                 <a href='change_email.php?id=<?php echo $userID?>' class="text-success my-2">Change Email Address</a>
                                <a href='change_password.php?id=<?php echo $userID?>' class="text-success my-2">Change Password</a>
                                </div>
                                <div class="row my-2">
                                    <div class="col-sm-6">
                                        <label class="form-label">Birthday</label> 
                                        <input type="date" name="birthday" class="form-control" value="<?php echo $getuser_birthday; ?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Gender</label>
                                        <?php if ($getuser_gender == "Male"){ ?>          
                                            <div class="form-check">
                                              <input class="form-check-input" type="radio" name="gender" id="gender" value = "Male" required checked>
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
                                            <?php }


                                            else { ?>
                                            <div class="form-check">
                                              <input class="form-check-input" type="radio" name="gender" id="gender" value = "Male" required>
                                              <label class="form-check-label" for="gender">
                                                Male
                                              </label>
                                            </div>
                                            <div class="form-check">
                                              <input class="form-check-input" type="radio" name="gender" id="gender" value = "Female" required checked>
                                              <label class="form-check-label" for="gender">
                                                Female
                                              </label>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    
                                <div class="row my-2">
                                    <div class="col-sm-6">
                                        <label class="form-label">Work</label>
                                        <input type="text" class="form-control" name="work" value="<?php echo $getuser_work; ?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Status</label>
                                        <select name="status" id="status" class="form-select">
                                            <option value="<?php echo $getuser_status; ?>"><?php echo $getuser_status; ?></option>
                                            <option value="Single">Single</option>
                                            <option value="In a relationship">In a relationship</option>
                                            <option value="Married">Married</option>
                                            <option value="Divorce">Divorce</option>
                                        </select>
                                    </div>
                                </div>
                                <?php endwhile;
                                    }?>
                                <div class="row">
                                    <div class="col-sm-12 my-3">  
                                  <button type="submit" class="btn btn-success btn-send btn-block " name="btneditprofile" value = "<?php echo $getprofileid; ?>">Edit</button>
                                 <button type = "button" class="btn btn-error btn-send btn-block btn-danger" onclick="history.go(-1);">Cancel</button>
                                    </div>
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