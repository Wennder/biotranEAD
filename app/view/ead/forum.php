<div>
    <div style="border-bottom:1px solid #f0f0f0; margin-left:20px">
        <div style="border-bottom:1px solid #eeeeee;">
            <center><label style="font-size: 15px; font-weight: bold;">Fórum - <?php echo $this->curso->getNome(); ?></label></center>
        </div>
        <div style="padding:15px;"><br>
            <div>
                <a href="#" name="index.php?c=ead&a=adicionar_topico&id=<?php echo $_GET['id'] ?>" class="button2 ref_ajax">Novo Tópico</a> 
            </div><br><br>
            <table class="tabela_forum" cellspacing="0" cellpadding="0">
                <thead>
                    <tr class="cabecalho_tabela">
                        <th width="60%" align="center" style="border-right: solid 1px #fff;">Tópico</th>
                        <th width="30%" align="center" style="border-right: solid 1px #fff;">Autor</th>
                        <th width="10%" align="center" style="border-right: solid 1px #fff;">Respostas</th>
                        <th></th>
                    </tr>
                    <?php $this->controller = new ControllerForum(); echo $this->controller->listTopicos($_GET['id']);?>
                </thead>
            </table>
        </div>
    </div>
</div>