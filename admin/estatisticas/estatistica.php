<?php
session_start();
if (isset($_SESSION['logado'])){
  include("../../conn.php");
  include("gerar_estatistica.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Premio ACEPCDL - Gráficos</title>

	<link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body onload="gerar_estatistica()">
<?php 
    if (!isset($_SESSION['logado'])){
      $_SESSION['erro'] = "Faça o login para acessar o sistema";
      header("Location: ../login.php");
    } else {
?>
<div class="container graficos">
  <div class="mx-auto text-center">
        <a href="../index.php"><img class="img-fluid" src="../../images/logomarca.jpeg" /></a>
    </div>
    <div class="row">
      <div class="col-sm-12"><hr /><h3>Estatistica da Pesquisa</h3><hr /></div>
        <div class="container row" id="mostrarEstatistica">
            <div class="col-sm-6" >
                <h3>Faixa Etaria</h3>
                <hr />
                <div id="estatistica-idade"></div>
            </div>
            <div class="col-sm-6" >
                <h3>Sexo</h3>
                <hr />
                <div id="estatistica-sexo"></div>
            </div>
        </div>
      </div>
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
    </div>
</div>
<?php } ?>
<!-- Scripts do JS -->
<script type="text/javascript" src="../../js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>