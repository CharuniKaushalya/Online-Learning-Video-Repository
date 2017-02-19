<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\DashBoardAsset;
use yii\helpers\Url;


DashBoardAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-yellow sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">
  <header class="main-header" style="background-color: white;">
    <!-- Logo -->
    <a href="#" class="logo" style="background: url(images/TeessideUniversity2.gif) no-repeat;margin-left:35px;color:white;background-color: white;">
      
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      

      <div class="navbar-custom-menu">
	  <?php
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
           // ['label' => 'About', 'url' => ['/site/about']],
           // ['label' => 'Contact', 'url' => ['/site/contact']],
			Yii::$app->user->isGuest ? (
				['label' => 'Sign Up', 'url' => ['/site/signup','#' => 'signup-form']]
			) : (
     // Yii::$app->user->identity->id == 10 ? (
				['label' => 'Videos', 'url' => ['/videos/index']]
			),

            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->firstName . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    ?>

      </div>
    </nav>
  </header>

  <div class="stage">
  <div id="SLDR-ONE" class="sldr">
    <ul class="wrp animate">
      <li class="elmnt-one"><div class="skew"><div class="wrap"><img src="dist/img/photo1.png" width="1000" height="563"></div></div></li>
      <li class="elmnt-two"><div class="skew"><div class="wrap"><img src="dist/img/photo2.png" width="1000" height="563"></div></div></li>
      <li class="elmnt-three"><div class="skew"><div class="wrap"><img src="dist/img/photo3.jpg" width="1000" height="563"></div></div></li>
      <li class="elmnt-four"><div class="skew"><div class="wrap"><img src="dist/img/photo4.jpg" width="1000" height="563"></div></div></li>
    </ul>
  </div>

  <div class="clear"></div>

  <div class="captions">
   <div class="focalPoint"><p><small>See what's next.</small></p></div>
   <div><p><small>WATCH ANYWHERE.</small></p></div>
   <div><p><small>Watch Now</small></p></div>
   <div><p><small>New Videos</small></p></div>
  </div>

  <ul class="selectors">
    <li class="focalPoint"><a href="">•</a></li><li><a href="">•</a></li><li><a href="">•</a></li><li><a href="">•</a></li>
  </ul>

  <button class="sldr-prv sldr-nav prev">Prev</button>
  <button class="sldr-nxt sldr-nav next">Next</button>

  <p>See what's next.</p>
  <p style="float:left;">&#8596;&nbsp;</p>
  <p style="float:right;">&nbsp;&#8596;</p>

  <p><small>Watch music video and movies anytime, anywhere — personalized for you.Available on phone and tablet, wherever you go.</small></p>

  <div class="clear"></div>

  <br>
  <br>
  <br>

</div>
<!-- Main content -->
  <section class="content" style="background-color: white;">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
  </section>


<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<script>

$( window ).load( function() {

  $( '.sldr' ).each( function() {
    var th = $( this );
    th.sldr({
      focalClass    : 'focalPoint',
      offset        : th.width() / 2,
      sldrWidth     : 'responsive',
      nextSlide     : th.nextAll( '.sldr-nav.next:first' ),
      previousSlide : th.nextAll( '.sldr-nav.prev:first' ),
      selectors     : th.nextAll( '.selectors:first' ).find( 'li' ),
      toggle        : th.nextAll( '.captions:first' ).find( 'div' ),
      sldrInit      : sliderInit,
      sldrStart     : slideStart,
      sldrComplete  : slideComplete,
      sldrLoaded    : sliderLoaded,
      sldrAuto      : true,
      sldrTime      : 5000,
      hasChange     : true
    });
  });

});

/**
 * Sldr Callbacks
 */

/**
 * When the sldr is initiated, before the DOM is manipulated
 * @param {object} args the slides, callback, and config of the slider
 * @return null
 */
function sliderInit( args ) {

}

/**
 * When individual slides are loaded
 * @param {object} args the slides, callback, and config of the slider
 * @return null
 */
function slideLoaded( args ) {

}

/**
 * When the full slider is loaded, after the DOM is manipulated
 * @param {object} args the slides, callback, and config of the slider
 * @return null
 */
function sliderLoaded( args ) {

}

/**
 * Before the slides change focal points
 * @param {object} args the slides, callback, and config of the slider
 * @return null
 */
function slideStart( args ) {

}

/**
 * After the slides are done changing focal points
 * @param {object} args the slides, callback, and config of the slider
 * @return null
 */
function slideComplete( args ) {

}

</script>
<?php $this->endPage() ?>
