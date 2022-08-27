
<?php

ob_start();

include('connection.php');

?>

<div class="modal fade" id="setstatemodal" tabindex="-1" role="dialog" aria-labelledby="setstatemodalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="setstatemodalLabel"> Order Update State To Delivered  </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="ordersetstate.php" method="POST">

                    <div class="modal-body">
                        <input type="hidden" name="o_id6" id="o_id6">
                        <h4>Set Order as delivered</h4>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-default text-white" style="background:#178066 !important;"
                        type="submit" name="up">Yes !! Update it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


 <?php


        if (isset($_POST["up"])) {
            session_start();
            include("connection.php");

            $o_id = $_POST["o_id6"];

            

            if($o_id != ""){
                $query = "UPDATE orders SET `state` = ? WHERE idorders = ?";

                $stmt = $con->prepare($query);


                $state = (int)1;
                $id = (int)$_POST["o_id6"];

                $stmt->bind_param('ii', $state,$id);

                $stmt->execute();

                if ($stmt) {
                    $_SESSION["assigned"] = "The order was set as delivered successfully";
                    header("Location: vieworders.php");
                    exit();
                } else {
                    $_SESSION["eassigned"] = "The order was not set as delivered, please try again !!!";
                    header("Location: vieworders.php");
                    exit();
                }
            }
            
            
            
        }


    ?>