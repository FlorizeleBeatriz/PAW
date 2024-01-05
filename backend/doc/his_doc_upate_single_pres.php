<!-- Código do lado do servidor para lidar com o Cadastro de Pacientes -->
<?php
	session_start();
	include('assets/inc/config.php');
	
	if(isset($_POST['update_patient_presc']))
	{
		$pres_pat_name = $_POST['pres_pat_name'];
		$pres_pat_number = $_POST['pres_pat_number'];
        $pres_pat_addr = $_POST['pres_pat_addr'];
        $pres_pat_age = $_POST['pres_pat_age'];
        $pres_number = $_GET['pres_number'];
        $pres_ins = $_POST['pres_ins'];
        
        // SQL para atualizar os valores capturados
		$query = "UPDATE   his_prescriptions  SET pres_pat_name = ?, pres_pat_number = ?, pres_pat_addr = ?, pres_pat_age = ?,  pres_ins = ? WHERE pres_number = ?";
		$stmt = $mysqli->prepare($query);
		$rc = $stmt->bind_param('ssssss', $pres_pat_name, $pres_pat_number, $pres_pat_addr, $pres_pat_age,  $pres_ins, $pres_number);
		$stmt->execute();
		
		if($stmt)
		{
			$success = "Prescrição do Paciente Atualizada";
		}
		else {
			$err = "Por favor, tente novamente ou mais tarde";
		}
	}
?>
<!-- Fim do lado do servidor -->
<!-- Fim do Cadastro de Pacientes -->
<!DOCTYPE html>
<html lang="pt-br">
    
    <!-- Cabeçalho -->
    <?php include('assets/inc/head.php');?>
    <body>

        <!-- Início da página -->
        <div id="wrapper">

            <!-- Barra superior -->
            <?php include("assets/inc/nav.php");?>
            <!-- Fim da barra superior -->

            <!-- ========== Início da barra lateral esquerda ========== -->
            <?php include("assets/inc/sidebar.php");?>
            <!-- Fim da barra lateral esquerda -->

            <!-- ============================================================== -->
            <!-- Início do conteúdo da página -->
            <!-- ============================================================== -->
            <?php
                $pres_number = $_GET['pres_number'];
                $ret="SELECT  * FROM his_prescriptions WHERE pres_number=?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('s',$pres_number);
                $stmt->execute();
                $res=$stmt->get_result();
                //$cnt=1;
                while($row=$res->fetch_object())
                {
            ?>
                <div class="content-page">
                    <div class="content">

                        <!-- Início do Conteúdo -->
                        <div class="container-fluid">
                            
                            <!-- Início do título da página -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box">
                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="his_doc_dashboard.php">Dashboard</a></li>
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Farmácia</a></li>
                                                <li class="breadcrumb-item active">Gerenciar Prescrições</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Atualizar Prescrição do Paciente</h4>
                                    </div>
                                </div>
                            </div>     
                            <!-- Fim do título da página --> 
                            <!-- Formulário -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="header-title">Preencha todos os campos</h4>
                                            <!-- Formulário de Atualização -->
                                            <form method="post">
                                                <div class="form-row">

                                                    <div class="form-group col-md-6">
                                                        <label for="inputEmail4" class="col-form-label">Nome do Paciente</label>
                                                        <input type="text" required="required" readonly name="pres_pat_name" value="<?php echo $row->pres_pat_name;?>" class="form-control" id="inputEmail4" placeholder="Primeiro Nome do Paciente">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="inputPassword4" class="col-form-label">Idade do Paciente</label>
                                                        <input required="required" type="text" readonly name="pres_pat_age" value="<?php echo $row->pres_pat_age;?>" class="form-control"  id="inputPassword4" placeholder="Sobrenome do Paciente">
                                                    </div>

                                                </div>

                                                <div class="form-row">

                                                    <div class="form-group col-md-6">
                                                        <label for="inputPassword4" class="col-form-label">Número do Paciente</label>
                                                        <input required="required" readonly type="text" name="pres_pat_number" value="<?php echo $row->pres_pat_number;?>" class="form-control"  id="inputPassword4" placeholder="Idade do Paciente">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="inputPassword4" class="col-form-label">Endereço do Paciente</label>
                                                        <input required="required" type="text" readonly name="pres_pat_addr" value="<?php echo $row->pres_pat_addr;?>" class="form-control"  id="inputPassword4" placeholder="Idade do Paciente">
                                                    </div>
                                                </div>
                                                <hr>
                                                
                                                <div class="form-group">
                                                        <label for="inputAddress" class="col-form-label">Prescrição</label>
                                                        <textarea required="required"  type="text" class="form-control" name="pres_ins" id="editor"><?php echo $row->pres_ins;?></textarea>
                                                </div>

                                                <button type="submit" name="update_patient_presc" class="ladda-button btn btn-primary" data-style="expand-right">Atualizar Prescrição do Paciente</button>

                                            </form>
                                            <!-- Fim do Formulário de Atualização -->
                                        </div> <!-- end card-body -->
                                    </div> <!-- end card-->
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->

                        </div> <!-- container -->

                    </div> <!-- content -->

                    <!-- Rodapé -->
                    <?php include('assets/inc/footer1.php');?>
                    <!-- Fim do Rodapé -->

                </div>
            <?php }?>

            <!-- ============================================================== -->
            <!-- Fim do conte
