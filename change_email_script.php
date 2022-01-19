<?php

session_start();

$errors = array();
$db = mysqli_connect('localhost', 'root', '', 'fb_db');   
$find_userID = $_SESSION['senduserID'];

if(isset($_POST['btnchangeemail'])){
    $getemail =  ($_POST['change_email']);

    //Get ID from user table 
    $query = "SELECT * FROM `user_table` WHERE `ID` = '$find_userID'";
    $result = mysqli_query($db, $query);
    while ($row = mysqli_fetch_array($result)) :;
    $fromdbemail = $row['user_email'];
    endwhile;


        //Process of Validation
        if(empty($getemail)){
            array_push($errors,"First Name is Required");
            echo '<script type="text/javascript">alert("Email is Required!");history.go(-1);</script>';
            }
        //Process of Validation
        if ($getemail == $fromdbemail){
            echo '<script type="text/javascript">alert("Email is the same as Old Email.");history.go(-1);</script>';
        }
        else{
    

            $query = "SELECT * FROM `user_table` WHERE `user_email`= '$getemail'";
            $result = mysqli_query($db,$query);
            if (mysqli_num_rows($result)!=0) {

                echo '<script type="text/javascript">alert("An account is registered to this Email Address!");history.go(-1);</script>';

             }
            else {
                 
             //Update of email upon passing all validations
            $sqlupdateemail = "UPDATE `user_table` SET `user_email`='$getemail' WHERE `ID`='$find_userID'";
            mysqli_query($db, $sqlupdateemail);
            echo "<script>
            alert('Email Updated Successfully!');
            window.location.href='userprofile.php';
            </script>";
}
}
}



?>