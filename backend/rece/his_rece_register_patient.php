<?php
session_start();
include('assets/inc/config.php');

$pat_number = '';

if (isset($_POST['add_patient'])) {
    $pat_id = $_POST['pat_id'];
    $pat_fname = $_POST['pat_fname'];
    $pat_lname = $_POST['pat_lname'];
    $pat_age = $_POST['pat_age'];
    $pat_addr = $_POST['pat_addr'];
    $pat_addrn = $_POST['pat_addrn'];
    $pat_phone = $_POST['pat_phone'];
    $pat_number = $_POST['pat_number'];
    //sql to insert captured values
    $query = "INSERT INTO his_patients (pat_id, pat_fname, pat_lname, pat_age, pat_addr, pat_addrn, pat_phone, pat_number) VALUES (?,?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('isssssss', $pat_id, $pat_fname, $pat_lname,  $pat_age, $pat_addr, $pat_addrn, $pat_phone, $pat_number);
    $stmt->execute();
    /*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/
    //declare a varible which will be passed to alert function
    if ($stmt) {
        $success = "Paciente Adicionado com sucesso";
    } else {
        $err = "Tente novamente mais tarde!";
    }
}
?>
<!--End Server Side-->
<!--End Patient Registration-->
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
                                        <li class="breadcrumb-item"><a href="his_doc_dashboard.php">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pacientes</a></li>
                                        <li class="breadcrumb-item active">Adicionar Pacientes</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Adicione Dados do Paciente</h4>
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
                                    <form method="post">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="col-form-label">Nome</label>
                                                <input type="text" required="required" name="pat_fname" class="form-control" id="inputEmail4" placeholder="Nome do Paciente">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4" class="col-form-label">Sobre Nome</label>
                                                <input required="required" type="text" name="pat_lname" class="form-control" id="inputPassword4" placeholder="Sobrenome do Paciente">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-2">
                                                <label for="inputPassword4" class="col-form-label">Idade</label>
                                                <input required="required" type="number" name="pat_age" class="form-control" id="inputPassword4" placeholder="Idade do Paciente">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputAddress" class="col-form-label">Bairro</label>
                                                <br>
                                                <select class="form-select rounded p-1" name="pat_addr" aria-label="Default select example">
                                                    <option selected>Escolha um Bairro</option>
                                                    <option value="Mahotas">Mahotas</option>
                                                    <option value="Bairro Ferroviario">Bairro Ferroviario</option>
                                                    <option value="Museu">Museu</option>
                                                    <option value="Malhazine">Malhazine</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="rua" class="col-form-label">Rua</label>
                                                <input required="required" type="number" name="pat_addrn" class="form-control" id="rua">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="inputCity" class="col-form-label">Contacto</label>
                                            <input required="required" type="text" name="pat_phone" class="form-control" id="inputCity" placeholder="876367294">
                                        </div>
                                    </div>

                                        <div class="form-group col-md-2" style="display:none">
                                            <?php
                                            $length = 5;
                                            $pat_number =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
                                            ?>
                                            <label for="inputZip" class="col-form-label">Número do paciente</label>
                                            <input type="text" name="pat_number" value="<?php echo $pat_number; ?>" class="form-control" id="inputZip">
                                        </div>



                                        <button type="submit" name="add_patient" class="ladda-button btn btn-primary" data-style="expand-right">Adicionar Paciente</button>

                                    </form>
                                    <!--End Patient Form-->
                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <?php include('assets/inc/footer.php'); ?>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

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