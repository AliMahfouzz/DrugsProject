<?php
ob_start();
include('connection.php');
session_start();

$query = "SELECT * FROM users WHERE `role` = 'pharmacie'";

$result = mysqli_query($con, $query);

$query2 = "SELECT * FROM users WHERE `role` = 'delivery'";

$result2 = mysqli_query($con, $query2);

include('approveaccount.php');


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
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700|Roboto:400,700&display=swap" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css-1/style.css" rel="stylesheet" />
  <link href="css-1/style.scss" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css-1/responsive.css" rel="stylesheet" />

    <link href="js/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <style>
        .detail-box{
            min-width: 50%;
        }
        hr{
            border:3px solid #178066
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
        <div class="container">
            <div class="custom_heading-container  mx-auto" style="width:max-content">
                <h2>
                    All Accounts
                </h2>
                <hr>
            </div>

            <div class="detail-box card shadow p-3 m-3">

                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title text-center">
                                <a class="w-100"
                                role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Pharmacies
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <div class="table-responsive w-100">
                                    <table class="table table-bordered tableexample" >
                                        <thead>
                                            <tr>
                                                <td>#</td>
                                                <td>Account Name</td>
                                                <td>Account Email</td>
                                                <td>Account Phone</td>
                                                <td>Account Image</td>
                                                <td>Account Status</td>
                                                <td>#</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['idusers'] ?></td>
                                                    <td><?php echo $row['name'] ?></td>
                                                    <td><?php echo $row['email'] ?></td>
                                                    <td><?php echo $row['phone'] ?></td>
                                                    <td><img src=<?php echo "./uploads/" . $row['image'] ?> alt="" style="width: 50%; border: 1px solid #cda45e;"></td>
                                                    <?php
                                                    if ($row['approved'] != 1) {
                                                        echo '<td><button class="btn btn-warning" type="button" disabled>
                                                                    <i class="fa fa-spinner fa-pulse"></i>Pending
                                                                    </button></td>';
                                                        echo '<td>
                                                                                <button type="button" class="btn btn-success approvebtn0"> <i class="fa fa-check-circle" aria-hidden="true"></i> </button>
                                                                            </td>';
                                                    } else {
                                                        echo '<td><span class="badge badge-success">Approved</span>
                                                                                    </td><td></td>';
                                                    }
                                                    ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title  text-center">
                                <a class="w-100"
                                role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    Delivery Users
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <div class="table-responsive ">
                                    <table class="table table-bordered tableexample">
                                        <thead>
                                            <tr>
                                                <td>#</td>
                                                <td>Account Name</td>
                                                <td>Account Email</td>
                                                <td>Account Phone</td>
                                                <td>Account Image</td>
                                                <td>Account Status</td>
                                                <td>#</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_array($result2)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['idusers'] ?></td>
                                                    <td><?php echo $row['name'] ?></td>
                                                    <td><?php echo $row['email'] ?></td>
                                                    <td><?php echo $row['phone'] ?></td>
                                                    <td><img src=<?php echo "./uploads/" . $row['image'] ?> alt="" style="width: 50%; border: 1px solid #cda45e;"></td>
                                                    <?php
                                                    if ($row['approved'] != 1) {
                                                        echo '<td><button class="btn btn-warning" type="button" disabled>
                                                                    <i class="fa fa-spinner fa-pulse"></i>Pending
                                                                    </button></td>';
                                                        echo '<td>
                                                                                <button type="button" class="btn btn-success approvebtn1"> <i class="fa fa-check-circle" aria-hidden="true"></i> </button>
                                                                            </td>';
                                                    } else {
                                                        echo '<td><span class="badge badge-success">Approved</span>
                                                                                    </td><td></td>';
                                                    }
                                                    ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </section>

    <?php include('footer.php'); ?>




    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js">
    </script>

    <script src="js/datatables/jquery.dataTables.min.js"></script>
    <script src="js/datatables/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(".owl-carousel").owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            navText: [],
            autoplay: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        });
    </script>
    <script type="text/javascript">
        $(".owl-2").owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            navText: [],
            autoplay: true,

            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".tableexample").DataTable();
        });
    </script>

<script>
        $(document).ready(function() {

            $('.approvebtn0').on('click', function() {

                $('#approvemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                //console.log(data);

                $('#p_id').val(data[0].replaceAll(' ', ''));
                $('#d_id').val('');
                $('#approvemodalLabel').html('Approve Pharmacie Account');

            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $('.approvebtn1').on('click', function() {

                $('#approvemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                //console.log(data);

                $('#d_id').val(data[0].replaceAll(' ', ''));
                $('#p_id').val('');
                $('#approvemodalLabel').html('Approve Delivery Account');


            });
        });
    </script>
</body>

</html>