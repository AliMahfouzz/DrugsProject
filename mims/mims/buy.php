<?php
ob_start();
include('connection.php');
session_start();

$query = "SELECT * FROM medicine";

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
  <style>hr{
            border:3px solid #178066
        }
        .box-2{
         display:block !important;
         border-radius:5px;
       
          
        }.box-2 >div{
          background:white;
          display:flex;
          flex-direction:column;
          justify-content: space-between;
          height:100%;
          border-radius:5px;
          align-items:center;
          padding: 10px 5px;
        
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




  <!-- health section -->

  <section class="health_section layout_padding">
    <div class="health_carousel-container">
      <div class="text-center m-auto" style="width:max-content">
      <h2 class="text-uppercase">
        Medicine & Health

      </h2>
      <hr>
      </div>
      <!-- <div class="carousel-wrap layout_padding2">
        <div class="owl-carousel"> -->
      <div class="row bg-light p-3">
        <?php
        while ($row = mysqli_fetch_array($result)) {
          echo '
            <div class="box-2 col-md-3  py-2">
              
              <div class="shadow-sm">
              <div class="img-box w-100 h-75">
                <img src="uploads/'.$row['image'].'" width="100%" height="80%" alt="">
              </div>
              <div class="h-25 d-flex flex-column justify-content-between align-items-center">
              <div class="detail-box">
              <div class="text">
                <h6>
                 <b style="color:#178066">Name </b> '.$row['name'].'
                </h6>
                <h6 class="price">
                <b style="color:#178066">Price </b>
                  
                  '.$row['price'].'
                  <span>
                    $
                  </span>
                </h6>
              </div>
            </div>
            <div class="btn_container mt-2 w-100">
              <a href="medicine.php?idmedicine='.$row['idmedicine'].'" class="w-100 btn btn-sm btn-default text-white"
              style="background:#178066">
                Buy Now 
              </a>
            </div>
              </div>
              </div>

            </div>';
        }
        ?>
      </div>
      <!-- </div>
      </div> -->
    </div>
  </section>

  <!-- end health section -->



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
</body>

</html>