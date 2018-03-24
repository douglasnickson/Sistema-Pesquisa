<?php
session_start();
if (isset($_SESSION['logado'])){
  include("../../conn.php");
  include("gerar_graficos.php");
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
<body>
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
      <div class="col-sm-12"><hr /><h3>Relatório da Pesquisa</h3><hr /></div>
        <div class="col-sm-12">
          <form class="form-inline">
            <select class="custom-select mr-sm-2 mb-2" id="opcoes-grafico" onchange="mostrarTodos()">
              <option selected>Escolha uma Opção...</option>
              <option value="0">mostrar todos</option>
              <?php
                mysql_set_charset('utf8', $conn);
                $sql_ts = mysqli_query($conn, "select lower(titulo) as titulo, id from tb_pergunta");
                while($sql_select = mysqli_fetch_array($sql_ts)){
                  echo "<option value=".$sql_select['id'].">".$sql_select['titulo']."</option>";
                }
              ?>
            </select>
            <input type='hidden' value='' id='tipo-grafico'>
          </form>
          <hr />
          <div class="col-sm-12" style="display:none; text-align:center" id="msg-graficos">
            <img src="../../images/loading.gif" align="center"/><hr />
          </div>
          <?php 
            $sql_votos = mysqli_query($conn, "select count(*) total from tb_usuario;");
            $votos = mysqli_fetch_assoc($sql_votos);
          ?>
          <div style="text-align:center" class="col-sm-12 alert alert-success">Total de participantes: <?php echo $votos['total'] ?></div>
        </div>
        <div class="container row" id="mostrarGraficos" style="display:none;">
        <?php
          $sql_t = mysqli_query($conn, "select titulo, id from tb_pergunta");
          while($t = mysqli_fetch_array($sql_t)){
              echo "<div class='col-sm-4'><hr /><h6>".$t['titulo']."</h6><hr />
                    <div id='graficos-".$t['id']."'></div>
                    </div>";
          }
        ?>
        </div>
        <div class="container row justify-content-center align-items-center" id='mostrarTitulo'>
            <div class="col-sm-12" id="titulo-grafico"></div>
        </div>
        <div class="container row justify-content-center align-items-center" id='mostrarGrafico'>
          <div class='grafico'>
            <div class='col-sm-4' id='grafico'></div>
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