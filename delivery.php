<?php
require "layout/_menu.php";
require "layout/_nav.php";
$query = 'SELECT * FROM AdminCart';
$result = mysqli_query($conn, $query);
$row = $result->fetch_all();
if(isset($_GET["id"])){
    $id = $_GET["id"];
    print($id);
    $query = "UPDATE AdminCart SET IsActive=true WHERE Id='$id'";
    mysqli_query($conn, $query);
    $query = "SELECT * FROM CartPrint,Item WHERE CartPrint.IdItem=Item.Id AND CartPrint.IdCart='$id'";
    $result = mysqli_query($conn, $query);
    $row = $result->fetch_all();
    foreach ($row as $key => $value){
        $query = "UPDATE Item SET Amount=Amount-'$value[3]' WHERE Id='$value[4]'";
        $result = mysqli_query($conn, $query);
    }
    echo "<script>window.location.assign('delivery.php')</script>";
}
?>
<link href="assets/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Delivery</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>User</th>
                        <th>Price</th>
                        <th>Active</th>
                        <th>Confirm</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>User</th>
                        <th>Price</th>
                        <th>Active</th>
                        <th>Confirm</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    foreach ($row as $key => $value){
                        if($value[3] == 0){
                            echo '<tr>
                                    <td><a href="items.php?id='.$value[0].'" data-color="#265ed7">'.$value[0].'</a></td>
                                    <td><a href="users.php?id='.$value[1].'" data-color="#265ed7">'.$value[1].'</a></td>
                                    <td>'.$value[2].'</td>
                                    <td>'.$value[3].'</td>
                                    <td><a href="delivery.php?id='.$value[0].'" data-color="#265ed7">DELIVERY</a></td>
                                </tr>';
                        } else {
                            echo '<tr>
                                    <td><a href="#" data-color="#265ed7">'.$value[0].'</a></td>
                                    <td><a href="#" data-color="#265ed7">'.$value[1].'</a></td>
                                    <td>'.$value[2].'</td>
                                    <td>'.$value[3].'</td>
                                    <td><a href="#" data-color="#d73e26">CONFIRMED</a></td>
                                </tr>';
                        }

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
