function gerarAlternativas (id_pergunta) {
    var req;
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        req = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var url = "./gerar_alternativas.php?id=" + id_pergunta;
    req.open("Get", url, true);
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            var resposta = req.responseText;
            $("#alternativas").html(resposta);
        }
    }
    req.send(null);
}