<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<style>
    ul{
        list-style: none;
    }

    .accordion_body_content{
        display: none;
    }

    .accordion_body{
        background-color: #eeeeee;
        border-top:1px solid white;
        border-bottom: 1px solid #cccccc;
    }
    .accordion_body *{
        cursor: pointer;
    }

    .lista_cursos_professor{
        padding:0px 20px;
    }
    .lista_cursos_professor a:hover{
        color:#565656;
        cursor: pointer;
    }

    .seta_formatacao{
        margin:7px 7px 0px 5px;
        float:left;
    }
</style>
<div>
    <?php echo $this->lista; ?>
</div>
