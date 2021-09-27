<?php
require "layout/_menu.php";
require "layout/_nav.php";


$viewId = "";
if(isset($_GET["id"])){
    $viewId = $_GET["id"];
    $query = "SELECT * FROM TypeItem WHERE Id='$viewId'";
    $result = mysqli_query($conn, $query);
    $row = $result->fetch_row();
    $nameview = $row[1];
}
if(isset($_POST["Create"])){
    $name = $_POST["Name"];
    $query = "INSERT INTO TypeItem VALUES (UUID(),'$name')";
    mysqli_query($conn, $query);
    echo "<script>window.location.assign('typeitem.php')</script>";
}
if(isset($_POST["Edit"])){
    $id = $_POST["Id"];
    $name = $_POST["Name"];
    $query = "UPDATE TypeItem SET Name='$name' WHERE Id='$id'";
    mysqli_query($conn, $query);
    echo "<script>window.location.assign('typeitem.php')</script>";
}
?>
<link href="assets/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo isset($_GET["id"]) ? "Edit" : "Create"  ?> Type Item / <a href="typeitem.php">Cancel</a></h6>
        </div>
        <div class="card-body">
            <form method="post">
                <input type="hidden" class="form-control" name="Id" value="<?php echo $viewId ?>">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" name="Name" placeholder="Enter Name" value="<?php if (isset($_GET["id"])) echo $nameview ?>">
                </div>
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
