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
    .clientsimage {
      border-radius: 30px;
      width: 125px;
      height: 125px;
    }
    .form-control{
      background:#d6d8d9
    }
    hr{
      border-top: 3px solid #178066;
    }
  </style>
</head>

<body class="sub_page">
  <div class="hero_area">
    <!-- header section strats -->
    <?php include('header.php');?>
  </div>



  <!-- contact section -->
  <section class="contact_section layout_padding">
    <div class="container">
      <div class="row m-0 pb-4">
        <div class="custom_heading-container ">
          <h2 style="color:#178066">
            Register a new user
          </h2>
          <hr>
        </div>
      </div>
    </div>
    <div class="container ">
      <div class="row">
        <div class="form_contaier col-md-12">
          <?php
            if(isset($_SESSION['message'])){
              echo '
              <div class="alert alert-info" role="alert">
                  '.$_SESSION['message'].'
              </div>
              ';
            }
            else if(isset($_SESSION['e_message'])){
              echo '
              <div class="alert alert-danger" role="alert">
                  '.$_SESSION['e_message'].'
              </div>
              ';
            }
          ?>
          <form enctype="multipart/form-data" method="POST" action="register.php">
            <div class="row">

              <div class="form-group col-md-12">
                <label>User Type</label>
                <br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required type="radio" name="usertype" id="usertype1" value="client">
                  <label class="form-check-label" for="usertype1">Client</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required type="radio" name="usertype" id="usertype2" value="pharmacie">
                  <label class="form-check-label" for="usertype2">Pharmacie</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required type="radio" name="usertype" id="usertype3" value="delivery">
                  <label class="form-check-label" for="usertype3">Delivery</label>
                </div>
              </div>
            </div>
            <div class="row">

              <div class="form-group col-md-6">
                <label for="exampleInputName1">Name</label>
                <input type="text" required name="username" class="form-control" id="exampleInputName1">
              </div>
              <div class="form-group col-md-6">
                <label for="exampleInputNumber1">Phone Number</label>
                <input type="text" required name="phone" class="form-control" id="exampleInputNumber1">
              </div>
            </div>
            <div class="row">

              <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Email </label>
                <input type="email" required name="email" class="form-control" id="exampleInputEmail1">
              </div>

              <div class="form-group col-md-6">
                <label for="exampleInputPassword1">Password </label>
                <input type="password" required name="password" class="form-control" id="exampleInputPassword1">
              </div>
            </div>
            <div class="row">
              <div class="form-group col">
                <label for="exampleInputImage">Image</label>
                <input type="file" required name="fileToUpload" class="form-control" id="exampleInputImage">
              </div>
            </div>
            <div class="row">
              <div  class="form-group col">
              <label for="Location">Location</label>
              <input type="text" required name="location" class="form-control" id="Location">
          </div>
            </div>
            <button type="submit" name="submit" class="btn btn-sm btn-default text-white" style="background:#178066 !important">Register</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- end contact section -->

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

<?php

if (isset($_POST['submit'])) {
  //echo var_dump($_POST);

  $client_type = $_POST["usertype"];
  $username = $_POST["username"];
  $phone = $_POST["phone"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $location = $_POST["location"];
  $approved = 0;

  $profile_pic = "";
  $emails = [];

  $query1 = "
    SELECT email from users
  ";

  $result = mysqli_query($con, $query1);

  while ($row = mysqli_fetch_assoc($result)) {
    $emails[] = $row['email'];
  }


  if (!in_array($email, $emails)) {
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

    $date = date('Y-m-d H:i:s');


    $approved = 0;

    if($client_type == 'client'){
      $approved = 1;
    }

    $query = "insert into users (name,email,password,phone,image,role,regdate,location,approved) values ('$username','$email','$password','$phone','$profile_pic','$client_type','$date','$location','$approved')";
    
    $result = mysqli_query($con, $query);

    if ($result) {
      $_SESSION['message'] = 'Your account is registered successfully';
      header('Location: register.php');
    } else {
      $_SESSION['e_message'] = 'Your account is not registered, try again !!!!';
      header('Location: register.php');
    }
  } else {
    $_SESSION['e_message'] = 'Your account is not registered, email already in use, try again !!!!';
    header('Location: register.php');
  }
}


?>