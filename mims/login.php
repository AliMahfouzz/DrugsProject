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
      <div class="row m-0">
        <div class="custom_heading-container ">
          <h2 style="color:#178066">
            User Login
          </h2>
          <hr>
        </div>
      </div>
    </div>
    <div class="container ">
      <div class="row">
        <div class="form_contaier col-md-12">
          <?php
            if(isset($_SESSION['elogin_message'])){
              echo '
              <div class="alert alert-danger" role="alert">
                  '.$_SESSION['elogin_message'].'
              </div>
              ';
            }
          ?>
          <form enctype="multipart/form-data" method="POST" action="login.php">

            <div class="row">

              <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Email </label>
                <input type="email" required name="email" class="form-control " id="exampleInputEmail1">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-6">
                <label for="exampleInputPassword1">Password </label>
                <input type="password" required name="password" class="form-control " id="exampleInputPassword1">
              </div>
            </div>

            <button type="submit" name="submit"  class="btn btn-sm btn-default text-white" style="background:#178066 !important">Login</button>
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

  $email = $_POST["email"];
  $password = $_POST["password"];

  $profile_pic = "";

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

    $query = "select * from users where email = '$email' limit 1";
        $result = mysqli_query($con, $query);

    
          if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            if ($user_data['password'] === $password) {
                if((int)$user_data['approved'] == 1){
                    $_SESSION['username'] = $user_data['name'];
                    $_SESSION['userid'] = $user_data['idusers'];
                    $_SESSION['usertype'] = $user_data['role'];
                    header('Location: dashboard.php');
                    die;
                }
                else{
                    $_SESSION['elogin_message'] =  "Your account is disabled!";
                    header('Location: login.php');
                    exit();
                }
              
            } else {
              $_SESSION['elogin_message'] =  "Wrong Username Or Password!";
              header('Location: login.php');
              exit();
            }
          }
          else{
            $_SESSION['elogin_message'] =  "Wrong Username Or Password!";
              header('Location: login.php');
              exit();
          }
}


?>