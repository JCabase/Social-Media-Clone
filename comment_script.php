<?php

session_start();
$db = mysqli_connect('localhost','root','','fb_db');
$referer = $_SERVER['HTTP_REFERER'];
$find_userID = $_SESSION['senduserID'];

//Getting postID and Comment text
if(isset($_POST['btncomment'])){
  $getpostid =  ($_POST['btncomment']);
  $getcommenttext = ($_POST['commenttext']);
  if ($getcommenttext==""){
    echo '<script type="text/javascript">alert("Comment is Required!");history.go(-1);</script>';
  }
else {
  //Getting User ID 
  $getuser_name = "SELECT * FROM `user_table` WHERE `ID` = '$find_userID'";
  $resultuser_name = mysqli_query($db, $getuser_name);
  while($rowuser_name = mysqli_fetch_array($resultuser_name)){
    $getuser_firstname = $rowuser_name['user_firstname'];
    $getuser_lastname = $rowuser_name['user_lastname'];

    //INSERT into Comment Table and post details
  $sql = "INSERT INTO `comment_table`(`post_id`,`user_id`,`comment_text`,`user_firstname`,`user_lastname`) VALUES ('$getpostid','$find_userID','$getcommenttext','$getuser_firstname','$getuser_lastname')";
  mysqli_query($db, $sql);

  //Prompt 
  echo "<script>
  alert('Commented to the Post Successfully!');
  window.location.href='$referer';
  </script>";

}

  }


}

//Process of Like Increment
if(isset($_POST['btnlike'])){
    $getpostid =  ($_POST['btnlike']);
    $findlike_query = "SELECT * FROM `like_table` WHERE `post_id` = '$getpostid' AND `user_id` = '$find_userID'";
    $resultfindlike_query = mysqli_query($db, $findlike_query);
    if(mysqli_num_rows($resultfindlike_query) > 0){
        while($rowfindlike_query = mysqli_fetch_array($resultfindlike_query))
        {
        $getlikecount_query = "SELECT * FROM `like_table` WHERE `post_id` = '$getpostid'";
        $resultlikecount_query = mysqli_query($db, $getlikecount_query);
        $rowlikecount_query = mysqli_num_rows($resultlikecount_query);
        $addlike = $rowlikecount_query - 1;
        //Decremental of like
        $sql = "DELETE FROM `like_table` WHERE `post_id` = '$getpostid' AND `user_id` = '$find_userID'";
        mysqli_query($db, $sql);

        $sqladdlike = "UPDATE `post_table` SET `likes`='$addlike' WHERE `post_id`='$getpostid'";
        mysqli_query($db, $sqladdlike);

        echo "<script>
        alert('Unliked the Post Successfully!');
        window.location.href='$referer';
        </script>";
    
        }
    } else {
      //Increment of like process
        $getlikecount_query = "SELECT * FROM `like_table` WHERE `post_id` = '$getpostid'";
        $resultlikecount_query = mysqli_query($db, $getlikecount_query);
        $rowlikecount_query = mysqli_num_rows($resultlikecount_query);
        $addlike = $rowlikecount_query + 1;
        $sql = "INSERT INTO `like_table`(`post_id`,`user_id`) VALUES ('$getpostid','$find_userID')";
        mysqli_query($db, $sql);
        
        $sqladdlike = "UPDATE `post_table` SET `likes`='$addlike' WHERE `post_id`='$getpostid'";
        mysqli_query($db, $sqladdlike);

        echo "<script>
        alert('Liked the Post Successfully!');
        window.location.href='$referer';
        </script>";
    
    }
  }

  //Process of Delete post
    if(isset($_POST['btndelete_post'])){
        $getpostid =  ($_POST['btndelete_post']);
        $post_delete = "DELETE FROM `post_table` WHERE `post_id` = '$getpostid'";
        mysqli_query($db, $post_delete);

        $comment_delete = "DELETE FROM `comment_table` WHERE `post_id` = '$getpostid'";
        mysqli_query($db, $comment_delete);

        $like_delete = "DELETE FROM `like_table` WHERE `post_id` = '$getpostid'";
        mysqli_query($db, $like_delete);

        echo "<script>
        alert('Deleted Post Successfully!');
        window.location.href='$referer';
        </script>";
    
    }
//Process of Delete Comment
    if(isset($_POST['btndelete_comment'])){
      //Getting ID to Delete
      $getcomment_id =  ($_POST['btndelete_comment']);
      $comment_delete = "DELETE FROM `comment_table` WHERE `comment_id` = '$getcomment_id' AND `user_id` = '$find_userID'";
      mysqli_query($db, $comment_delete);

      echo "<script>
      alert('Deleted Post Successfully');
      window.location.href='$referer';
      </script>";
  
 
  }

    ?>