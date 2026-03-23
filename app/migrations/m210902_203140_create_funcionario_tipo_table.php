<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%funcionario_tipo}}`.
 */
class m210902_203140_create_funcionario_tipo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%funcionario_tipo}}', [
            'id' => $this->primaryKey(),
            'tipo' => $this->string(50)->notNull()->unique(),
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
