<?php
require "layout/_menu.php";
require "layout/_nav.php";
$item = $_GET["id"];
$query = "SELECT * FROM Users,DeliveryAddress WHERE Users.Id='$item' AND DeliveryAddress.Id=Users.Id";
$result = mysqli_query($conn, $query);
$row = $result->fetch_all();
?>
<link href="assets/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Users / <a href="delivery.php">Cancel</a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    foreach ($row as $key => $value){
                        echo '<tr>
                                    <td>'.$value[2].' '.$value[1].'</td>
                                    <td>'.$value[10].', '.$value[9].', '.$value[8].'</td>
                                    
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
