<?php
include_once('config.php');

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $empresa = $_POST['empresa'];
    $curso = $_POST['curso'];
    $carga_horaria = $_POST['carga_horaria'];
    $endereco = $_POST['endereco'];
    $data = $_POST['data_curso'];
    $instrutor = $_POST['instrutor'];

    $sqlUpdate = "UPDATE cursos 
    SET empresa='$empresa', curso='$curso', carga_horaria='$carga_horaria', endereco='$endereco', data_curso='$data', instrutor='$instrutor' WHERE id=$id";

    $result = $conexao->query($sqlUpdate);

    if ($result) {
        // Redireciona para a página após a atualização bem-sucedida com parâmetro GET
        header('Location: sistemaadm.php?success=1');
    } else {
        echo "Erro ao atualizar o registro: " . $conexao->error;
    }
}
?>
<script>
    // JavaScript to display a success message when the update is successful
    <?php if (isset($_GET['success']) && $_GET['success'] == 1) { ?>
        alert("Alterações salvas!");
    <?php } ?>
</script>
