<?php
session_start();
include_once('config.php');

if ((!isset($_SESSION['email']) || empty($_SESSION['email'])) || (!isset($_SESSION['senha']) || empty($_SESSION['senha']))) {
    header('Location: loginadm.html');
    exit;
}

$logado = $_SESSION['email'];
$mensagem = '';

if (isset($_POST['submit'])) {
    include_once('config.php');

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "INSERT INTO instrutores (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

    if (mysqli_query($conexao, $sql)) {
        $mensagem = 'Cadastro realizado com sucesso!';
    } else {
        $mensagem = 'Erro ao cadastrar. Tente novamente.';
    }
}

if (!empty($_GET['search'])) {
    $data = $_GET['search'];
    $sql = "SELECT * FROM cursos WHERE id LIKE '%$data%' or empresa LIKE '%$data%' or curso LIKE '%$data%' ORDER BY id ASC";
} else {
    $sql = "SELECT * FROM cursos ORDER BY data_curso ASC";
}

$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <title>Teste Formulário</title>
</head>
<style>

    body{
        overflow-y: hidden;
    }

    .navbar{
        background-color: transparent;
        padding-inline: 10px;
        color: #fff;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' width='1280' height='720' preserveAspectRatio='none' viewBox='0 0 1280 720'%3e%3cg mask='url(%26quot%3b%23SvgjsMask1184%26quot%3b)' fill='none'%3e%3crect width='1280' height='720' x='0' y='0' fill='url(%23SvgjsLinearGradient1185)'%3e%3c/rect%3e%3cpath d='M 0%2c136 C 85.4%2c167.6 256.2%2c311.2 427%2c294 C 597.8%2c276.8 683.4%2c43.6 854%2c50 C 1024.6%2c56.4 1194.8%2c270.8 1280%2c326L1280 720L0 720z' fill='%23184a7e'%3e%3c/path%3e%3cpath d='M 0%2c579 C 128%2c548 384%2c410.4 640%2c424 C 896%2c437.6 1152%2c602.4 1280%2c647L1280 720L0 720z' fill='%232264ab'%3e%3c/path%3e%3c/g%3e%3cdefs%3e%3cmask id='SvgjsMask1184'%3e%3crect width='1280' height='720' fill='white'%3e%3c/rect%3e%3c/mask%3e%3clinearGradient x1='10.94%25' y1='-19.44%25' x2='89.06%25' y2='119.44%25' gradientUnits='userSpaceOnUse' id='SvgjsLinearGradient1185'%3e%3cstop stop-color='%230e2a47' offset='0'%3e%3c/stop%3e%3cstop stop-color='%2300459e' offset='1'%3e%3c/stop%3e%3c/linearGradient%3e%3c/defs%3e%3c/svg%3e");;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    .div-cadastro{
        margin-block-start: 20px;
        color: #000;
        padding: 0 34px;
        width: 100%;
        min-height: 100%;
        display: flex;
    }

    .div-cadastro h1{
        font-family: "Poppins", sans-serif;
        font-weight: bold;
        padding: 20px;
    }

    #id-cadastro{
        width: 50%;
        display: flex;
        align-items: center;
        flex-direction: column;
        padding-block-start: 110px;
    }

    #id-cadastro i{
        font-size: 50px;
    }

    .cadastro{
        width: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .cadastro .div-nome{
        display: flex;
        flex-direction: column;
        width: 300px;
        margin-block-end: 15px;
    }

    .cadastro .div-nome input{
        padding-left: 10px;
        padding-right: 10px;
        height: 40px;
        border-radius: 10px;
        border: 3px solid rgba(0, 0, 0, 0.7);
    }

    .cadastro .div-nome label,
    .cadastro .div-email label,
    .cadastro .div-senha label{
        margin-block-end: 5px;
    }

    .cadastro .div-email{
        display: flex;
        flex-direction: column;
        width: 300px;
        margin-block-end: 15px;
    }

    .cadastro .div-email input{
        color: rgba(0, 0, 0, 0.7);
        padding-left: 10px;
        height: 40px;
        border-radius: 10px;
        border: 3px solid rgba(0, 0, 0, 0.7);
    }

    .cadastro .div-senha{
        display: flex;
        flex-direction: column;
        width: 300px;
        margin-block-end: 15px;
    }

    .cadastro .div-senha input{
        color: #000;
        padding-left: 10px;
        height: 40px;
        border-radius: 10px;
        border: 3px solid rgba(0, 0, 0, 0.7);
    }

    .cadastro button{
        width: 300px;
    }

    .fa-solid {
        transform: translateY(0px) rotate(0deg) !important;
    }

    .inputsubmit{
        width: 300px;
        padding: 15px;
        border: none;
        font-size: 18px;
        background-color: #0088d2;
        border-radius: 10px;
        margin-block-start: 10px;
        color: #fff;
        cursor: pointer;
        transition: 0.3s;
    }

    .inputsubmit:hover{
        background-color: #069dee;
    }

    @media (max-width: 991.98px) { 

        #id-cadastro{
            display: none;
        }

        .cadastro{
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

 }


</style>
<body style="overflow-x: hidden;">
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="img/logo.png.png" width="100px">
    <h3>CapacityTreinamentos</h3></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" aria-current="page" href="sistemaadm.php">Início</a>
        <a class="nav-link active" aria-current="page" href="cadastro.php">Cadastro</a>
        <a class="nav-link" aria-current="page" href="formulario.php">Agendar</a>
        <a class="nav-link" aria-current="page" href="sairadm.php" tabindex="-1">Sair</a>
      </div>
    </div>
  </div>
</nav>
<div class="container">
    <div class="div-cadastro">
        <div id="id-cadastro">
            <h1>Cadastro Instrutor</h1>
            <i class="fa-solid fa-user"></i>
        </div>
        <form class="cadastro" method="POST" action="cadastro.php">
            <div class="div-nome">
                <label for="name">Nome</label>
                <input class="input-empresa" input type="text" name="nome" placeholder="Instrutor" required>
            </div>
            <div class="div-email">
                <label for="date">Email</label>
                <input type="text" name="email" placeholder="@email.com" required>
            </div>
            <div class="div-senha">
                <label for="password">Senha</label>
                <input type="password" name="senha" placeholder="Senha" required>
            </div>
            <div class="input-box">
                <input class="inputsubmit" type="submit" name="submit">
            </div>
            <?php
                if ($mensagem) {
                    echo '<p style="color: green;">' . $mensagem . '</p>';
                }
            ?>
        </form>
    </div>
</div>

<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
