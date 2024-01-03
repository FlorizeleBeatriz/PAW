<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  $farm_id=$_SESSION['farm_id'];
  $farm_fname = $_SESSION['farm_fname'];

?>
<!farmTYPE html>
<html lang="en">
    
    <!--Head Code-->
    <?php include("assets/inc/head.php");?>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <?php include('assets/inc/nav.php');?>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <?php include('assets/inc/sidebar.php');?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    
                                    <h4 class="page-title">Hospital Management Information System Dashboard</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        

                        <div class="row">
                            <!--Start OutPatients-->
                            <div class="col-md-6 col-xl-6">
                                <div class="widget-rounded-circle card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-lg rounded-circle bg-soft-danger border-danger border">
                                                <i class="fab fa-accessible-icon  font-22 avatar-title text-danger"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <?php
                                                    //code for summing up fname of out patients 
                                                    $result ="SELECT count(*) FROM his_patients  ";
                                                    $stmt = $mysqli->prepare($result);
                                                    $stmt->execute();
                                                    $stmt->bind_result($patient);
                                                    $stmt->fetch();
                                                    $stmt->close();
                                                ?>
                                                <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $patient;?></span></h3>
                                                <p class="text-muted mb-1 text-truncate">Pacientes</p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->
                            <!--End Out Patients-->


                            <!--Start InPatients-->
                            <!-- end widget-rounded-circle-->
                           
                            <!--End InPatients-->

                            <!--Start Pharmaceuticals-->
                            <div class="col-md-6 col-xl-6">
                                <div class="widget-rounded-circle card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-lg rounded-circle bg-soft-danger border-danger border">
                                                <i class="mdi mdi-pill font-22 avatar-title text-danger"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <?php
                                                    /* 
                                                     * code for summing up fname of pharmaceuticals,
                                                     */ 
                                                    $result ="SELECT count(*) FROM his_pharmaceuticals ";
                                                    $stmt = $mysqli->prepare($result);
                                                    $stmt->execute();
                                                    $stmt->bind_result($phar);
                                                    $stmt->fetch();
                                                    $stmt->close();
                                                ?>
                                                <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $phar;?></span></h3>
                                                <p class="text-muted mb-1 text-truncate">Medicamentos</p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->
                            <!--End Pharmaceuticals-->
                        
                        </div>

                        <div class="row">

                        <!--Start Vendors-->
                       
                            <div class="col-md-6 col-xl-6">
                                <a href="his_farm_account.php">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-danger border-danger border">
                                                    <i class="fas fa-user-tag font-22 avatar-title text-danger"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"></span></h3>
                                                    <p class="text-muted mb-1 text-truncate">My Profile</p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </a> <!-- end widget-rounded-circle-->
                            </div> 
                           <!-- end col--> 
                            <!--End Vendors-->  

                            <!--Start Corporation Assets-->
                     
                            <!--End Corporation Assets-->
                        </div>
                        

                        
                        <!--farmntly Employed Employees-->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card-box">
                                    <h4 class="header-title mb-3">Medicamentoss</h4>

                                    <div class="table-responsive">
                                        <table class="table table-borderless table-hover table-centered m-0">

                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>Quantidade</th>
                                                    <th>Código de Barra</th>
                                                    <th>Categoria </th>
                                                    <th>Fornecedor</th>
                                                    <th>Descrição</th>
                                                </tr>
                                            </thead>
                                            <?php
                                                $ret="SELECT * FROM his_pharmaceuticals ORDER BY RAND() LIMIT 100 "; 
                                                //sql code to get to ten farms  randomly
                                                $stmt= $mysqli->prepare($ret) ;
                                                $stmt->execute() ;//ok
                                                $res=$stmt->get_result();
                                                $cnt=1;
                                                while($row=$res->fetch_object())
                                                {
                                            ?>
                                            <tbody>
                                                <tr>
                                                    
                                                    <td>
                                                        <?php echo $row->phar_name;?> 
                                                    </td>
                                                    <td>
                                                        <?php echo $row->phar_qty;?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->phar_bcode;?> 
                                                    </td>
                                                    <td>
                                                        <?php echo $row->phar_cat;?>
                                                    </td>   
                                                     <td>
                                                        <?php echo $row->phar_vendor;?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->phar_desc;?>
                                                    </td>                                                                                                                                                                                                                                                                                       
                                                </tr>
                                            </tbody>
                                            <?php }?>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->                                                                                                                                                                                                                                         
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <?php include('assets/inc/footer.php');?>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
     
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- Plugins js-->
        <script src="assets/libs/flatpickr/flatpickr.min.js"></script>
        <script src="assets/libs/jquery-knob/jquery.knob.min.js"></script>
        <script src="assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="assets/libs/flot-charts/jquery.flot.js"></script>
        <script src="assets/libs/flot-charts/jquery.flot.time.js"></script>
        <script src="assets/libs/flot-charts/jquery.flot.tooltip.min.js"></script>
        <script src="assets/libs/flot-charts/jquery.flot.selection.js"></script>
        <script src="assets/libs/flot-charts/jquery.flot.crosshair.js"></script>

        <!-- Dashboar 1 init js-->
        <script src="assets/js/pages/dashboard-1.init.js"></script>

        <!-- App js-->
        <script src="assets/js/app.min.js"></script>
        
    </body>

</html>