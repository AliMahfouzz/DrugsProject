<?php
ob_start();
include('connection.php');
session_start();

include('editmedicine.php');
include('deletemedicine.php');

if($_SESSION['usertype'] == 'admin'){
    $query = "SELECT * FROM medicine";
}
else if($_SESSION['usertype'] == 'pharmacie'){
    $query = "SELECT * FROM medicine WHERE idusers = '".$_SESSION['userid']."'";
}
$result = mysqli_query($con, $query);


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
        .dataTables_wrapper {
  width: 100% !important;
}
hr{
            border:3px solid #178066
        }
        .page-item.active .page-link,.btn-success{
    background:#178066 !important;
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
                <h2>
                    All Medicines
                </h2>
                <hr>
            </div>

            <div class="detail-box card shadow p-5 m-3">


                <div class="table-responsive d-flex justify-content-center">
                    <table class="table table-bordered tableexample">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Medicine Name</td>
                                <td>Medicine Description</td>                               
                                <td>Medicine Price</td>
                                <td>Registration Date</td>
                                <td>Expiration Date</td>
                                <td>Medicine Category</td>
                                <td>Image</td>
                                <td>Quantity</td>
                                <td>Validity Period</td>
                                <td>#</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $row['idmedicine'] ?></td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['description'] ?></td>
                                    <td><?php echo $row['price'] ?></td>
                                    <td><?php echo $row['regdate'] ?></td>
                                    <td><?php echo $row['expdate'] ?></td>
                                    <td><?php echo $row['category'] ?></td>
                                    <td><img src=<?php echo "./uploads/" . $row['image'] ?> alt="" style="width: 50%; border: 1px solid #cda45e;"></td>
                                    <td><?php echo $row['quantity'] ?></td>
                                    <td><?php echo $row['validity_period'] ?></td>
                                   <?php
                                        echo '<td>
                                        <button type="button" class="btn btn-success editbtn0 mb-1"> <i class="fa fa-pencil" aria-hidden="true"></i> </button>
                                        <button type="button" class="btn btn-danger deletemedicinebtn"> <i class="fa fa-trash" aria-hidden="true"></i> </button>
                                            </td>';
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

            $('.deletemedicinebtn').on('click', function() {

                $('#deletemedicinemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();


                $('#m_id1').val(data[0].replaceAll(' ', ''));

            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $('.editbtn0').on('click', function() {

                $('#editmedicinemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();


                $('#m_id').val(data[0].replaceAll(' ', ''));
                $('#m_name').val(data[1]);
                $('#m_description').val(data[2]);
                $('#m_price').val(data[3].replaceAll(' ', ''));
                $('#m_regdate').val(data[4]);
                $('#m_expdate').val(data[5]);
                $('#m_category').val(data[6]);
                $('#m_quantity').val(data[8]);
                $('#m_vperiod').val(data[9]);

            });
        });
    </script>

</body>

</html>