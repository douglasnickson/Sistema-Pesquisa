<script type="text/javascript" src="../../js/loader.js"></script>
<script type="text/javascript">

function gerar_estatistica () {
    //Faz uma requisicao ajax para buscar os dados via php
    $(document).ready(function(){
        $.ajax({
            url: 'buscar_estatistica.php?tipo=0',
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
                        data.addColumn('string', 'Idade');
                        data.addColumn('number', 'Quantidade');
                        for(var i=0; i<len; i++){
                            data.addRow([response[i].faixa_etaria, parseInt(response[i].total)]);
                        }  
                //Definindo as opcoes de customizacao do grafico                 
                var options = {
                    width: 500,
                    height: 450,
                    sliceVisibilityThreshold:0,
                    chartArea:{top:10, left:10, bottom:10, width:500, height:450},
                    legend:{alignment:'center',position:'right',textStyle:{fontSize:'11'}}
                };
                    //Gerando o grafico
                    var chart = new google.visualization.PieChart(document.getElementById('estatistica-idade'));
                    chart.draw(data, options);            
                }
            }
        });
    });

     //Faz uma requisicao ajax para buscar os dados via php
     $(document).ready(function(){
        $.ajax({
            url: 'buscar_estatistica.php?tipo=1',
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
                        data.addColumn('string', 'Sexo');
                        data.addColumn('number', 'Quantidade');
                        for(var i=0; i<len; i++){
                            data.addRow([response[i].sexo, parseInt(response[i].total)]);
                        }  
                //Definindo as opcoes de customizacao do grafico                 
                var options = {
                    width: 500,
                    height: 450,
                    sliceVisibilityThreshold:0,
                    chartArea:{top:10, left:10, bottom:10, width:500, height:450},
                    legend:{alignment:'center',position:'right',textStyle:{fontSize:'11'}}
                };
                    //Gerando o grafico
                    var chart = new google.visualization.PieChart(document.getElementById('estatistica-sexo'));
                    chart.draw(data, options);            
                }
            }
        });
    });
}


</script>