<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%funcionario}}`.
 */
class m210603_101132_create_funcionario_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%funcionario}}', [
            'id' => $this->primaryKey(),
            'ativo' => $this->boolean()->defaultValue(true),
            'nome' => $this->string(150)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%funcionario}}');
    }
}
