<?php 

// Saindo do sistema
if (isset($_GET['sair'])){
    if ($_GET['sair'] == "ok"){
        session_start();
        session_destroy();
        unset($_SESSION['logado']);
        $_SESSION['erro'] = "Até Mais!!";
        header("Location: login.php");
    }
}

// Verificando o tipo de formulario
$tipo = $_POST['tipo_formulario'];

// Chama a funcao de acordo com o tipo do formulario
switch ($tipo) {
    case '1':
        login();
        break;
    case '2':
        cad_pergunta();
        break;
    case '3':
        cad_alternativa();
        break;
    case '4':
        upd_pergunta();
        break;
    case '5':
        upd_alternativa();
        break;
    default:
        echo "Alternativa Invalida!!";
        break;
}


function login () {
    session_start();

    $login_adm = "admin";
    $senha_adm = md5("admin");

    if ((isset($_POST['login'])) && (isset($_POST['senha']))) {
        $login = addslashes($_POST['login']);
        $senha = addslashes($_POST['senha']);

        if (($login == $login_adm) && (md5($senha) == $senha_adm)) {
            $_SESSION['logado'] = "Logado com Sucesso!";
            header("Location: index.php");
        } else {
            $_SESSION['erro'] = "Login ou Senha Invalido!";
            header("Location: login.php");
        }
    } else {
        $_SESSION['erro'] = "Preencha todos os Campos!";
        header("Location: login.php");
    }

}
function cad_pergunta () {
    session_start();
    include ("../conn.php");

    if(isset($_POST['pergunta'])){
        $titulo = addslashes($_POST['pergunta']);
        $sql = mysqli_query($conn, "insert into tb_pergunta (titulo) values ('".$titulo."')");
        if ($sql) {
            $_SESSION['sucesso'] = "Cadastrado com Sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao fazer Cadastro!";
        }
        header("Location: index.php");
    }else {
        $_SESSION['erro'] = "Preencha todos os campos!";
        header("Location: cadastros/cadastrar_pergunta.php");
    }
}
function cad_alternativa () {
    session_start();
    include("../conn.php");

    if((isset($_POST['pergunta'])) && (isset($_POST['alternativa']))){
        $alternativa = addslashes($_POST['alternativa']);
        $pergunta = $_POST['pergunta'];

        $sql = mysqli_query ($conn, "insert into tb_alternativa (titulo, id_pergunta) values ('".$alternativa."', ".$pergunta.")");

        if ($sql) {
            $_SESSION['sucesso'] = "Cadastrado com Sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao fazer Cadastro!";
        }
        header("Location: index.php");
    } else {
        $_SESSION['erro'] = "Preencha todos os campos!";
        header("Location: cadastros/cadastrar_alternativa.php"); 
    }
}

function upd_pergunta() {
    session_start();
    include("../conn.php");

    if((isset($_POST['pergunta'])) && (isset($_POST['nova_pergunta']))){
        $pergunta = $_POST['pergunta'];
        $nova_pergunta = addslashes($_POST['nova_pergunta']);

        $sql = mysqli_query ($conn, "update tb_pergunta set titulo = '".$nova_pergunta."' where id = ".$pergunta."");

        if ($sql) {
            $_SESSION['sucesso'] = "Atualizado com Sucesso!";
        } else {
            echo
            $_SESSION['erro'] = "Erro ao atualizar a Pergunta! ".mysqli_error($conn);
        }
        header("Location: index.php");
    } else {
        $_SESSION['erro'] = "Preencha todos os campos!";
        header("Location: atualizacao/atualizar_pergunta.php"); 
    }
}

function upd_alternativa() {
    session_start();
    include("../conn.php");

    if((isset($_POST['alternativa'])) && (isset($_POST['nova_alternativa']))){
        $alternativa = $_POST['alternativa'];
        $nova_alternativa = addslashes($_POST['nova_alternativa']);

        $sql = mysqli_query ($conn, "update tb_alternativa set titulo = '".$nova_alternativa."' where id = ".$alternativa."");

        if ($sql) {
            $_SESSION['sucesso'] = "Atualizado com Sucesso!";
        } else {
            echo
            $_SESSION['erro'] = "Erro ao atualizar a Pergunta! ".mysqli_error($conn);
        }
        header("Location: index.php");
    } else {
        $_SESSION['erro'] = "Preencha todos os campos!";
        header("Location: atualizacao/atualizar_alternativa.php"); 
    }
}

?>