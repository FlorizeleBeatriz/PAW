<?php
session_start();
include('assets/inc/config.php');

if (isset($_POST['add_cons'])) {
    $cons_id = isset($_POST['cons_id']) ? $_POST['cons_id'] : '';
    $cons_number = isset($_POST['cons_number']) ? $_POST['cons_number'] : '';
    $cons_pat_name = isset($_POST['cons_pat_name']) ? $_POST['cons_pat_name'] : '';
    $cons_pat_number = isset($_POST['cons_pat_number']) ? $_POST['cons_pat_number'] : '';
    $cons_pat_age = isset($_POST['cons_pat_age']) ? $_POST['cons_pat_age'] : '';
    $cons_time = isset($_POST['cons_time']) ? $_POST['cons_time'] : '';
    $cons_atend = isset($_POST['cons_atend ']) ? $_POST['cons_atend '] : '';
    $cons_valor = isset($_POST['cons_valor']) ? $_POST['cons_valor'] : '';


    $query = "INSERT INTO his_cons (cons_id, cons_number, cons_pat_name, cons_time, cons_atend, cons_doc_name, cons_valor) VALUES (?, ?, ?, ?, ?, ?,?)";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('issssss', $doc_id, $cons_number, $cons_pat_name, $cons_time, $cons_atend, $cons_doc_name, $cons_valor);
    $stmt->execute();

    if ($stmt) {
        $success = "Patient Cons Addded";
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
        $pat_number = $_GET['pat_number'];
        $ret = "SELECT  * FROM his_patients WHERE pat_number=?";
        $stmt = $mysqli->prepare($ret);
        $stmt->bind_param('s', $pat_number);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        //$cnt=1;
        while ($row = $res->fetch_object()) {
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
                                            <li class="breadcrumb-item"><a href="his_doc_dashboard.php">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pacientes</a></li>
                                            <li class="breadcrumb-item active">Adicionar Consulta</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Adicionar Consulta</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <!-- Form row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Fill all fields</h4>
                                        <!--Add Patient Form-->
                                        <form method="post">
                                            <div class="form-row">

                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4" class="col-form-label">Nome do Paciente</label>
                                                    <input type="text" required="required" readonly name="cons_pat_name" value="<?php echo $row->pat_fname; ?> <?php echo $row->pat_lname; ?>" class="form-control" id="inputEmail4" placeholder="Patient's First Name">
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label for="inputPassword4" class="col-form-label">Idade Do Paciente</label>
                                                    <input required="required" type="text" readonly name="cons_pat_age" value="<?php echo $row->pat_age; ?>" class="form-control" id="inputPassword4" placeholder="Patient`s Last Name">
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4" class="col-form-label">Número do Paciente</label>
                                                    <input type="text" required="required" readonly name="cons_pat_number" value="<?php echo $row->pat_number; ?>" class="form-control" id="inputEmail4">
                                                </div>

                                            </div>
                                            <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="doc_dept" class="col-form-label">Departamento</label>
                                                <select class="form-select rounded p-1" name="doc_dept" id="doc_dept">
                                                    <option selected>Escolha um departamento...</option>
                                                    <option value="Urologia">Urologia</option>
                                                    <option value="Pediatria">Pediatria</option>
                                                    <option value="Ginecologia">Ginecologia</option>
                                                    <option value="Estomatologia">Estomatogia</option>
                                                    <option value="Dermatologia">Dermatologia</option>
                                                    <option value="Dermatologia">Accountig</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="cons_time" class="col-form-label">Hora</label>
                                                <select class="form-select rounded p-1" name="cons_time" id="doc_dept">
                                                <option selected>Escolha um horario...</option>
                                                    <option value="Urologia">8:00</option>
                                                    <option value="Pediatria">9:00</option>
                                                    <option value="Ginecologia">10:00</option>
                                                    <option value="Estomatologia">11:00</option>
                                                    <option value="Dermatologia">12:00</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="cons_time" class="col-form-label">Valor</label>
                                                <select class="form-select rounded p-1" name="cons_time" id="doc_dept">
                                                <option selected>Valores...</option>
                                                <option value="Urologia">Urologia - 1500</option>
                                                    <option value="Pediatria">Pediatria - 900</option>
                                                    <option value="Ginecologia">Ginecologia - 2000</option>
                                                    <option value="Estomatologia">Estomatogia - 1000</option>
                                                    <option value="Dermatologia">Dermatologia - 1000</option>
                                                    <option value="Dermatologia">Accountig</option>
                                                </select>
                                            </div>

                                        </div>

                                            <hr>
                                            <div class="form-row">
                                                <div class="form-group col-md-2" style="display:none">
                                                    <?php
                                                    $length = 5;
                                                    $pres_no =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
                                                    ?>
                                                    <label for="inputZip" class="col-form-label">Número da Consulta</label>
                                                    <input type="text" name="cons_number" value="<?php echo $cons_no; ?>" class="form-control" id="inputZip">
                                                </div>
                                            </div>

                                            <button type="submit" name="add_cons" class="ladda-button btn btn-primary" data-style="expand-right">Adicionar Consulta</button>

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
        <?php } ?>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    



    </div>
    <!-- END wrapper -->


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <!-- ... (código HTML anterior) ... -->
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