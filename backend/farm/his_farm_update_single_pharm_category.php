<?php
	session_start();
	include('assets/inc/config.php');
	
	if(isset($_POST['update_pharmaceutical_category']))
	{
		$pharm_cat_name = $_GET['pharm_cat_name'];
		$pharm_cat_vendor = $_POST['pharm_cat_vendor'];
		$pharm_cat_desc = $_POST['pharm_cat_desc'];
            
		// SQL para atualizar os valores capturados
		$query = "UPDATE his_pharmaceuticals_categories SET pharm_cat_vendor=?, pharm_cat_desc=? WHERE pharm_cat_name = ?";
		$stmt = $mysqli->prepare($query);
		$rc = $stmt->bind_param('sss', $pharm_cat_vendor, $pharm_cat_desc, $pharm_cat_name);
		$stmt->execute();
		
		if($stmt)
		{
			$success = "Categoria Farmacêutica Atualizada";
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
            $pharm_cat_name = $_GET['pharm_cat_name'];
            $ret = "SELECT  * FROM his_pharmaceuticals_categories WHERE pharm_cat_name=?";
            $stmt = $mysqli->prepare($ret);
            $stmt->bind_param('s', $pharm_cat_name);
            $stmt->execute();
            $res = $stmt->get_result();
            while($row = $res->fetch_object())
            {
        ?>
        <div class="content-page">
            <div class="content">

                <!-- Início do conteúdo -->
                <div class="container-fluid">
                    
                    <!-- Título da página -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="his_doc_dashboard.php">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Farmacêuticos</a></li>
                                        <li class="breadcrumb-item active">Gerenciar Categoria Farmacêutica</li>
                                    </ol>
                                </div>
                                <h4 class="page-title"><?php echo $row->pharm_cat_name;?></h4>
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
                                        <div class="form-row" >
                                            <div class="form-group col-md-6" style="display:none">
                                                <label for="inputEmail4" class="col-form-label">Nome da Categoria Farmacêutica</label>
                                                <input  type="text" value="<?php echo $row->pharm_cat_name;?>" required="required" name="pharm_cat_name" class="form-control" id="inputEmail4" >
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="inputPassword4" class="col-form-label">Fornecedor da Categoria Farmacêutica</label>
                                                <input required="required" value="<?php echo $row->pharm_cat_vendor;?>" type="text" name="pharm_cat_vendor" class="form-control"  id="inputPassword4">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputAddress" class="col-form-label">Descrição da Categoria Farmacêutica</label>
                                            <textarea required="required" type="text" class="form-control" name="pharm_cat_desc" id="editor"><?php echo $row->pharm_cat_desc;?></textarea>
                                        </div>

                                       <button type="submit" name="update_pharmaceutical_category" class="ladda-button btn btn-danger" data-style="expand-right">Atualizar Categoria</button>

                                    </form>
                                 
                                </div> <!-- Fim do corpo do cartão -->
                            </div> <!-- Fim do cartão-->
                        </div> <!-- Fim da coluna -->
                    </div>
                    <!-- Fim da linha -->

                </div> <!-- container -->

            </div> <!-- conteúdo -->

            <!-- Rodapé -->
            <?php include('assets/inc/footer.php');?>
            <!-- Fim do Rodapé -->

        </div>

        <!-- ============================================================== -->
        <!-- Fim do conteúdo da página -->
        <!-- ============================================================== -->
            <?php }?>
    </div>
    <!-- FIM do wrapper -->
    
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
