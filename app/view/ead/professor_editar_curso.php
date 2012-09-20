<?php require 'structure/header.php'; ?>
<?php require 'structure/leftcolumn_professor.php' ?>
<?php require 'structure/content.php'; ?>
<style>
    #div_conteudo_professor_editar_curso{
        position: relative;
        padding:40px;
        padding-top:0px;
    }
    
    #div_conteudo_professor_editar_curso h4{
        margin:0;
        
        padding:0;
    }
    
    #disposicao_conteudo_professor_editar_curso{
        position: relative;
        margin: 20px;
        margin-top:40px;
    }
    
    
    .quadro_de_conteudo_especifico{
        margin:0px;
        margin-bottom:20px;
        border:1px solid #CCCCCC;
        padding: 10px;
        color: #888888;
    }
    
    .quadro_de_conteudo_especifico ul{
        margin:0;
        padding: 0;
    }
    
    .quadro_de_conteudo_especifico ul li{
        list-style: none;
        color: #888888;
        background-color: #eeeeee;
        border:1px solid #CCCCCC;
        padding:4px;
    }
    
    .quadro_de_conteudo_especifico ul li:hover{
        border:1px solid black;
        
    }
    
    .quadro_de_conteudo_especifico ul a:hover,a:active,a:visited{
        text-decoration: none;
        outline: none;
        
    }
    
    hr{
          border: 0; 
          height: 0; 
          border-top: 1px solid rgba(0, 0, 0, 0.1); 
          border-bottom: 1px solid rgba(255, 255, 255, 0.3);
          margin-bottom: 10px;
    }
    
    #professor_adicionar_modulo{
        padding: 7px 7px;
        color: #888888;
        background-color: #eeeeee;
        border:1px solid #CCCCCC;
    }
    
    #professor_adicionar_modulo:hover{
        border-color: black;
        text-decoration: none;
    }
</style>

<div id="div_conteudo_professor_editar_curso">
    <h1>Curso tchu tcha</h1>
    <div id="disposicao_conteudo_professor_editar_curso">
        <h4>Descricao: </h4>
        <div class="quadro_de_conteudo_especifico">
            Curso muito bacana!
        </div>
        <h4>Modulos: </h4>
        <div class="quadro_de_conteudo_especifico">
            <ul>
                <a href="#"> 
                    <li>
                        <h4 style="float:left; margin-right: 3px;">Modulo 1: </h4> eu quero tchu eu quero tcha, eu quero tchu tcha tcha!
                    </li>
                </a>
                <a href="#"> 
                    <li>
                        <h4 style="float:left; margin-right:  3px;">Modulo 2: </h4> tchu tchu tcha, tchu tcha tcha tchu tchu tcha!
                    </li>
                </a>
                <a href="#"> 
                    <li>
                        <h4 style="float:left; margin-right: 3px;">Modulo 3: </h4> musica ruim dos infernos!
                    </li>
                </a>
            </ul>
            <hr>
            <h4><a id="professor_adicionar_modulo" href="#">Adicionar Modulo</a></h4> 
        </div>
    </div>
</div>
<?php require 'structure/footer.php'; ?>