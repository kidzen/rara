<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
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
    <body>
        <div class="wrap">

            <?php $this->beginBody() ?>
            <?php
            NavBar::begin([
                'brandLabel' => 'Rara Kitchy',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
//                    'class' => 'navbar-inverse navbar-static-top',
                ],
                'innerContainerOptions' => ['class' => 'container-fluid'],
            ]);
//            $bar = Html::tag('span', '', ['class' => 'icon-bar']);
//            $screenReader = "<span class=\"sr-only\">Toggle navigation</span>";
//            $menuItems1[] = Html::button("{$screenReader}<i class=\"fa fa-bars\" aria-hidden=\"true\"></i>", [
//                        'class' => 'sidebar-toggle',
//                        'role' => 'button',
//                        'data-toggle' => 'offcanvas',
//                        'data-target' => "#sidebar-left}",
//            ]);
//            echo Nav::widget([
//                'options' => ['class' => 'navbar-nav navbar-left'],
//                'items' => $menuItems1,
//            ]);
            $menuItemsLeft = [
                ['label' => 'Accounts', 'url' => ['/account/index']],
                ['label' => 'Stocks', 'url' => ['/raw-material/index']],
                ['label' => 'Clients', 'url' => ['/client/index']],
                ['label' => 'Orders', 'url' => ['/orders/index']],
                ['label' => 'Schedule', 'url' => ['/schedule/my-schedule']],
            ];
            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'About', 'url' => ['/site/about']],
                ['label' => 'Contact', 'url' => ['/site/contact']],
            ];
            if (Yii::$app->user->isGuest) {
//                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                                'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link']
                        )
                        . Html::endForm()
                        . '</li>';
            }
            if (!Yii::$app->user->isGuest) {
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-left'],
                    'items' => $menuItemsLeft,
                ]);
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <!--<div class="container-fluid">-->
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>

                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

