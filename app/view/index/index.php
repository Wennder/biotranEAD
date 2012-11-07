<?php require 'structure/header.php'; ?>
<?php require 'structure/content_up.php'; ?>
 
<script>
    $(document).ready( function(){
        $('#sliderShow').jqFancyTransitions({
            width: 650,
            height: 300,
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
    
    $(document).ready(function() {
    $("#slider_parceiros").carouFredSel({
        circular            : true,
        items               : 4,
        direction           : "left",
        scroll : {
            items           : 1,
            easing          : "linear",
            fx              : "crossfade",
            duration        : 700,
            pauseOnHover    : true
        }
    });
});
</script>

<div id="menu_destaque">
    <table>
        <tr>
            <td class="destaque_item1">
                <span>
                    <a href="#">Veja como é</a>
                </span>
            </td>
            <td class="destaque_item2">
                <span>
                    <a href="index.php?c=index&a=cadastro">Cadastre-se</a>
                </span>
            </td>
            <td class="destaque_item3">
                <span>
                    <a href="#">Matricule-se</a>
                </span>
            </td>
        </tr>
    </table>
</div>

<div id='sliderShow'>
    <img src='img/biotran.jpg' />
    <img src='img/curso.jpg' />
    <img src='img/fazenda.jpg'/>
</div>

<?php require 'structure/content_down.php'; ?>
<?php require 'structure/footer.php'; ?>