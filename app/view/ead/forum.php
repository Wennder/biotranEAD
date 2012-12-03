<div>
    <h1>Fórum</h1>
    <h1>    <?php echo $this->curso->getNome(); ?></h1>
    <!-- topicos   -->
    <div style="padding:15px;">
        <br>
        <a href="#" id="index.php?c=ead&a=adicionar_topico&id=<?php echo $_GET['id'] ?>" id="forum_novo_topico">Novo Tópico</a> 
        <br>
        <br>
        <table>
            <tr>
            </tr>
            <thead>
                <tr>
                    <th width="60%" align="center">Tópicos</th>
                    <th width="35%" align="center">Autor</th>
                    <th  align="center">Respostas</th>
                   
                </tr>
                <?php $this->controller = new ControllerForum(); echo $this->controller->listTopicos($_GET['id']); ?>
            </thead>
        </table>
          
    </div>
</div>
<?php // require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>