<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.maskMoney.js" type="text/javascript"></script>

<script>
    $(document).ready(function(){ 
        $("#valor").maskMoney({showSymbol:false, decimal:",", thousands:"."});
    });
</script>

<label>Valor: </label>
<label>R$</label>
<input type="text" id="valor" name="valor"/>