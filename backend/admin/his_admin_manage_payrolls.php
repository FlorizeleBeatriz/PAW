<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  $aid=$_SESSION['ad_id'];
  if(isset($_GET['delete_pay_number']))
  {
        $id=intval($_GET['delete_pay_number']);
        $adn="delete from his_payrolls where pay_number=?";
        $stmt= $mysqli->prepare($adn);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();	 
  
          if($stmt)
          {
            $success = "Payroll Record Deleted";
          }
            else
            {
                $err = "Try Again Later";
            }
    }

?>

<!DOCTYPE html>
<html lang="en">
    
<?php include('assets/inc/head.php');?>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
                <?php include('assets/inc/nav.php');?>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
                <?php include("assets/inc/sidebar.php");?>
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Folha de Pagamento</a></li>
<li class="breadcrumb-item active">Gerenciar Folha de Pagamento</li>
</ol>
</div>
<h4 class="page-title">Detalhes do Funcionário</h4>
</div>
</div>
</div>
<!-- fim do título da página -->

<div class="row">
    <div class="col-12">
        <div class="card-box">
            <h4 class="header-title"></h4>
            
            <div class="table-responsive">
                <table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th data-toggle="true">Nome do Funcionário</th>
                            <th data-toggle="true">Número do Funcionário</th>
                            <th data-hide="phone">Número da Folha de Pagamento</th>
                            <th data-hide="phone">Salário do Funcionário</th>
                            <th data-hide="phone">Ação</th>
                        </tr>
                    </thead>
                    <?php
                    $ret = "SELECT * FROM his_payrolls ORDER BY RAND() "; 
                    $stmt = $mysqli->prepare($ret);
                    $stmt->execute();
                    $res = $stmt->get_result();
                    $cnt = 1;
                    while($row = $res->fetch_object()) {
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $cnt;?></td>
                            <td><?php echo $row->pay_doc_name;?></td>
                            <td><?php echo $row->pay_doc_number;?></td>
                            <td><?php echo $row->pay_number;?></td>   
                            <td>$ <?php echo $row->pay_emp_salary;?></td>
                         
                            <td>
                                <a href="his_admin_manage_payrolls.php?delete_pay_number=<?php echo $row->pay_number;?>" class="badge badge-danger"><i class="fas fa-trash"></i> Excluir</a>
                                <a href="his_admin_update_single_employee_payroll.php?pay_number=<?php echo $row->pay_number;?>" class="badge badge-success"><i class="fas fa-edit "></i> Atualizar Folha de Pagamento</a>
                            </td>
                                                </tr>
                                                </tbody>
                                            <?php  $cnt = $cnt +1 ; }?>
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
                 <?php include('assets/inc/footer.php');?>
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