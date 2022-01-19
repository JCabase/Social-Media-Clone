<?php

$msg = "";
session_start();
$db = mysqli_connect('localhost','root','','fb_db');
$referer = $_SERVER['HTTP_REFERER'];
$find_userID = $_SESSION['senduserID'];

//Process of Posting in Newsfeed
if(isset($_POST['btnpost'])){
$imageempty = "";
$target = "images/".time()."_".basename($_FILES['uploadfile']['name']);
$userposts = ($_POST['userpost']);
$image = $_FILES["uploadfile"]["name"];
$fileType = pathinfo($target,PATHINFO_EXTENSION);
$image_name = time()."_".$image;

echo $date = date('m/d/Y h:i:s a', time());

if (($userposts=="") && ($image=="")){
    echo '<script type="text/javascript">alert("Post is Required");history.go(-1);</script>';
}

else{
if($image == ""){
    $tag = ($_POST['tag']);

    //Insertion of post to table

    $sql = "INSERT INTO `post_table`(`user_id`,`post`,`images`,`likes`,`tags`,`time_post`) VALUES
    ('$find_userID','$userposts','$image','0', '$tag',NOW())";
    mysqli_query($db, $sql);
    echo "<script>
    alert('Posted Successfully!');
    window.location.href='$referer';
    </script>";
}
else{
    //Getting Tag
    $tag = ($_POST['tag']);
    
    //Validation of Image being post
    $allowTypes = array('jpg','png','jpeg');
    if(in_array($fileType, $allowTypes)){
    if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $target)){
    $sql = "INSERT INTO `post_table`(`user_id`,`post`,`images`,`likes`,`tags`,`time_post`) VALUES
    ('$find_userID','$userposts','$image_name','0', '$tag',NOW())";
    mysqli_query($db, $sql);
    
    echo "<script>
  alert('Posted Successfully!');
  window.location.href='$referer';
  </script>";
    }
    }
    else {
        echo "<script>
        alert('Post failed!');
        window.location.href='$referer';
        </script>";
    }
    }
}
}

    ?>