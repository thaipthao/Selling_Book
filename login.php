<?php
include("config/db_connection.php");
$error2 = null;
if (isset($_SESSION['login_user'])) {
    header("location: index.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($conn)) {
        if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwords']) && isset($_POST['firstname']) && isset($_POST['lastname'])){
            $myusername = mysqli_real_escape_string($conn, $_POST['username']);
            $mypassword = mysqli_real_escape_string($conn, $_POST['password']);
            $mypassword = md5(md5(md5($mypassword)));
            $mypassword2 = mysqli_real_escape_string($conn, $_POST['passwords']);
            $mypassword2 = md5(md5(md5($mypassword2)));
            $myfn = mysqli_real_escape_string($conn, $_POST['firstname']);
            $myls = mysqli_real_escape_string($conn, $_POST['lastname']);
            $sql = "SELECT * FROM users WHERE Email='$myusername'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);
            if ($count == 1) {
                $error2 = "Email của bạn đã tồn tại trong hệ thống, vui lòng đăng kí tài khoản khác hoặc liên hệ Admin";
            } else {
                if ($mypassword == $mypassword2){
                    $sqlquery = "INSERT INTO Users(Id,LastName,FirstName,Email,Password,Roles) value (UUID(),'$myls','$myfn','$myusername','$mypassword','29d89cbf-ff39-11eb-8562-2cf05dd1bda8')";
                    mysqli_query($conn, $sqlquery);
                    $sql = "SELECT * FROM Users WHERE Email='$myusername' and Password = '$mypassword'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $count = mysqli_num_rows($result);
                    if ($count == 1) {
                        $active = $row['Id'];
                        $_SESSION['login_user'] = $active;
                        header("location: index.php");
                    } else {
                        $error2 = "Có lỗi trong việc đăng kí tài khoản";
                    }
                } else {
                    $error2 = "Mật khẩu nhập lại của bạn không chính xác";
                }
            }
        }
        if(isset($_POST['emailname']) && isset($_POST['passname'])){
            $myuser = mysqli_real_escape_string($conn, $_POST['emailname']);
            $mypass = mysqli_real_escape_string($conn, $_POST['passname']);
            $mypass = md5(md5(md5($mypass)));
            $sqlz = "SELECT * FROM users WHERE Email='$myuser' and Password = '$mypass'";
            $resultz = mysqli_query($conn, $sqlz);
            $rowz = mysqli_fetch_array($resultz, MYSQLI_ASSOC);
            $countz = mysqli_num_rows($resultz);
            if ($countz == 1) {
                $active = $rowz['Id'];
                $_SESSION['login_user'] = $active;
                header("location: index.php");
            } else {
                $error2 = "Tài khoản hoặc mật khẩu của bạn không đúng";
            }
        }



    }



}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>Bootstrap 4 Login/Register Form</title>
    <style>

        /* sign in FORM */
        #logreg-forms{
            width:412px;
            margin:10vh auto;
            background-color:#f3f3f3;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
            transition: all 0.3s cubic-bezier(.25,.8,.25,1);
        }
        #logreg-forms form {
            width: 100%;
            max-width: 410px;
            padding: 15px;
            margin: auto;
        }
        #logreg-forms .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }
        #logreg-forms .form-control:focus { z-index: 2; }
        #logreg-forms .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        #logreg-forms .form-signin input[type="password"] {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        #logreg-forms .social-login{
            width:390px;
            margin:0 auto;
            margin-bottom: 14px;
        }
        #logreg-forms .social-btn{
            font-weight: 100;
            color:white;
            width:190px;
            font-size: 0.9rem;
        }

        #logreg-forms a{
            display: block;
            padding-top:10px;
            color:lightseagreen;
        }

        #logreg-form .lines{
            width:200px;
            border:1px solid red;
        }


        #logreg-forms button[type="submit"]{ margin-top:10px; }

        #logreg-forms .facebook-btn{  background-color:#3C589C; }

        #logreg-forms .google-btn{ background-color: #DF4B3B; }

        #logreg-forms .form-reset, #logreg-forms .form-signup{ display: none; }

        #logreg-forms .form-signup .social-btn{ width:210px; }

        #logreg-forms .form-signup input { margin-bottom: 2px;}

        .form-signup .social-login{
            width:210px !important;
            margin: 0 auto;
        }

        /* Mobile */

        @media screen and (max-width:500px){
            #logreg-forms{
                width:300px;
            }

            #logreg-forms  .social-login{
                width:200px;
                margin:0 auto;
                margin-bottom: 10px;
            }
            #logreg-forms  .social-btn{
                font-size: 1.3rem;
                font-weight: 100;
                color:white;
                width:200px;
                height: 56px;

            }
            #logreg-forms .social-btn:nth-child(1){
                margin-bottom: 5px;
            }
            #logreg-forms .social-btn span{
                display: none;
            }
            #logreg-forms  .facebook-btn:after{
                content:'Facebook';
            }

            #logreg-forms  .google-btn:after{
                content:'Google+';
            }

        }
    </style>

