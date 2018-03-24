<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Premio ACEPCDL - ADM</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<?php 
    if (isset($_SESSION['logado'])){
?>

<div class="container">
	<div class="row justify-content-center align-items-center">
	  	<div class="form-search">
		  	<div class="mx-auto text-center">
                <a href="index.php"><img class="img-fluid" src="../images/logomarca.jpeg" /></a>
			</div>
			<hr />
	  		<h4 style="text-align:center;">Seja bem vindo ao Sistema ADM.</h4>
	  		<hr />
            <table class="table table-sm table-hover admin-home" style="color: grey;">
                <tr>
                    <td><a href="graficos/graficos.php"><b>> Abrir Gráficos</b></a></td>
                </tr>
                <tr>
                    <td><a href="estatisticas/estatistica.php"><b>> Abrir Estatisticas</b></a></td>
                </tr>
                <tr>
                    <td><a href="cadastros/cadastrar_pergunta.php"><b>> Cadastrar Pergunta</b></a></td>
                </tr>
                <tr>
                    <td><a href="atualizacao/atualizar_pergunta.php"><b>> Atualizar Pergunta</b></a></td>
                </tr>
                <tr>
                    <td><a href="cadastros/cadastrar_alternativa.php"><b>> Cadastrar Alternativa</b></a></td>
                </tr>
                <tr>
                    <td><a href="atualizacao/atualizar_alternativa.php"><b>> Atualizar Alternativa</b></a></td>
                </tr>
                <tr>
                    <td><a href="acoes.php?sair=ok"><b>> Sair</b></a></td>
                </tr>
            </table>
            <hr />
            <h6 style="text-align:center;">Realização</h6>
            <hr />
            <div class="mx-auto text-center">
                    <img class="img-thumbnail" src="../images/logo1.jpeg" />
                    <img class="img-thumbnail" src="../images/logo2.jpeg" />
                    <img class="img-thumbnail" src="../images/logo3.jpeg" />
                    <img class="img-thumbnail" src="../images/logo4.jpeg" />
                    <img class="img-thumbnail" src="../images/logo5.png" />
            </div>
            <br />
			<!-- Mensagens de Erro ou Sucesso -->
			<?php 
				if(isset($_SESSION['erro'])){
					$msg_erro = $_SESSION['erro'];
                    echo"<div class='alert alert-danger' style='text-align:center;' role='alert'>".$msg_erro."</div>";
                    unset($_SESSION['erro']);
				} else if (isset($_SESSION['sucesso'])) {
                    $msg_sucesso = $_SESSION['sucesso'];
                    echo"<div class='alert alert-success' style='text-align:center;' role='alert'>".$msg_sucesso."</div>";
                    unset($_SESSION['sucesso']);
                }
			?>
		</div>   
	</div>  
</div>
<?php 

    } else {
        $_SESSION['erro'] = "Faça o login para acessar o sistema!";
        header("Location: login.php");
    }

?>
<!-- Scripts do JS -->
<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/jquery.mask.js"></script>
<script type="text/javascript" src="../js/scripts.js"></script>
</body>
</html>