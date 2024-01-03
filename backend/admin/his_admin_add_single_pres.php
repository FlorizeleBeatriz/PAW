<?php
session_start();
include('assets/inc/config.php');
if (isset($_POST['add_patient_single_pres'])) {
    $pres_id = $_POST['pres_id'];
    $pres_pat_name = $_POST['pres_pat_name'];
    $pres_pat_age = $_POST['pres_pat_age'];
    $pres_number = $_POST['pres_number'];
    $pres_ins = $_POST['pres_ins'];


    //sql to insert captured values
    $query = "INSERT INTO his_prescriptions (pres_id, pres_pat_name,pres_pat_age, pres_pat_number, pres_pat_recedr) values(?,?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('issss', $pres_id, $pres_pat_name, $pres_pat_age, $pres_pat_number, $pres_pat_recedr);
    $stmt->execute();
    /*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/
    //declare a varible which will be passed to alert function
    if ($stmt) {
        $success = "Employee Details Added";
    } else {
        $err = "Please Try Again Or Try Later";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<!--Head-->
<?php include('assets/inc/head.php'); ?>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <?php include("assets/inc/nav.php"); ?>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <?php include("assets/inc/sidebar.php"); ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <?php
               $pat=$_SESSION['pat_id'];
               $ret="select * from his_patients where pat_id=?";
               $stmt= $mysqli->prepare($ret) ;
               $stmt->bind_param('i',$pat_id);
               $stmt->execute() ;//ok
               $res=$stmt->get_result();
               //$cnt=1;
               while($row=$res->fetch_object())
               {
           ?>
        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="his_admin_dashboard.php">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Farmácia</a></li>
                                        <li class="breadcrumb-item active">Adicionar Prescrição</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Adicionar Prescrição Do Paciente</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <!-- Form row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Preencha todos os campos</h4>
                                    <!--Add Patient Form-->
                                    <!-- Form row -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="header-title">Preencha todos os campos</h4>
                                                    <!--Add Patient Form-->
                                                    <form method="post">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="inputEmail4" class="col-form-label">Nome do Paciente</label>
                                                                <input type="text" readonly name="pres_pat_name" value="<?php echo isset($row) ? $row->pat_fname . ' ' . $row->pat_lname : ''; ?>" class="form-control" id="pres_pat_name" placeholder="Patient's First Name">
                                                            </div>

                                                            <div class="form-group col-md-6">
                                                                <label for="inputPassword4" class="col-form-label">Idade do paciente</label>
                                                                <input type="text" readonly name="pres_pat_age" value="<?php echo isset($row) ? $row->pat_age : ''; ?>" class="form-control" id="pres_pat_age" placeholder="Patient`s Last Name">
                                                                <button type="submit" name="add_patient_presc" class="ladda-button btn btn-primary" data-style="expand-right">Adicionar Prescrição Do Paciente</button>
                                                            </div>
                                                        </div>
                                                        <!-- Restante do formulário... -->
                                                    </form>
                                                    <!--End Patient Form-->
                                                </div> <!-- end card-body -->
                                            </div> <!-- end card-->
                                        </div> <!-- end col -->
                                    </div>
                                    <!-- end row -->

                                    <!--End Patient Form-->
                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <?php include('assets/inc/footer1.php'); ?>
            <!-- end Footer -->

        </div>
        <?php }?>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('editor')
    </script>

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js-->
    <script src="assets/js/app.min.js"></script>

    <!-- Loading buttons js -->
    <script src="assets/libs/ladda/spin.js"></script>
    <script src="assets/libs/ladda/ladda.js"></script>

    <!-- Buttons init js-->
    <script src="assets/js/pages/loading-btn.init.js"></script>

</body>

</html>