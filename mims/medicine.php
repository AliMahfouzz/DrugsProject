<?php
ob_start();
include('connection.php');
session_start();

unset($_SESSION["idmedicine"]);

$idmedicine = 0;

if(isset($_GET['idmedicine'])){

    $idmedicine = $_GET["idmedicine"];
    $_SESSION['idmed'] = $_GET["idmedicine"];
}


if(isset($_SESSION['idmed'])){
    $idmedicine = $_SESSION['idmed'];
}

$query = "SELECT m.*, u.location as location1, (SELECT location from users where idusers = '" . $_SESSION["userid"] . "') as location2 FROM mims.medicine m 
left join users u on u.idusers = m.idusers WHERE idmedicine = '$idmedicine'";

$result = mysqli_query($con, $query);


 $newprice = 0.0;


 $_SESSION["idmed"] = $idmedicine;

//  while ($row = mysqli_fetch_array($result)) {

//      $_SESSION["p"] = $row["price"];
//  }




?>

<!DOCTYPE html>
<html>

<head>
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

    <style>
        .card-bounding {
            width: 90%;
            max-width: 500px;
            margin: 0 auto;
            position: relative;
            /* top:50%; */
            /* transform: translateY(-50%); */
            padding: 30px;
            border: 1px solid #2eca6a;
            border-radius: 6px;
            font-family: 'Roboto';
            background: #ffffff;
        }

        .card-bounding aside {
            font-size: 24px;
            padding-bottom: 8px;
        }

        .card-container {
            width: 100%;
            padding-left: 80px;
            padding-right: 40px;
            position: relative;
            box-sizing: border-box;
            border: 1px solid #ccc;
            margin: 0 auto 30px auto;
        }

        .card-container input {
            width: 100%;
            letter-spacing: 1px;
            font-size: 30px;
            padding: 15px 15px 15px 25px;
            border: 0;
            outline: none;
            box-sizing: border-box;
        }

        .card-type {
            width: 80px;
            height: 56px;
            background: url("cards.png");
            background-position: 0 -291px;
            background-repeat: no-repeat;
            position: absolute;
            top: 3px;
            left: 4px;
        }

        .card-type.mastercard {
            background-position: 0 0;
        }

        .card-type.visa {
            background-position: 0 -115px;
        }

        .card-type.amex {
            background-position: 0 -57px;
        }

        .card-type.discover {
            background-position: 0 -174px;
        }

        .card-valid {
            position: absolute;
            top: 0;
            right: 15px;
            line-height: 60px;
            font-size: 40px;
            font-family: 'icons';
            color: #ccc;
        }

        .card-valid.active {
            color: green;
        }

        .card-details {
            width: 100%;
            text-align: left;
            margin-bottom: 30px;
            transition: 300ms ease;
        }

        .card-details input {
            font-size: 30px;
            padding: 15px;
            box-sizing: border-box;
            width: 100%;
        }

        .card-details input.error {
            border: 1px solid #2eca6a;
            box-shadow: 0 4px 8px 0 rgba(238, 76, 87, 0.3);
            outline: none;
        }

        .card-details .expiration {
            width: 50%;
            float: left;
            padding-right: 5%;
        }

        .card-details .cvv {
            width: 45%;
            float: left;
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




    <!-- health section -->

    <section class="health_section layout_padding d-flex justify-content-center flex-column">
        <h2 class="text-uppercase">
            Medicine & Health

        </h2>
        <div class="health_carousel-container d-flex justify-content-center m-5">
            <!-- <div class="carousel-wrap layout_padding2">
        <div class="owl-carousel"> -->
            <div class="row">
                <?php
                $drugname = "";
                $price = 0.0;
                $newprice = 0.0;
                while ($row = mysqli_fetch_array($result)) {
                    $drugname = $row['name'];

                    echo '
                <div class="card col-md-5 mr-5 p-2">
                <div class="img-box">
                    <img src="uploads/' . $row['image'] . '" alt="" width="100%">
                </div>
                <div class="detail-box">
                    <div class="text">
                    <h6>
                        ' . $row['name'] . '
                    </h6>
                    <h6 class="price">
                        <span>
                        L.E
                        </span>
                        ' . $row['price'] . '
                    </h6><br>';
                    if (trim(strtolower($row['location1'])) == trim(strtolower($row["location2"]))) {
                        echo '<h7 class="price">
                        Additional delivery charge with ability to increase depending on availability
                        <span>
                        L.E
                        </span>
                        20
                    </h7>';
                        $newprice += (float)20.0;
                    } else {
                        echo '<h7 class="price">
                        Additional delivery charge with ability to increase depending on availability
                        <span>
                        $
                        </span>
                        50
                    </h7>';
                        $newprice += (float)50.0;
                    }
                    echo '
                    </div>
                </div>
                </div>';
                    $price = (float)$row['price'];
                }

                ?>
                <div class="card col-md-5 mr-5 p-5">
                <?php
                        if (isset($_SESSION['e_quantity'])) {
                            echo '<div class="alert alert-danger">
                                ' . $_SESSION['e_quantity']
                                . '
                                </div>';
                        }
                        ?>
                    <form action="medicine.php" method="POST" >
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Quantity</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" name="qu" id="inputPassword" placeholder="Quantity">
                            </div>
                        </div>


                                <aside>Card Number:</aside>
                                <div class="card-container">
                                    <!--- ".card-type" is a sprite used as a background image with associated classes for the major card types, providing x-y coordinates for the sprite --->
                                    <div class="card-type"></div>
                                    <input placeholder="0000 0000 0000 0000" required onkeyup="$cc.validate(event)" name="creditcard" />
                                    <!-- The checkmark ".card-valid" used is a custom font from icomoon.io --->
                                    <div class="card-valid">&#x2713;</div>
                                </div>

                                <div class="card-details clearfix">

                                    <div class="expiration">
                                        <aside>Expiration Date</aside>
                                        <input onkeyup="$cc.expiry.call(this,event)" required maxlength="7" name="expiration_date" placeholder="mm/yyyy" />
                                    </div>

                                    <div class="cvv">
                                        <aside>CVV</aside>
                                        <input placeholder="XXX" required name="cvv" />
                                    </div>

                                </div>

                        <input type="hidden" name="p" value="<?php echo $price; ?>">
                        <input type="hidden" name="np" value="<?php echo $newprice; ?>">
                        <!-- </div> -->
                        <input type="submit" value="Submit" name="submit1" class="btn btn-sm btn-default text-white" style="background:#178066 !important">
                    </form>
                </div>

            </div>
            <!-- </div>
      </div> -->
        </div>
    </section>

    <!-- end health section -->



    <?php include('footer.php'); ?>

    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js-CreditCardValidator-master/creditCardValidator.js"></script>
</body>

</html>

<?php

$query2 = "SELECT SUM(quantity) as total from medicine where TRIM(LOWER(`name`)) = '" . trim(strtolower($drugname)) . "'";
$result2 = mysqli_query($con, $query2);

$total_quantity = 100000000;

if ($result2->num_rows > 0) {
    // output data of each row
    while ($row = $result2->fetch_assoc()) {
        $total_quantity = $row["total"];
    }
}

if (isset($_POST['submit1'])) {
    //echo var_dump($_POST);

    $price = $_POST['p'];
    $nprice = $_POST['np'];
    $idmedicine =  $_SESSION["idmed"];
    $mqu = $_POST['qu'];

    // echo var_dump($mqu);
    // echo var_dump($total_quantity);

    if ($mqu > $total_quantity) {
        $_SESSION['e_quantity'] = "The quantity is not available in our stores, you can make request for " . $total_quantity . " only.";
        header('Location: medicine.php?idmedicine='.$idmedicine);
        exit();
    } 
    else {
        unset($_SESSION['e_quantity']);

        $query3 = "SELECT * from medicine where TRIM(LOWER(`name`)) = '" . trim(strtolower($drugname)) . "' AND quantity > $mqu LIMIT 1";
        $result3 = mysqli_query($con, $query3);


        $query44 = "SELECT * from medicine where TRIM(LOWER(`name`)) = '" . trim(strtolower($drugname)) . "' AND quantity = '$mqu' LIMIT 1";
        $result44 = mysqli_query($con, $query44);

        if ($result3->num_rows > 0) {
            $idph = -1;
            $newq = -1;
            $pharmacy_c = -1;
            // output data of each row
            while ($row = $result3->fetch_assoc()) {
                $idph = $row["idmedicine"];
                $newq = $row["quantity"];
                $pharmacy_c = $row["idusers"];
            }

            $query = "UPDATE medicine SET quantity = ? WHERE idmedicine = ?";

            $stmt = $con->prepare($query);

            $newquantity = abs($newq - $mqu);

            $originalq = $mqu;

            $id = (int)$idph;

            $stmt->bind_param('si', $newquantity, $id);

            $stmt->execute();

            $pp = ($price * $mqu) + $nprice;

            $query4 = "SELECT * from users where idusers = '" . $_SESSION["userid"] . "'";
            $result4 = mysqli_query($con, $query4);

            $dateee = date('Y-m-d H:i:s');
            $clientid = $_SESSION["userid"];

            $query5 = "INSERT INTO orders(idmedicine, price, date, idclient, idph,quantity,originalq) VALUES ('$idmedicine', '$pp', '$dateee', '$clientid', '$pharmacy_c','$newquantity', '$originalq')";
            $result5 = mysqli_query($con, $query5);

            if ($result5 && $stmt) {
                $_SESSION['orders_message'] = "Your Order was placed successfully";
                header('Location: vieworders.php');
                exit();
            } else {
                $_SESSION['eorders_message'] = "Your order was not sent, please try again!!";
                header('Location: vieworders.php');
                exit();
            }
            unset($_SESSION['e_quantity']);
        }
        else if($result44->num_rows > 0){
            $query = "UPDATE medicine SET quantity = ? WHERE idmedicine = ?";

            $stmt = $con->prepare($query);

            $idph = $row44["idmedicine"];
            $newq = $row44["quantity"];
            $pharmacy_c = $row44["idusers"];

            $newquantity = abs($mqu - $newq);

            $originalq = $mqu;


            $id = (int)$idph;

            $stmt->bind_param('si', $newquantity, $id);

            $stmt->execute();

            $pp = ($price * $mqu) + $nprice;

            $query4 = "SELECT * from users where idusers = '" . $_SESSION["userid"] . "'";
            $result4 = mysqli_query($con, $query4);

            $dateee = date('Y-m-d H:i:s');
            $clientid = $_SESSION["userid"];

            $query5 = "INSERT INTO orders(idmedicine, price, date, idclient, idph, quantity,originalq) VALUES ('$idmedicine', '$pp', '$dateee', '$clientid', '$pharmacy_c', '$mqu', '$originalq')";
            $result5 = mysqli_query($con, $query5);

            if ($result5 && $stmt) {
                $_SESSION['orders_message'] = "Your Order was placed successfully";
                header('Location: vieworders.php');
                exit();
            } else {
                $_SESSION['eorders_message'] = "Your order was not sent, please try again!!";
                header('Location: vieworders.php');
                exit();
            }
            $rest = 0.0;
        }
        else {
            unset($_SESSION['e_quantity']);

            $query45 = "SELECT * from medicine where TRIM(LOWER(`name`)) = '" . trim(strtolower($drugname)) . "'";
            $result45 = mysqli_query($con, $query45);
            $rest = $mqu;
            //echo $rest.'<br>';
            $update_variable = 0;
            while ($row45 = mysqli_fetch_array($result45)) {
                //echo $rest.'<br>';
                if ($rest == 0) {
                    break;
                    header('Location: vieworders.php');
                    exit();

                  //echo $rest . "scenario zero";
                }
                else {
                   // echo '<br>';
                    unset($_SESSION['e_quantity']);

                    $query = "UPDATE medicine SET quantity = ? WHERE idmedicine = ?";

                    $stmt = $con->prepare($query);

                    $idph = $row45["idmedicine"];
                    $newq = $row45["quantity"];
                    $pharmacy_c = $row45["idusers"];

                   // echo $newq . "------". $mqu.'<br>';

                    $originalq = $mqu;

                    $updatemedicine_variable = 0.0;

                    
                    $quantity_reserved = 0;

                    if($mqu > $newq){
                        $quantity_reserved = 0;
                        // $update_variable = 0;
                    }
                    // else{
                    //     $quantity_reserved = $newq - $rest;
                    // }

                    if($rest != $mqu){
                        if($rest > $row45['quantity']){

                            $update_variable = $row45['quantity'];
                        }
                        else{
                            $update_variable = $rest;
                        }
                    }

                    $order_qu = 0.0;

                    if($update_variable == 0){
                        $order_qu = $row45['quantity'];
                    }
                    else{
                        $order_qu = $update_variable;
                    }


                    if($order_qu == $row45['quantity']){
                        $updatemedicine_variable = 0;
                    }
                    else{
                        $updatemedicine_variable = $row45['quantity'] - $order_qu;
                    }
                    
                 // echo $rest . "scenario many medicines".$newq.'--'.$originalq.'----'.$order_qu.'--='.$updatemedicine_variable.'<br>';


                    $id = (int)$idph;

                    $stmt->bind_param('si', $updatemedicine_variable, $id);

                    $stmt->execute();

                    $pp = ($price * $order_qu) + $nprice;

                    $query4 = "SELECT * from users where idusers = '" . $_SESSION["userid"] . "'";
                    $result4 = mysqli_query($con, $query4);

                    $dateee = date('Y-m-d H:i:s');
                    $clientid = $_SESSION["userid"];

                    $query5 = "INSERT INTO orders(idmedicine, price, date, idclient, idph,quantity,originalq) VALUES ('$idmedicine', '$pp', '$dateee', '$clientid', '$pharmacy_c', '$order_qu', '$originalq')";
                    $result5 = mysqli_query($con, $query5);

                    if ($result5 && $stmt) {
                        $_SESSION['orders_message'] = "Your Order was placed successfully";
                    } else {
                        $_SESSION['eorders_message'] = "Your order was not sent, please try again!!";
                    }
                    $rest -= $newq;
                    $rest = abs($rest);
                    

                }
            }
        }
        header('Location: vieworders.php');
        exit();
    }
}


?>