</head>
<body>
<div id="logreg-forms">
    <form action="" class="form-signin" method="post">
        <h1 class="h1 mb-3 font-weight-normal" style="text-align: center"> Login</h1>


        <input type="email" id="inputEmail" value="<?php if(isset($_POST["passname"])) { echo $_POST["emailname"]; } ?>" name="emailname" class="form-control" placeholder="Email address" required="" autofocus="">
        <input type="password" id="inputPassword" name="passname" class="form-control" placeholder="Password" required="">

        <button class="btn btn-success btn-block" type="submit"><i class="fas fa-sign-in-alt"></i> Login</button>
        <div style="font-size:18px; color:#cc0000; margin-bottom:20px"><?php echo $error2; ?></div>
        <hr>
        <!-- <p>Don't have an account!</p>  -->
        <button class="btn btn-primary btn-block" type="button" id="btn-signup"><i class="fas fa-user-plus"></i> Register</button>
    </form>



    <form action="" class="form-signup" method="post">
        <h1 class="h1 mb-3 font-weight-normal" style="text-align: center"> Register</h1>

        <input type="text" id="user-name" value="<?php if(isset($_POST["lastname"])) { echo $_POST["lastname"]; } ?>" name="lastname" class="form-control" placeholder="Last name" required="" autofocus="">
        <input type="text" id="user-name" value="<?php if(isset($_POST["firstname"])) { echo $_POST["firstname"]; } ?>" name="firstname" class="form-control" placeholder="First name" required="" autofocus="">
        <input type="email" id="user-email" value="<?php if(isset($_POST["username"])) { echo $_POST["username"]; } ?>" name="username"  class="form-control" placeholder="Email address" required autofocus="">
        <input type="password" id="user-pass" name="password" class="form-control" placeholder="Password" required autofocus="">
        <input type="password" id="user-repeatpass" name="passwords" class="form-control" placeholder="Repeat Password" required autofocus="">
        <button class="btn btn-primary btn-block" type="submit" value="Submit"><i class="fas fa-user-plus"></i> Register</button>
        <a href="#" id="cancel_signup"><i class="fas fa-angle-left"></i> Back</a>
    </form>
    <br>

</div>

</p>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    function toggleResetPswd(e){
        e.preventDefault();
        $('#logreg-forms .form-signin').toggle() // display:block or none
        $('#logreg-forms .form-reset').toggle() // display:block or none
    }

    function toggleSignUp(e){
        e.preventDefault();
        $('#logreg-forms .form-signin').toggle(); // display:block or none
        $('#logreg-forms .form-signup').toggle(); // display:block or none
    }

    $(()=>{
        // Login Register Form
        $('#logreg-forms #forgot_pswd').click(toggleResetPswd);
        $('#logreg-forms #cancel_reset').click(toggleResetPswd);
        $('#logreg-forms #btn-signup').click(toggleSignUp);
        $('#logreg-forms #cancel_signup').click(toggleSignUp);
    })
</script>
</body>
</html>