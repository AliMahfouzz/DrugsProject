
 <div class="modal fade" id="deletemedicinemodal" tabindex="-1" role="dialog" aria-labelledby="deletemedicinemodalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="deletemedicinemodalLabel"> Delete Medicine  </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="deletemedicine.php" method="POST">

                    <div class="modal-body">
                        <input type="hidden" name="m_id1" id="m_id1">

                        <h4> Do you want to delete this medicine ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-default text-white" style="background:#178066" type="submit" name="delete">Yes !! Delete it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


 <?php


        if (isset($_POST["delete"])) {
            include("connection.php");

            $m_id1 = $_POST["m_id1"];

            

            if($m_id1 != ""){
                $query = "DELETE FROM medicine WHERE idmedicine = ?";

                $stmt = $con->prepare($query);


                $id = (int)$_POST["m_id1"];

                $stmt->bind_param('i', $id);

                $stmt->execute();

                if ($stmt) {
                    header("Location: viewmedicines.php");
                    exit();
                } else {
                    header("Location: viewmedicines.php");
                    exit();
                }
            }
            
            
            
        }


    ?>