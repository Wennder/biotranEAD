<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<script>
    $('.accord_body').live('click', function(e) {
        $(this).next('.accord_content_body').slideToggle('fast');                  
    }); 
</script>

<div>
    <div style="border-bottom:1px solid #f0f0f0; margin-left:20px">
        <label style="font-size: 18px;"><b>Meus Cursos</b></label><br><br>
        <div id="menu_accordion">
            <?php echo $this->lista; ?>
        </div>
    </div>
</div>
