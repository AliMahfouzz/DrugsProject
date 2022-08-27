
<?php

ob_start();

include('connection.php');

$query222 = "SELECT * from users where `role`='delivery'";

$result222 = mysqli_query($con, $query222);

$select = '<select name="deliveries" class="form-control">';

while ($row222 = mysqli_fetch_array($result222)) {

    $select .= '<option value="'.$row222["idusers"].'">'.$row222["name"].'</option>';

}


$select .= '</select>';

?>
<div class="modal fade" id="assigndeliverymodal" tabindex="-1" role="dialog" aria-labelledby="assigndeliverymodalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="assigndeliverymodalLabel"> Assign Order To Delivery  </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="assignordertodelivery.php" method="POST">

                    <div class="modal-body">
                        <input type="hidden" name="o_id5" id="o_id5">

                        <div class="form-group">
                            <label>Select Delivery Man</label>
                            <?php echo $select; ?>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-default text-white" 
                        style="background:#178066 !important;" type="submit" name="delete">Yes !! Assign it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


 <?php


        if (isset($_POST["delete"])) {
            session_start();
            include("connection.php");

            $o_id = $_POST["o_id5"];
            $delivery_id = $_POST["deliveries"];

            

            if($o_id != ""){
                $query = "UPDATE orders SET iddelivery = ? WHERE idorders = ?";

                $stmt = $con->prepare($query);


                $id = (int)$_POST["o_id5"];

                $stmt->bind_param('si', $delivery_id,$id);

                $stmt->execute();

                if ($stmt) {
                    $_SESSION["assigned"] = "The order was assigned successfully to the delivery man";
                    header("Location: vieworders.php");
                    exit();
                } else {
                    $_SESSION["eassigned"] = "The order was not assigned, please try again !!!";
                    header("Location: vieworders.php");
                    exit();
                }
            }
            
            
            
        }


    ?>