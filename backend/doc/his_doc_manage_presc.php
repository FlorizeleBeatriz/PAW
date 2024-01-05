<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  $doc_id = $_SESSION['doc_id'];
  
  if(isset($_GET['delete']))
  {
        $id=intval($_GET['delete']);
        $adn="DELETE FROM his_prescriptions WHERE pres_number=?";
        $stmt= $mysqli->prepare($adn);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();	 
  
          if($stmt)
          {
            $success = "Prescrição removida.";
          }
            else
            {
                $err = "Tente novamente mais tarde";
            }
    }
    ?>

<!DOCTYPE html>
<html lang="pt-br">
    
<?php include('assets/inc/head.php');?>

    <body>

        <!-- Início da página -->
        <div id="wrapper">

            <!-- Barra superior -->
                <?php include('assets/inc/nav.php');?>
            <!-- Fim da barra superior -->

            <!-- ========== Início da barra lateral esquerda ========== -->
                <?php include("assets/inc/sidebar.php");?>
            <!-- Fim da barra lateral esquerda -->

            <!-- ============================================================== -->
            <!-- Início do conteúdo da página -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Início do conteúdo -->
                    <div class="container-fluid">
                        
                        <!-- Início do título da página -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Farmácia</a></li>
                                            <li class="breadcrumb-item active">Gestão de Prescrições</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Gestão de Prescrições</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- Fim do título da página --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="header-title"></h4>
                                   
                                    
                                    <div class="table-responsive">
                                        <table id="" class="table mb-4" data-page-size="7">
                                            <thead>
                                            <tr>
                                                <th scope="col">>#</th>
                                                <th scope="col">>Nome do Paciente</th>
                                                <th scope="col">Número do Paciente</th>
                                                <th scope="col">Endereço</th>
                                                <th scope="col">Idade</th>
                                                <th scope="col">Data</th>
                                                <th scope="col">Ação</th>
                                            </tr>
                                            </thead>
                                            <?php
                                            /*
                                                *Obter detalhes de todos os pacientes
                                                *
                                            */
                                                $ret="SELECT * FROM  his_prescriptions ORDER BY RAND() "; 
                                                //código SQL para obter aleatoriamente os detalhes de dez documentos
                                                $stmt= $mysqli->prepare($ret) ;
                                                $stmt->execute() ;//ok
                                                $res=$stmt->get_result();
                                                $cnt=1;
                                                while($row=$res->fetch_object())
                                                {
                                            ?>

                                                <tbody>
                                                <tr>
                                                    <th scope="row"><?php echo $cnt;?></th>
                                                    <td><?php echo $row->pres_pat_name;?></td>
                                                    <td><?php echo $row->pres_pat_number;?></td>
                                                    <td><?php echo $row->pres_pat_addr;?></td>
                                                    <td><?php echo $row->pres_pat_age;?> Anos</td>
                                                    <td><?php echo $row->pres_date;?></td>
                                                    <td>
                                                        <a href="his_doc_view_single_pres.php?pres_number=<?php echo $row->pres_number;?>&&pres_id=<?php echo $row->pres_id;?>" class="badge badge-success"><i class="fas fa-eye"></i> Ver</a>
                                                        <a href="his_doc_upate_single_pres.php?pres_number=<?php echo $row->pres_number;?>" class="badge badge-warning"><i class="fas fa-eye-dropper "></i> Atualizar</a>
                                                        <a href="his_doc_manage_presc.php?delete=<?php echo $row->pres_number;?>" class="badge badge-danger"><i class=" fas fa-trash-alt "></i> Excluir</a>

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

                <!-- Rodapé -->
                 <?php include('assets/inc/footer1.php');?>
                <!-- Fim do rodapé -->

            </div>

            <!-- ============================================================== -->
            <!-- Fim do conteúdo da página -->
            <!-- ============================================================== -->


        </div>
        <!-- FIM wrapper -->


        <!-- Sobreposição da barra direita-->
        <div class="rightbar-overlay"></div>

        <!-- Scripts de fornecedores -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- Scripts do Footable -->
        <script src="assets/libs/footable/footable.all.min.js"></script>

        <!-- Inicialização do script -->
        <script src="assets/js/pages/foo-tables.init.js"></script>

        <!-- Scripts do aplicativo -->
        <script src="assets/js/app.min.js"></script>
        
    </body>

</html>
