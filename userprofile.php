<?php include('createaccount_script.php');
if (empty($_SESSION['displayname'])) {
    header('location: index.php');
} else {
    $user = $_SESSION['displayname'];
    $userID = $_SESSION['senduserID'];
}
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Social Media Clone - Profile</title>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    .socmedimg{
        width: 350px;
        height: auto;
        padding:20px;
        text-align: center;
    }
    img{
        max-width: 100%;
        height: auto;
    }
</style>
<body>
  <div class="jumbotron p-3 bg-primary">
        <h1 class="text-white">Social Media Clone</h1>  
  </div>

<div class="container">
        <div class="row" style="padding-top: 25px;padding-bottom: 25px;">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                    <?php
                       $query = "SELECT * FROM `user_table` WHERE `ID` = '$userID'";
            
                       $result = mysqli_query($db, $query);
                       while($row = mysqli_fetch_array($result)){
                      ?>
                    <?php echo "<a href='edit_profile.php?id=".$row['ID']."' class='text-warning'>Update Profile</a>"; ?>
                        <div>  
                          <?php 
                              if (!$row['user_profile_image']){
                                echo "No Image";
                               }else{
                                echo "<img src = 'images/" . $row['user_profile_image']."' class='my-3'>";
                              }
                          ?>
                        </div>
                      <h5 class="my-3"><?php echo $row['user_firstname']." ".$row['user_lastname']; ?></h5>
                        
                        <p style="margin-bottom: 0;">Gender: <?php echo $row['user_gender'];?></p>
                        <p style="margin-bottom: 0;">Birthday: <?php echo $row['user_birthday'];?></p>
                        <?php 
                        if ($row['status']==""){

                        }
                        else{
                          ?>
                          <p style="margin-bottom: 0;">Status: <?php echo $row['status'];?></p>
                          <?php
                        }

                        if ($row['work']==""){

                        }
                        else {
                          ?><p style="margin-bottom: 0;">Occupation: <?php echo $row['work'];?></p>
                          <?php
                        } } ?>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                        <a href='newsfeed.php'>News Feed</a>
                        </li>
                        <li class="list-group-item">
                        <a href='logout.php' class="text-danger">Logout</a>
                        </li>
                      
                    </ul>
                </div>
            </div>
            <div class="col-sm-9">
                <form class="userprofile" method="POST" action="post_script.php" enctype = "multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" data-bs-tabs="tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="true" data-bs-toggle="tab" href="#post">Post</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#image">Image</a>
                                </li>
                            </ul>
                        </div>
                        <?php
                            $getTag = "SELECT * FROM `user_table`";
                            $resultTag = mysqli_query($db, $getTag);
                        ?>
                        <div class="card-body tab-content">
                            <div class="tab-pane active" id="post">
                                <div class="form-group">
                                      <label class="form-label">What's on your mind?</label>
                                      <textarea class="form-control" name="userpost" id="message" rows="3"></textarea>
                                  </div>
                            </div>
                            <div class="tab-pane" id="image">
                                <div class="form-group">
                                      <div class="custom-file">
                                      <input type="file" class="custom-file-input" name="uploadfile" id="fileToUpload">
                                          <label class="custom-file-label" for="uploadfile">Upload image</label>
                                      </div>
                                  </div>
                                  <div class="my-2">
                                        <label class="form-label">Tag someone</label>
                                        <select name="tag" class="form-select">
                                              <option value="">--</option>
                                            <?php
                                              while($rows = $resultTag -> fetch_assoc()){
                                                $user_name = $rows['user_firstname'];
                                                echo "<option value='$user_name' id = 'tag_id'>$user_name</option>";
                                              }
                                            ?>
                                        </select>
                                  </div>
                            </div>
                            <button type="submit" class="btn btn-primary my-3" name="btnpost">Post</button>
                        </div>
                    </div>
                </form>
               
                <?php

                  
                  $query = "SELECT *, DATE_FORMAT(`time_post`, '%d/%m/%Y %h:%i %p') as `datetime_post` FROM `post_table` a LEFT JOIN `user_table` b ON b.ID = a.user_id WHERE `user_id` = '$userID' ORDER BY `time_post` DESC";
                                          
                  $result = mysqli_query($db, $query);
                  while($row = mysqli_fetch_array($result)){

                    $getcomment = $row['post_id'];
                    
                ?>                         
                            
                <form class="comment" method="POST" action="comment_script.php" enctype = "multipart/form-data">
                    <div class="card gedf-card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="mr-2">
                                                  <?php

                                                    if (!$row['user_profile_image']){
                                                      echo "No Image";
                                                     }else{
                                                      echo "<img class='rounded-circle' width='45'  src = 'images/" . $row['user_profile_image']."'>";
                                                    }
                                                  
                                                  ?>
                                                
                                            </div>
                                            <div class="h5 mb-0" style="margin-left: 10px !important;">
                                              <?php echo $row['user_firstname']. " ". $row['user_lastname'] ;?>
                                            </div>
                                        </div>
                                        <div>
                                    <?php 
                                     $finduserposttodelete = "SELECT * FROM `post_table` WHERE `post_id` = '$getcomment' AND `user_id` = '$userID'";
                                     $resultuserposttodelete = mysqli_query($db, $finduserposttodelete);

                                        if(mysqli_num_rows($resultuserposttodelete) > 0){
                                                echo "<div class='dropdown'>";
                                                echo "<button class='btn btn-danger dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'></button>";
                                                    echo "<ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>";
                                                    echo "<button type='submit' class='dropdown-item' name = 'btndelete_post' value = '".$row['post_id']."'>Delete</button>";
                                                    echo "<a  class='dropdown-item' href='edit_post.php?id=".$row['post_id']."'>Edit</a>";
                                                    echo "</ul>";
                                                    echo "</div>";
                                            }
                                        ?>
                                        </div>
                                    </div>

                                </div>
                              
                                <div class="card-body">
                                    <h5 class="card-title">
                                    <?php 
                                        
                                        echo $row['post'];
                                    ?>
                                    </h5>

                                    <p class="card-text">
                                      <?php 
                                            $getcomment = $row['post_id'];
                                            $gettags = $row['tags'];
                                            if ($gettags!=""){
                                              echo "<p><b> Tagged users: ".$row['tags']."</b></p>";
                                            }

                                      ?>
                                    </p>
                                    <p class="card-text">
                                    <?php
                                    if ($row['images']==""){

                                    }
                                    else{
                                        echo "<img class='socmedimg' src = 'images/" . $row['images']."'>";
                                    } 
                                    ?>
                                    </p>
                                    <p class="text-muted mb-2"><?php 
                                   
                                    echo $row['datetime_post'];
                                    ?></p>
                                    <?php
                                        $getlikecount_query = "SELECT * FROM `like_table` WHERE `post_id` = '$getcomment'";
                                        $resultlikecount_query = mysqli_query($db, $getlikecount_query);
                                        echo "<p class='text-info'>Likes: ";
                                        echo $rowlikecount_query = mysqli_num_rows($resultlikecount_query);
                                        echo "</p>";

                                        $finduseriflikequery = "SELECT * FROM `like_table` WHERE `post_id`= '$getcomment' AND `user_id` = '$userID'";
                                        $resultfinduseriflike = mysqli_query($db,$finduseriflikequery);
                                         if (mysqli_num_rows($resultfinduseriflike)!=0) {
                                        
                            ?>
                    </div>
                    <div class="card-footer">
                        <?php 
                            echo "<button class='btn btn-danger text-white mb-2' type='submit' name = 'btnlike' value = '".$row['post_id']."'>Unlike1</button>";
                            }
                            else {
                              echo "<button class='btn btn-info text-white mb-2' type='submit' name = 'btnlike' value = '".$row['post_id']."'>Like</button>";
                            }
                            $querylike = "SELECT * FROM `comment_table` WHERE `post_id` = '$getcomment'";
                            $resultlike = mysqli_query($db, $querylike);
                            while($rowlike = mysqli_fetch_array($resultlike)){     
                              echo "<p>".$rowlike['user_firstname'], " ", $rowlike['user_lastname'], ": "."";
                              echo "</p>";
                              echo "<input type = 'text' class='form-control' name = 'edit_comment' id = 'edittext' disabled='true' value = '".$rowlike['comment_text']."'>";
                              echo "<br>";
                              
                              $getusercommenttodelete = $rowlike['user_id'];
                              $getpostidfromcommentable = $rowlike['post_id'];
                    
                              if(($getusercommenttodelete == $userID) && ($getpostidfromcommentable == $getcomment)) {
                                echo "<button type='submit' class='btn btn-danger mb-3' style='margin-right: 10px;' name = 'btndelete_comment' value = '".$rowlike['comment_id']."'>Delete</button>";
                              
                                echo "<a class='btn btn-warning text-white mb-3' href='edit_comment.php?id=".$rowlike['comment_id']."'>Edit</a>";
                                
                    
                              }
                      
                              
                            }

                            echo "<input type='text' class='form-control my-2' name = 'commenttext' value = '' placeholder = 'Comment here...'>";
                            echo "<button type='submit' class='btn btn-success' name = 'btncomment' value = '".$row['post_id']."'>Comment</button>";
                            
                      ?>                                           
                            </div>
                        </div>
                    </form>
                    <?php } ?>
            </div>
                                      
        </div>
    </div>
</body>
     


</html> 
