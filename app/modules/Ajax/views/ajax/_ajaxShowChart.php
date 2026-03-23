<?php
    /** @var string $chartFunction */
    /** @var array $args */
?>
<?= Yii::$app->runAction('/charts/print-prescripts-highcharts'); ?>

<?= Yii::$app->runAction('/charts/print-css-highcharts'); ?>

<?php
$randomId = rand(10000, 99999);
$chartContainer = 'container-'.$randomId;
$scriptContainer = 'script-container-'.$randomId;
?>

<div id="<?=$chartContainer?>"></div>
<div id="<?=$scriptContainer?>">
    <button class="btn btn-primary" type="button" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        <span class="visually-hidden">A carregar...</span>
    </button>
</div>


<?php

$url = yii\helpers\Url::toRoute( 'ajax/htmlcall?ajax=true', true );

$dateElementId = Yii::$app->params['SYSTEM_DAY_USER_IN'];

Yii::debug($args, 'vars');

$idLoja = null;
if(!empty($args['idLoja']))
    $idLoja = $args['idLoja'];

$this->registerJs(<<< JS

            function updateData{$randomId}() {
                var buttonClick = false;
                var date = document.getElementById('{$dateElementId}').value;

                            
                $.ajax({
                    type: 'POST',
                    data: { 'function': '{$chartFunction}','args':['$chartContainer', date, {$idLoja}]},
                    dataType: 'html',
                    url: '{$url}',

                    success: function (data) {
                        $('#{$scriptContainer}').html(data);
                        
                        if(buttonClick){
                            buttonClick = false;
                            toastr.success('','Dia Carregado com Sucesso!');
                        }
                        
                        setTimeout(updateData{$randomId}, 60000);

                    },
                    
                    error: function (data) {
                        alert(JSON.stringify(data));
                    }
                });
            };

            updateData{$randomId}();
            
             function changeDateChart{$randomId}() {
                 $('#{$scriptContainer}').html(
                     '<button class="btn btn-primary" type="button" disabled>'+
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>' +
                        '<span class="visually-hidden">A carregar...</span> ' +
                     '</button>'
                 );
                buttonClick = true;
                updateData{$randomId}();
             };
            
            document.getElementById('loadNewDateChart').addEventListener('click', changeDateChart{$randomId});

            JS); ?>

