<?php
require "layout/_menu.php";
require "layout/_nav.php";
$query2 = "SELECT * FROM TypeItem";
$result2 = mysqli_query($conn, $query2);
$list2 = $result2->fetch_all();
$query3 = "SELECT * FROM Discount";
$result3 = mysqli_query($conn, $query3);
$list3 = $result3->fetch_all();
$error = "";
$viewId = "";
if(isset($_GET["id"])){
    $viewId = $_GET["id"];
    $query = "SELECT * FROM Item WHERE Id='$viewId'";
    $result = mysqli_query($conn, $query);
    $row = $result->fetch_row();
    $nameview = $row[1];
    $authorview = $row[2];
    $contentview = $row[3];
    $imageview = $row[4];
    $amountview = $row[5];
    $priceview = $row[6];
    $typeitemview = $row[7];
    $discountview = $row[8];
    $error = "Hãy chọn lại ảnh mới, nếu không sẽ sử dụng ảnh cũ";
}
if(isset($_POST["Create"])){
    $name = $_POST["Name"];
    $author = $_POST["Author"];
    $content = $_POST["Content"];
    $amount = $_POST["Amount"];
    $price = $_POST["Price"];
    $typeitem = $_POST["TypeItem"];
    $discount = $_POST["Discount"];
    $image = $_FILES['Image']['name'];
    $target = "assets/image/" . basename($image);
    move_uploaded_file($_FILES['Image']['tmp_name'], $target);
    $tagetdata = $image;
    $query = "INSERT INTO Item VALUES (UUID(),'$name','$author','$content','$tagetdata','$amount','$price','$typeitem','$discount')";
    mysqli_query($conn, $query);
    echo "<script>window.location.assign('item.php')</script>";
}
if(isset($_POST["Edit"])){
    $id = $_POST["Id"];
    $name = $_POST["Name"];
    $author = $_POST["Author"];
    $content = $_POST["Content"];
    $amount = $_POST["Amount"];
    $price = $_POST["Price"];
    $typeitem = $_POST["TypeItem"];
    $discount = $_POST["Discount"];
    $image = $_FILES['Image']['name'];
    $target = "assets/image/" . basename($image);
    move_uploaded_file($_FILES['Image']['tmp_name'], $target);
    $tagetdata = $image;
    $query = "UPDATE Item SET Name='$name',Author='$author',Content='$content',Image='$tagetdata',Amount='$amount',Price='$price',TypeItem='$typeitem',Discount='$discount' WHERE Id='$id'";
    mysqli_query($conn, $query);
    echo "<script>window.location.assign('item.php')</script>";

}

?>
<link href="assets/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo isset($_GET["id"]) ? "Edit" : "Create"  ?> Discount / <a href="item.php">Cancel</a></h6>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="Id" value="<?php echo $viewId ?>">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" name="Name" placeholder="Enter Name" value="<?php if (isset($_GET["id"])) echo $nameview ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Author</label>
                    <input type="text" class="form-control" name="Author" placeholder="Enter Author" value="<?php if (isset($_GET["id"])) echo $authorview ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Content</label>
                    <input type="text" class="form-control" name="Content" placeholder="Enter Content" value="<?php if (isset($_GET["id"])) echo $contentview ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Image</label>
                    <input type="file" class="form-control" name="Image" placeholder="Enter Image" value="<?php if (isset($_GET["id"])) echo $imageview ?>">
                </div>
                <div style="font-size:18px; color:#cc0000; margin-bottom:20px"><?php echo $error; ?></div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Amount</label>
                    <input type="number" class="form-control" name="Amount" placeholder="Enter Amount" value="<?php if (isset($_GET["id"])) echo $amountview ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Price</label>
                    <input type="number" class="form-control" name="Price" placeholder="Enter Price" value="<?php if (isset($_GET["id"])) echo $priceview ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">TypeItem</label>
                    <select class="custom-select col-12" name="TypeItem" id="TypeItem">
                        <?php
                        foreach ($list2 as $key => $value){
                            echo '<option value="'.$value[0].'">'.$value[1].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Discount</label>
                    <select class="custom-select col-12" name="Discount" id="Discount">
                        <?php
                        foreach ($list3 as $key => $value){
                            echo '<option value="'.$value[0].'">'.$value[1].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <script>
                    document.getElementById("TypeItem").value = "<?php echo $typeitemview?>";
                    document.getElementById("Discount").value = "<?php echo $discountview?>";
                </script>
                <?php
                if(isset($_GET["id"])){
                    echo '<button type="submit" name="Edit" class="btn btn-success">Edit</button>';
                } else {
                    echo '<button type="submit" name="Create" class="btn btn-primary">Create</button>';
                }
                ?>

            </form>
        </div>
    </div>





    <?php
    require "layout/_footer.php";
    ?>
    <!-- Page level plugins -->
    <script src="assets/admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/admin/js/demo/datatables-demo.js"></script>
