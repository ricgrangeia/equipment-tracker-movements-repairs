<?php
/** @var string $url*/
/** @var array $args */
/** @var int $randomId */

Yii::debug($url, __FUNCTION__);
Yii::debug($args, __FUNCTION__);
?>


<?php
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

$url = yii\helpers\Url::toRoute( $url, ['ajax' => true], true );

$dateElementId = Yii::$app->params['SYSTEM_DAY_USER_IN'];

$idLoja = null;
if(!empty($args['idLoja']))
	$idLoja = $args['idLoja'];

$function = null;
if(!empty($args['function']))
	$idLoja = $args['function'];


$this->registerJs(<<< JS

            var buttonClick = false;

            function updateData{$randomId}() {
                
                var date = document.getElementById('{$dateElementId}').value;
              
                let sendData = {
                    'url':'{$url}',
                        'args':{
                         'function': '{$function}',
                        'container': '{$chartContainer}',
                             'date': date,
                           'idLoja': '{$idLoja}'
                    }
                };
                $.ajax({
                    'type': 'POST',
                    'data': {'ajaxData':JSON.stringify(sendData)},
                    'dataType': 'html',
                    'url': '{$url}',

                    success: function (data) {
                        $('#{$chartContainer}').html('');
                        $('#{$scriptContainer}').html(data);
                        
                        if(buttonClick){
                            buttonClick = false;
                            toastr.success('','Dia Carregado com Sucesso!');
                        }
                        
                        setTimeout(updateData{$randomId}, 60000);

                    },
                    
                    error: function (data) {
                        $('#{$scriptContainer}').html('Erro');
                    }
                });
            };

            updateData{$randomId}();

            JS); ?>