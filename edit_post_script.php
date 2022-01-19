<?php

session_start();
$db = mysqli_connect('localhost','root','','fb_db');
$find_userID = $_SESSION['senduserID'];
$referer = $_SERVER['HTTP_REFERER'];

//Edit of Post Process 
if(isset($_POST['btneditpost'])){
$getpostid =  ($_POST['btneditpost']);
$getpost = ($_POST['user_post']);
$tag = ($_POST['tag']);
if ($getpost==""){
    header('location: newsfeed.php');
}
else {
    
    //Update query on Post Table
    $sqlupdatepost = "UPDATE `post_table` SET `post`='$getpost',`tags` = '$tag' WHERE `post_id`='$getpostid'";
    mysqli_query($db, $sqlupdatepost);
    echo "<script>
    alert('Post Updated Successfully!');
    window.location.href='newsfeed.php';
    </script>";
}

}

    ?>