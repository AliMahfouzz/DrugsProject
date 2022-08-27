<?php
ob_start();
include('connection.php');
session_start();

if($_SESSION['usertype'] == 'admin'){
    $query = "SELECT o.*, u.name as client_name, p.name as pharmacie_name, d.name as delivery_name, m.name as medicine_name FROM mims.orders o
    left join users u on u.idusers = o.idclient
    left join users p on p.idusers = o.idph
    left join users d on d.idusers = o.iddelivery
    left join medicine m on m.idmedicine = o.idmedicine";

}
else if($_SESSION['usertype'] == 'delivery'){
    $query = "SELECT o.*, u.name as client_name, p.name as pharmacie_name, d.name as delivery_name, m.name as medicine_name FROM mims.orders o
    left join users u on u.idusers = o.idclient
    left join users p on p.idusers = o.idph
    left join users d on d.idusers = o.iddelivery
    left join medicine m on m.idmedicine = o.idmedicine
    WHERE d.name = '".$_SESSION['username']."'
    ";
}
else if($_SESSION['usertype'] == 'pharmacie'){
    $query = "SELECT o.*, u.name as client_name, p.name as pharmacie_name, d.name as delivery_name, m.name as medicine_name FROM mims.orders o
    left join users u on u.idusers = o.idclient
    left join users p on p.idusers = o.idph
    left join users d on d.idusers = o.iddelivery
    left join medicine m on m.idmedicine = o.idmedicine
    WHERE p.name = '".$_SESSION['username']."' or u.name = '".$_SESSION['username']."'
    ";
}
else{
    $query = "SELECT o.*, u.name as client_name, p.name as pharmacie_name, d.name as delivery_name, m.name as medicine_name FROM mims.orders o
    left join users u on u.idusers = o.idclient
    left join users p on p.idusers = o.idph
    left join users d on d.idusers = o.iddelivery
    left join medicine m on m.idmedicine = o.idmedicine
    WHERE u.name = '".$_SESSION['username']."'
    ";
}

$result = mysqli_query($con, $query);

include('assignordertodelivery.php');
include('ordersetstate.php');


?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Mims</title>

    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css"
    href="css/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link rel="stylesheet" href="css/font-awesome.min.css">


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css-1/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700|Roboto:400,700&display=swap" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css-1/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css-1/responsive.css" rel="stylesheet" />

    <link href="js/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
   

    <style>
        .detail-box {
            min-width: 50%;
        }
        .table-responsive{
            width: 100% !important;
        }
        hr{
            border:3px solid #178066
        }
        .dataTables_wrapper {
  width: 100% !important;
}
.assigndelivery{
    background:#178066;
    color:white
}
.page-item.active .page-link{
    background:#178066;
    color:white;
    border:0
}

    </style>
</head>

<body class="sub_page">
    <?php
        if($_SESSION['usertype'] == 'admin'){
            include('adminnavbar.php');
        }
        else if($_SESSION['usertype'] == 'delivery'){
            include('deliverynavbar.php');
        }
        else if($_SESSION['usertype'] == 'pharmacie'){
            include('pharmacienavbar.php');
        }
        else{
            include('clientnavbar.php');
        }
    
    
    ?>


    <!-- about section -->
    <section class="about_section layout_padding">
        <div class="">
            <div class="custom_heading-container  mx-auto" style="width:max-content">
                <h2 >
                    All Orders
                </h2>
                <hr>
            </div>

            <div class="detail-box card shadow p-5 m-3">

                <?php
                    if(isset($_SESSION["assigned"])){
                        echo '<div class="alert alert-success">'.$_SESSION["assigned"].'</div>';
                    }
                    else if(isset($_SESSION["eassigned"])){
                        echo '<div class="alert alert-danger">'.$_SESSION["eassigned"].'</div>';
                    }
                
                ?>

                <div class="table-responsive d-flex justify-content-center">
                    <table class="table table-bordered tableexample">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Drug Name</td>
                                <td>Client Name</td>
                                <td>Pharmacy Name</td>                               
                                <td>Delivery Name</td>
                                <td>Quantity</td>
                                <td>Quantity Needed</td>
                                <td>State</td>
                                <td>#</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $row['idorders'] ?></td>
                                    <td><?php echo $row['medicine_name'] ?></td>
                                    <td><?php echo $row['client_name'] ?></td>
                                    <td><?php echo $row['pharmacie_name'] ?></td>
                                    <td><?php echo $row['delivery_name'] ?></td>
                                    <td><?php echo $row['quantity'] ?></td>
                                    <td><?php echo $row['originalq'] ?></td>
                                    <?php
                                        if( $row["state"] == "0"){
                                    
                                            echo '<td><span class="badge badge-warning">Pending</span></td>';
                                     } else { 
                                            echo '<td><span class="badge badge-success">Delivered</span></td>';
                                     } ?>
                                   <?php
                                        if($_SESSION['usertype'] == 'admin' && $row["state"] == "0"){
                                            echo '<td>
                                            <button type="button" class="btn  assigndelivery"> <i class="fa fa-edit" aria-hidden="true"></i> </button>
                                                </td>';
                                        }
                                        else if($_SESSION['usertype'] == 'delivery' && $row["state"] == "0"){
                                            echo '<td>
                                            <button type="button" class="btn btn-default text-white setstate"
                                            style="background:#178066"> <i class="fa fa-edit" aria-hidden="true"></i> </button>
                                                </td>';
                                        }
                                        else{
                                            echo '<td></td>';
                                        }
                                    ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>




    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>

    <script src="js/datatables/jquery.dataTables.min.js"></script>
    <script src="js/datatables/dataTables.bootstrap4.min.js"></script>


    <script>
        $(document).ready(function() {
            $(".tableexample").DataTable();
        });
    </script>

    <script>
        $(document).ready(function() {

            $('.assigndelivery').on('click', function() {

                $('#assigndeliverymodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();


                $('#o_id5').val(data[0].replaceAll(' ', ''));

            });
        });
    </script>    
    <script>
        $(document).ready(function() {

            $('.setstate').on('click', function() {

                $('#setstatemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();


                $('#o_id6').val(data[0].replaceAll(' ', ''));

            });
        });
    </script>


</body>

</html>