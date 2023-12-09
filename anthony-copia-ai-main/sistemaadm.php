<?php
session_start();
include_once('config.php');

if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: loginadm.html');
}

$logado = $_SESSION['email'];

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Teste Formulário</title>
</head>

<style>
    
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Inconsolata:wght@500&family=Poppins:wght@500;600;700&display=swap');
    
    body{
        color: black;
        font-family: "Poppins", sans-serif;
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
    .success-message {
    text-align: center;
    color: green;
    font-weight: bold;
    margin-top: 10px;
}

    .table-bg{
        /* background: rgba(0, 0, 0, 0.7); */
        background: #696969;
        border-radius: 15px 15px 0 0;
      
    }

    .box-search{
        display: block;
        gap: 10px;
        text-align: center;
        
    }

    .search{
        margin-block-start: 30px;
        padding-inline: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
    }

    .box-search input{
        height: 40px;
        width: 500px;
        border-radius: 8px;
        border: 1px solid rgba(0, 0, 0, 0.7);
    }

    .btn-lupa{
        width: 50px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-block: auto;
        border-radius: 8px;
        border: 1px solid rgba(0, 0, 0, 0.7);
    }

    .table tr th{
        text-align: center;
    }

    .table tr td{
        text-align: center;
    }



    @media (max-width: 575.98px){

        .box-search input{
        height: 40px;
        width: 400px;
    }

    .btn-lupa{
        width: 40px;
        height: 40px;
    }

}

</style>

<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="img/logo.png.png" width="100px">
            <h3>CapacityTreinamentos</h3></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="sistemaadm.php">Início</a>
                <a class="nav-link" aria-current="page" href="cadastro.php">Cadastro</a>
                <a class="nav-link" aria-current="page" href="formulario.php">Agendar</a>
                <a class="nav-link" aria-current="page" href="sairadm.php" tabindex="-1">Sair</a>
            </div>
        </div>
    </div>
</nav>

<br>
<div class="box-search">
    <?php
    echo "<h1>Bem-vindo <u>$logado</u></h1>";
    ?>
    <div class="search">
        <input type="search" class="form-control" placeholder="Pesquisar" id="pesquisar">
        <button onclick="searchData()" class="btn-lupa btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                 viewBox="0 0 16 16">
                <path
                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>
    </div>
    <?php
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo "<p class='success-message'>Alterações salvas!</p>";
    }
    ?>
    <?php
    if (isset($_GET['success']) && $_GET['success'] == 2) {
        echo "<p class='success-message'>Agendamento realizado com sucesso!</p>";
    }
    ?>
</div>
<div class="m-5">
    <div class="table-responsive">
        <table class="table text-white table-bg">
            <thead>
            <tr>
                <th scope="col">EMPRESA</th>
                <th scope="col">CURSO</th>
                <th scope="col">CARGA HORÁRIA</th>
                <th scope="col">ENDEREÇO</th>
                <th scope="col">DATA</th>
                <th scope="col">INSTRUTOR</th>
                <th scope="col">...</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($user_data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $user_data['empresa'] . "</td>";
                echo "<td>" . $user_data['curso'] . "</td>";
                echo "<td>" . $user_data['carga_horaria'] . "</td>";
                echo "<td>" . $user_data['endereco'] . "</td>";
                // Formatando a data para "DD/MM/AAAA"
                $data_curso = date('d/m/Y', strtotime($user_data['data_curso']));
                echo "<td>" . $data_curso . "</td>";
                echo "<td>" . $user_data['instrutor'] . "</td>";
                echo "<td>
                            <a class='btn btn-sm btn-primary' style='border: 1px solid rgba(0, 0, 0, 0.7);' href='edit.php?id=$user_data[id]' title='Editar'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                            </svg>
                            </a>
                            <a class='btn btn-sm btn-danger' style='border: 1px solid rgba(0, 0, 0, 0.7);' href='delete.php?id=$user_data[id]' title='Deletar'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                    <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                </svg>
                            </a>
                            </td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
<script>
    var search = document.getElementById('pesquisar');

    search.addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
            searchData();
        }
    });

    function searchData() {
        window.location = 'sistemaadm.php?search=' + search.value;
    }
</script>

<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>
</html>
