<?php
include("conn.php");

$cpf = $_GET['cpf'];
$sql = mysqli_query($conn, "select cpf from tb_usuario where cpf = '".$cpf."';");
$result = mysqli_fetch_array($sql);

echo $result["cpf"];
?>