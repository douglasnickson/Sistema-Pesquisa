<script type="text/javascript" src="../../js/loader.js"></script>
<script type="text/javascript">

//Funcao chamada via Ajax
//Mostra todos caso seja 0 ou determinado grafico pelo id
function mostrarTodos(){
    var id = document.getElementById("opcoes-grafico").value;
    if(id == 0){
        gerarGraficos();
    }else{
        gerarGrafico();
    }
}

//Funcao que lista todos os Graficos
function gerarGraficos(){
        //Mostra a mensagem buscando os graficos
        //Esconde as divs de titulo e graficos individuais
        document.getElementById('msg-graficos').style.display="inherit";
        document.getElementById('mostrarTitulo').style.display="none";
        document.getElementById('mostrarGrafico').style.display="none";

        //Requisicao ajax para buscar os dados dos graficos via php
        $(document).ready(function(){
        $.ajax({
            url: 'buscar_graficos.php?id_pergunta=0',
            type: 'get',
            dataType: 'JSON',
            success: function(response){
                //Trata o retorno da requisicao ajax
                var len = response[0].linhas; //Total de perguntas
                var len_alternativas = response.length; //Total de Respostas
                //Carrega o google chart
                google.charts.load("visualization", "1", {packages:["corechart"]});
                google.charts.setOnLoadCallback(drawChart);
                
                //Funcao responsavel por criar os graficos
                function drawChart() {
                    ok = 0; //Utilizado para mostrar as divs apenas no final

                    //Laco que percorre todas as alternativas do json
                    for(var i=0; i<len; i++){
                    id_pergunta = i + 1;
                    //Define as informacoes do grafico
                    var data = new google.visualization.DataTable();
                        data.addColumn('string', 'Alternativa');
                        data.addColumn('number', 'Votos');
                        //Mostra apenas as alternativas relacionadas ao id da pergunta
                        for(l=0; l<len_alternativas; l++){
                            if(response[l].id_pergunta == id_pergunta){
                                data.addRow([response[l].titulo_alternativa, parseInt(response[l].votos)]);
                            }
                        }
                    //Opcoes de customizacao do grafico
                    var options = {
                        width: 370,
                        height: 250,
                        sliceVisibilityThreshold:0,
                        chartArea:{left:7, width: 370, height: 250},
                        legend:{alignment:'center',position:'right',textStyle:{fontSize:'10'}}
                    };
                        //Cria o grafico e adiciona a div
                        var chart = new google.visualization.PieChart(document.getElementById('graficos-'+id_pergunta));
                        chart.draw(data, options);
                        ok = ok + 1;
                    }
                    //Quando percorrer e buscar todas as informacoes
                    //Mostra as divs com os graficos
                    if(ok == len){
                        document.getElementById('msg-graficos').style.display="none";
                        document.getElementById('mostrarGrafico').style.display="none";
                        document.getElementById('mostrarGraficos').style.display="inherit";
                    }
                }
            }
        });
    });    
}

//Funcao que gera os graficos individuais
function gerarGrafico(){
    var id = document.getElementById("opcoes-grafico").value; //Pega id da pergunta do select

        //Faz uma requisicao ajax para buscar os dados via php
        $(document).ready(function(){
        $.ajax({
            url: 'buscar_graficos.php?id_pergunta='+id,
            type: 'get',
            dataType: 'JSON',
            success: function(response){
                var len = response.length; //Total de respostas da pergunta
                
                //Carregando o google charts
                google.charts.load("visualization", "1", {packages:["corechart"]});
                google.charts.setOnLoadCallback(drawChart);
                
                //funcao que cria o grafico
                function drawChart() {
                    //gerando os dados do grafico
                    var data = new google.visualization.DataTable();
                        data.addColumn('string', 'Alternativa');
                        data.addColumn('number', 'Votos');
                        for(var i=0; i<len; i++){
                            data.addRow([response[i].titulo + " (" + parseInt(response[i].votos) + ")", parseInt(response[i].votos)]);
                        }  
                //Definindo as opcoes de customizacao do grafico                 
                var options = {
                    width: 600,
                    height: 450,
                    sliceVisibilityThreshold:0,
                    chartArea:{top:10, left:10, bottom:10, width:600, height:450},
                    legend:{alignment:'center',position:'right',textStyle:{fontSize:'11'}}
                };
                    //Gerando o grafico
                    var chart = new google.visualization.PieChart(document.getElementById('mostrarGrafico'));
                    chart.draw(data, options);

                    //Manipulando as divs da pagina
                    document.getElementById('titulo-grafico').innerHTML = "<h4>"+response[1].titulo_pergunta+"</h4><hr />";
                    document.getElementById('mostrarGraficos').style.display="none";
                    document.getElementById('mostrarTitulo').style.display="inherit";
                    document.getElementById('mostrarGrafico').style.display="inherit";                }
            }
        });
    });
}
</script>