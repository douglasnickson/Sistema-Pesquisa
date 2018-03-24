<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Premio ACEPCDL</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="container">
	<div class="row justify-content-center align-items-center">
	  	<div class="form-search">
		  	<div class="mx-auto text-center">
		  		<a href="index.php"><img class="img-fluid" src="images/logomarca.jpeg" /></a>
			</div>
			<hr />
	  		<h4 style="text-align:center;">Bem vindo(a) a pesquisa</h4>
	  		<h4 style="text-align:center;">Por Favor, Preencha os dados abaixo para continuar.</h4>
	  		<hr />
		    <form method="post" action="pesquisa.php" id="formulario" name="formulario">
	            <div class="form-group">
	                <label for="cpf">CPF:</label>
	                <input type="text" class="form-control" id="cpf" name="cpf"  maxlength="14" placeholder="Digite o seu CPF" required>
	            </div>    
				<div class="form-group">
					<label for="idade">Idade:</label>
					<input type="number" class="form-control" id="idade" name="idade" min="0" max="100" placeholder="Digite sua Idade" required>
				</div>
				<div class="form-check">
					<label for="idade">Sexo:</label><br />
					<label>
						<input type="radio" name="sexo" id="sexo" value="M" required> <span class="label-text">Masculino </span>
					</label>
					<label>
						<input type="radio" name="sexo" id="sexo" value="F"> <span class="label-text">Feminino </span>
					</label>
				</div>
				<br />
				<button type="submit" class="btn btn-lg btn-block btn-info" id="enviar">Iniciar Pesquisa</button>				
				<input type="hidden" value="false" id="validado" name="validado">

				<hr />
				<h6 style="text-align:center;">Realização</h6>
				<hr />
				<div class="mx-auto text-center">
					  <img class="img-thumbnail" src="images/logo1.jpeg" />
					  <img class="img-thumbnail" src="images/logo2.jpeg" />
					  <img class="img-thumbnail" src="images/logo3.jpeg" />
					  <img class="img-thumbnail" src="images/logo4.jpeg" />
					  <img class="img-thumbnail" src="images/logo5.png" />
				</div>
		    </form>

			<br />
			
			<div id="resultado"></div>

			<!-- Mensagens de Erro ou Sucesso -->
			<?php 
				if(isset($_GET['erro'])){
					$msg_erro = $_GET['erro'];
					echo"<div class='alert alert-danger' style='text-align:center;' role='alert'>".$msg_erro."</div>";
				}else if(isset($_GET['sucesso'])){
					$msg_sucesso = $_GET['sucesso'];
					echo"<div class='alert alert-success' style='text-align:center;' role='alert'>".$msg_sucesso."</div>";
				}
			?>

		</div>   
	</div>  
</div>
<!-- Scripts do JS -->
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.mask.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
</body>
</html>