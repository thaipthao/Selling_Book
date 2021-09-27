
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
    $query = 'SELECT Item.*,TypeItem.Name,Discount.Percent FROM Item,TypeItem,Discount WHERE Item.TypeItem=TypeItem.Id AND Item.Discount=Discount.Id';
    $result = mysqli_query($conn, $query);
    $row = $result->fetch_all();
    $query2 = 'SELECT * FROM TypeItem';
    $result2 = mysqli_query($conn, $query2);
    $row2 = $result2->fetch_all();
    if(isset($_GET["id"])){
        $mt = $_GET["id"];
        $query = "SELECT Item.*,TypeItem.Name,Discount.Percent FROM Item,TypeItem,Discount WHERE Item.TypeItem=TypeItem.Id AND Item.Discount=Discount.Id AND TypeItem.Id='$mt'";
        $result = mysqli_query($conn, $query);
        $row = $result->fetch_all();
    }
    ?>




    <section id="content-holder" class="container-fluid container">
        <section class="row-fluid">
            <div class="heading-bar">
                <h2>Grid View</h2>
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


                <div class="product_sort">
                    <div class="row-1">
                        <div class="left">
                            <span class="s-title">Sort by</span>
                            <span class="list-nav">
<select name="">
<option>Position</option>
<option>Position 2</option>
<option>Position 3</option>
<option>Position 4</option>
</select>
</span>
                        </div>
                        <div class="right">
                            <span>Show</span>
                            <span>
<select name="">
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
</select>
</span>
                            <span>per page</span>
                        </div>
                    </div>
                    <div class="row-2">
                        <span class="left">Items 1 to 9 of 15 total</span>
                        <ul class="product_view">
                            <li>View as:</li>
                            <li>
                                <a class="grid-view" href="grid-view.html">Grid View</a>
                            </li>
                            <li>
                                <a class="list-view" href="list-view.html">List View</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <section class="list-holder">
                    <?php

                    foreach ($row as $key => $value){
                        if($value[10]==0){
                            $viewreal = $value[6];
                        } else {
                            $viewreal = $value[6] - ($value[6]*$value[10]/100);
                        }

                        echo '<article class="item-holder">
                        <div class="span2">
                            <a href="details.php?id='.$value[0].'"><img src="assets/image/'.$value[4].'" alt="Image07"/></a> </div>
                        <div class="span10">
                            <div class="title-bar"><a href="details.php?id='.$value[0].'">'.$value[1].'</a> <span>by '.$value[2].'</span></div>
                            
                            <span class="rating-bar"><img alt="Rating Star" src="assets/images/rating-star.png"></span>
                            <p>'.$value[3].'</p>
                            <div class="cart-price">
                                <a href="cart.html" class="cart-btn2">Add to Cart</a>
                                <span class="price">'.$viewreal.'</span>
                            </div>
                        </div>
                    </article>';
                    }
                    ?>

                </section>
                <div class="blog-footer">
                    <div class="pagination">
                        <ul>
                            <li><a href="#">Prev</a></li>
                            <li class="active">
                                <a href="#">1</a>
                            </li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">Next</a></li>
                        </ul>
                    </div>
                    <ul class="product_view">
                        <li>View as:</li>
                        <li><a class="grid-view" href="grid-view.html">Grid View</a></li>
                        <li><a class="list-view" href="list-view.html">List View</a></li>
                    </ul>
                </div>

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