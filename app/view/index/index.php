<?php require 'structure/header.php'; ?>
<?php require 'structure/content_up.php'; ?>
<script>
    $(document).ready( function(){
        $('#slideshowHolder').jqFancyTransitions({
            width: 980,
            height: 405,
            delay: 3000,
            effect: 'zipper', //zipper, wave, curtain, fountain top, random top, curtain alternate, felt top, right bottom
            strips: 20,
            stripDelay: 50,
            titleOpacity: 0.7,
            titleSpeed: 1000,
            navigation: true,
            position: 'alternate', // top, bottom, alternate, curtain
            direction: 'random', // left, right, alternate, random, fountain, fountainAlternate
            links: false
        });
    });
</script>

<div id='slideshowHolder'>
    <img src='img/image1.jpg' alt='The Beatles' />
    <img src='img/image2.jpg' alt='Painting' />
    <img src='img/image3.jpg' alt='Paisagem' />
    <img src='img/image4.jpg' alt='Arara' />
</div>
<?php require 'structure/content_down.php'; ?>
<h1><a href="<?php echo "index.php?c=ead&a=index" ?>">SISTEMA EAD</a></h1><br>
<h1><a href="<?php echo "index.php?c=index&a=cadastro" ?>">CADASTRAR</a></h1>
<?php require 'structure/footer.php'; ?>