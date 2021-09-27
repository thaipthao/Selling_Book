
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
    if(isset($_SESSION['login_user'])==false){
        echo "<script>window.location.assign('login.php')</script>";
    }
    require "layout/nav.php";
    require "layout/head.php";
    $error = "";
    $sum = 0;
    if(isset($_SESSION['login_user'])){
        $iduser = $_SESSION['login_user'];
        $query2 = "SELECT *
                FROM Cart,Item,Discount
                WHERE Cart.Id='$iduser' AND Cart.IdItem=Item.Id AND Discount.Id=Item.Discount";
        $result2 = mysqli_query($conn, $query2);
        $row2 = $result2->fetch_all();
        $query = "SELECT * FROM DeliveryAddress WHERE Id='$iduser'";
        $result = mysqli_query($conn, $query);
        $row = $result->fetch_row();
        $count = mysqli_num_rows($result);
    }
    if(isset($_GET['id'])){
        $iduser = $_SESSION['login_user'];
        $iditem = $_GET['id'];
        $query2 = "DELETE FROM Cart WHERE Id='$iduser' AND IdItem='$iditem' ";
        mysqli_query($conn, $query2);
        echo "<script>window.location.assign('cart.php')</script>";
    }
    function GUID()
    {
        if (function_exists('com_create_guid') === true)
        {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }
    if(isset($_GET['send'])){

        $iduser = $_SESSION['login_user'];
        $price = $_GET['send'];
        $idnew = GUID();
        $query2 = "INSERT INTO AdminCart VALUES ('$idnew','$iduser','$price',false)";
        mysqli_query($conn, $query2);
        $query2 = "INSERT INTO CartPrint (IdCart,IdUser,IdItem,Amount)
                SELECT '$idnew',Id,IdItem,Amount
                FROM Cart
                WHERE Id='$iduser' ";

        mysqli_query($conn, $query2);
        $query2 = "DELETE FROM Cart WHERE Id='$iduser'";
        mysqli_query($conn, $query2);
//        echo "<script>alert('Đặt hàng thành công, vui lòng đợi nhân viên cửa hàng liên lạc với bạn, xin cảm ơn')";
        echo "<script>window.location.assign('cart.php')</script>";
    }
    ?>




    <section id="content-holder" class="container-fluid container">
        <section class="row-fluid">

            <section class="span12 cart-holder">
                <div class="heading-bar">
                    <h2>SHOPPING CART</h2>
                    <span class="h-line"></span>
                    <a href="#" class="more-btn">proceed to checkout</a>
                </div>
                <div class="cart-table-holder">
                    <table width="100%" border="0" cellpadding="10">
                        <tr>
                            <th width="14%">&nbsp;</th>
                            <th width="43%" align="left">Product Name</th>
                            <th width="6%"></th>
                            <th width="10%">Unit Price</th>
                            <th width="10%">Quantity</th>
                            <th width="12%">Subtota</th>
                            <th width="5%">&nbsp;</th>
                        </tr>
                        <?php
                            foreach ($row2 as $key=>$value){
                                if($value[10]==0){
                                    $viewreal = $value[9];
                                } else {
                                    $viewreal = $value[9] - ($value[9]*$value[13]/100);
                                }

                                echo '<tr bgcolor="#FFFFFF" class=" product-detail">
                            <td valign="top"><img src="assets/image/'.$value[7].'"/></td>
                            <td valign="top">'.$value[4].' by '.$value[5].'</td>
                            <td align="center" valign="top"><a href="details.php?id='.$value[1].'">Edit</a></td>
                            <td align="center" valign="top">'.number_format($viewreal).'</td>
                            <td align="center" valign="top"><input name="" type="text" value="'.$value[2].'" readonly/></td>
                            <td align="center" valign="top">'.number_format($viewreal*$value[2]).'</td>
                            <td align="center" valign="top"><a href="cart.php?id='.$value[1].'"> <i class="icon-trash"></i></a></td>
                        </tr>';
                                $sum+=$viewreal*$value[2];
                            }
                        ?>

                    </table>
                </div>
                <figure class="span4 first">
                    <div class="cart-option-box">
                        <h4><i class="icon-shopping-cart"></i> ESTIMATE SHIPPING & TAX</h4>
                        <p>Enter your destination to get a shipping estimate.</p>
                        <form class="form-horizontal">
                            <ul class="billing-form">
                                <?php
                                    if($count == 0){
                                        echo '<li>
                                    <div class="control-group">
                                        <label class="control-label" for="inputState/Province">State/Province<sup>*</sup></label>
                                        <div class="controls">
                                            <input type="text" id="inputZip" placeholder="" readonly>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="control-group">
                                        <label class="control-label" for="inputCountry">District <sup>*</sup></label>
                                        <div class="controls">
                                            <input type="text" id="inputZip" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="inputZip">Commune <sup>*</sup></label>
                                        <div class="controls">
                                            <input type="text" id="inputZip" placeholder="" readonly>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="control-group">
                                        <div class="controls">
                                            <a href="profile.php" class="more-btn btn-danger">Update Address</a>
                                        </div>
                                    </div>
                                </li>';
                                    } else {
                                        echo '<li>
                                    <div class="control-group">
                                        <label class="control-label" for="inputState/Province">State/Province<sup>*</sup></label>
                                        <div class="controls">
                                            <input type="text" id="inputZip" placeholder="" readonly value="'.$row[1].'">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="control-group">
                                        <label class="control-label" for="inputCountry">District <sup>*</sup></label>
                                        <div class="controls">
                                            <input type="text" id="inputZip" placeholder="" readonly value="'.$row[2].'">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="inputZip">Commune <sup>*</sup></label>
                                        <div class="controls">
                                            <input type="text" id="inputZip" placeholder="" readonly value="'.$row[3].'">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="control-group">
                                        <div class="controls">
                                            <a href="profile.php" class="more-btn btn-success">Change Address</a>
                                        </div>
                                    </div>
                                </li>';
                                    }
                                ?>

                            </ul>
                        </form>
                    </div>
                </figure>
                <figure class="span4">
                    <div class="cart-option-box">
                        <h4><i class="icon-money"></i> DISCOUNT CODES</h4>
                        <p>Enter your coupon code if you have one.</p>
                        <input type="text" id="inputDiscount" placeholder="">
                        <br / class="clearfix">
                        <a href="#" class="more-btn">apply coupon</a>
                    </div>
                </figure>
                <figure class="span4 price-total">
                    <div class="cart-option-box">
                        <table width="100%" border="0" cellpadding="10" class="total-payment">

                            <tr>
                                <td align="right"><strong class="large-f">GRAND TOTAL :</strong></td>
                                <td align="left"><strong class="large-f"><?php echo number_format($sum)?></strong></td>
                            </tr>
                        </table>
                        <hr />
                        <?php
                            if($count==0){
                                echo '<a class="more-btn btn-danger">pay attention to the address</a>';
                            } else {
                                echo '<a href="cart.php?send='.$sum.'" class="more-btn">proceed to checkout</a>';
                            }
                        ?>
                        <p>Checkout with Multiple Addresses</p>
                    </div>
                </figure>
            </section>
            <!-- End Main Content -->
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