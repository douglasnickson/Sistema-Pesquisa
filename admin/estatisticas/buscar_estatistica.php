<?php 

$tipo = $_GET['tipo'];

//Caso o id seja 0 mostra todos os graficos
//Senao mostra o grafico id
if($tipo == 0){
    gerar_estatistica_idade();
}else{
    gerar_estatistica_sexo();
}

function gerar_estatistica_idade () {
    include("../../conn.php"); //Conexao com DB

    //Select que busca as alternativas do id informado
    $sql_estatistica = mysqli_query($conn, "select IF (idade <= 15, 'Até 15 anos', 
                        IF(idade <= 25, '16-25 anos', 
                        IF(idade <= 35, '26-35 anos', 
                        IF(idade <= 45, '36-45 anos', 
                        IF(idade <= 55, '46-55 anos', 
                        IF(idade > 55, 'Mais que 55 anos', 0)))))) faixa_etaria, count(*) qtd
                        from tb_usuario
                        group by faixa_etaria;");
    
    while ($estatistica = mysqli_fetch_array($sql_estatistica)) {
        $faixa_etaria = $estatistica['faixa_etaria'];
        $total = $estatistica['qtd'];
    
        $return_arr[] = array("faixa_etaria" => $faixa_etaria, "total" => $total);
    }
    
    echo json_encode($return_arr);
}

function gerar_estatistica_sexo () {

    include("../../conn.php"); //Conexao com DB

    //Select que busca as alternativas do id informado
    $sql_estatistica = mysqli_query($conn, "select if (sexo = 'M', 'MULHERES', 
                                    if(sexo = 'F', 'HOMENS',0)) sexo, count(*) qtd
                                    from tb_usuario
                                    group by sexo;");
    
    while ($estatistica = mysqli_fetch_array($sql_estatistica)) {
        $sexo = $estatistica['sexo'];
        $total = $estatistica['qtd'];
    
        $return_arr[] = array("sexo" => $sexo, "total" => $total);
    }
    
    echo json_encode($return_arr);

}


?>