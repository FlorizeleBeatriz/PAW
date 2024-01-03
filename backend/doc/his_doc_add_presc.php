<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();
$doc_id = $_SESSION['doc_id'];
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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Farmácia</a></li>
                                        <li class="breadcrumb-item active">Dar Prescrição</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Adicionar Prescrição</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title --> 
                    <div class="table-responsive">
                        <table class="table" data-page-size="7">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th scope="col">Nome Paciente</th>
                                    <th scope="col">Número Paciente</th>
                                    <th scope="col">Endereço do Paciente</th>
                                    <th scope="col">Idade do Paciente</th>
                                    <th scope="col">Acções</th>
                                </tr>
                            </thead>
                            <?php
                            /*
                                                *get details of allpatients
                                                *
                                            */
                            $ret = "SELECT * FROM  his_patients ORDER BY RAND() ";
                            //sql code to get to ten docs  randomly
                            $stmt = $mysqli->prepare($ret);
                            $stmt->execute(); //ok
                            $res = $stmt->get_result();
                            $cnt = 1;
                            while ($row = $res->fetch_object()) {
                            ?>

                                <tbody>
                                    <tr>
                                        <th scope="row"><?php echo $cnt; ?></th>
                                        <td><?php echo $row->pat_fname; ?> <?php echo $row->pat_lname; ?></td>
                                        <td><?php echo $row->pat_number; ?></td>
                                        <td><?php echo $row->pat_addr; ?> <?php echo $row->pat_addrn; ?></td>
                                        <td><?php echo $row->pat_age; ?> Years</td>

                                        <td><a href="his_doc_add_single_pres.php?pat_number=<?php echo $row->pat_number; ?>" class="badge badge-success"> Add Prescrição</a></td>
                                    </tr>
                                </tbody>
                            <?php $cnt = $cnt + 1;
                            } ?>
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
    <?php include('assets/inc/footer1.php'); ?>
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