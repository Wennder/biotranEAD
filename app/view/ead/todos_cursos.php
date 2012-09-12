<?php require 'structure/header.php'; ?>
<?php require 'structure/leftcolumn_aluno.php';?>
<?php require 'structure/content.php'; ?>

<div id="cursos_top_bar">
    <h2 align="center">CURSOS</h2>
    <label>Exibir: </label>
    <select>
        <option value="Todos">Todos</option>
        <option value="Matriculado">Matriculado</option>
        <option value="Não Matriculado">Não Matriculado</option>
    </select>
    </br>
</div>

<div id="cursos_aluno">
    <table style="width: 100%;">
        <tr>
            <td>
                <label>Curso teste 1</label>
            </td>
            <td align="right">
                <a href="index.php?c=ead&a=curso&id=1" class="button">Acessar</a>
            </td>
        </tr>
        <tr>
            <td>
                <label style="font-size: 12px">Tempo restante: 30 dias</label>
            </td>
            <td align="right">
                <label style="font-size: 12px">22 Membros</label>
            </td>
        </tr>
    </table>
    <table style="width: 100%;">
        <tr>
            <td>
                <label>Curso teste 2</label>
            </td>
            <td align="right">
                <a href="index.php?c=ead&a=curso&id=2" class="button">Acessar</a>
            </td>
        </tr>
        <tr>
            <td>
                <label style="font-size: 12px">Tempo restante: 12 dias</label>
            </td>
            <td align="right">
                <label style="font-size: 12px">31 Membros</label>
            </td>
        </tr>
    </table>
    <table style="width: 100%;">
        <tr>
            <td>
                <label>Curso teste 3</label>
            </td>
            <td align="right">
                <a href="index.php?c=ead&a=matricula&id=1" class="button" >Matricular</a>
            </td>
        </tr>
        <tr>
            <td>
                <label style="font-size: 12px">Tempo restante: 12 dias</label>
            </td>
            <td align="right">
                <label style="font-size: 12px">31 Membros</label>
            </td>
        </tr>
    </table>
    <table style="width: 100%;">
        <tr>
            <td>
                <label>Curso teste 4</label>
            </td>
            <td align="right">
                <a href="index.php?c=ead&a=matricula&id=2" class="button">Matricular</a>
            </td>
        </tr>
        <tr>
            <td>
                <label style="font-size: 12px">Tempo restante: 12 dias</label>
            </td>
            <td align="right">
                <label style="font-size: 12px">31 Membros</label>
            </td>
        </tr>
    </table>
    <table style="width: 100%;">
        <tr>
            <td>
                <label>Curso teste 5</label>
            </td>
            <td align="right">
                <a href="index.php?c=ead&a=matricula&id=1" class="button">Matricular</a>
            </td>
        </tr>
        <tr>
            <td>
                <label style="font-size: 12px">Tempo restante: 12 dias</label>
            </td>
            <td align="right">
                <label style="font-size: 12px">31 Membros</label>
            </td>
        </tr>
    </table>
</div>

<?php require 'structure/footer.php'; ?>