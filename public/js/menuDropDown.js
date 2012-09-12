var item = 0;
var cronometro = 0;
var tempo = 500;

// Abre o menu
function expandir(id)
{	
    // Zera o cronometro de fechamento
	zerarCronometro();

	// Fecha outra aba aberta
	if(item) item.style.visibility = "hidden";
    // Abre a aba
    item = document.getElementById(id);
    item.style.visibility = "visible";
}
// Fecha a aba
function comprimir()
{
    if(item) {
        item.style.visibility = "hidden";
    } 
}
// Fecha a aba de a acordo com a variável "tempo"
function iniciarCronometro()
{
    cronometro = window.setTimeout(comprimir, tempo);
}

// cancel close timer
function zerarCronometro()
{
    if(cronometro)
    {
        window.clearTimeout(cronometro);
        cronometro = null;
    }
}
          
            


