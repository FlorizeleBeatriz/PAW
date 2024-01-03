<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();
$aid = $_SESSION['ad_id'];
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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Employee</a></li>
                                        <li class="breadcrumb-item active">View Employee</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Employee Details</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title"></h4>
                                

                                <div class="table-responsive">
                                    <table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th data-toggle="true">Number</th>
                                                <th data-hide="phone">Nome</th>
                                                <th data-hide="phone">Tipo</th>
                                                <th data-hide="phone">Accoes</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $ret = "SELECT fnumber, nome, tipo FROM funcionarios";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute();
                                            $res = $stmt->get_result();

                                            if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row->fnumber; ?></td>
                                                    <td><?php echo $row->nome; ?></td>
                                                    <td><?php echo $row->tipo; ?></td>
                                                    <td><a href="his_admin_view_single_employee.php?doc_id=<?php echo $row->doc_id; ?>&doc_number=<?php echo $row->doc_number; ?>" class="badge badge-success"><i class="mdi mdi-eye"></i> View</a></td>
                                                </tr>
                                            
                                            <?php
                                            } 

                                            }
                                        

                                            $ret = "SELECT * FROM  his_rece ORDER BY RAND() ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute();
                                            $res = $stmt->get_result();

                                            while ($row = $res->fetch_object()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row->rece_id; ?></td>
                                                    <td><?php echo $row->rece_fname; ?> <?php echo $row->rece_lname; ?></td>
                                                    <td><?php ?></td>
                                                    <td><?php echo $row->rece_email; ?></td>
                                                    <td><a href="his_admin_view_single_employee.php?rece_id=<?php echo $row->rece_id; ?>&rece_id=<?php echo $row->rece_fname; ?>" class="badge badge-success"><i class="mdi mdi-eye"></i> View</a></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>

                                        </tbody>
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
    <script src="assets/js/vendor.min