<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/jquery.Jcrop.min.js"></script>
<link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />

<script type="text/javascript">
    $(document).ready(function(){
        /* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
        $('#foto').live('change',function(){
            $('#visualizar').html('<img src="ajax-loader.gif" alt="Enviando..."/> Enviando...');
            /* Efetua o Upload sem dar refresh na pagina */
            $('#formulario').ajaxForm({
                target:'#visualizar' // o callback será no elemento com o id #visualizar
            }).submit();
        });
    })
    
    jQuery(function($) {
        $('#visualizar img').Jcrop({
            onChange:   showCoords,
            onSelect:   showCoords,
            onRelease:  clearCoords
        });

    });

    // Simple event handler, called from onChange and onSelect
    // event handlers, as per the Jcrop invocation above
    function showCoords(c)
    {
        $('#x1').val(c.x);
        $('#y1').val(c.y);
        $('#x2').val(c.x2);
        $('#y2').val(c.y2);
        $('#w').val(c.w);
        $('#h').val(c.h);
    };

    function clearCoords()
    {
        $('#formulario input').val('');
    };
    
</script>

<!--<img src="img/profile/teste1.jpg" id="target" />-->

<form id="formulario" class="coords" onsubmit="return checkCoords();" method="post" action="crop.php" enctype="multipart/form-data">
    <input type="file" name="foto" id="foto"/>
    <input type="submit" value="Enviar" onclick="$('#formulario')..attr({action: 'salvar.php'});"/>

    <div>
        <label>X1 <input type="text" size="4" id="x1" name="x1" /></label>
        <label>Y1 <input type="text" size="4" id="y1" name="y1" /></label>
        <label>X2 <input type="text" size="4" id="x2" name="x2" /></label>
        <label>Y2 <input type="text" size="4" id="y2" name="y2" /></label>
        <label>W <input type="text" size="4" id="w" name="w" /></label>
        <label>H <input type="text" size="4" id="h" name="h" /></label>
    </div>
</form>
<div id="visualizar"></div>

