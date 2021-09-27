<?php
include("config/db_connection.php");
$sl = 0;
$sum = 0;
if (isset($_SESSION['login_user'])){
    $user_check = $_SESSION['login_user'];
    $query = "SELECT SUM(Amount)
                FROM Cart
                WHERE Id='$user_check'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_fetch_array($result);
    if($count[0] != null){
        $sl = $count[0];
    }

    $query2 = "SELECT Item.Price,Discount.Percent,Cart.Amount
FROM Cart,Item,Discount
WHERE Cart.Id='$user_check' and Cart.IdItem = Item.Id and Item.Discount = Discount.Id";
    $result = mysqli_query($conn, $query2);
    $row = $result->fetch_all();

    foreach ($row as $key => $value){
        $sum += ($value[0] - ($value[0]*$value[1]/100))* $value[2];
    }
}

?>
<section class="top-nav-bar">
    <section class="container-fluid container">
        <section class="row-fluid">
            <section class="span6">
                <ul class="top-nav">
                    <li><a href="index.php" class="active">Home page</a></li>
                    <li><a href="grid-view.html">Online Store</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="shortcodes.html">Short Codes</a></li>
                    <li><a href="blog-detail.html">News</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                </ul>
            </section>
            <section class="span6 e-commerce-list">
                <ul>
<!--                    <li>Welcome! <a href="checkout.html">Login</a> or <a href="checkout.html">Create an account</a></li>-->
<!--                    <li class="p-category"><a href="#">$</a> <a href="#">£</a> <a href="#">€</a></li>-->
<!--                    <li class="p-category"><a href="#">eng</a> <a href="#">de</a> <a href="#">fr</a></li>-->
                </ul>
                <div class="c-btn"> <a href="cart.php" class="cart-btn">Cart</a>
                    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle"><?php echo $sl?> item(s) - <?php echo number_format($sum) ?><span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="index.php?deleteall">Xóa All</a></li>
                            <li><a href="cart.php">Thanh Toán</a></li>
                        </ul>
                    </div>
                </div>
            </section>
        </section>
    </section>
</section>