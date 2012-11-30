<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn_admin_modulo.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<script>         
    $(document).ready(function() {        
        if(centro == 1){
            centro = $('#center_content').load('index.php?c=ead&a=conteudo_modulo', {id_curso: $('#id_curso_1').val()}, function (){
                pag_content = 'conteudo_modulo';
            });
        }
        $('.accord_body').live('click', function(e) {
            $(this).next('.accord_content_body').slideToggle('fast');                  
        }); 
    });
</script>

<div id="center_content"></div>

<div style="display: none;">
    <input type="text" id="id_curso_1" name="id_curso_1" value="<?php echo $this->curso->getId_curso(); ?>"/>
</div>

<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>