<div>
    <div style="border-bottom:1px solid #f0f0f0; margin-left:20px">
        <div id="info_modulo">
            <label style="font-size: 18px;"><b>Módulo <?php echo $this->modulo->getNumero_modulo() . ' - ' . $this->curso->getNome(); ?></b></label><br><br>
            <label><b>Título: </b><?php echo $this->modulo->getTitulo_modulo(); ?></label><br>
            <label><b>Descrição:</b> <?php echo $this->modulo->getDescricao() ?></label><br><br>
            <div id="menu_accordion">
                <div class="accord_body">
                    <div class='accord_list'>
                        <img src="img/movie.png"/><label class="accord_label">Vídeo Aulas</label>
                    </div>
                </div>
                <div class="accord_content_body" style="display:none;">                                                                
                    <ul class="accord_ul">                                                            
                        <?php echo $this->listaVideo; ?>                                    
                    </ul>
                </div>
                <div class="accord_body">
                    <div class='accord_list'>
                        <img src="img/text_enriched.png"/><label class="accord_label">Textos de Referência</label>
                    </div>
                </div>
                <div class="accord_content_body" style="display:none;">
                    <ul class="accord_ul">
                        <?php echo $this->listaTexto; ?>
                    </ul>
                </div>
                <div class="accord_body">
                    <div class='accord_list'>
                        <img src="img/folder-icon.png"/><label class="accord_label">Material Complementar</label>
                    </div>
                </div>
                <div class="accord_content_body" style="display:none;">
                    <ul class="accord_ul">                        
                        <?php echo $this->listaMaterial; ?>
                    </ul>
                </div>
                <div class="accord_body">
                    <div class='accord_list'>
                        <img src="img/check.png"/><label class="accord_label">Exercicios</label>
                    </div>
                </div>
                <div class="accord_content_body" style="display:none;">
                    <ul class="accord_ul">                        
                        <?php echo $this->listaExercicio; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="display:none;">
    <input type="text" name="id_modulo" id="id_modulo" value="<?php echo $this->modulo->getId_modulo(); ?>"/>
    <input type="text" name="id_curso" id="id_curso" value="<?php echo $this->modulo->getId_curso(); ?>"/>
</div>