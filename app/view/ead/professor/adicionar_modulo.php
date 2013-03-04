<form id="form_descritivo" enctype="multipart/form-data" method="post">
    <table>
        <tr>
            <td>
                <label>Numero Modulo: </label>
            </td>
            <td>
                <input type="text" name="numero_modulo" class="text-input" />
            </td>
        </tr>
        <tr>
            <td>
                <label><b>Título: </b></label>
            </td>
            <td>
                <input id="titulo_modulo" type="text" name="titulo_modulo" class="text-input" /><br>
            </td>
        </tr>
        <tr>
            <td>
                <label style="margin: -10px 0 0 0;"><b>Descrição: </b></label>
            </td>
            <td>
                <textarea readonly="true" type="text" id="descricao" name="descricao" class="text-area" rows="2" cols="29"></textarea>                        
            </td>
        </tr>
    </table>
    <div >
        <input id="btn_editar_modulo" type="button" class="button2" value="Adicionar"/>
    </div>
</form>