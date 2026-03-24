<?php

use yii\db\Migration;

class m260322_171049_seed_funcionario_tipo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
            // 2. Insert Seed Data
        $this->batchInsert('{{%funcionario_tipo}}', ['id', 'tipo'], [
            [1, 'Funcionário'],
            [2, 'Localização'],
            [3, 'Fornecedor'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%funcionario_tipo}}');
    }
}
