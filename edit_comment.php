<?php include('createaccount_script.php');
if (empty($_SESSION['displayname'])) {
    header('location: index.php');
} else {
    $user = $_SESSION['displayname'];
    $userID = $_SESSION['senduserID'];
}

if(isset($_GET['id'])){
    $getcomment_id = $_GET['id']; // get id through query string 
    $db = mysqli_connect('localhost', 'root', '', 'fb_db');
    $query = "SELECT * FROM comment_table WHERE comment_id = '$getcomment_id'";
    $result = mysqli_query($db, $query);
    while ($row = mysqli_fetch_array($result)) :;
    $comment = $row['comment_text'];
endwhile;
}
    ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Social Media Clone - Edit Comment</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
      <div class="jumbotron p-3 bg-primary">
        <h1 class="text-white">Social Media Clone</h1>  
    </div>
    <div class="container">
        <div class="row" style="padding-top: 25px;padding-bottom: 25px;">
            <div class="col-sm-12 col-lg-6 mx-auto">
                <div class="card-body bg-light">
                    <h4 class="card-title">Edit Comment</h4>
                    <p class="text-danger">Hi <?php echo $user;?>! You are editing your comment.</p>
                    <form class="edit_comment" method="POST" action="edit_comment_script.php" enctype = "multipart/form-data">
                        <div class="row my-2">
                            <div class="col-md-12">
                                <div class="form-group"> <label for="form_message">Comment</label> 
                                <textarea id="form_message" name="user_comment" class="form-control"  rows="4" value="<?php echo $comment; ?>" required="required" data-error="Please, leave us a message."><?php echo $comment ?></textarea> </div>
                            </div>
                        </div>
                            <div class="row my-2">    
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success btn-send btn-block" name="btneditcomment" value = "<?php echo $getcomment_id; ?>">Edit</button>
                                    <button type = "button" class="btn btn-error btn-send btn-block btn-danger" onclick="history.go(-1);">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>
</html> 
