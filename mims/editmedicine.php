<?php
ob_start();
?>
 <div class="modal fade"  id="editmedicinemodal" tabindex="-1" role="dialog" aria-labelledby="editmedicinemodalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="editmedicinemodalLabel"> Edit Medicine </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="editmedicine.php" method="POST" enctype="multipart/form-data">

                    <div class="modal-body">
                        <input type="hidden" name="m_id" id="m_id">
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="exampleInputName1">Name</label>
                                <input type="text" required name="mname" class="form-control" id="m_name">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Medicine Category</label>
                                <select class="form-control" name="category" id="m_category">
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
                                <textarea required name="description" id="m_description" class="form-control" style="resize: none; height:150px" rows="50"></textarea>
                            </div>
                            
                        </div>

                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Price </label>
                                <input type="number" min="0" step="any" required name="price" class="form-control" id="m_price">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputPassword1">Image </label>
                                <input type="file"  name="fileToUpload" class="form-control" id="exampleInputPassword1">
                            </div>
                        </div>
                        <div class="row" id="dates">

                            <div class="form-group col">
                                <label for="exampleInputdate">Reg. Date</label>
                                <input type="date" required name="regdate" class="form-control" id="m_regdate">
                            </div>
                            <div class="form-group col">
                                <label for="exampleInputdatee">Exp. Date</label>
                                <input type="date" required name="expdate" class="form-control" id="m_expdate">
                            </div>
                        </div>
                        <div id="error_message"></div>
                        <div class="row">

                            <div class="form-group col">
                                <label for="exampleInputdate">Validity period</label>
                                <input type="text" required name="vperiod" class="form-control" id="m_vperiod">
                            </div>
                            <div class="form-group col">
                                <label for="exampleInputdatee">Quantity</label>
                                <input type="number" min="0" required name="quantity" class="form-control" id="m_quantity">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-default text-white" style="background:#178066"
                         type="submit" name="update">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


 <?php


        if (isset($_POST["update"])) {
            include("connection.php");

            $m_id = $_POST["m_id"];

            $profile_pic = "";

            if($m_id != ""){

                $mname = $_POST['mname'];
                $mdescription = $_POST['description'];
                $mprice = $_POST['price'];
                $mregdate = $_POST['regdate'];
                $mexpdate = $_POST['expdate'];
                $mcategory = $_POST['category'];
                $mperiod = $_POST['vperiod'];
                $mquantity = $_POST['quantity'];
            
            
            
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
            
            
                if($profile_pic != ""){
                    $query = "UPDATE medicine SET name = ?,description = ?,category = ?,regdate = ?,expdate = ?,validity_period = ?,quantity = ?,image = ?,price = ? WHERE idmedicine = ?";

                    $stmt = $con->prepare($query);


                    $id = (int)$_POST["m_id"];

                    $stmt->bind_param('sssssssssi', $mname,$mdescription,$mcategory,$mregdate,$mexpdate,$mperiod,$mquantity,$profile_pic,$mprice, $id);

                    $stmt->execute();

                }
                else{
                    $query = "UPDATE medicine SET name = ?,description = ?,category = ?,regdate = ?,expdate = ?,validity_period = ?,quantity = ?,price = ? WHERE idmedicine = ?";

                    $stmt = $con->prepare($query);


                    $id = (int)$_POST["m_id"];

                    $stmt->bind_param('ssssssssi', $mname,$mdescription,$mcategory,$mregdate,$mexpdate,$mperiod,$mquantity,$mprice, $id);

                    $stmt->execute();

                }


                
                if ($stmt) {
                    header("Location: viewmedicines.php");
                    exit();
                } else {
                    header("Location: viewmedicines.php");
                    exit();
                }

                //echo var_dump($stmt);
            }
            
            
            
        }


    ?>