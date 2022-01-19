<?php
    session_start();
    //setting variables to null
    $firstname = "";
    $lastname = "";
    $email = "";
    $password = "";
    $birthday = "";
    $gender = "";
    //storage of errors 
    $errors = array();

     //connection to the database
     $db = new mysqli('localhost','root','','fb_db');
     mysqli_select_db($db,'php');

     //log in user from login page
     if(isset($_POST['btnsignup'])){
        $firstname =($_POST['firstname']);
        $lastname =($_POST['lastname']); 
        $email =($_POST['email']);
        $password =($_POST['password']);
        $birthday =($_POST['birthday']);
        $gender =($_POST['gender']);
     
     //ensure that form fields are filled properly
     if(empty($firstname)){
        array_push($errors,"First Name is Required");
        echo '<script type="text/javascript">alert("First Name is Required!");history.go(-1);</script>';
     }
     else if(empty($lastname)){
        array_push($errors,"Last Name is Required");
        echo '<script type="text/javascript">alert("Last Name is Required"!);history.go(-1);</script>';
    }
    else if(empty($email)){
        array_push($errors,"Email is Required");
        echo '<script type="text/javascript">alert("Email is Required!");history.go(-1);</script>';
    }
    else if(empty($password)){
        array_push($errors,"Password is Required");
        echo '<script type="text/javascript">alert("Password is Required!");history.go(-1);</script>';
    }
     else if(empty($birthday)){
         array_push($errors,"Birthday is Required");
         echo '<script type="text/javascript">alert("Birthday is Required!");history.go(-1);</script>';
     }
     else if(strtotime($birthday)>strtotime('-18 year')){
        array_push($errors,"Young");
        echo '<script type="text/javascript">alert("Your age does not meet our required age!");history.go(-1);</script>';
           
     }
     else if(empty($gender)){
        array_push($errors,"Gender is Required");
        echo '<script type="text/javascript">alert("Gender is Required!");history.go(-1);</script>';
    }
    
     if(count($errors) == 0) {

         //bind and protect data before passing to db
 

         $query = "SELECT * FROM `user_table` WHERE `user_email`= '$email'";
         $result = mysqli_query($db,$query);
             if (mysqli_num_rows($result)!=0) {

                echo '<script type="text/javascript">alert("An account is registered to this Email Address!");history.go(-1);</script>';

             }
            else{
                
                $sql = "INSERT INTO user_table(user_firstname,user_lastname,user_email,user_password,user_birthday,user_gender,work,status,user_profile_image)
                VALUES ('$firstname','$lastname','$email','$password','$birthday','$gender','','','')";

                mysqli_query($db, $sql);

                $_SESSION['displayname'] = $firstname;
                echo "<script>
                alert('User Registered Successfully!');
                window.location.href='index.php';
                </script>";
                
            }

        }
    }
    
     //logout
    if(isset($_POST['btnlogout'])){
        session_destroy();
        unset($_SESSION['displayname']);
        header('location: index.php');
    }
    ?>