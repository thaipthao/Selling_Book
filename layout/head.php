<?php

//$sqlist = mysqli_query($conn, "SELECT * FROM EducationProgram");
//$page = mysqli_fetch_all($sqlist,MYSQLI_ASSOC);
//    $count = mysqli_num_rows($page);
if (isset($_SESSION['login_user'])){
    $user_check = $_SESSION['login_user'];
    if (isset($conn)) {
        $ses_sql = mysqli_query($conn, "SELECT Users.*,Roles.Name FROM Users,Roles where Users.Id='$user_check' and Users.Roles=Roles.Id");
    }

    $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
}
function logout(){
    session_destroy();
    header("location: index.php");

}
if (isset($_GET['logout'])) {
    logout();
}
?>
<header id="main-header">
    <section class="container-fluid container">
        <section class="row-fluid">
            <section class="span4">
                <h1 id="logo"> <a href="index.php"><img src="assets/images/logo.png"/></a> </h1>
            </section>
            <section class="span8">
            <?php
                if (isset($_SESSION['login_user'])) {
                    if ($row["Name"]=="Admin"){
                        echo '
                                <ul class="top-nav2">
                                    <li><a href="profile.php">Hello, '.$row["LastName"].' '.$row["FirstName"].'</a></li>
                                    <li><a href="admin.php">Dashboard</a></li>
                                    <li><a href="index.php?logout">Logout</a></li>
                                </ul>
                                ';
                    } else {
                        echo '
                                <ul class="top-nav2">
                                    <li><a href="profile.php">Hello, '.$row["LastName"].' '.$row["FirstName"].'</a></li>
                                    <li><a href="index.php?logout">Logout</a></li>
                                </ul>
                                ';
                    }
                } else {
                        echo '
                                <ul class="top-nav2">
                                    <li><a href="login.php">Login</a></li>
                                </ul>
                                ';
                }
            ?>
                <div class="search-bar">
                    <input name="" type="text" value="search entire store here..."/>
                    <input name="" type="button" value="Search"/>
                </div>
            </section>
        </section>
    </section>

    <nav id="nav">
        <div class="navbar navbar-inverse">
            <div class="navbar-inner">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <div class="nav-collapse collapse">
                    <ul class="nav">
                        <li> <a href="book.php">Books</a> </li>
                        <li> <a href="grid-view.html">NOOK Books</a></li>
                        <li><a href="grid-view.html">Textbooks</a></li>
                        <li><a href="grid-view.html">News stand</a></li>
                        <li><a href="grid-view.html">Teens</a></li>
                        <li><a href="grid-view.html">Toys & Games</a></li>
                        <li class="dropdown"> <a class="dropdown-toggle" href="grid-view.html" data-toggle="dropdown"><i class="icon-heart"></i> Features<b class="caret"></b> </a>
                            <ul class="dropdown-menu">
                                <li><a href="about-us.html">About Us</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="blog-detail.html">Blog Detail</a></li>
                                <li><a href="grid-view.html">Product Grid View</a></li>
                                <li><a href="list-view.html">Product List View</a></li>
                                <li><a href="grid-view-without-side-bar.html">Product Grid View Without Side Bar</a></li>
                                <li><a href="shortcodes.html">Short Codes</a></li>
                                <li><a href="blog-detail.html">News</a></li>
                                <li><a href="contact.html">Contact Us</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"> <a class="dropdown-toggle" href="grid-view.html" data-toggle="dropdown">Movies & TV <b class="caret"></b> </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Submenu Detail Column 1</a></li>
                                <li><a href="#">Submenu Detail Column 2</a></li>
                                <li><a href="#">Submenu Detail Column 3</a></li>
                            </ul>
                        </li>
                        <li> <a href="grid-view.html">Music</a></li>
                        <li> <a href="grid-view.html">Gift Cards</a> </li>
                        <li><a href="grid-view.html">Deals & Offers</a></li>
                    </ul>
                </div>

            </div>

        </div>

    </nav>

</header>