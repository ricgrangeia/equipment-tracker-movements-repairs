<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%equipamento_movimento}}`.
 */
class m210608_002529_create_equipamento_movimento_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%equipamento_movimento}}', [
            'id' => $this->primaryKey(),
            'data' => $this->string(10)->notNull(),
            'destino_id' => $this->integer(11)->notNull(),
            'tipo_movimento_id' => $this->integer(11)->notNull(),
            'observacoes' => $this->text()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%equipamento_movimento}}');
    }
}
