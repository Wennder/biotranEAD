<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->


<!DOCTYPE html>
<html>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script>
    
            var centro = 1;
            $(document).ready(function (e){
                
            });
            function openCenter(s){       
                if(centro!=1){            
                    centro.find('div').remove();
                }  
                var _aux = $('#center_content').load(s, 'oi', function (){                    
                });                                   
                centro = _aux;
                $('#div_conteudo_professor_editar_modulo').append(centro);                
            }    


        </script>
    </head>

    <body>

        <div id="topmenu">
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><h3 onclick="openCenter('teste2.php');">CURSOS</h3></li>
                <li><h3 onclick="openCenter('teste.php');">CURSOS2</h3></li>
            </ul>
        </div>
        <div id="div_conteudo_professor_editar_modulo">
            <div id="div_do_centro2">
                
                <h3>
                    <a href="#"> Home </a>
                </h3>
                <div>
                    <p>nao <?php echo 'fooi'; ?></p>
                </div>
                <h3>
                    <a href="#"> Home2 </a>
                </h3>
                <div>
                    <p>teste3</p>
                </div>
                <h3>
                    <a href="#"> Home3 </a>
                </h3>
                <div>
                    <p>teste4</p>
                </div>
            </div>
        </div>


        <div id="center_content">
            
        </div>

    </body>
</html>
