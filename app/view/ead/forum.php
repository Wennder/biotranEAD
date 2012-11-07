<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php' ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>


<div>
    <h1>Forum</h1>
    <h1>    <?php echo $this->curso->getNome(); ?></h1>
    <!-- topicos   -->
    <div style="padding:15px;">
        <a href="index.php?c=ead&a=adicionar_topico&id=<?php echo $_GET['id'] ?>">Novo Topico</a> 
        <table>
            <tr>
            </tr>
            <thead>
                <tr>
                    <th width="60%" align="left">Tópicos</th>
                    <th width="35%" align="left">Autor</th>
                    <th  align="right">Respostas</th>
                   
                </tr>
                <?php $this->controller = new ControllerForum(); echo $this->controller->listTopicos($_GET['id']); ?>
            </thead>
        </table>
          
    </div>
</div>
<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>