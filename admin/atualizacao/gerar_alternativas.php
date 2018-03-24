<?php 
include ('../../conn.php');
$id_pergunta = $_GET['id'];
$sql_ts = mysqli_query($conn, "select lower(titulo) as titulo, id from tb_alternativa where id_pergunta = ".$id_pergunta."");

$text = "<select class='custom-select mr-sm-2 mb-2' name='alternativa'"
    ."<option>Escolha uma Opção...</option>";
while($sql_select = mysqli_fetch_array($sql_ts)){
    $text .= "<option value=".$sql_select['id'].">".$sql_select['titulo']."</option>";
}
    $text .= "</select>";
    echo $text;
?>