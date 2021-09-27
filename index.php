
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


</head>
<body>

<div class="wrapper">


    <?php
    require "layout/nav.php";
    require "layout/head.php";
    $query = 'SELECT Item.*,TypeItem.Name,Discount.Percent FROM Item,TypeItem,Discount WHERE Item.TypeItem=TypeItem.Id AND Item.Discount=Discount.Id';
    $result = mysqli_query($conn, $query);
    $row = $result->fetch_all();
    if(isset($_GET["deleteall"])){
        if(isset($_SESSION['login_user'])){
            $iduser = $_SESSION['login_user'];
            $querys = "DELETE FROM Cart WHERE Id='$iduser'";
            mysqli_query($conn, $querys);
            echo "<script>window.location.assign('index.php')</script>";
        }
    }
    ?>




    <section id="content-holder" class="container-fluid container">
        <section class="row-fluid">
            <section class="book-box">
                <div class="book-outer">
                    <div id="mybook">
                        <div title="first page">
                            <div class="left-page">
                                <div class="frame"><img src="assets/images/image01.jpg" alt="img"></div>
                                <div class="bottom">
                                    <div class="cart-price"> <span class="cart">&nbsp;</span> <strong class="price">$149.50</strong> </div>
                                </div>
                            </div>
                        </div>
                        <div title="second page">
                            <div class="right-page">
                                <div class="text">
                                    <h1>Parenting - For Early Years</h1>
                                    <strong class="name">by Bonnier</strong>
                                    <div class="rating-box"><img src="assets/images/rating-img.png" alt="img"></div>
                                    <a href="#" class="btn-shop">SHOP NOW</a> </div>
                                <div class="bottom">
                                    <div class="text">
                                        <div class="inner">
                                            <p>Curabitur lreaoreet nisl lorem in pellente e vidicus pannel impirus sadintas velisurabitur lreaoreet nisl lorem in pellente vidicus pannel.</p>
                                            <a href="#" class="readmore">Read More</a> </div>
                                        <div class="batch-icon"><img src="assets/images/batch-img.png" alt="img"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div title="third page">
                            <div class="left-page">
                                <div class="frame"><img src="assets/images/image01.jpg" alt="img"></div>
                                <div class="bottom">
                                    <div class="cart-price"> <span class="cart">&nbsp;</span> <strong class="price">$149.50</strong> </div>
                                </div>
                            </div>
                        </div>
                        <div title="fourth page">
                            <div class="right-page">
                                <div class="text">
                                    <h1>Parenting - For Early</h1>
                                    <strong class="name">by Bonnier</strong>
                                    <div class="rating-box"><img src="assets/images/rating-img.png" alt="img"></div>
                                    <a href="#" class="btn-shop">SHOP NOW</a> </div>
                                <div class="bottom">
                                    <div class="text">
                                        <div class="inner">
                                            <p>Curabitur lreaoreet nisl lorem in pellente e vidicus pannel impirus sadintas velisurabitur lreaoreet nisl lorem in pellente vidicus pannel.</p>
                                            <a href="#" class="readmore">Read More</a> </div>
                                        <div class="batch-icon"><img src="assets/images/batch-img.png" alt="img"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div title="fifth page">
                            <div class="left-page">
                                <div class="frame"><img src="assets/images/image01.jpg" alt="img"></div>
                                <div class="bottom">
                                    <div class="cart-price"> <span class="cart">&nbsp;</span> <strong class="price">$149.50</strong> </div>
                                </div>
                            </div>
                        </div>
                        <div title="sixth page">
                            <div class="right-page">
                                <div class="text">
                                    <h1>For Early Years</h1>
                                    <strong class="name">by Bonnier</strong>
                                    <div class="rating-box"><img src="assets/images/rating-img.png" alt="img"></div>
                                    <a href="#" class="btn-shop">SHOP NOW</a> </div>
                                <div class="bottom">
                                    <div class="text">
                                        <div class="inner">
                                            <p>Curabitur lreaoreet nisl lorem in pellente e vidicus pannel impirus sadintas velisurabitur lreaoreet nisl lorem in pellente vidicus pannel.</p>
                                            <a href="#" class="readmore">Read More</a> </div>
                                        <div class="batch-icon"><img src="assets/images/batch-img.png" alt="img"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div title="seventh page">
                            <div class="left-page">
                                <div class="frame"><img src="assets/images/image01.jpg" alt="img"></div>
                                <div class="bottom">
                                    <div class="cart-price"> <span class="cart">&nbsp;</span> <strong class="price">$149.50</strong> </div>
                                </div>
                            </div>
                        </div>
                        <div title="eighth page">
                            <div class="right-page">
                                <div class="text">
                                    <h1>Parenting </h1>
                                    <strong class="name">by Bonnier</strong>
                                    <div class="rating-box"><img src="assets/images/rating-img.png" alt="img"></div>
                                    <a href="#" class="btn-shop">SHOP NOW</a> </div>
                                <div class="bottom">
                                    <div class="text">
                                        <div class="inner">
                                            <p>Curabitur lreaoreet nisl lorem in pellente e vidicus pannel impirus sadintas velisurabitur lreaoreet nisl lorem in pellente vidicus pannel.</p>
                                            <a href="#" class="readmore">Read More</a> </div>
                                        <div class="batch-icon"><img src="assets/images/batch-img.png" alt="img"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="span12 wellcome-msg m-bottom first">
                <h2>WELCOME TO BookShoppe’.</h2>
                <p>Offering a wide selection of books on thousands of topics at low prices to satisfy any book-lover!</p>
            </section>
        </section>
        <section class="row-fluid ">
            <figure class="span4 s-product">
                <div class="s-product-img"><a href="book-detail.html"><img src="assets/images/image02.jpg" alt="Image02"/></a></div>
                <article class="s-product-det">
                    <h3><a href="book-detail.html">A Walk Across The Sun</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod dolore magna aliqua.</p>
                    <span class="rating-bar"><img src="assets/images/rating-star.png" alt="Rating Star"/></span>
                    <div class="cart-price"> <a href="cart.html" class="cart-btn2">Add to Cart</a> <span class="price">$129.90</span> </div>
                    <span class="sale-icon">Sale</span> </article>
            </figure>
            <figure class="span4 s-product">
                <div class="s-product-img"><a href="book-detail.html"><img src="assets/images/image03.jpg" alt="Image02"/></a></div>
                <article class="s-product-det">
                    <h3><a href="book-detail.html">Harry Potter</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod dolore magna aliqua.</p>
                    <span class="rating-bar"><img src="assets/images/rating-star.png" alt="Rating Star"/></span>
                    <div class="cart-price"> <a href="cart.html" class="cart-btn2">Add to Cart</a> <span class="price">$44.95</span> </div>
                    <span class="sale-icon">Sale</span> </article>
            </figure>
            <figure class="span4 s-product">
                <div class="s-product-img"><a href="book-detail.html"><img src="assets/images/image04.jpg" alt="Image02"/></a></div>
                <article class="s-product-det">
                    <h3><a href="book-detail.html">Sleeping Beauty</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod dolore magna aliqua.</p>
                    <span class="rating-bar"><img src="assets/images/rating-star.png" alt="Rating Star"/></span>
                    <div class="cart-price"> <a href="cart.html" class="cart-btn2">Add to Cart</a> <span class="price">$223.00</span> </div>
                    <span class="sale-icon">Sale</span> </article>
            </figure>
        </section>

        <section class="row-fluid features-books">
            <section class="span12 m-bottom">
                <div class="heading-bar">
                    <h2>Featured Books</h2>
                    <span class="h-line"></span> </div>
                <div class="slider1">
                    <?php

                        foreach ($row as $key => $value){
                            if($value[10]==0){
                                $viewreal = $value[6];
                            } else {
                                $viewreal = $value[6] - ($value[6]*$value[10]/100);
                            }
                            echo '<div class="slide"> <a href="details.php?id='.$value[0].'"><img src="assets/image/'.$value[4].'" alt="" class="pro-img"/></a> <span class="title"><a href="details.php?id='.$value[0].'">'.$value[1].'</a></span> <span class="rating-bar"><img src="assets/images/rating-star.png" alt="Rating Star"/></span>
                        <div class="cart-price"> <a class="cart-btn2" href=details.php?id='.$value[0].'">Add to Cart</a> <span class="price">'.$viewreal.'</span> </div>
                    </div>';
                        }
                    ?>

                </div>
            </section>
        </section>




        <section class="row-fluid m-bottom">

            <section class="span9 blog-section">
                <div class="heading-bar">
                    <h2>Latest from the Blog</h2>
                    <span class="h-line"></span> </div>
                <div class="slider3">
                    <div class="slide">
                        <div class="post-img"><a href="blog-detail.html"><img src="assets/images/image18.jpg" alt=""/></a> <span class="post-date"><span>02</span> May</span> </div>
                        <div class="post-det">
                            <h3><a href="blog-detail.html">Our latest arrival is the Spring Summer 2013 Book Fair</a></h3>
                            <span class="comments-num">6 comments</span>
                            <p>Gluten-free quinoa selfies carles, kogi gentrify retro marfa viral. Aesthetic before they sold out put a bird on it sriracha typewriter. Skateboard viral irony tonx ... </p>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="post-img"><a href="blog-detail.html"><img src="assets/images/image29.jpg" alt=""/></a> <span class="post-date"><span>24</span> Oct</span> </div>
                        <div class="post-det">
                            <h3><a href="blog-detail.html">Our latest arrival is the Spring Summer 2012 Book Fair</a></h3>
                            <span class="comments-num">48 comments</span>
                            <p>Gluten-free quinoa selfies carles, kogi gentrify retro marfa viral. Aesthetic before they sold out put a bird on it sriracha typewriter. Skateboard viral irony tonx ... </p>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="post-img"><a href="blog-detail.html"><img src="assets/images/image30.jpg" alt=""/></a> <span class="post-date"><span>10</span> Aug</span> </div>
                        <div class="post-det">
                            <h3><a href="blog-detail.html">Our latest arrival is the Spring Summer 2011 Book Fair</a></h3>
                            <span class="comments-num">24 comments</span>
                            <p>Gluten-free quinoa selfies carles, kogi gentrify retro marfa viral. Aesthetic before they sold out put a bird on it sriracha typewriter. Skateboard viral irony tonx ... </p>
                        </div>
                    </div>
                </div>
            </section>


            <section class="span3 testimonials">
                <div class="heading-bar">
                    <h2>Testimonials</h2>
                    <span class="h-line"></span> </div>
                <div class="slider4">
                    <div class="slide">
                        <div class="author-name-holder"> <img src="assets/images/image19.png"/> </div>
                        <strong class="title">Robert Smith <span>Manager</span></strong>
                        <div class="slide">
                            <p>Lorem ipsum dolor slo onsec nelioro tueraliquet Morbi nec In Curabitur lorem in design Morbi nec In Curabituritus gojus, </p>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="author-name-holder"> <img src="assets/images/image19.png"/> </div>
                        <strong class="title">Mr. Khalid Hosseini <span>Manager</span></strong>
                        <div class="slide">
                            <p>Gluten-free quinoa selfies carles, kogi gentrify retro marfa viral. Aesthetic before they sold out put a bird on it sriracha typewriter. Skateboard viral irony tonx ... </p>
                        </div>
                    </div>
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