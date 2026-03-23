<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%equipamento_movimento_tipo}}`.
 */
class m210608_011038_create_equipamento_movimento_tipo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%equipamento_movimento_tipo}}', [
            'id' => $this->primaryKey(),
            'tipo_movimento' => $this->string(100)->notNull(),
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
