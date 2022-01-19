<?php

session_start();
$db = mysqli_connect('localhost','root','','fb_db');
$find_userID = $_SESSION['senduserID'];

//Process of Edit comment section

if(isset($_POST['btneditcomment'])){
$getcommentid =  ($_POST['btneditcomment']);
$getcommenttext = ($_POST['user_comment']);

$sqlupdatecomment = "UPDATE `comment_table` SET `comment_text`='$getcommenttext' WHERE `comment_id`='$getcommentid'";
mysqli_query($db, $sqlupdatecomment);

}
echo "<script>
alert('Comment Updated Successfully!');
window.location.href='newsfeed.php';
</script>";

?>