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
  <style>
   
    hr{
      border:2px solid #178066
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
        else if($_SESSION['usertype'] == 'client'){
            include('clientnavbar.php');
        }
        else{
          header('Location: index.php');
          die();
        }
    
    
    ?>


  <!-- about section -->
<div class="d-flex align-items-center">
<section class="about_section ">
  <div class="homeImg ">
    <div class="h-100 px-3 py-4 d-flex  flex-column align-items-center" style="flex-grow:1">
      <h3>WELCOME TO OUR ONLINE MEDICINE
      <hr>
      </h3>
     
      <p class="text-muted">
      An online pharmacy, internet pharmacy, or mail-order pharmacy is a pharmacy that operates over the Internet and sends orders to customers through mail, shipping companies, or online pharmacy web portal.
      </p>
      <div>
      <img src="images/p-1.jpg" alt="" style="height:auto;width:200px">
      <img src="images/p-2.jpg" alt="" style="height:auto;width:200px">
      <img src="images/p-3.jpg" alt="" style="height:auto;width:200px">
      <img src="images/p-4.jpg" alt="" style="height:auto;width:200px">
      </div>
      </div>
     
      </div>
      
  </section>

      </div>
  <?php include('footer.php');?>




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