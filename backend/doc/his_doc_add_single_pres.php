<?php
session_start();
include('assets/inc/config.php');

// Verifique se a sessão está iniciada
if (!isset($_SESSION['doc_id'])) {
    // Redirecione para a página de login se a sessão não estiver iniciada
    header("Location: login.php");
    exit();
}

// Recupere o nome do médico da sessão
$doc_id = $_SESSION['doc_id'];
$query = "SELECT doc_fname, doc_lname FROM his_docs WHERE doc_id=?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('i', $doc_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $doc_fname = $row['doc_fname'];
    $doc_lname = $row['doc_lname'];
} else {
    // Se não encontrar o médico, redirecione para a página de login
    header("Location: login.php");
    exit();
}

if (isset($_POST['add_patient_presc'])) {
    $pres_pat_name = $_POST['pres_pat_name'];
    $pres_pat_number = $_POST['pres_pat_number'];
    $pres_pat_addr = $_POST['pres_pat_addr'];
    $pres_pat_age = $_POST['pres_pat_age'];
    $pres_number = $_POST['pres_number'];
    // Utilize as variáveis de sessão para o nome do médico
    $pres_doc_name = $doc_fname . ' ' . $doc_lname;
    $pres_ins = $_POST['pres_ins'];
    $pres_phar_name = $_POST['pres_phar_name'];
    $pres_date = $_POST['pres_date'];

    //sql to insert captured values
    $query = "INSERT INTO  his_prescriptions  (pres_pat_name, pres_pat_number,pres_doc_name, pres_pat_addr, pres_pat_age, pres_number, pres_ins, pres_phar_name, pres_date) VALUES(?,?,?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('sssssssss', $pres_pat_name, $pres_pat_number, $pres_doc_name, $pres_pat_addr, $pres_pat_age, $pres_number, $pres_ins, $pres_phar_name, $pres_date);
    $stmt->execute();

    // Declare uma variável que será passada para a função de alerta
    if ($stmt) {
        $success = "Prescrição Adicionada.";
    } else {
        $err = "Tente novamente!";
    }
}
?>
<!-- Restante do seu código... -->

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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Farmácia</a></li>
                                            <li class="breadcrumb-item active">Adicionar Receita</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Adicionar Prescrição do Paciente</h4>
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
                                        <!--Formulário de Adição de Paciente-->
                                        <form method="post">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Nome do Paciente</label>
                                                    <input type="text" required="required" readonly name="pres_pat_name" value="<?php echo $row->pat_fname; ?> <?php echo $row->pat_lname; ?>" class="form-control" id="inputEmail4" placeholder="Primeiro Nome do Paciente">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4" class="col-form-label">Idade do Paciente</label>
                                                    <input required="required" type="text" readonly name="pres_pat_age" value="<?php echo $row->pat_age; ?>" class="form-control" id="inputPassword4" placeholder="Sobrenome do Paciente">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Número do Paciente</label>
                                                    <input type="text" required="required" readonly name="pres_pat_number" value="<?php echo $row->pat_number; ?>" class="form-control" id="inputEmail4" placeholder="Numero do paciente">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4" class="col-form-label">Endereço do Paciente</label>
                                                    <input required="required" type="text" readonly name="pres_pat_addr" value="<?php echo $row->pat_addr; ?> <?php echo $row->pat_addrn; ?>" class="form-control" id="inputPassword4" placeholder="Endereço do Paciente">
                                                </div>
                                            </div>
                                            <input type="hidden" class="hidden" value="<?php echo $row->pres_date; ?>">
                                            <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="inputState" class="col-form-label">Medicamento</label>
                                                <select id="inputState" required="required" name="pres_phar_name" class="form-control">
                                                    <!-- Buscar Todos os Medicamentos -->
                                                    <?php
                                                    $ret = "SELECT * FROM  his_pharmaceuticals ORDER BY RAND() ";
                                                    $stmt = $mysqli->prepare($ret);
                                                    $stmt->execute();
                                                    $res = $stmt->get_result();
                                                    $cnt = 1;
                                                    while ($row = $res->fetch_object()) {
                                                    ?>
                                                        <option><?php echo $row->phar_name; ?></option>
                                                    <?php } ?>
                                                </select> 
                                                <br><button type="button" name="add_textarea" class="ladda-button btn btn-primary" onclick="addMedication()" data-style="expand-right">Adicionar</button> 
                                            </div>
                                            <div class="form-group col-md-6">
                                                    <label for="Nome do medico" class="col-form-label">Nome do Medico</label>
                                                    <input required="required" type="text" readonly name="pres_doc_name" value="<?php echo $doc_fname . ' ' . $doc_lname; ?>">
                                                </div>
                                           </div>
                                        
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-2" style="display:none">
                                            <?php
                                            $length = 5;
                                            $pres_no =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
                                            ?>
                                            <label for="inputZip" class="col-form-label">Número da Receita</label>
                                            <input type="text" name="pres_number" value="<?php echo $pres_no; ?>" class="form-control" id="inputZip">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress" class="col-form-label">Receita</label>
                                        <textarea required="required" type="text" class="form-control " name="pres_ins" id="editor"></textarea>
                                    </div>
                                    <button type="submit" name="add_patient_presc" class="ladda-button btn btn-primary" data-style="">Adicionar Receita</button>
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
            <?php include('assets/inc/footer1.php'); ?>
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
<script>
function addMedication() {
    var selectedMedication = document.getElementById("inputState").value;
    CKEDITOR.instances.editor.insertText(selectedMedication + '\n');
}
</script>
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