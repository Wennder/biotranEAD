<?php require 'structure/header.php'; ?>
<?php require 'structure/content_up.php'; ?>

<div id="div_cursos">
    <center>
        <h1>CURSOS</h1>
        <table id="lista_cursos">
            <?php
            $quantCursos = count($this->cursos);
            $quantLinhas = $quantCursos%3 == 0 ? $quantCursos/3 : (int)($quantCursos/3)+1;
            $curso = 0;
            for($i = 0; $i < $quantLinhas; $i++){
                echo "<tr>";
                for($j = 0; $j < 3; $j++){
                    if($curso < $quantCursos){
                        $caminho = file_exists("img/cursos/". $this->cursos[$curso]->getId_curso() .".jpg") ? "img/cursos/". $this->cursos[$curso]->getId_curso() .".jpg" : "img/cursos/00.jpg";
                        echo "
                            <td>
                                <a href='index.php?c=index&a=descricao_curso&id=".$this->cursos[$curso]->getId_curso()."'>
                                    <img src='$caminho' />
                                </a>
                                <div id='nome_curso'><label>".$this->cursos[$curso]->getNome()."</label></div>
                            </td>
                        ";
                        $curso++;
                    }
                    else{
                        echo "<td></td>";
                    }     
                }
                echo "</tr>";
            }
            ?>
        </table>
        <br><br>
    </center>
</div>
<?php // require 'structure/content_down.php'; ?>
<?php require 'structure/footer.php'; ?>