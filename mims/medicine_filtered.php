<?php
session_start();

include('connection.php');

$idfilter = $_GET["idfilter"];

$query = "SELECT * FROM medicine WHERE category LIKE '%$idfilter%'";

$result = mysqli_query($con, $query);

$string = "";

while ($row = mysqli_fetch_array($result)) {
    $string .= '
      <div class="box-2 col-md-3  py-2 mb-1" style="height:350px;">
        <div class="shadow-sm">
        <div class="w-100" style="height:180px;">
          <img src="uploads/' . $row['image'] . '" width="100%" height="200px;" alt="">
        </div>
        <div style="height:150px;" class="d-flex mt-3 flex-column justify-content-between align-items-center mt-0">
        <div class="detail-box">
        <div class="text">
          <h6>
           <b style="color:#178066">Name </b> ' . $row['name'] . '
          </h6>
          <h6 class="price">
          <b style="color:#178066">Price </b>
            
            ' . $row['price'] . '
            <span>
              L.E
            </span>
          </h6>

          <h6>
          <b style="color:#178066">Branch </b>
            
            ' . $row['branch'] . '
          </h6>
          
        </div>
      </div>
      <div class="btn_container mt-1 w-100">
        <a href="medicine.php?idmedicine=' . $row['idmedicine'] . '" class="w-100 btn btn-sm btn-default text-white"
        style="background:#178066">
          Buy Now 
        </a>
      </div>              </div>
      </div>
      </div>';
  }




echo json_encode($string);


?>