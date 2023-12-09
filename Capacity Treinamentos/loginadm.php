<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link CSS -->
    <link rel="stylesheet" href="css/styleadm.css">
    <title>Login</title>
</head>
<style>

    .error-message {
        text-align: center;
        color: red;
        padding: 10px;
        background-color: #ffeeee;
        border: 1px solid #ffaaaa;
        border-radius: 5px;
        margin-top: 10px;
    }

    .img-box{
        position: relative;
    }

    .img-box a button{
        position: absolute;
        top: 0;
        left: 0;
        margin-top: 10px;
        margin-left: 10px;
        height: 30px;
        width: 50px;
        border-radius: 10px;
        border: 1px solid #fff;
        background-color: transparent;
        color: #fff;
        cursor: pointer; 
    }

</style>

<body>
    <div class="container-login">
        <div class="img-box">
            <img src="img/logo.png.png">

            <a href="index.html"><button>Voltar</button></a>
        </div>
        <div class="content-box">
            <div class="form-box">
                <h2>Login</h2>
                <form action="testloginadm.php" method="POST">
                    <div class="input-box">
                        <span>Email</span>
                        <input type="text" name="email" placeholder="@email.com">
                    </div>

                    <div class="input-box">
                        <span>Senha</span>
                        <input type="password" name="senha" placeholder="senha">
                    </div>
                    <div class="input-box">
                        <input class="inputSubmit" type="submit" name="submit" value="Entrar">
                    </div>
                    <?php if (isset($error_message) && !empty($error_message)) { ?>
                        <p class="error-message"><?php echo $error_message; ?></p>
                    <?php } ?>
                </form>
                <?php if (isset($_GET['error']) && $_GET['error'] === 'invalidlogin') { ?>
    <p class="error-message" style="color: red;">Login Inválido</p>
<?php } ?>

            </div>
        </div>
    </div>
</body>

</html>
