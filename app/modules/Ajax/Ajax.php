<?php

namespace app\modules\Ajax;

use Yii;

final class Ajax{

	public static function createAjaxCall(string $idDiv, string $function, array $args, int $refreshTime = 30000): string{

		$data = \yii\helpers\Json::htmlEncode( [
			'function' => $function,
			'args' => $args,
		] );
		$url = yii\helpers\Url::toRoute( 'ajax/htmlcall?ajax=true', true);

		return "
                    function updateData$idDiv(){ 
                    
                    
                    
                         $.ajax({ 
                            type: 'POST',
                            data: $data,
                            dataType: 'html',
                            url:'$url', 
                            async: true,
                            success: function(data){    
                                $('#$idDiv').html(data);
                                setTimeout( updateData$idDiv , $refreshTime);
                               
                            },
                            error: function(data){
                                alert(JSON.stringify(data));
                            }      
                        });
                    };
                    
                   updateData$idDiv();
                     
                " ;


	}


	public static function createAsyncajaxCall(string $idDiv, string $function, array $args, int $refreshTime = 10000): string{

		$data = \yii\helpers\Json::htmlEncode( [
			'function' => $function,
			'args' => $args,
		] );
		$url = yii\helpers\Url::toRoute( 'ajax/htmlcall?ajax=true', true);

		return "
              
					setTimeout('updateData$idDiv()',1000); // Aqui eu chamo a função após 2s quando a página for carregada
				

                    function updateData$idDiv(){ 
                        $.ajax({ 
                            type: 'POST',
                            data: $data,
                            dataType: 'html',
                            url:'$url', 
                            async: 'true',
                   
                        }).done(function (data) { 
							a = true;
							$('#$idDiv').html(data); // Aqui eu jogo o retorno do Ajax dentro da div
							setTimeout('updateData$idDiv()',$refreshTime); // Novamente chamo a função após 2s quando o Ajax for completado
    					});
                    };
                   updateData$idDiv()
                " ;

	}
}
