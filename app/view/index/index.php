<?php require 'structure/header.php'; ?>
<?php require 'structure/content_up.php'; ?>
<script>
    $(document).ready( function(){
        $('#sliderShow').jqFancyTransitions({
            width: 650,
            height: 400,
            delay: 5000,
            effect: 'zipper', //zipper, wave, curtain, fountain top, random top, curtain alternate, felt top, right bottom
            strips: 20,
            stripDelay: 50,
            titleOpacity: 0.7,
            titleSpeed: 1000,
            navigation: false,
            position: 'alternate', // top, bottom, alternate, curtain
            direction: 'random', // left, right, alternate, random, fountain, fountainAlternate
            links: false
        });
    });
</script>

<div id="menu_destaque">
    <ul>
        <li style="margin-bottom: 12px;">
            <span class="destaque_item">
                <a href="index.php?c=index&a=cadastro">Cadastre-se</a>
            </span>
        </li>
        <li style="margin-bottom: 12px;">
            <span class="destaque_item">
                <a href="#">Matricule-se</a>
            </span>
        </li>
        <li style="margin-bottom: 12px;">
            <span class="destaque_item">
                <a href="#">Veja como é</a>
            </span>
        </li>
        <li>
            <span class="destaque_item">
                <a href="#">Cursos Presenciais</a>
            </span>
        </li>
    </ul>
</div>

<div id='sliderShow'>
    <img src='img/biotran.jpg' />
    <img src='img/curso.jpg' />
    <img src='img/fazenda.jpg'/>
<!--    <img src='img/image4.jpg' alt='Arara' />-->
</div>

<?php require 'structure/content_down.php'; ?>

<?php require 'structure/footer.php'; ?>
