<?php
	session_start();
	include('assets/inc/config.php');

	if(isset($_POST['update_pharmaceutical']))
	{
		$phar_name = $_POST['phar_name'];
		$phar_desc = $_POST['phar_desc'];
        $phar_qty = $_POST['phar_qty'];
        $phar_cat = $_POST['phar_cat'];
        $phar_bcode = $_GET['phar_bcode'];
        $phar_vendor = $_POST['phar_vendor'];
        
		// SQL para atualizar os valores capturados
		$query = "UPDATE his_pharmaceuticals SET phar_name = ?, phar_desc = ?, phar_qty = ?, phar_cat = ?, phar_vendor = ? WHERE phar_bcode = ?";
		$stmt = $mysqli->prepare($query);
		$rc = $stmt->bind_param('ssssss', $phar_name, $phar_desc, $phar_qty, $phar_cat, $phar_vendor, $phar_bcode);
		$stmt->execute();
		
		if($stmt)
		{
			$success = "Farmacêutico Atualizado";
		}
		else {
			$err = "Por favor, tente novamente ou tente mais tarde";
		}
	}
?>

<!-- Fim do lado do servidor -->

<!DOCTYPE html>
<html lang="pt-br">

<!-- Cabeçalho -->
<?php include('assets/inc/head.php');?>

<body>

    <!-- Início da página -->
    <div id="wrapper">

        <!-- Início da barra superior -->
        <?php include("assets/inc/nav.php");?>
        <!-- Fim da barra superior -->

        <!-- ========== Início da barra lateral ========== -->
        <?php include("assets/inc/sidebar.php");?>
        <!-- Fim da barra lateral -->

        <!-- ============================================================== -->
        <!-- Início do conteúdo da página aqui -->
        <!-- ============================================================== -->
        <?php
            $phar_bcode = $_GET['phar_bcode'];
            $ret = "SELECT  * FROM his_pharmaceuticals WHERE phar_bcode=?";
            $stmt = $mysqli->prepare($ret);
            $stmt->bind_param('s', $phar_bcode);
            $stmt->execute();
            $res = $stmt->get_result();
            while($row = $res->fetch_object())
            {
        ?>
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
                                            <li class="breadcrumb-item"><a href="his_doc_dashboard.php">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Farmacêuticos</a></li>
                                            <li class="breadcrumb-item active">Gerenciar Farmacêutico</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Atualizar #<?php echo $row->phar_bcode;?> - <?php echo $row->phar_name;?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- Fim do título da página --> 
                        
                        <!-- Linha do formulário -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Preencha todos os campos</h4>
                                        <!-- Formulário de Atualização -->
                                        <form method="post">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Nome do Farmacêutico</label>
                                                    <input type="text" required="required" value="<?php echo $row->phar_name;?>" name="phar_name" class="form-control" id="inputEmail4" >
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4" class="col-form-label">Quantidade de Farmacêuticos (Caixas)</label>
                                                    <input required="required" type="text" value="<?php echo $row->phar_qty;?>" name="phar_qty" class="form-control"  id="inputPassword4">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputAddress" class="col-form-label">Descrição do Farmacêutico</label>
                                                <textarea required="required"  type="text" class="form-control" name="phar_desc" id="editor"><?php echo $row->phar_desc;?></textarea>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4" class="col-form-label">Fornecedor do Farmacêutico</label>
                                                    <input required="required" type="text" value="<?php echo $row->phar_vendor;?>" name="phar_vendor" class="form-control"  id="inputPassword4">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputState" class="col-form-label">Categoria do Farmacêutico</label>
                                                    <select id="inputState" required="required" name="phar_cat" class="form-control">
                                                        <!-- Obtenha todas as categorias de farmacêuticos -->
                                                        <?php
                                                            $ret = "SELECT * FROM his_pharmaceuticals_categories ORDER BY RAND() "; 
                                                            $stmt = $mysqli->prepare($ret);
                                                            $stmt->execute();
                                                            $res = $stmt->get_result();
                                                            while($row = $res->fetch_object())
                                                            {
                                                        ?>
                                                            <option><?php echo $row->pharm_cat_name;?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                            <button type="submit" name="update_pharmaceutical" class="ladda-button btn btn-warning" data-style="expand-right">Atualizar Farmacêutico</button>
                                        </form>
                                    </div> <!-- Fim do corpo do cartão -->
                                </div> <!-- Fim do cartão-->
                            </div> <!-- Fim da coluna -->
                        </div>
                        <!-- Fim da linha do formulário -->

                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Início do rodapé -->
                <?php include('assets/inc/footer.php');?>
                <!-- Fim do rodapé -->

            </div>
        <?php }?>
        <!-- ============================================================== -->
        <!-- Fim do conteúdo da página -->
        <!-- ============================================================== -->

    </div>
    <!-- FIM wrapper -->
    
    <!-- Carregar CK EDITOR Javascript -->
    <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
    <script type="text/javascript">
    CKEDITOR.replace('editor')
    </script>
   
    <!-- Sobreposição da barra direita -->
    <div class="rightbar-overlay"></div>

    <!-- Scripts do fornecedor -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- Script do aplicativo -->
    <script src="assets/js/app.min.js"></script>

    <!-- Scripts de botões de carregamento -->
    <script src="assets/libs/ladda/spin.js"></script>
    <script src="assets/libs/ladda/ladda.js"></script>

    <!-- Inicialização de botões js -->
    <script src="assets/js/pages/loading-btn.init.js"></script>
    
</body>

</html>
