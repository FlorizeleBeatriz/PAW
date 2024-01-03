<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();
//$aid=$_SESSION['ad_id'];
$rece_id = $_SESSION['rece_id'];

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $adn = "delete from his_cons where cons_id=?";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();

    if ($stmt) {
        $success = "Patients Records Deleted";
    } else {
        $err = "Try Again Later";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('assets/inc/head.php'); ?>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <?php include('assets/inc/nav.php'); ?>
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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Patients</a></li>
                                        <li class="breadcrumb-item active"></li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Gestão de Consultas </h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="table-responsive">
                        <table  class="table" data-page-size="7">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th scope="col">Número da Consulta</th>
                                    <th scope="col">Nome do Paciente</th>
                                    <th scope="col">Idade</th>
                                    <th scope="col">Hora</th>
                                    <th scope="col">Departamento</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Acções</th>
                                </tr>
                            </thead>
                            <?php
                            /*
                                                *get details of allpatients
                                                *
                                            */
                            $ret = "SELECT * FROM  his_cons ORDER BY RAND() ";
                            //sql code to get to ten docs  randomly
                            $stmt = $mysqli->prepare($ret);
                            $stmt->execute(); //ok
                            $res = $stmt->get_result();
                            $cnt = 1;
                            while ($row = $res->fetch_object()) {
                            ?>

                                <tbody>
                                    <tr>
                                        <th><?php echo $row->cons_number;?></th>
                                        <td><?php echo $row->pat_fname; ?> <?php echo $row->pat_lname; ?></td>
                                        <td><?php echo $row->pat_age; ?></td>
                                        <td><?php echo $row->cons_time; ?></td>
                                        <td><?php echo $row->cons_atend; ?></td>
                                        <td><?php echo $row->cons_valor; ?></td>


                                        <td>
                                            <a href="his_rece_manage_patient.php?delete=<?php echo $row->pat_id; ?>" class="badge badge-danger"><i class=" mdi mdi-trash-can-outline "></i> Delete</a>
                                            <a href="his_rece_view_patient.php?pat_id=<?php echo $row->pat_id; ?>&&pat_number=<?php echo $row->pat_number; ?>" class="badge badge-success"><i class="mdi mdi-eye"></i> View</a>
                                            <a href="his_rece_update_single_patient.php?pat_id=<?php echo $row->pat_id; ?>" class="badge badge-primary"><i class="mdi mdi-check-box-outline "></i> Update</a>
                                        </td>
                                    </tr>
                                </tbody>
                            <?php   } ?>
                            <tfoot>
                                <tr class="active">
                                    <td colspan="8">
                                        <div class="text-right">
                                            <ul class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0"></ul>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div> <!-- end .table-responsive-->
                </div> <!-- end card-box -->
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

    <!-- Footable js -->
    <script src="assets/libs/footable/footable.all.min.js"></script>

    <!-- Init js -->
    <script src="assets/js/pages/foo-tables.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>

</html>