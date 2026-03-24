<?php

// 1. Regista o ficheiro externo
$this->registerJsFile('https://www.googletagmanager.com/gtag/js?id=G-DN053M6RBJ', [
    'async' => true,
    'position' => \yii\web\View::POS_HEAD,
]);

// 2. Regista a configuração inline
$js = <<<JS
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-DN053M6RBJ');
JS;

$this->registerJs($js, \yii\web\View::POS_HEAD);

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap4\Modal;
use yii\widgets\Pjax;
\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
\hail812\adminlte3\assets\PluginAsset::register($this)->add(['sweetalert2', 'toastr']);

$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');
$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">
    <?php
    Pjax::begin(['id' => 'pjax-flash-messages',  'timeout' => false]);
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
        //echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
            $this->registerJs("
            // Set the options that I want
                toastr.options = {
                  'closeButton': true,
                  'newestOnTop': false,
                  'progressBar': true,
                  'positionClass': 'toast-top-right',
                  'preventDuplicates': false,
                  'onclick': null,
                  'showDuration': '300',
                  'hideDuration': '1000',
                  'timeOut': '5000',
                  'extendedTimeOut': '1000',
                  'showEasing': 'swing',
                  'hideEasing': 'linear',
                  'showMethod': 'fadeIn',
                  'hideMethod': 'fadeOut'
                }
            
            toastr.success('$message'); ");
        }
    Pjax::end();
    ?>
    <!-- Navbar -->
    <?php if (!Yii::$app->user->isGuest) { ?>
        <?= $this->render('navbar', ['assetDir' => $assetDir]) ?>
    <?php } ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php if (!Yii::$app->user->isGuest) { ?>
        <?= $this->render('sidebar', ['assetDir' => $assetDir]) ?>
    <?php } ?>

    <!-- Content Wrapper. Contains page content -->
    <?= $this->render('content', ['content' => $content, 'assetDir' => $assetDir]) ?>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <?php if (!Yii::$app->user->isGuest) { ?>
        <?= $this->render('control-sidebar') ?>
    <?php } ?>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?php if (!Yii::$app->user->isGuest) { ?>
        <?= $this->render('footer') ?>
    <?php } ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


<?php
//Modal::begin([
//    'headerOptions' => ['id' => 'modalHeader'],
//    'id' => 'modal',
//    'size' => 'modal-lg',
//    'centerVertical' => true,
//    'scrollable' => true,
//    //keeps from closing modal with esc key or by clicking out of the modal.
//    // user must click cancel or X to close
//    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
//]);
//echo "<div id='modalContent'></div>";
//Modal::end();
//?>

