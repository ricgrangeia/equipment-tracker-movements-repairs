<?php
/** @var int $randomId */

$scriptContainer = 'script-container-' . $randomId;

$this->registerJs(<<< JS
            
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