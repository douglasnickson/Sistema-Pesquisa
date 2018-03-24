<?php
$id = $_GET['id_pergunta'];

//Caso o id seja 0 mostra todos os graficos
//Senao mostra o grafico id
if($id == 0){
    gerarTodosGraficos();
}else{
    gerarGrafico($id);
}

//Funcao que gera os graficos individuais
function gerarGrafico($id){
    include("../../conn.php"); //Conexao com DB

    //Select que busca as alternativas do id informado
    $sql_alternativa = mysqli_query($conn, "select a.titulo, count(r.id_resposta) as votos from tb_resposta as r
    right join tb_alternativa as a on a.id = r.id_resposta
    where (r.id_pergunta = ".$id." and r.id_pergunta is not null) or (r.id_pergunta is null and a.id_pergunta = ".$id.")
    group by a.titulo order by votos DESC");

    //Busca o titulo da pergunta para mostrar na pagina
    $sql_titulo_pergunta = mysqli_query($conn, "select titulo from tb_pergunta where id = ".$id."");
    
    //Armazena o titulo para retornar no json
    $titulo_pergunta = mysqli_fetch_array($sql_titulo_pergunta);
    $pergunta = $titulo_pergunta['titulo'];

    //Busca as alternativas do id e salva em um array
    while($alternativas = mysqli_fetch_array($sql_alternativa)){
        $titulo = $alternativas['titulo'];
        $votos = $alternativas['votos'];
    
        $return_arr[] = array("titulo" => $titulo, "votos" => $votos, "titulo_pergunta" => $pergunta);
    }
    //Retorna os valores em formato json
    echo json_encode($return_arr);
}

//Funcao que mostra todos os graficos da pesquisa
function gerarTodosGraficos(){
    include("../../conn.php"); //Conexao com BD

    //Busca todas as perguntas do banco
    $sql_pergunta = mysqli_query($conn, "select titulo, id from tb_pergunta");
    while($pergunta = mysqli_fetch_array($sql_pergunta)){

        //Select que busca as alternativas de cada id
        $sql_alternativa = mysqli_query($conn, "select a.titulo, count(r.id_resposta) as votos from tb_resposta as r
        right join tb_alternativa as a on a.id = r.id_resposta
        where (r.id_pergunta = ".$pergunta['id']." and r.id_pergunta is not null) or (r.id_pergunta is null and a.id_pergunta = ".$pergunta['id'].")
        group by a.titulo order by votos DESC");

        //Armazena o total de linhas eo id da pergunta para usar
        //Na hora de gerar os graficos em javascript
        $linhas = mysqli_num_rows($sql_pergunta);
        $id = $pergunta['id'];

        //Laco que busca e armazena num array todas as alternativas
        while($alternativas = mysqli_fetch_array($sql_alternativa)){
            $titulo_pergunta = $pergunta['titulo'];
            $titulo_alternativa = $alternativas['titulo'];
            $votos = $alternativas = $alternativas['votos'];

            $return_arr[] = array("id_pergunta" => $id, "titulo_pergunta" => $titulo_pergunta, "titulo_alternativa" => $titulo_alternativa, "votos" => $votos, "linhas" => $linhas);
        }
    }
    //Retorna um json com todas as alternativas e o id das perguntas
    echo json_encode($return_arr);
}
?>
