
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
    $error = "";
    $query2 = 'SELECT * FROM TypeItem';
    $result2 = mysqli_query($conn, $query2);
    $row2 = $result2->fetch_all();
    
    if(isset($_GET["id"])){
        $mt = $_GET["id"];
        $query = "SELECT Item.*,TypeItem.Name,Discount.Percent FROM Item,TypeItem,Discount WHERE Item.TypeItem=TypeItem.Id AND Item.Discount=Discount.Id AND Item.Id='$mt'";
        $result = mysqli_query($conn, $query);
        $row = $result->fetch_row();
        if($row[10]==0){
            $viewreal = $row[6];
        } else {
            $viewreal = $row[6] - ($row[6]*$row[10]/100);
        }
    }
    
    if(isset($_GET["amount"])){
        if(isset($_SESSION['login_user'])==false){
            echo "<script>window.location.assign('login.php')</script>";
        } else {
            $user_check = $_SESSION['login_user'];
        $mt = $_GET["id"];
        $sl = $_GET["amount"];
        $query = "SELECT * FROM Item WHERE Item.Id='$mt' AND Item.Amount>'$sl'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);
        if($count == 0){
            $error = "Số lượng trong kho không đủ, vui lòng liên hệ Admin để tiến hành đặt hàng";
        } else {
            $query = "SELECT * FROM Cart WHERE Id='$user_check' AND IdItem='$mt'";
            $results = mysqli_query($conn, $query);
            $cs = mysqli_num_rows($results);
            if($cs==0){
                $query = "INSERT INTO Cart VALUES ('$user_check','$mt','$sl')";
//                print($query);
                mysqli_query($conn, $query);
                echo "<script>window.location.assign('details.php?id=$mt')</script>";
            } else {
                $query = "UPDATE Cart SET Amount = Amount+'$sl' WHERE Id='$user_check' AND IdItem='$mt'";
                mysqli_query($conn, $query);
                echo "<script>window.location.assign('details.php?id=$mt')</script>";
            }
        }
        }
        
    }
    ?>



    <section id="content-holder" class="container-fluid container">
        <section class="row-fluid">
            <div class="heading-bar">
                <h2>Book Detail</h2>
                <span class="h-line"></span>
            </div>

            <section class="span9 first">

                <div class="blog-sec-slider">
                    <div class="slider5">
                        <div class="slide"><a href="#"><img src="assets/images/image22.jpg" alt=""/></a></div>
                        <div class="slide"><a href="#"><img src="assets/images/image36.jpg" alt=""/></a></div>
                        <div class="slide"><a href="#"><img src="assets/images/image22.jpg" alt=""/></a></div>
                    </div>
                </div>


                <section class="b-detail-holder">
                    <article class="title-holder">
                        <div class="span6">
                            <h4><strong><?php echo $row[1]?></strong> by <?php echo $row[2]?></h4>
                        </div>
                        <div class="span6 book-d-nav">
                            <ul>
                                <li><a href="#">2 Reviews</a></li>
                                <li><i class="icon-envelope"></i><a href="#"> Email to a Friend</a></li>
                            </ul>
                        </div>
                    </article>
                    <div class="book-i-caption">

                        <div class="span6 b-img-holder">
                            <span class='zoom' id='ex1'> <img src='assets/image/<?php echo $row[4]?>' height="219" width="300" id='jack' alt=''/></span>
                        </div>


                        <div class="span6">
                            <strong class="title">Quick Overview</strong>
                            <p><?php echo $row[3]?></p>

                            <h5>Price: <a><?php echo $viewreal?></a></h5>
                            <div class="comm-nav">
                                <strong class="title2">Quantity</strong>
                                <form method="get">
                                    <ul>
                                        <input name="id" type="hidden" value="<?php echo $row[0]?>"/>
                                        <li><input name="amount" type="number" value="0"/></li>
                                        <li><button type="submit" class="more-btn">+ Add to Cart</button></li>
                                    </ul>
                                </form>
                                <div style="font-size:18px; color:#cc0000; margin-bottom:20px"><?php echo $error; ?></div>
                                <a href="#">Add to Wishlist</a>
                            </div>
                        </div>

                    </div>

                    <div class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#pane1" data-toggle="tab">Book Summary</a></li>
                            <li><a href="#pane2" data-toggle="tab">Additional Information</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="pane1" class="tab-pane active">
                                <p>Sed molestie semper ligula vitae pellentesque duis laoreet erat a pretium pulvinar, justo nisi fermentum risus, sed condimentum nisl elit vel risus. Vivamus felis dolor, consectetur vel condimentum sit amet, iaculis in orci. </p>
                                <p>Phasellus sed vehicula justo nunc quis erat vel ante ornare pulvinar cras tristique facilisis tincidunt quisque felis erat iaculis at fringilla vitae rutrum id magna. Nam pharetra scelerisque justo at vehicula aliquam erat volutpat.
                                    Quisque vulputate justo eu mattis interdum magna erat porta risus tincidunt </p>
                            </div>
                            <div id="pane2" class="tab-pane">
                                <h4>Pane 2 Content</h4>
                                <p> and so on ...</p>
                            </div>
                        </div>
                    </div>







                </section>

            </section>


            <section class="span3">
                <div class="side-holder">
                    <article class="banner-ad"><img src="assets/images/image20.jpg" alt="Banner Ad"/></article>
                </div>

                <div class="side-holder">
                    <article class="shop-by-list">
                        <h2>Shop by</h2>
                        <div class="side-inner-holder">
                            <strong class="title">Category</strong>
                            <ul class="side-list">
                                <?php

                                foreach ($row2 as $key => $value){

                                    echo '<li><a href="book.php?id='.$value[0].'">'.$value[1].'</a></li>';
                                }
                                ?>

                            </ul>

                        </div>
                    </article>
                </div>




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

<!-- Tieu Long Lanh Kute -->
</html>