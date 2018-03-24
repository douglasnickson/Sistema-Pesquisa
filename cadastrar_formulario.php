<?php 
include("conn.php");
$erro = false;
$sucesso = false;

//Verificando se os dados foram enviados
if(!isset($_POST) || empty($_POST)){
    $erro = "Nenhum dado Postado!";
}

//Checando se não existem campos em branco
foreach ($_POST as $chave => $valor){
    $$chave = trim(strip_tags($valor));
    if(empty($valor)){
        $erro = "Existem campos em Branco!";
    }
}

//Busca o ID das perguntas
$sql_buscar_pergunta_radios = mysqli_query($conn, "select id from tb_pergunta");

//Percorre todas as perguntas e verifica se foi selecionado uma opção
while ($radios = mysqli_fetch_array($sql_buscar_pergunta_radios)){
    if(!isset($_POST["qst".$radios["id"]]) || empty($_POST["qst".$radios["id"]])){
        $erro = "Por Favor, Selecione todas as respostas!";
        header("Location: pesquisa.php?erro=$erro");
        break;
    }
}

//Caso nao tenha erros salva as informacoes
if(!$erro){
    $cpf    = $_POST['cpf'];
    $idade  = $_POST['idade'];
    $sexo   = $_POST['sexo'];

    $cpf_novo = limpaCPF($cpf); //Remove a pontuacao do CPF

    //Cadastra o a pessoa no bd
    $sql_cadastrar_usuario = mysqli_query($conn, "insert into tb_usuario VALUES ('".$cpf_novo."', ".$idade.", '".$sexo."')");
   
    if($sql_cadastrar_usuario){
        $sql_buscar_pergunta = mysqli_query($conn, "select id from tb_pergunta");

        //loop que cadastra todas as alternativas
        while ($pergunta = mysqli_fetch_array($sql_buscar_pergunta)){
            $pergunta_pesquisa = $pergunta ["id"]; 
            $resposta_pesquisa = $_POST["qst".$pergunta["id"]];
            $sql_cadastrar_pesquisa = mysqli_query($conn, "insert into tb_resposta values ('".$cpf_novo."', ".$pergunta_pesquisa.", ".$resposta_pesquisa.")");            
            
            if($sql_cadastrar_pesquisa){
                $sucesso = "Pesquisa enviada com Sucesso!";
            }else{
                $erro = "Erro ao cadastrar dados no banco de dados! - Error: ".mysqli_error($conn);
                break;
            }
        }

    }else{
        $erro = "Erro ao cadastrar dados no banco de dados! - Error: ".mysqli_error($conn);
    }
    header ("location: index.php?sucesso=$sucesso");
}else{
    header ("location: index.php?erro=$erro");
}

//Funcao que remove a pontuacao do cpf
function limpaCPF($valor){
    $valor = trim($valor);
    $valor = str_replace(".", "", $valor);
    $valor = str_replace(",", "", $valor);
    $valor = str_replace("-", "", $valor);
    $valor = str_replace("/", "", $valor);
    return $valor;
}

?>