<?php
ob_start();
session_start();

include('connection.php');
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
        .clientsimage {
            border-radius: 30px;
            width: 125px;
            height: 125px;
        }
        hr{
            border:3px solid #178066
        }
        .form-control{
            background:#d6d8d9
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



    <!-- contact section -->
    <section class="contact_section layout_padding">
        <div class="container">
            <div class="row m-0 justify-content-center mb-3">
                <div class="custom_heading-container ">
                    <h2>
                        Add a new Medicine
                    </h2>
                    <hr>

                </div>
            </div>
        </div>
        <div class="container ">
            <div class="row">
                <div class="form_contaier col-md-12">
                    <?php
                    if (isset($_SESSION['m_message'])) {
                        echo '
              <div class="alert alert-info" role="alert">
                  ' . $_SESSION['m_message'] . '
              </div>
              ';
                    } else if (isset($_SESSION['em_message'])) {
                        echo '
              <div class="alert alert-danger" role="alert">
                  ' . $_SESSION['em_message'] . '
              </div>
              ';
                    }
                    ?>
                    <form enctype="multipart/form-data" method="POST" action="addmedicine.php">
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="exampleInputName1">Name</label>
                                <input type="text" required name="mname" class="form-control" id="exampleInputName1">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Medicine Category</label>
                                <select class="form-control" name="category">
                                    <option value="drugs">Drugs</option>
                                    <option value="vitamins">Vitamins</option>
                                    <option value="creams">Creams</option>
                                    <option value="injections">Injections</option>
                                    <option value="supplements">Supplements</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Description</label>
                                <textarea required name="description" class="form-control"style="resize: none; height:150px" rows="50"></textarea>
                            </div>
                            
                        </div>

                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Price </label>
                                <input type="number" min="0" step="any" required name="price" class="form-control" id="exampleInputEmail1">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputPassword1">Image </label>
                                <input type="file" required name="fileToUpload" class="form-control" id="exampleInputPassword1">
                            </div>
                        </div>
                        <div class="row" id="dates">

                            <div class="form-group col">
                                <label for="exampleInputdate">Reg. Date</label>
                                <input type="date" required name="regdate" class="form-control" id="regdate">
                            </div>
                            <div class="form-group col">
                                <label for="exampleInputdatee">Exp. Date</label>
                                <input type="date" required name="expdate" class="form-control" id="expdate">
                            </div>
                        </div>
                        <div id="error_message"></div>
                        <div class="row">

                            <div class="form-group col">
                                <label for="exampleInputdate">Validity period</label>
                                <input type="text" required name="vperiod" class="form-control" id="exampleInputdate">
                            </div>
                            <div class="form-group col">
                                <label for="exampleInputdatee">Quantity</label>
                                <input type="number" min="0" required name="quantity" class="form-control" id="exampleInputdatee">
                            </div>
                        </div>
                        <button type="submit" name="submit" id="submit"  class="btn btn-sm btn-default text-white" style="background:#178066 !important">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- end contact section -->

    <?php include('footer.php'); ?>


    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js">
    </script>
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
        $(document).ready(function(){
            $("#dates").change(function(e){
                var element_id = e.target.id;

                var from_date = $("#regdate").val();
                var to_date = $("#expdate").val();

                if(new Date(from_date) <= new Date(to_date))
                {//compare end <=, not >=
                    //your code here
                    $("#error_message").html("");
                    $("#submit").prop('disabled', false);
                }
                else{
                    $("#submit").prop('disabled', true);
                    $("#error_message").html("<span class='text-danger'>Reg date should be less than Exp date</span>");
                }
            });
        });
    </script>
</body>

</html>

<?php

if (isset($_POST['submit'])) {
    $mname = $_POST['mname'];
    $mdescription = $_POST['description'];
    $mprice = $_POST['price'];
    $mregdate = $_POST['regdate'];
    $mexpdate = $_POST['expdate'];
    $mcategory = $_POST['category'];
    $mperiod = $_POST['vperiod'];
    $mquantity = $_POST['quantity'];

    $idusers = $_SESSION["userid"];



        $target_dir = "uploads/";
        $target_file = $target_dir . time() . basename($_FILES["fileToUpload"]["name"]);

        //get all emails to be validated


        if (isset($_FILES["fileToUpload"]["tmp_name"]) && $_FILES["fileToUpload"]["tmp_name"] != "") {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $profile_pic = time() . basename($_FILES["fileToUpload"]["name"]);
            } else {
                $error_msg = "Sorry, there was an error uploading your file.";
            }
        }


        $query = "insert into medicine (name,description,category,regdate,expdate,validity_period,quantity,image,price,idusers) values ('$mname','$mdescription','$mcategory','$mregdate','$mexpdate','$mperiod','$mquantity','$profile_pic','$mprice','$idusers')";
        $result = mysqli_query($con, $query);

        if ($result) {
            $_SESSION['m_message'] = 'Your medicine is added successfully';
            header('Location: addmedicine.php');
        } else {
            $_SESSION['em_message'] = 'Your medicine is not added, try again !!!!';
            header('Location: addmedicine.php');
        }

}


?>