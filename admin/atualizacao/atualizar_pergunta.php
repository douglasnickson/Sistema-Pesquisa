<?php 
session_start();
if (isset($_SESSION['logado'])){
    include("../../conn.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Premio ACEPCDL - Atualizar Categoria</title>
	<link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php 
    if (!isset($_SESSION['logado'])){
      $_SESSION['erro'] = "Faça o login para acessar o sistema";
      header("Location: ../login.php");
    } else {
?>
<div class="container">
	<div class="row justify-content-center align-items-center">
	  	<div class="form-search">
		  	<div class="mx-auto text-center">
			  	<a href="../index.php"><img class="img-fluid" src="../../images/logomarca.jpeg" /></a>
			</div>
			<hr />
	  		<h4 style="text-align:center;">Por Favor, Insira a pergunta.</h4>
	  		<hr />
            <form method="post" action="../acoes.php">
                <label for="pergunta">Selecione uma pergunta:</label>
                <select class="custom-select mr-sm-2 mb-2" name="pergunta">
                <option selected>Escolha uma Opção...</option>
                <?php
                    mysql_set_charset('utf8', $conn);
                    $sql_ts = mysqli_query($conn, "select lower(titulo) as titulo, id from tb_pergunta");
                    while($sql_select = mysqli_fetch_array($sql_ts)){
                    echo "<option value=".$sql_select['id'].">".$sql_select['titulo']."</option>";
                    }
                ?>
                </select>            
	            <div class="form-group">
	                <label for="pergunta">Atualizar pergunta:</label>
	                <input type="text" class="form-control" id="nova_pergunta" name="nova_pergunta" placeholder="Insira a nova pergunta" required>
	            </div>   
				<br />
				<button type="submit" class="btn btn-lg btn-block btn-info" id="enviar">Atualizar</button>				
				<input type="hidden" value="4" id="tipo_formulario" name="tipo_formulario">
				<br />
				<p class="form-search-voltar" style="text-align:center;"><a href="../index.php">Voltar</a></p>				
				<hr />
				<h6 style="text-align:center;">Realização</h6>
				<hr />
				<div class="mx-auto text-center">
					  <img class="img-thumbnail" src="../../images/logo1.jpeg" />
					  <img class="img-thumbnail" src="../../images/logo2.jpeg" />
					  <img class="img-thumbnail" src="../../images/logo3.jpeg" />
					  <img class="img-thumbnail" src="../../images/logo4.jpeg" />
					  <img class="img-thumbnail" src="../../images/logo5.png" />
				</div>
            </form>
            <br />
            <!-- Mensagens de Erro ou Sucesso -->
			<?php 
				if(isset($_SESSION['erro'])){
					$msg_erro = $_SESSION['erro'];
                    echo"<div class='alert alert-danger' style='text-align:center;' role='alert'>".$msg_erro."</div>";
                    unset($_SESSION['erro']);
				}
			?>
		</div>   
	</div>  
</div>
<?php } ?>

<!-- Scripts do JS -->
<script type="text/javascript" src="../../js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../../bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../js/jquery.mask.js"></script>
<script type="text/javascript" src="../../js/scripts.js"></script>
</body>
</html>