
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Book Store</title>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name="viewport" content="width=device-width">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/bs.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/main-slider.css"/>
    <!--[if lte IE 10]><link rel="stylesheet" type="text/css" href="assets/css/customIE.css" /><![endif]-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/font-awesome-ie7.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/jquery.booklet.latest.css" type="text/css" rel="stylesheet" media="screen, projection, tv"/>
    <noscript>
        <link rel="stylesheet" type="text/css" href="assets/css/noJS.css"/>
    </noscript>
    <link href="assets/css/switcher.css" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" name="skins" href="assets/css/default.css" type="text/css" media="all">


</head>
<body>

<div class="wrapper">


    <?php

    require "layout/nav.php";
    require "layout/head.php";
    if (isset($_SESSION['login_user'])){
        $user_check = $_SESSION['login_user'];
        if (isset($conn)) {
            $ses_sql = mysqli_query($conn, "SELECT Users.*,Roles.Name FROM Users,Roles where Users.Id='$user_check' and Users.Roles=Roles.Id");
            $ses_sql2 = mysqli_query($conn, "SELECT Users.*,Roles.Name,DeliveryAddress.* FROM Users,Roles,DeliveryAddress where Users.Id='$user_check' and Users.Roles=Roles.Id and Users.Id=DeliveryAddress.Id");
        }

        $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
        $count = mysqli_num_rows($ses_sql2);
        if(isset($_POST["inputProvince"]) && isset($_POST["inputDistrict"]) && isset($_POST["inputCommune"]) && isset($_POST["inputLastname"])  && isset($_POST["inputFirstname"]) ){
            $ln = $_POST["inputLastname"];
            $fn = $_POST["inputFirstname"];
            $pv = $_POST["inputProvince"];
            $dtr = $_POST["inputDistrict"];
            $cm = $_POST["inputCommune"];
            mysqli_query($conn, "UPDATE Users SET LastName='$ln',FirstName='$fn' WHERE Id='$user_check'");
            if ($count == 0){
                mysqli_query($conn, "INSERT INTO DeliveryAddress VALUES ('$user_check','$pv','$dtr','$cm')");
            } else {
                mysqli_query($conn, "UPDATE DeliveryAddress SET Province='$pv',District='$dtr',Commune='$cm' WHERE Id='$user_check'");
            }

        }
        $pv2 = "";
        $dtr2 = "";
        $cm2 = "";
        if($count==1){
            $row2 = mysqli_fetch_array($ses_sql2, MYSQLI_ASSOC);
            $pv2 = $row2["Province"];
            $dtr2 = $row2["District"];
            $cm2 = $row2["Commune"];
        }
    }

    ?>

    <section id="content-holder" class="container-fluid container">
        <section class="row-fluid">
            <div class="heading-bar">
                <h2>Profile</h2>
                <span class="h-line"></span> </div>

            <section class="checkout-holder">
                <section class="span9 first">

                    <div class="accordion" id="accordion2">

                        <div class="accordion-group">
                            <div class="accordion-heading"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo"> Billing Information </a> </div>
                            <div id="collapseOne" class="accordion-body collapse in">
                                <div class="accordion-inner">
                                    <strong class="green-t">Checkout as Guest</strong>
                                    <form class="form-horizontal" method="post">
                                        <ul class="billing-form">
                                            <li>
                                                <div class="control-group">
                                                    <label class="control-label" for="inputFirstname">First Name <sup>*</sup></label>
                                                    <div class="controls">
                                                        <input type="text" name="inputFirstname"  value="<?php echo $row["FirstName"]?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="inputLastname">Last Name<sup>*</sup></label>
                                                    <div class="controls">
                                                        <input type="text" name="inputLastname"  value="<?php echo $row["LastName"]?>">
                                                    </div>
                                                </div>
                                            </li>
                                            <li>

                                                <div class="control-group">
                                                    <label class="control-label" for="inputEmail">Email Address<sup>*</sup></label>
                                                    <div class="controls">
                                                        <input type="text" id="inputEmail" placeholder="" readonly value="<?php echo $row["Email"]?>">
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="control-group">
                                                    <label class="control-label" for="inputProvince">Province <sup>*</sup></label>
                                                    <div class="controls">
                                                        <input type="text" name="inputProvince" placeholder="" value="<?php echo $pv2?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="inputDistrict">District<sup>*</sup></label>
                                                    <div class="controls">
                                                        <input type="text" name="inputDistrict" placeholder="" value="<?php echo $dtr2?>">
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="control-group">
                                                    <label class="control-label" for="inputCommune">Commune (Specify the name of the street) <sup>*</sup></label>
                                                    <div class="controls">
                                                        <input type="text" name="inputCommune" placeholder="" value="<?php echo $cm2 ?>">
                                                    </div>
                                                </div>

                                            </li>
                                            <br>
                                            <li>
                                                <div class="control-group">
                                                    <div class="controls">
                                                        <button type="submit" class="more-btn">Save</button>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>

                </section>
                <section class="span3 first">
                    <div class="side-holder">
                        <div class="r-title-bar"> <strong><a href="#">Write Your Own Review > </a></strong> </div>
                        <ul class="review-list">
                            <li><a href="#">Billing Information</a></li>
                            <li><a href="#">Shipping Information</a></li>
                            <li><a href="#">Shipping Method</a></li>
                            <li><a href="#">Payment Method </a></li>
                            <li><a href="#">Order Review</a></li>
                        </ul>
                    </div>
                </section>
            </section>

        </section>
    </section>




    <?php
    require "layout/footer.php";
    ?>


</div>


<script type="text/javascript" src="assets/js/lib.js"></script>
<script type="text/javascript" src="assets/js/modernizr.js"></script>
<script type="text/javascript" src="assets/js/easing.js"></script>
<script type="text/javascript" src="assets/js/bs.js"></script>
<script type="text/javascript" src="assets/js/bxslider.js"></script>
<script type="text/javascript" src="assets/js/input-clear.js"></script>
<script src="assets/js/range-slider.js"></script>
<script src="assets/js/jquery.zoom.js"></script>
<script type="text/javascript" src="assets/js/bookblock.js"></script>
<script type="text/javascript" src="assets/js/social.js"></script>
<script src="assets/js/jquery.booklet.latest.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $("#mybook").booklet({
            width:'100%',
            height:430,
            auto: true,
            //speed: 250,
        });
    });
</script>

<noscript>
    <style>#socialicons>a span{top:0px;left:-100%;-webkit-transition:all 0.3s ease;-moz-transition:all 0.3s ease-in-out;-o-transition:all 0.3s ease-in-out;-ms-transition:all 0.3s ease-in-out;transition:all 0.3s ease-in-out;}#socialicons>ahover div{left:0px;}</style>
</noscript>
<script type="text/javascript">
    /* <![CDATA[ */
    $(document).ready(function() {
        $('.social_active').hoverdir( {} );
    })
    /* ]]> */
</script>

<script type="text/javascript" src="assets/js/cookie.js"></script>
<script type="text/javascript" src="assets/js/colorswitcher.js"></script>

<script type="text/javascript" src="assets/js/custom.js"></script>
</body>

</html>