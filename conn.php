<?php 
/*
header('Content-Type: text/html; charset=utf-8');

//Dados do Banco de Dados
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "pesquisapombal";

//Efetuando a conexao
$conn =  mysqli_connect($host, $usuario, $senha);
$db = mysqli_select_db($conn, $banco);

//Charset do Banco
mysqli_query($conn, "SET NAMES 'utf8'");
mysqli_query($conn,'SET character_set_connection=utf8');
mysqli_query($conn,'SET character_set_client=utf8');
mysqli_query($conn,'SET character_set_results=utf8');

*/


header('Content-Type: text/html; charset=utf-8');

//Dados do Banco de Dados
$host = "10.16.4.61";
$usuario = "usr_pesquisapombal";
$senha = "W2K@pesquisapombal";
$banco = "pesquisapombal";

//Efetuando a conexao
$conn =  mysqli_connect($host, $usuario, $senha);
$db = mysqli_select_db($conn, $banco);

//Charset do Banco
mysqli_query($conn, "SET NAMES 'utf8'");
mysqli_query($conn,'SET character_set_connection=utf8');
mysqli_query($conn,'SET character_set_client=utf8');
mysqli_query($conn,'SET character_set_results=utf8');

?>