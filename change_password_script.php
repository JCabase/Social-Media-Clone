<?php

session_start();
$errors = array();
$db = mysqli_connect('localhost', 'root', '', 'fb_db');    
$find_userID = $_SESSION['senduserID'];

//Upon clicking submit will find user ID 
if(isset($_POST['btnchangepassword'])){
    $getpassword =  ($_POST['change_password']);
    $query = "SELECT * FROM `user_table` WHERE `ID` = '$find_userID'";
    $result = mysqli_query($db, $query);
    while ($row = mysqli_fetch_array($result)) :;
    $fromdbpassword = $row['user_password'];
    endwhile;

//Validation for password required
if(empty($getpassword)){
        array_push($errors,"Password Required");
        echo '<script type="text/javascript">alert("Email is Required!");history.go(-1);</script>';
     }

//Validation for same old password
if ($getpassword == $fromdbpassword){
    echo '<script type="text/javascript">alert("Password is the same as Old Password");history.go(-1);</script>';
}
else{
//Update process of user password
$sqlupdatepassword = "UPDATE `user_table` SET `user_password`='$getpassword' WHERE `ID`='$find_userID'";
mysqli_query($db, $sqlupdatepassword);
echo "<script>
alert('Password Updated Successfully!');
window.location.href='userprofile.php';
</script>";
}
             
}



    ?>