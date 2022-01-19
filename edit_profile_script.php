<?php

session_start();

$errors = array();
$db = mysqli_connect('localhost', 'root', '', 'fb_db');

    
$find_userID = $_SESSION['senduserID'];

//Process of Edit Profile 
if(isset($_POST['btneditprofile'])){
$getfirstname =  ($_POST['firstname']);
$getlastname = ($_POST['lastname']);
$getbirthday = ($_POST['birthday']);
$getgender = ($_POST['gender']);
$getwork = ($_POST['work']);
$getstatus = ($_POST['status']);

//Setting Image
$target = "images/".time()."_".basename($_FILES['uploadfile']['name']);
$image = $_FILES["uploadfile"]["name"];
$fileType = pathinfo($target,PATHINFO_EXTENSION);
$image_name = time()."_".$image;

$date = date('m/d/Y h:i:s a', time());

//Validation on Empty
if(empty($getfirstname)){
        array_push($errors,"First Name is Required");
        echo '<script type="text/javascript">alert("First Name is Required!");history.go(-1);</script>';
     }
     else if(empty($getlastname)){
        array_push($errors,"Last Name is Required");
        echo '<script type="text/javascript">alert("Last Name is Required!");history.go(-1);</script>';
    }
  
     else if(empty($getbirthday)){
         array_push($errors,"Birthday is Required");
         echo '<script type="text/javascript">alert("Birthday is Required!");history.go(-1);</script>';
     }
     else if(strtotime($getbirthday)>strtotime('-18 year')){
        array_push($errors,"Young");
        echo '<script type="text/javascript">alert("Young");history.go(-1);</script>';
           
     }
     else if(empty($getgender)){
        array_push($errors,"Gender is Required");
        echo '<script type="text/javascript">alert("Gender is Required!");history.go(-1);</script>';
    }

if(count($errors) == 0) {
   
if($image == ""){

    //Update query on User Table
    $sql = "UPDATE `user_table` SET `user_firstname`='$getfirstname',`user_lastname` = '$getlastname',`user_birthday` = '$getbirthday',`user_gender` = '$getgender',`work` = '$getwork',`status` = '$getstatus' WHERE `ID`='$find_userID'";
    mysqli_query($db, $sql);
    
    echo "<script>
    alert('Profile Updated Successfully!');
    window.location.href='userprofile.php';
    </script>";
}
else{
    //Validation upon image 
    $allowTypes = array('jpg','png','jpeg');
    if(in_array($fileType, $allowTypes)){
    if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $target)){
        $sql = "UPDATE `user_table` SET `user_firstname`='$getfirstname',`user_lastname` = '$getlastname',`user_birthday` = '$getbirthday',`user_gender` = '$getgender',`work` = '$getwork',`status` = '$getstatus',`user_profile_image` = '$image_name' WHERE `ID`='$find_userID'";
    mysqli_query($db, $sql);

    echo "<script>
    alert('Profile Updated Successfully!');
    window.location.href='userprofile.php';
    </script>";
    }
    }
    else {
    echo '<script type="text/javascript">alert("Cannot upload image");history.go(-1);</script>';
    }
    }


}
}



    ?>