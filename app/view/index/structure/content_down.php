</div>
<div id="content_down">
    <div id="content_in">
        <div id="topo_parceiros"><label>PARCEIROS</label></div>
        <div id="div_parceiros">
            <div id="slider_parceiros" style="margin-left: 35px;">
                <?php $controller = new ControllerSistema(); echo $controller->listaPatrocinadores_index();?>
                
            </div>
        </div>
        <div id="topo_noticias"><label>NOTÍCIAS</label></div>
        <div id="div_noticias">
            <?php echo $controller->listaNoticia_index(); ?>
        </div>
        <div id="topo_comentarios"><label>COMENTÁRIOS</label></div>
        <div id="div_comentarios">
            <?php echo $controller->listaComentarios_index() ?>
        </div>
    </div>