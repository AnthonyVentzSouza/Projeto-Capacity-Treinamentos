<?php
session_start();

if (isset($_POST['submit'])) {
    include_once('config.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM instrutores WHERE email = '$email' AND senha = '$senha'";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        header('Location: sistemainstrutor.php');
        exit();
    } else {
        $error_message = 'Login Inválido';
        header('Location: logininstrutor.php?error=invalidlogin');
        exit();
    }
} else {
    $error_message = '';
}
?>
