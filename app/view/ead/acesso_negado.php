<?php require 'structure/header.php'; ?>
<?php
$papel = $_SESSION["usuarioLogado"]->getId_papel();
switch ($papel) {
    case 1:
        require 'structure/leftcolumn_admin.php';
        break;
    case 2:
        require 'structure/leftcolumn_gestor.php';
        break;
    case 3:
        require 'structure/leftcolumn_professor.php';
        break;
    case 4:
        require 'structure/leftcolumn_aluno.php';
        break;
}
?>
<?php require 'structure/content.php'; ?>

<?php
echo "YOU SHALL NOT PASS! --> Você não tem permissão para acessar essa página!";
?>
<?php require 'structure/footer.php'; ?>
