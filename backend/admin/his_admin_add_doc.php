<!--Server side code to handle  Patient Registration-->
<?php
session_start();
include('assets/inc/config.php');

if (isset($_POST['add_doc'])) {
    // Verifique se os campos do formulário existem antes de acessá-los
    $doc_id = isset($_POST['doc_id']) ? $_POST['doc_id'] : '';
    $doc_fname = isset($_POST['doc_fname']) ? $_POST['doc_fname'] : '';
    $doc_lname = isset($_POST['doc_lname']) ? $_POST['doc_lname'] : '';
    $doc_number = isset($_POST['doc_number']) ? $_POST['doc_number'] : '';
    $doc_email = isset($_POST['doc_email']) ? $_POST['doc_email'] : '';
    $doc_pwd = isset($_POST['doc_pwd']) ? sha1(md5($_POST['doc_pwd'])) : '';
    $doc_dept = isset($_POST['doc_dept']) ? $_POST['doc_dept'] : '';

    // SQL para inserir os valores capturados
    $query = "INSERT INTO his_docs (doc_id, doc_fname, doc_lname, doc_number, doc_email, doc_pwd, doc_dept) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);

    // Verifique se a preparação da consulta foi bem-sucedida
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param('issssss', $doc_id, $doc_fname, $doc_lname, $doc_number, $doc_email, $doc_pwd, $doc_dept);

        // Execute a consulta
        $stmt->execute();

        // Verifique se a execução foi bem-sucedida
        if ($stmt->affected_rows > 0) {
            $success = "Detalhes do funcionário adicionados com sucesso.";
        } else {
            $err = "Por favor, tente novamente ou tente mais tarde.";
        }

        // Feche a declaração
        $stmt->close();
    } else {
        $err = "Erro na preparação da consulta.";
    }
}
?>



<!--End Server Side-->
<!--End Patient Registration-->
<!docTYPE html>
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
                                        <li class="breadcrumb-item"><a href="his_admin_dashboard.php">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Médico</a></li>
                                        <li class="breadcrumb-item active">Cadastrar Médico</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Cadastrar Médico</h4>
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
                                                <input type="text" required="required" name="doc_fname" class="form-control" id="inputEmail4">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4" class="col-form-label">Sobre Nome</label>
                                                <input required="required" type="text" name="doc_lname" class="form-control" id="inputPassword4">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6" style="display:none">
                                                <?php
                                                $length = 5;
                                                $patient_number =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
                                                ?>
                                                <label for="inputZip" class="col-form-label">Número Médico</label>
                                                <input type="text" name="doc_number" value="<?php echo $doc_number; ?>" class="form-control" id="inputZip">
                                            </div>

                                            <div class="form-group col-md-6 ">
                                                <label for="inputAddress" class="col-form-label">Email</label>
                                                <input required="required" type="email" class="form-control" name="doc_email" id="inputAddress">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputdepartaments" class="col-form-label">Departamento</label>
                                                <br>
                                                <select class="form-select rounded p-1" name="doc_dept" aria-label="Selecione um departamento">
                                                    <option selected>Escolha um departamento...</option>
                                                    <option value="Urologia">Urologia</option>
                                                    <option value="Pediatria">Pediatria</option>
                                                    <option value="Ginecologia">Ginecologia</option>
                                                    <option value="Estomatologia">Estomatogia</option>
                                                    <option value="Dermatologia">Dermatologia</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputCity" class="col-form-label">Password</label>
                                                <input required="required" type="password" name="doc_pwd" class="form-control" id="inputCity">
                                            </div>

                                        </div>

                                        <button type="submit" name="add_doc" class="ladda-button btn btn-success" data-style="expand-right">Adicionar</button>

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