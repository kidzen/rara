<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

//$this->title = 'About';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div id="myCarousel" class="carousel slide">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner">
        <div class="item active">
            <img src="img/MPSP3.jpg" alt="First slide">
        </div>
        <div class="item">
            <img src="img/MPSP3.jpg" alt="Second slide">

        </div>
        <div class="item">
            <img src="img/MPSP2.jpg" alt="Third slide">

        </div>
        <div class="item">
            <img src="img/MPSP1.jpg" alt="Fourth slide">

        </div>
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>

</div>
<!-- carousel -->

<?php
$css = "        
    html, body {
            height: 100%;
        }

        .carousel, .item, .active {
            height: 100%;
        }

        .carousel-inner {
            height: 100%;
        }
";

$this->registerCss($css);
