<div id="cad_exercicios">
    <div style="display:none;">                
    </div>
    <div>
        <div style="border-bottom:1px solid #eeeeee; width: 923px;">
            <center><label style="font-weight: bold; font-size: 14px;"><?php echo $this->exercicio->getTitulo(); ?></label></center>
        </div><br>
        <table style="width: 100%;">
            <tr>
                <td valign="top">
                    <label><b>Descrição:</b> </label>
                </td>
                <td>
                    <label><?php echo $this->exercicio->getDescricao(); ?></label>
                </td>
            </tr>
        </table><br>
        <div style="border-top:1px solid #eeeeee; width: 923px;"></div>
    </div><br>
    <div id="lista_perguntas" style="width: 925px;">
        <?php echo ($this->listaPerguntas); ?>        
    </div><br>
    <div>        
        <input type="button" value="Fechar" id="cancelar_exercicio" class="button2"/>
    </div><br>    
</div>