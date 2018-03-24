<?php 
	include("conn.php");
	//Recebe os valores do form 1 por POST
	$cpf = $_POST['cpf'];
	$idade = $_POST['idade'];
	$sexo = $_POST['sexo'];
	$sql_pergunta = mysqli_query($conn, "select titulo, id from tb_pergunta");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Premio ACEPCDL - Pesquisa</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>


<div class="container h-100">
	<div class="row h-100 justify-content-center align-items-center">
	  	<div class="form-search">
		  	<div class="mx-auto text-center">
		  		<a href="index.php"><img class="img-fluid" src="images/logomarca.jpeg" /></a>
			</div>
			<hr />
			<h4>Por Favor, Responda todas as perguntas.</h4>
			<hr />  
		    <form action="cadastrar_formulario.php" method="POST">
				<?php
				//Laco que percorre todas as perguntas no DB
				while($pergunta = mysqli_fetch_array($sql_pergunta)){
					echo "<h5>".$pergunta["titulo"]."</h5>"; //Mostra o titulo da pergunta
					$titulo_id = $pergunta["id"];

					//Select que busca as alternativas de acordo com o id da pergunta
					$sql_alternativa = mysqli_query($conn, "select a.titulo, a.id from tb_alternativa as a 
					inner join tb_pergunta as p on p.id = a.id_pergunta
					where a.id_pergunta = ".$titulo_id."");

					//Laco que percorre todas as alternativas da pergunta
					while($alternativa = mysqli_fetch_array($sql_alternativa)){
						//Mostra na tela as alternativas para escolha
						//name e gerado dinamicamente de acordo com o id da pergunta
						echo "<div class='form-check'>
						<label>
							<input type='radio' name='qst".$titulo_id."' value='".$alternativa["id"]."' required> <span class='label-text'>".$alternativa["titulo"]."</span>
						</label>
						</div>";
					}
				}

				?>			
				<br />
				<button type="submit" class="btn btn-lg btn-block btn-info">Finalizar Pesquisa</button>
				<!-- Valores armazenados do primeiro form -->
				<input type="hidden" name="cpf" value="<?php echo $cpf?>">
				<input type="hidden" name="idade" value="<?php echo $idade?>">
				<input type="hidden" name="sexo" value="<?php echo $sexo?>">
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

			<?php 
				if(isset($_GET['erro'])){
					$msg_erro = $_GET['erro'];
					echo"<div class='alert alert-danger' style='text-align:center;' role='alert'>".$msg_erro."</div>";
				}
			?>
		</div>   
	</div>  
</div>

<!-- Scripts do JS -->
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>