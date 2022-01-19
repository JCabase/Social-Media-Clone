<?php include('createaccount_script.php');
if (empty($_SESSION['displayname'])) {
    header('location: index.php');
} else {
    $user = $_SESSION['displayname'];
    $userID = $_SESSION['senduserID'];
}


if(isset($_GET['id'])){
    $getpostid = $_GET['id']; // get id through query string 
    $db = mysqli_connect('localhost', 'root', '', 'fb_db');
    $query = "SELECT * FROM `post_table` WHERE `post_id` = '$getpostid'";
    $result = mysqli_query($db, $query);
    while ($row = mysqli_fetch_array($result)) :;
    $post = $row['post'];
    $tags = $row['tags'];
    $image = $row['images'];
endwhile;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Social Media Clone - Edit Post</title>
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
          <div class="col-sm-12">
            <div class="card bg-light">
                <div class="card-body">
                    <h4 class="card-title">Edit Post</h4>
                    <p class="text-danger">Hi <?php echo $user;?>! You are editing your post.</p>
                    <form class="edit_post" method="POST" action="edit_post_script.php" enctype = "multipart/form-data" style="padding-top: 25px;">
                        <div class="row my-2">
                            <div class="col-sm-6">
                                <?php
                                    $getTag = "SELECT * FROM user_table";
                                    $resultTag = mysqli_query($db, $getTag);
                                  ?>
                                <div class="form-group"> <label for="form_need">Tag user</label> 
                                     <select id="form_need" name="tag" class="form-select" data-error="Please specify your need.">
                                     <option value="<?php echo $tags;?>"><?php echo $tags ?></option>
                                     <?php
                                        while($rows = $resultTag -> fetch_assoc()){
                                          $user_name = $rows['user_firstname'];
                                          echo "<option value='$user_name'>$user_name</option>";
                                        }
                                      ?>
                                    </select> 
                                  </div>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-sm-12">
                                <div class="form-group"> <label for="form_message">Post</label> 
                                <textarea id="form_message" name="user_post" class="form-control"  rows="4" value="<?php echo $post; ?>"><?php echo $post; ?></textarea> </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group"> <label for="form_message"></label>
                                <?php 
                                if ($image == ""){
                                  
                                }
                                else {
                                 
                                  ?>
                                  <img class='socmedimg' src = "images/<?php echo $image;?>">
                                  <?php
                                }
                                ?>
                                
                            </div>
                            <div class="col-sm-12 my-3">
                                <button type="submit" class="btn btn-success btn-send" name="btneditpost" value = "<?php echo $getpostid; ?>">Edit</button>
                                <button type = "button" class="btn btn-danger btn-error btn-send" onclick="history.go(-1);">Cancel</button>
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
