<!--<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.form.js" type="text/javascript"></script>

<script>
    $(document).ready(function(){
        /* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
        $('#imagem').live('change',function(){
            $('#visualizar').html('<img src="img/gif/ajax-loader-f.gif" alt="Enviando..."/> Enviando...');
            /* Efetua o Upload sem dar refresh na pagina */
            $('#formulario').ajaxForm({
                target:'#visualizar' // o callback será no elemento com o id #visualizar
            }).submit();
        });
    })
</script>

<form id="formulario" method="post" enctype="multipart/form-data" action="upload.php">
    Foto
    <input type="file" id="imagem" name="imagem" />
</form>
<div id="visualizar"></div>-->