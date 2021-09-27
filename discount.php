<?php
require "layout/_menu.php";
require "layout/_nav.php";
$query = 'SELECT * FROM Discount';
$result = mysqli_query($conn, $query);
$row = $result->fetch_all();
if(isset($_GET["id"])){
    $id = $_GET["id"];
    $query = "DELETE FROM Discount WHERE Id='$id'";
    mysqli_query($conn, $query);
    echo "<script>window.location.assign('discount.php')</script>";
}
?>
<link href="assets/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Discount / <a href="discounte.php">Create</a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Percent</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Percent</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    foreach ($row as $key => $value){
                        echo '<tr>
                                    <td>'.$value[1].'%</td>
                                    <td><a href="discounte.php?id='.$value[0].'" data-color="#265ed7">EDIT</a></td>
                                    <td><a href="discount.php?id='.$value[0].'" data-color="#265ed7">DELETE</a></td>
                                </tr>';
                    }
                    ?>

                    </tbody>
                </table>
            </div>
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
