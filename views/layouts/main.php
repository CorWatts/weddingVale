<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body style="background: url('/img/<?php echo (isset($this->context->background)) ? $this->context->background : 'background.jpg'; ?>') no-repeat left top fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover">

<?php $this->beginBody() ?>
    <div class="wrap">
        <div id='navbar'>
            <ul id='navbar-links'>
            <li><?php echo Html::a('HOME', array('index')); ?></li>
                <li><?php echo Html::a('RSVP', array('rsvp')); ?></li>
                <li><?php echo Html::a('REGISTRY', array('registry')); ?></li>
                <li><?php echo Html::a('VENUE', array('venue')); ?></li>
            </ul>
        </div>

        <div class="container">
            <?= $content ?>
        </div>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
