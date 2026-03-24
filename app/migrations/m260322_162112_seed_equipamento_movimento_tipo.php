<?php

use yii\db\Migration;

class m260322_162112_seed_equipamento_movimento_tipo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
          // 2. Insert Seed Data
        $this->batchInsert('{{%equipamento_movimento_tipo}}', ['id', 'tipo_movimento'], [
            [1, 'Saída'],
            [2, 'Entrada'],
            [3, 'Reparação'],
            [4, 'Fim de Vida'],
            [6, 'Re-Avaliação de Estado'],
            [7, 'Transferência Armazém (Saída)'],
            [8, 'Transferência Armazém (Entrada)'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%equipamento_movimento_tipo}}');
    }
}
