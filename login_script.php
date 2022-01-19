<?php
    session_start();
    //setting variables to null

    $email = "";
    $password = "";
    //storage of errors 
    $errors = array();

     //connection to the database
     $db = mysqli_connect('localhost','root','','fb_db');

     //log in user from login page
     if(isset($_POST['btnlogin'])){
            $email =($_POST['email']);
            $password =($_POST['password']);
        
        //ensure that form fields are filled properly

        if(empty($email)){
            array_push($errors,"Email is Required");
            echo '<script type="text/javascript">alert("Email is Wrong or Incorrect!");history.go(-1);</script>';
        }
        if(empty($password)){
            array_push($errors,"Password is Required");
            echo '<script type="text/javascript">alert("Password is Wrong or Incorrect!");history.go(-1);</script>';
        }
        
        if(count($errors) == 0) {
            $query = "SELECT * FROM user_table WHERE user_email= '$email' AND user_password = '$password'";
            $result = mysqli_query($db,$query);

                if (mysqli_num_rows($result)!=0) {

                    while($row=mysqli_fetch_array($result)){
                    $getfirstname=$row['user_firstname'];
                    $getuserid=$row['ID'];      

                    $_SESSION['displayname'] = $getfirstname;
                    $_SESSION['senduserID'] = $getuserid;

                    echo "<script>
                    alert('Login Successfully!');
                     window.location.href='newsfeed.php';
                      </script>";

                }
            }
            else {
                    echo "<script>
                    alert('Credentials are incorrect!');
                    window.location.href='index.php';
                    </script>";
            }
        }

     }



     //RESET PASSWORD
     if(isset($_POST['btnReset'])){
        $emailRes = ($_POST['resetEmail']);
        $passRes = ($_POST['resetPassword']);

        if ($emailRes == ""){
            echo "<script>
            alert('Email is Blanked!');
             window.location.href='index.php';
              </script>"; 
        }

        else if ($passRes == ""){
            echo "<script>
            alert('Password is Blanked!');
             window.location.href='index.php';
              </script>"; 
        }

     
        else {

            $query = "SELECT * FROM user_table WHERE user_email= '$emailRes'";
            $result = mysqli_query($db,$query);
             if (mysqli_num_rows($result)!=0) {

            $queryRes = "UPDATE user_table SET user_password = '$passRes' WHERE user_email = '$emailRes'";
            mysqli_query($db, $queryRes);

            echo "<script>
            alert('Updated Successfully!');
             window.location.href='index.php';
              </script>"; 
        }
        else {
            echo "<script>
            alert('Credentials are incorrect!');
             window.location.href='index.php';
              </script>";
        }
        }
    
     
   }
   
     //logout
    if(isset($_POST['btnlogout'])){
        session_destroy();
        unset($_SESSION['displayname']);
        unset($_SESSION['senduserID']);
        header('location: index.php');
    }
    ?>