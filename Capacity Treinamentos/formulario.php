<?php
session_start();
include_once('config.php');

if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: loginadm.html');
}

$logado = $_SESSION['email'];

if (isset($_POST['submit'])) {
    $empresa = $_POST['empresa'];
    $curso = $_POST['curso'];
    $carga_horaria = $_POST['carga_horaria'];
    $endereco = $_POST['endereco'];
    $data = $_POST['data_curso'];
    $instrutor = $_POST['instrutor'];

    $mysqli = mysqli_query($conexao, "INSERT INTO cursos(empresa,curso,carga_horaria,endereco,data_curso,instrutor) 
        VALUES ('$empresa','$curso','$carga_horaria','$endereco','$data','$instrutor')");

    // Adicionando a variável de sucesso à URL
    header('Location: sistemaadm.php?success=1');
    exit(); // Certifique-se de sair após o redirecionamento
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Teste Formulário</title>
</head>
<style>

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

.formulario{
    padding: 0 34px;
    width: 100%;
}

.formulario h1{
    padding: 30px;
    font-size: 40px;
    text-align: center;
    color: #000;
}

.form{
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    color: #000;
}

.form .curso{
    width: 500px;
    display: flex;
    gap: 10px;
}

.curso .div-instrutor input{
    width: 245px;
    border: 3px solid rgba(0, 0, 0, 0.7);
}

.curso label{
    padding-bottom: 5px;
    display: inline-block;
    width: 245px;
}

.curso .div-curso input{
    width: 245px;
    border: 3px solid rgba(0, 0, 0, 0.7);
}

.data-instrutor{
    width: 500px;
    display: flex;
    gap: 10px;
}

.data-instrutor label{
    padding-bottom: 5px;
    display: inline-block;
    width: 245px;
}

.data-instrutor .input-instrutor select{
    width: 245px;
    border-radius: 10px;
    height: 50px;
    padding-left: 8px;
    font-size: 18px;
    font-family: "Poppins", sans-serif;
    padding-inline: 10px;
    cursor: pointer;
    border: 3px solid rgba(0, 0, 0, 0.7);
    }

.data-instrutor .input-date input{
    width: 245px;
    border: 3px solid rgba(0, 0, 0, 0.7);
}

input[type="date"]{
    font-family: "Poppins", sans-serif;
    font-weight: 500;
    padding-inline: 10px;
    cursor: pointer;
}

.form input{
    height: 50px;
    width: 500px;
    border-radius: 10px;
    border: 1px solid #848586;
    font-size: 18px;
    padding-left: 8px;
}

.radio{
    width: 500px;
}

.radio h3{
    text-align: center;
    padding: 10px;
}

.radio label{
    position: relative;
    color: #ffffff;
    cursor: pointer;
    display: inline-flex;
    gap: 0.8rem;
    border: 2px solid rgba( 0, 0, 0, 0.7);
    margin-top: 10px;
    border-radius: 0.5em;
    background-color: #4189e0;
}

.nr label{
    display: flex;
    align-items: center;
    padding: 10px;
}

.nr label::before{
    content: '';
    height: 1em;
    width: 1em;
    border: 2px solid #ffffff;
    border-radius: 50%;
}

.nr input[type="radio"]{
    display: none;
}

.nr input[type="radio"]:checked + label::before{
    height: 1em;
    width: 1em;
    border: 4px solid #ffffff;
}

.nr input[type="radio"]:checked + label{
    transform: scale(1.10);
    background-color: #4189e0;
    color: #ffffff;
}
 
label{
    font-weight: bold;
    letter-spacing: 0.7px;
    text-align: left;
    width: 500px;
}

input::placeholder{
    color: #ccc;
}

.endereco{
    display: flex;
    flex-direction: column;
    margin-block-start: 10px;
   
}

.endereco label{
    padding-bottom: 5px;
}

.endereco input{
    border: 2px solid rgba( 0, 0, 0, 0.7);
}

button{
    width: 500px;
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

button:hover{
    background-color: #069dee;
}

</style>
<body>
    
    
    <!-- <header>
        <nav class="navbar">
            <a href="#" class="logo"><img src="logo.png.png" width="80px">
                <h3>CapacityTreinamentos</h3></a>
            
            <ul class="nav-menu">
                <li class="nav-item"><a href="#" class="nav-link">Início</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Cadastro</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Formulário</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Sair <i class="fa-solid fa-caret-down"></i></a></li>
            </ul>
            <div class="hamburguer">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </nav>
    </header> -->
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
        <a class="nav-link" href="cadastro.php">Cadastro</a>
        <a class="nav-link active" href="formulario.php">Agendar</a>
        <a class="nav-link" href="sairadm.php" tabindex="-1">Sair</a>
      </div>
    </div>
  </div>
</nav>
    <div class="container">
            <div class="formulario">
                <h1>Agendar Treinamento</h1>
                <form class="form" action="formulario.php" method="POST">
                    <div class="curso">
                        <div class="div-instrutor">
                            <label for="name">Empresa</label>
                            <input class="input-empresa" type="text" name="empresa" placeholder="Empresa" required>
                        </div>
                        <div class="div-curso">
                            <label for="curso">Carga horária</label>
                            <input class="input-carga" type="text" name="carga_horaria" placeholder="Carga Horária" required>
                        </div>
                    </div>

                    <div class="data-instrutor">
                        <div class="input-instrutor">
                            <label for="instrutor">Instrutor</label>
                            <select name="instrutor" placeholder="Carga Horária">
                                <option value="">Instrutores</option>
                                <?php
                                include_once('config.php');
                                
                                // Modifique sua consulta SQL para selecionar apenas 'email' da tabela 'instrutores'
                                $query = "SELECT nome FROM instrutores";
                                $result = mysqli_query($conexao, $query);

                                // Loop para criar as opções do menu suspenso
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $email_instrutor = $row['nome'];
                                    ?>
                                    <option value="<?php echo $email_instrutor; ?>"><?php echo $email_instrutor; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="input-date">
                            <label for="date">Data</label>
                            <input type="date" name="data_curso"placeh required>
                        </div>
                    </div>

                    <div class="radio">
                        <h3>Treinamento de: </h3>
                        <div class="nr">
                            <input type="radio" id="nr10" name="curso" value="NR-10" required>
                            <label for="nr10">NR-10</label>
                        </div>
                        <div class="nr">
                            <input type="radio" id="nr35" name="curso" value="NR-35" required>
                            <label for="nr35">NR-35</label>
                        </div>
                        <div class="nr">
                            <input type="radio" id="nr" name="curso" value="Brigada"required>
                            <label for="nr">Brigada</label>
                        </div>
                    </div>
                    <div class="endereco">
                        <label for="password">Endereço</label>
                        <input type="text" name="endereco" placeholder="Endereço" required>
                    </div>
                    <div class="input-box">
            <input class="inputsubmit" type="submit" name="submit">
            </div>
                </form>
            </div>

    </div>

<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>