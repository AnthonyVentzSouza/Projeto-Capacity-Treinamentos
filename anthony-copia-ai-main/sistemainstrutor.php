<?php
session_start();
include_once('config.php');

// Verifica se o usuário está autenticado, se não, redireciona para a página de login
if (!isset($_SESSION['email'])) {
    header('Location: logininstrutor.html');
    exit;
}

$logado = $_SESSION['email'];

// Obtém o nome do instrutor atual da tabela 'instrutores'
$query = "SELECT nome FROM instrutores WHERE email = '$logado'";
$result = mysqli_query($conexao, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $selectedInstrutor = $row['nome'];

    // Construa a consulta SQL para obter os cursos do instrutor atual
    $sql = "SELECT * FROM cursos WHERE instrutor = '$selectedInstrutor' ORDER BY id ASC";

    // Execute a consulta
    $result = $conexao->query($sql);
} else {
    // Trate o caso em que o email do instrutor não foi encontrado na tabela 'instrutores'
    echo "Email do instrutor não encontrado na base de dados.";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Sistema Capacity</title>
    <style>
    
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Inconsolata:wght@500&family=Poppins:wght@500;600;700&display=swap');
        
        body{
            /* background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' width='1280' height='720' preserveAspectRatio='none' viewBox='0 0 1280 720'%3e%3cg mask='url(%26quot%3b%23SvgjsMask1184%26quot%3b)' fill='none'%3e%3crect width='1280' height='720' x='0' y='0' fill='url(%23SvgjsLinearGradient1185)'%3e%3c/rect%3e%3cpath d='M 0%2c136 C 85.4%2c167.6 256.2%2c311.2 427%2c294 C 597.8%2c276.8 683.4%2c43.6 854%2c50 C 1024.6%2c56.4 1194.8%2c270.8 1280%2c326L1280 720L0 720z' fill='%23184a7e'%3e%3c/path%3e%3cpath d='M 0%2c579 C 128%2c548 384%2c410.4 640%2c424 C 896%2c437.6 1152%2c602.4 1280%2c647L1280 720L0 720z' fill='%232264ab'%3e%3c/path%3e%3c/g%3e%3cdefs%3e%3cmask id='SvgjsMask1184'%3e%3crect width='1280' height='720' fill='white'%3e%3c/rect%3e%3c/mask%3e%3clinearGradient x1='10.94%25' y1='-19.44%25' x2='89.06%25' y2='119.44%25' gradientUnits='userSpaceOnUse' id='SvgjsLinearGradient1185'%3e%3cstop stop-color='%230e2a47' offset='0'%3e%3c/stop%3e%3cstop stop-color='%2300459e' offset='1'%3e%3c/stop%3e%3c/linearGradient%3e%3c/defs%3e%3c/svg%3e");;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;             */
            color: white;
            font-family: "Poppins", sans-serif;
        }
    
        .table-bg{
            background: rgba(0, 0, 0, 0.3);
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
        }
    
        .btn-lupa{
            width: 50px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-block: auto;
            border-radius: 8px;
            border: 0;
        }

        .container-fluid{
            padding-inline: 32px;
        }

        .navbar-brand{
            display: flex;
            align-items: center;
        }

        .navbar-brand h3{
            font-size: 20px;
            margin-inline-start: -5px;
        }

        .navbar-nav{
            margin-inline-start: auto;
            gap: 30px;
        }

        .navbar-toggler{
            padding: 0;
        }

        .table{
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

        .navbar-brand h3{
            font-size: .9rem;
        }

        .navbar-brand img{
            width: 75px;
        }
    
        }

        @media (max-width: 350px){

        .navbar-brand h3{
            font-size: .77rem;
        }

        .navbar-brand img{
            width: 65px;
        }

        }

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
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                  <a class="nav-link" href="sairinstrutor.php" tabindex="-1">Sair</a>
                </div>
              </div>
            </div>
          </nav>
      <br>
      <div class="box-search">
      <?php
    echo "<h1>Bem vindo <u>$selectedInstrutor</u></h1>";
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
                  </tr>
              </thead>
              <tbody>
             <br>
              <?php
                      while($user_data = mysqli_fetch_assoc($result)) {
                          echo "<tr>";
                          echo "<td>".$user_data['empresa']."</td>";
                          echo "<td>".$user_data['curso']."</td>";
                          echo "<td>".$user_data['carga_horaria']."</td>";
                          echo "<td>".$user_data['endereco']."</td>";
                          $data_curso = date('d/m/Y', strtotime($user_data['data_curso']));
                          echo "<td>" . $data_curso . "</td>";
                          echo "<td>".$user_data['instrutor']."</td>";
                          echo "</tr>";
                      }
                      ?>
              </tbody>
          </table>
        </div>
      </div>
      <script src="script.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
  <script>
      var search = document.getElementById('pesquisar');
  
      search.addEventListener("keydown", function(event) {
          if (event.key === "Enter") 
          {
              searchData();
          }
      });
  
      function searchData()
      {
          window.location = 'sistemainstrutor.php?search='+search.value;
      }
  </script>
  </html>